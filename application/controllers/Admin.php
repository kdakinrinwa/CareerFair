<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Admin Controller – FUTA Career Services & Career Fair Portal
 * Super Admin: manages students, employers, alumni, events,
 * site settings, news, QR passes, reports and audit logs.
 */
class Admin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('Admin_model');
    }

    /* ── Auth guard ─────────────────────────────────────────── */
    private function _guard() {
        $uid  = $this->session->userdata('userid');
        $role = $this->session->userdata('role');
        if (!$uid || !in_array($role, ['admin', 'superadmin'])) {
            redirect('admin/login');
            return false;
        }
        return true;
    }

    /* ── Shared view data ───────────────────────────────────── */
    private function _data($page_title = '') {
        $data = [];
        $data['page_title'] = $page_title;
        $data['admin_user'] = $this->session->userdata('userdata');
        $data['settings']   = $this->Admin_model->retrievesettings();
        $data['css']        = $this->load->view('admin/admin_css', '', TRUE);
        $data['sidebar']    = $this->load->view('admin/admin_sidebar', $data, TRUE);
        return $data;
    }

    /* ── Log audit event ────────────────────────────────────── */
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

    public function index() { redirect('admin/login'); }

    public function login() {
        if ($this->session->userdata('userid') && in_array($this->session->userdata('role'), ['admin','superadmin'])) {
            redirect('admin/dashboard');
        }
        $this->load->view('admin/login');
    }

    public function validate() {
        $newtoken = $this->security->get_csrf_hash();
        $result   = $this->Admin_model->validate();
        // validate() sets session on success; fix role to 'admin'
        if ($result == 1) {
            $this->session->set_userdata('role', 'admin');
            $this->_audit('LOGIN');
        }
        echo json_encode(['token' => $newtoken, 'result' => $result]);
        exit;
    }

    public function signout() {
        $this->_audit('LOGOUT');
        $this->Admin_model->signout();
        redirect('admin/login');
    }

    public function changepass() {
        if (!$this->_guard()) return;
        $data = $this->_data('Change Password');
        $this->load->view('admin/changepass', $data);
    }

    public function resetpassword() {
        if (!$this->_guard()) { echo json_encode(['result' => -1]); return; }
        $newtoken = $this->security->get_csrf_hash();
        $result   = $this->Admin_model->resetpassword();
        if ($result == 1) $this->_audit('CHANGE_PASSWORD');
        echo json_encode(['token' => $newtoken, 'result' => $result]);
        exit;
    }

    /* ════════════════════════════════════════════════════════
       DASHBOARD
    ════════════════════════════════════════════════════════ */

    public function dashboard() {
        if (!$this->_guard()) return;
        $data = $this->_data('Dashboard');
        // Stats
        $data['total_students']  = $this->db->table_exists('cf_students')  ? $this->db->count_all('cf_students')  : 0;
        $data['total_employers'] = $this->db->table_exists('cf_employers') ? $this->db->count_all('cf_employers') : 0;
        $data['total_alumni']    = $this->db->table_exists('cf_alumni')    ? $this->db->count_all('cf_alumni')    : 0;
        $data['total_cvs']       = $this->db->table_exists('cf_student_cvs') ? $this->db->where('is_active',1)->count_all_results('cf_student_cvs') : 0;
        $data['total_booths']    = $this->db->table_exists('cf_booth_requests') ? $this->db->count_all('cf_booth_requests') : 0;
        $data['total_talks']     = $this->db->table_exists('cf_career_talks')   ? $this->db->count_all('cf_career_talks')   : 0;
        $data['total_qr']        = $this->db->table_exists('cf_qr_passes')      ? $this->db->where('is_revoked',0)->count_all_results('cf_qr_passes') : 0;
        $data['total_checkins']  = $this->db->table_exists('cf_event_checkins') ? $this->db->count_all('cf_event_checkins') : 0;
        $data['pending_employers'] = $this->db->table_exists('cf_employers') ? $this->db->where('accstatus','pending')->count_all_results('cf_employers') : 0;
        $data['pending_students']  = $this->db->table_exists('cf_students')  ? $this->db->where('accstatus','pending')->count_all_results('cf_students')  : 0;
        // Recent registrations
        $data['recent_students']  = $this->db->table_exists('cf_students')  ? $this->db->order_by('created_at','DESC')->limit(6)->get('cf_students')->result()  : [];
        $data['recent_employers'] = $this->db->table_exists('cf_employers') ? $this->db->order_by('created_at','DESC')->limit(5)->get('cf_employers')->result() : [];
        // Recent audit log
        $data['recent_logs'] = $this->db->table_exists('cf_audit_logs') ? $this->db->order_by('created_at','DESC')->limit(8)->get('cf_audit_logs')->result() : [];
        $this->load->view('admin/dashboard', $data);
    }

    /* ════════════════════════════════════════════════════════
       STUDENTS MANAGEMENT
    ════════════════════════════════════════════════════════ */

    public function students() {
        if (!$this->_guard()) return;
        $data = $this->_data('Students');
        $search = $this->input->get('q');
        $school = $this->input->get('school');
        $status = $this->input->get('status');
        if ($this->db->table_exists('cf_students')) {
            if ($search) $this->db->like('fullname',$search)->or_like('matric_no',$search)->or_like('email',$search);
            if ($school) $this->db->where('school_id',(int)$school);
            if ($status) $this->db->where('accstatus',$status);
            $this->db->order_by('created_at','DESC');
            $data['students'] = $this->db->get('cf_students')->result();
        } else { $data['students'] = []; }
        $this->load->view('admin/students', $data);
    }

    public function view_student() {
        if (!$this->_guard()) return;
        $id   = (int)$this->uri->segment(3);
        $data = $this->_data('Student Profile');
        $data['student'] = $this->db->get_where('cf_students',['student_id'=>$id])->row();
        $data['cv']      = $this->db->table_exists('cf_student_cvs') ? $this->db->where(['student_id'=>$id,'is_active'=>1])->get('cf_student_cvs')->row() : null;
        $data['qr']      = $this->db->table_exists('cf_qr_passes')   ? $this->db->where(['user_id'=>$id,'user_type'=>'student','is_revoked'=>0])->get('cf_qr_passes')->row() : null;
        $data['shortlists'] = $this->db->table_exists('cf_candidate_shortlists') ? $this->db->select('sl.*,e.org_name')->from('cf_candidate_shortlists sl')->join('cf_employers e','sl.employer_id=e.employer_id','left')->where('sl.student_id',$id)->get()->result() : [];
        $this->load->view('admin/view_student', $data);
    }

    // AJAX: toggle student status
    public function toggle_student_status() {
        if (!$this->_guard()) { echo 0; return; }
        $id     = (int)$this->input->post('id');
        $status = $this->input->post('status');
        $allowed = ['active','inactive','pending'];
        if (!in_array($status,$allowed)) { echo 0; return; }
        $this->db->where('student_id',$id)->update('cf_students',['accstatus'=>$status]);
        $this->_audit('UPDATE_STUDENT_STATUS','cf_students',$id,"status=$status");
        echo 1;
    }

    /* ════════════════════════════════════════════════════════
       EMPLOYERS MANAGEMENT
    ════════════════════════════════════════════════════════ */

    public function employers() {
        if (!$this->_guard()) return;
        $data = $this->_data('Employers');
        $search = $this->input->get('q');
        $status = $this->input->get('status');
        if ($this->db->table_exists('cf_employers')) {
            if ($search) $this->db->like('org_name',$search)->or_like('contact_email',$search);
            if ($status) $this->db->where('accstatus',$status);
            $this->db->order_by('created_at','DESC');
            $data['employers'] = $this->db->get('cf_employers')->result();
        } else { $data['employers'] = []; }
        $this->load->view('admin/employers', $data);
    }

    public function view_employer() {
        if (!$this->_guard()) return;
        $id   = (int)$this->uri->segment(3);
        $data = $this->_data('Employer Profile');
        $data['employer']    = $this->db->get_where('cf_employers',['employer_id'=>$id])->row();
        $data['booth']       = $this->db->table_exists('cf_booth_requests')       ? $this->db->get_where('cf_booth_requests',['employer_id'=>$id])->row() : null;
        $data['talk']        = $this->db->table_exists('cf_career_talks')         ? $this->db->get_where('cf_career_talks',['employer_id'=>$id])->row() : null;
        $data['shortlists']  = $this->db->table_exists('cf_candidate_shortlists') ? $this->db->where('employer_id',$id)->count_all_results('cf_candidate_shortlists') : 0;
        $data['opps']        = $this->db->table_exists('cf_job_opportunities')    ? $this->db->where('employer_id',$id)->get('cf_job_opportunities')->result() : [];
        $this->load->view('admin/view_employer', $data);
    }

    // AJAX: approve / suspend employer
    public function toggle_employer_status() {
        if (!$this->_guard()) { echo 0; return; }
        $id     = (int)$this->input->post('id');
        $status = $this->input->post('status');
        $allowed = ['approved','pending','suspended'];
        if (!in_array($status,$allowed)) { echo 0; return; }
        $this->db->where('employer_id',$id)->update('cf_employers',['accstatus'=>$status]);
        $this->_audit('UPDATE_EMPLOYER_STATUS','cf_employers',$id,"status=$status");
        echo 1;
    }

    /* ════════════════════════════════════════════════════════
       BOOTH MANAGEMENT
    ════════════════════════════════════════════════════════ */

    public function booths() {
        if (!$this->_guard()) return;
        $data = $this->_data('Booth Requests');
        $data['booths'] = $this->db->table_exists('cf_booth_requests')
            ? $this->db->select('br.*,e.org_name,e.contact_name,e.contact_email')->from('cf_booth_requests br')->join('cf_employers e','br.employer_id=e.employer_id','left')->order_by('br.requested_at','DESC')->get()->result()
            : [];
        $this->load->view('admin/booths', $data);
    }

    public function approve_booth() {
        if (!$this->_guard()) { echo 0; return; }
        $id     = (int)$this->input->post('id');
        $status = $this->input->post('status');
        $booth_num = $this->input->post('booth_number');
        $location  = $this->input->post('booth_location');
        $update = ['status'=>$status];
        if ($booth_num) $update['booth_number']   = $booth_num;
        if ($location)  $update['booth_location']  = $location;
        $this->db->where('booth_req_id',$id)->update('cf_booth_requests',$update);
        $this->_audit('UPDATE_BOOTH','cf_booth_requests',$id,"status=$status");
        echo 1;
    }

    /* ════════════════════════════════════════════════════════
       CAREER TALKS
    ════════════════════════════════════════════════════════ */

    public function talks() {
        if (!$this->_guard()) return;
        $data = $this->_data('Career Talk Requests');
        $data['talks'] = $this->db->table_exists('cf_career_talks')
            ? $this->db->order_by('requested_at','DESC')->get('cf_career_talks')->result()
            : [];
        $this->load->view('admin/talks', $data);
    }

    public function approve_talk() {
        if (!$this->_guard()) { echo 0; return; }
        $id     = (int)$this->input->post('id');
        $status = $this->input->post('status');
        $this->db->where('talk_id',$id)->update('cf_career_talks',['status'=>$status]);
        $this->_audit('UPDATE_TALK','cf_career_talks',$id,"status=$status");
        echo 1;
    }

    /* ════════════════════════════════════════════════════════
       NEWS / ANNOUNCEMENTS
    ════════════════════════════════════════════════════════ */

    public function news() {
        if (!$this->_guard()) return;
        $data = $this->_data('News & Announcements');
        $data['news'] = $this->Admin_model->retrievenews();
        $this->load->view('admin/news', $data);
    }

    public function add_news() {
        if (!$this->_guard()) return;
        $data = $this->_data('Add News');
        $this->load->view('admin/add_news', $data);
    }

    public function save_news() {
        if (!$this->_guard()) { echo 0; return; }
        $file     = $_FILES['thumbnail']['name'] ?? '';
        $filename = '';
        if (!empty($file)) {
            $ext      = strtolower(pathinfo($file, PATHINFO_EXTENSION));
            $filename = 'news_'.time().'.'.$ext;
            $config   = ['upload_path'=>'./uploads/events/','allowed_types'=>'jpg|jpeg|png','max_size'=>3000,'file_name'=>$filename,'overwrite'=>TRUE];
            $this->load->library('upload',$config);
            if (!$this->upload->do_upload('thumbnail')) $filename = '';
        }
        $result = $this->Admin_model->submit_news($filename);
        if ($result == 1) $this->_audit('CREATE_NEWS','news',null,$this->input->post('title'));
        echo $result;
    }

    public function edit_news() {
        if (!$this->_guard()) return;
        $id   = (int)$this->uri->segment(3);
        $data = $this->_data('Edit News');
        $data['item'] = $this->Admin_model->findanews($id);
        $this->load->view('admin/edit_news', $data);
    }

    public function update_news() {
        if (!$this->_guard()) { echo 0; return; }
        $newsid   = (int)$this->input->post('newsid');
        $filename = $this->input->post('thumbnail');
        $file     = $_FILES['thumbnail']['name'] ?? '';
        if (!empty($file)) {
            $ext      = strtolower(pathinfo($file, PATHINFO_EXTENSION));
            $filename = 'news_'.$newsid.'.'.$ext;
            $config   = ['upload_path'=>'./uploads/events/','allowed_types'=>'jpg|jpeg|png','max_size'=>3000,'file_name'=>$filename,'overwrite'=>TRUE];
            $this->load->library('upload',$config);
            if (!$this->upload->do_upload('thumbnail')) $filename = $this->input->post('thumbnail');
        }
        $result = $this->Admin_model->update_news($newsid, $filename);
        if ($result == 1) $this->_audit('UPDATE_NEWS','news',$newsid);
        echo $result;
    }

    public function delete_news() {
        if (!$this->_guard()) { echo 0; return; }
        $result = $this->Admin_model->deleteanews();
        $this->_audit('DELETE_NEWS','news',(int)$this->input->post('newsid'));
        echo $result;
    }

    /* ════════════════════════════════════════════════════════
       QR PASS MANAGEMENT
    ════════════════════════════════════════════════════════ */

    public function qr_passes() {
        if (!$this->_guard()) return;
        $data = $this->_data('QR Event Passes');
        if ($this->db->table_exists('cf_qr_passes') && $this->db->table_exists('cf_students')) {
            $this->db->select('qr.*, s.fullname, s.matric_no, s.email, s.level');
            $this->db->from('cf_qr_passes qr');
            $this->db->join('cf_students s','s.student_id=qr.user_id AND qr.user_type="student"','left');
            $this->db->order_by('qr.issued_at','DESC');
            $data['passes'] = $this->db->get()->result();
        } else { $data['passes'] = []; }
        $this->load->view('admin/qr_passes', $data);
    }

    public function revoke_qr() {
        if (!$this->_guard()) { echo 0; return; }
        $id = (int)$this->input->post('pass_id');
        $this->db->where('pass_id',$id)->update('cf_qr_passes',['is_revoked'=>1,'revoked_at'=>date('Y-m-d H:i:s')]);
        $this->_audit('REVOKE_QR','cf_qr_passes',$id);
        echo 1;
    }

    /* ════════════════════════════════════════════════════════
       OPPORTUNITIES / JOBS
    ════════════════════════════════════════════════════════ */

    public function opportunities() {
        if (!$this->_guard()) return;
        $data = $this->_data('Job & Internship Opportunities');
        if ($this->db->table_exists('cf_job_opportunities')) {
            $this->db->select('o.*,e.org_name')->from('cf_job_opportunities o')->join('cf_employers e','o.employer_id=e.employer_id','left')->order_by('o.created_at','DESC');
            $data['opps'] = $this->db->get()->result();
        } else { $data['opps'] = []; }
        $this->load->view('admin/opportunities', $data);
    }

    public function toggle_opp_status() {
        if (!$this->_guard()) { echo 0; return; }
        $id     = (int)$this->input->post('id');
        $status = $this->input->post('status');
        $this->db->where('opp_id',$id)->update('cf_job_opportunities',['status'=>$status]);
        $this->_audit('UPDATE_OPP_STATUS','cf_job_opportunities',$id,"status=$status");
        echo 1;
    }

    /* ════════════════════════════════════════════════════════
       REPORTS
    ════════════════════════════════════════════════════════ */

    public function reports() {
        if (!$this->_guard()) return;
        $data = $this->_data('Reports & Analytics');
        // Registration by school
        $data['reg_by_school'] = [];
        if ($this->db->table_exists('cf_students') && $this->db->table_exists('cf_schools')) {
            $data['reg_by_school'] = $this->db->select('sc.school_name, COUNT(s.student_id) as total')->from('cf_students s')->join('cf_schools sc','s.school_id=sc.school_id','left')->group_by('s.school_id')->order_by('total','DESC')->get()->result();
        }
        // CV upload rate
        $data['cv_rate'] = ($data['total_students'] ?? 0) > 0 && $this->db->table_exists('cf_student_cvs')
            ? round($this->db->where('is_active',1)->count_all_results('cf_student_cvs') / max(1,$this->db->count_all('cf_students')) * 100)
            : 0;
        // Employer sectors
        $data['emp_by_sector'] = [];
        if ($this->db->table_exists('cf_employers') && $this->db->table_exists('cf_industries')) {
            $data['emp_by_sector'] = $this->db->select('i.industry_name, COUNT(e.employer_id) as total')->from('cf_employers e')->join('cf_industries i','e.industry_id=i.industry_id','left')->group_by('e.industry_id')->order_by('total','DESC')->get()->result();
        }
        // Recent activity totals
        $data['total_students']    = $this->db->table_exists('cf_students')          ? $this->db->count_all('cf_students')          : 0;
        $data['total_employers']   = $this->db->table_exists('cf_employers')         ? $this->db->count_all('cf_employers')         : 0;
        $data['total_cvs']         = $this->db->table_exists('cf_student_cvs')       ? $this->db->where('is_active',1)->count_all_results('cf_student_cvs') : 0;
        $data['total_booths']      = $this->db->table_exists('cf_booth_requests')    ? $this->db->count_all('cf_booth_requests')    : 0;
        $data['total_shortlists']  = $this->db->table_exists('cf_candidate_shortlists') ? $this->db->count_all('cf_candidate_shortlists') : 0;
        $data['total_qr']          = $this->db->table_exists('cf_qr_passes')         ? $this->db->where('is_revoked',0)->count_all_results('cf_qr_passes') : 0;
        $data['total_checkins']    = $this->db->table_exists('cf_event_checkins')    ? $this->db->count_all('cf_event_checkins')    : 0;
        $data['total_opps']        = $this->db->table_exists('cf_job_opportunities') ? $this->db->where('status','active')->count_all_results('cf_job_opportunities') : 0;
        $this->load->view('admin/reports', $data);
    }

    /* ════════════════════════════════════════════════════════
       AUDIT LOG
    ════════════════════════════════════════════════════════ */

    public function audit_log() {
        if (!$this->_guard()) return;
        $data = $this->_data('Audit Log');
        $data['logs'] = $this->db->table_exists('cf_audit_logs')
            ? $this->db->order_by('created_at','DESC')->limit(200)->get('cf_audit_logs')->result()
            : [];
        $this->load->view('admin/audit_log', $data);
    }

    /* ════════════════════════════════════════════════════════
       SITE SETTINGS
    ════════════════════════════════════════════════════════ */

    public function settings() {
        if (!$this->_guard()) return;
        $data = $this->_data('Site Settings');
        $data['setting'] = $this->Admin_model->retrievesettings();
        $this->load->view('admin/settings', $data);
    }

    public function save_settings() {
        if (!$this->_guard()) { echo 0; return; }
        $result = $this->Admin_model->save_siteinfo();
        if ($result == 1) $this->_audit('UPDATE_SETTINGS','settings',1);
        echo $result;
    }

    /* ════════════════════════════════════════════════════════
       CONTACT MESSAGES / NEWSLETTER
    ════════════════════════════════════════════════════════ */

    public function messages() {
        if (!$this->_guard()) return;
        $data = $this->_data('Contact Messages');
        $data['messages']    = $this->Admin_model->retrieve_contact_messages();
        $data['newsletters'] = $this->Admin_model->retrieve_newsletter();
        $this->load->view('admin/messages', $data);
    }

    /* ════════════════════════════════════════════════════════
       ADMIN USER MANAGEMENT (Super Admin only)
    ════════════════════════════════════════════════════════ */

    public function admins() {
        if (!$this->_guard()) return;
        $data = $this->_data('Admin Users');
        $data['admins'] = $this->db->get('profile_user')->result();
        $this->load->view('admin/admins', $data);
    }

    public function save_admin() {
        if (!$this->_guard()) { echo json_encode(['result'=>-1]); return; }
        $auto_id  = (int)$this->input->post('auto_id');
        $username = strtolower(trim($this->input->post('username')));
        $fullname = $this->input->post('fullname');
        $email    = $this->input->post('email');
        $group    = $this->input->post('usergroup');
        $status   = $this->input->post('accstatus');
        $token    = $this->security->get_csrf_hash();
        $data_row = ['username'=>$username,'fullname'=>$fullname,'email'=>$email,'usergroup'=>$group,'accstatus'=>$status];
        $pw = $this->input->post('password');
        if ($pw) $data_row['password'] = md5($pw);
        if ($auto_id) {
            $this->db->where('auto_id',$auto_id)->update('profile_user',$data_row);
            $result = 3;
        } else {
            $this->db->where('username',$username);
            if ($this->db->get('profile_user')->num_rows()) { echo json_encode(['token'=>$token,'result'=>2]); return; }
            $data_row['password'] = md5($pw ?: 'futa2026');
            $this->db->insert('profile_user',$data_row);
            $result = 1;
        }
        $this->_audit($auto_id?'UPDATE_ADMIN':'CREATE_ADMIN','profile_user',$auto_id??$this->db->insert_id());
        echo json_encode(['token'=>$token,'result'=>$result]);
        exit;
    }

    /* ════════════════════════════════════════════════════════
       ERROR PAGE
    ════════════════════════════════════════════════════════ */

    public function error() {
        $this->load->view('admin/error');
    }
}
