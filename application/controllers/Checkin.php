<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Checkin Controller – FUTA Career Services & Career Fair Portal
 *
 * Three roles can use the check-in system:
 *   superadmin / admin  – full access (scanner + attendance board + report)
 *   checkin_officer     – scanner + attendance board only
 *
 * URL structure:
 *   /checkin            → login (if not authed) or redirect to scanner
 *   /checkin/scan       → camera-based QR scanner
 *   /checkin/verify     → AJAX API: validate pass code, record check-in
 *   /checkin/attendance → live attendance board (present students & employers)
 *   /checkin/report     → full check-in log with export
 *   /checkin/logout     → destroy session, back to login
 */
class Checkin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('Admin_model');
    }

    /* ── Auth guard ─────────────────────────────────────────── */
    private function _guard() {
        $uid  = $this->session->userdata('userid');
        $role = $this->session->userdata('role');
        $ok   = $uid && in_array($role, ['admin', 'superadmin', 'checkin_officer']);
        if (!$ok) { redirect('checkin/login'); return false; }
        return true;
    }

    /* ── Audit log helper ───────────────────────────────────── */
    private function _audit($action, $table = null, $record_id = null, $detail = null) {
        if (!$this->db->table_exists('cf_audit_logs')) return;
        $this->db->insert('cf_audit_logs', [
            'user_type'  => 'admin',
            'user_id'    => $this->session->userdata('userid'),
            'action'     => $action,
            'table_name' => $table,
            'record_id'  => $record_id,
            'new_values' => $detail,
            'ip_address' => $this->input->ip_address(),
        ]);
    }

    /* ════════════════════════════════════════════════════════
       AUTH
    ════════════════════════════════════════════════════════ */

    public function index() {
        $uid = $this->session->userdata('userid');
        if ($uid && in_array($this->session->userdata('role'), ['admin','superadmin','checkin_officer'])) {
            redirect('checkin/scan');
        }
        redirect('checkin/login');
    }

    public function login() {
        if ($this->session->userdata('userid')) { redirect('checkin/scan'); return; }
        $this->load->view('checkin/login');
    }

    public function do_login() {
        $newtoken = $this->security->get_csrf_hash();
        $result   = $this->Admin_model->validate();   // reuses admin validate
        if ($result == 1) {
            $this->session->set_userdata('role', $this->session->userdata('userdata')['usergroup'] ?? 'checkin_officer');
            $this->_audit('CHECKIN_LOGIN');
        }
        echo json_encode(['token' => $newtoken, 'result' => $result]);
        exit;
    }

    public function logout() {
        $this->_audit('CHECKIN_LOGOUT');
        $this->session->sess_destroy();
        redirect('checkin/login');
    }

    /* ════════════════════════════════════════════════════════
       QR SCANNER  (camera page)
    ════════════════════════════════════════════════════════ */

    public function scan() {
        if (!$this->_guard()) return;
        $data['officer']  = $this->session->userdata('userdata');
        $data['settings'] = $this->Admin_model->retrievesettings();
        $this->load->view('checkin/scan', $data);
    }

    /* ════════════════════════════════════════════════════════
       VERIFY API  (AJAX – called by scanner every decode)
       POST params: pass_code, location (optional)
       Returns JSON with attendee info + check-in result
    ════════════════════════════════════════════════════════ */

    public function verify() {
        // Must be an auth'd session OR a valid API call
        if (!$this->session->userdata('userid')) {
            header('Content-Type: application/json');
            echo json_encode(['result' => -1, 'message' => 'Unauthorised']);
            exit;
        }

        $pass_code = trim($this->input->post('pass_code'));
        $location  = $this->input->post('location') ?: 'Main Entrance';
        $token     = $this->security->get_csrf_hash();

        if (empty($pass_code)) {
            echo json_encode(['token'=>$token, 'result'=>0, 'message'=>'No pass code received']);
            exit;
        }

        // 1. Look up the QR pass
        if (!$this->db->table_exists('cf_qr_passes')) {
            echo json_encode(['token'=>$token, 'result'=>-2, 'message'=>'QR pass table not found']);
            exit;
        }

        $pass = $this->db->get_where('cf_qr_passes', [
            'pass_code'  => $pass_code,
            'is_revoked' => 0,
        ])->row();

        if (!$pass) {
            echo json_encode(['token'=>$token, 'result'=>-3, 'message'=>'Invalid or revoked pass code']);
            exit;
        }

        // 2. Get attendee info
        $attendee = $this->_get_attendee($pass->user_id, $pass->user_type);
        if (!$attendee) {
            echo json_encode(['token'=>$token, 'result'=>-4, 'message'=>'Attendee record not found']);
            exit;
        }

        // 3. Check for duplicate scan today
        $already_in = false;
        if ($this->db->table_exists('cf_event_checkins')) {
            $today_start = date('Y-m-d') . ' 00:00:00';
            $today_end   = date('Y-m-d') . ' 23:59:59';
            $this->db->where('pass_id',     $pass->pass_id);
            $this->db->where('checkin_time >=', $today_start);
            $this->db->where('checkin_time <=', $today_end);
            $count = $this->db->count_all_results('cf_event_checkins');
            $already_in = ($count > 0);
        }

        // 4. Record the check-in (always record — multiple entries = multiple scans)
        if ($this->db->table_exists('cf_event_checkins')) {
            $this->db->insert('cf_event_checkins', [
                'pass_id'       => $pass->pass_id,
                'fair_id'       => $pass->fair_id ?? 1,
                'scanned_by'    => $this->session->userdata('userid'),
                'location'      => $location,
                'checkin_time'  => date('Y-m-d H:i:s'),
            ]);
        }

        // 5. Mark student fair_registered if not already (auto-activate on scan)
        if ($pass->user_type === 'student' && $this->db->table_exists('cf_students')) {
            $this->db->where('student_id', $pass->user_id);
            $this->db->update('cf_students', [
                'accstatus'       => 'active',
                'fair_registered' => 1,
            ]);
        }

        $this->_audit('QR_CHECKIN', 'cf_event_checkins', $pass->pass_id, $pass_code);

        // 6. Build response
        $response = [
            'token'       => $token,
            'result'      => 1,
            'already_in'  => $already_in,
            'pass_code'   => $pass_code,
            'user_type'   => $pass->user_type,
            'name'        => $attendee['name'],
            'detail'      => $attendee['detail'],
            'photo'       => $attendee['photo'],
            'time'        => date('H:i:s'),
            'message'     => $already_in ? 'Welcome back!' : 'Checked in successfully!',
        ];

        header('Content-Type: application/json');
        echo json_encode($response);
        exit;
    }

    /* ── Helper: get attendee name/detail/photo ─────────────── */
    private function _get_attendee($user_id, $user_type) {
        if ($user_type === 'student' && $this->db->table_exists('cf_students')) {
            $r = $this->db->get_where('cf_students', ['student_id' => $user_id])->row();
            if (!$r) return null;
            $schools = [1=>'SEET',2=>'SOC',3=>'SAAT',4=>'SEMS',5=>'SET',6=>'SMAT',7=>'SOS',8=>'SHHT'];
            return [
                'name'   => $r->fullname,
                'detail' => ($schools[$r->school_id] ?? 'FUTA') . ' · ' . ($r->level ?? '') . ' Level · ' . ($r->matric_no ?? ''),
                'photo'  => !empty($r->passport) ? base_url('uploads/photos/' . $r->passport) : '',
            ];
        }
        if ($user_type === 'employer' && $this->db->table_exists('cf_employers')) {
            $r = $this->db->get_where('cf_employers', ['employer_id' => $user_id])->row();
            if (!$r) return null;
            return [
                'name'   => $r->org_name,
                'detail' => ($r->contact_name ?? '') . ' · ' . ($r->contact_designation ?? '') . ' · ' . ($r->org_type ?? ''),
                'photo'  => !empty($r->logo) ? base_url('uploads/logos/' . $r->logo) : '',
            ];
        }
        if ($user_type === 'alumni' && $this->db->table_exists('cf_alumni')) {
            $r = $this->db->get_where('cf_alumni', ['alumni_id' => $user_id])->row();
            if (!$r) return null;
            return [
                'name'   => $r->fullname,
                'detail' => ($r->current_org ?? '') . ' · Class of ' . ($r->grad_year ?? ''),
                'photo'  => !empty($r->photo) ? base_url('uploads/photos/' . $r->photo) : '',
            ];
        }
        return null;
    }

    /* ════════════════════════════════════════════════════════
       ATTENDANCE BOARD  (live list of who is present today)
    ════════════════════════════════════════════════════════ */

    public function attendance() {
        if (!$this->_guard()) return;

        $data['settings'] = $this->Admin_model->retrievesettings();
        $data['officer']  = $this->session->userdata('userdata');
        $data['filter']   = $this->input->get('type') ?: 'all';
        $data['date']     = $this->input->get('date')  ?: date('Y-m-d');

        if (!$this->db->table_exists('cf_event_checkins') || !$this->db->table_exists('cf_qr_passes')) {
            $data['checkins']        = [];
            $data['total_students']  = 0;
            $data['total_employers'] = 0;
            $data['total_all']       = 0;
            $this->load->view('checkin/attendance', $data);
            return;
        }

        $date_start = $data['date'] . ' 00:00:00';
        $date_end   = $data['date'] . ' 23:59:59';

        // Unique attendees today (latest check-in per pass)
        $this->db->select('ci.pass_id, ci.location, ci.checkin_time, qr.pass_code, qr.user_type, qr.user_id');
        $this->db->from('cf_event_checkins ci');
        $this->db->join('cf_qr_passes qr', 'ci.pass_id = qr.pass_id', 'inner');
        $this->db->where('ci.checkin_time >=', $date_start);
        $this->db->where('ci.checkin_time <=', $date_end);
        if ($data['filter'] !== 'all') {
            $this->db->where('qr.user_type', $data['filter']);
        }
        $this->db->order_by('ci.checkin_time', 'DESC');
        $raw = $this->db->get()->result();

        // Deduplicate by pass_id (keep first = most recent)
        $seen = [];
        $unique = [];
        foreach ($raw as $r) {
            if (!isset($seen[$r->pass_id])) {
                $seen[$r->pass_id] = true;
                $unique[] = $r;
            }
        }

        // Enrich each with name/detail
        $checkins = [];
        foreach ($unique as $r) {
            $info = $this->_get_attendee($r->user_id, $r->user_type);
            $checkins[] = (object)[
                'pass_code'    => $r->pass_code,
                'user_type'    => $r->user_type,
                'name'         => $info['name']   ?? 'Unknown',
                'detail'       => $info['detail'] ?? '',
                'photo'        => $info['photo']  ?? '',
                'location'     => $r->location,
                'checkin_time' => $r->checkin_time,
            ];
        }

        $data['checkins']        = $checkins;
        $data['total_all']       = count($checkins);
        $data['total_students']  = count(array_filter($unique, fn($r) => $r->user_type === 'student'));
        $data['total_employers'] = count(array_filter($unique, fn($r) => $r->user_type === 'employer'));

        $this->load->view('checkin/attendance', $data);
    }

    /* ════════════════════════════════════════════════════════
       REPORT  (full log, all scans)
    ════════════════════════════════════════════════════════ */

    public function report() {
        if (!$this->_guard()) return;

        $data['settings'] = $this->Admin_model->retrievesettings();
        $data['officer']  = $this->session->userdata('userdata');

        if ($this->db->table_exists('cf_event_checkins') && $this->db->table_exists('cf_qr_passes')) {
            $this->db->select('ci.*, qr.pass_code, qr.user_type, qr.user_id, pu.username AS scanned_by_name');
            $this->db->from('cf_event_checkins ci');
            $this->db->join('cf_qr_passes qr',   'ci.pass_id = qr.pass_id', 'left');
            $this->db->join('profile_user pu',   'ci.scanned_by = pu.auto_id', 'left');
            $this->db->order_by('ci.checkin_time', 'DESC');
            $this->db->limit(500);
            $raw = $this->db->get()->result();

            // Enrich
            $data['logs'] = array_map(function($r) {
                $info = $this->_get_attendee($r->user_id, $r->user_type);
                $r->name   = $info['name']   ?? 'Unknown';
                $r->detail = $info['detail'] ?? '';
                return $r;
            }, $raw);
        } else {
            $data['logs'] = [];
        }

        $data['total_scans']  = count($data['logs']);
        $this->load->view('checkin/report', $data);
    }
}
