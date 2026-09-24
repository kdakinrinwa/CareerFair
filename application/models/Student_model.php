<?php
/**
 * Student_model
 * FUTA Career Services & Career Fair Portal
 * All database queries for the logged-in student portal.
 */
class Student_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    // ── Profile ───────────────────────────────────────────────

    public function get_student($student_id) {
        if (!$this->db->table_exists('cf_students')) return null;
        $q = $this->db->get_where('cf_students', ['student_id' => $student_id]);
        return $q->num_rows() ? $q->row() : null;
    }

    public function update_profile($student_id) {
        $data = [
            'fullname'          => $this->input->post('fullname'),
            'phone'             => $this->input->post('phone'),
            'school_id'         => (int)$this->input->post('school_id'),
            'level'             => $this->input->post('level'),
            'gender'            => $this->input->post('gender'),
            'skills'            => $this->input->post('skills'),
            'linkedin_url'      => $this->input->post('linkedin_url'),
            'github_url'        => $this->input->post('github_url'),
            'portfolio_url'     => $this->input->post('portfolio_url'),
            'available_for'     => $this->input->post('available_for'),
            'preferred_industry'=> $this->input->post('preferred_industry'),
        ];
        $interests = $this->input->post('career_interest');
        if (is_array($interests)) {
            $data['career_interest'] = implode(',', $interests);
        }
        $this->db->where('student_id', $student_id);
        return $this->db->update('cf_students', $data) ? 1 : 0;
    }

    public function change_password($student_id) {
        $current = $this->input->post('current_password');
        $new     = $this->input->post('new_password');
        $confirm = $this->input->post('confirm_password');

        if ($new !== $confirm) return -2;

        $q = $this->db->get_where('cf_students', ['student_id' => $student_id]);
        if (!$q->num_rows()) return 0;
        $student = $q->row();

        if ($student->password !== md5($current)) return -1;

        $this->db->where('student_id', $student_id);
        return $this->db->update('cf_students', ['password' => md5($new)]) ? 1 : 0;
    }

    // ── Passport photo ────────────────────────────────────────

    public function upload_passport($student_id) {
        $file = $_FILES['passport_file'] ?? null;
        if (empty($file['name'])) return 0;

        // Validate type
        $allowed_types = ['image/jpeg', 'image/jpg', 'image/png'];
        if (!in_array($file['type'], $allowed_types)) return -2;

        // Validate size (3 MB)
        if ($file['size'] > 3 * 1024 * 1024) return -3;

        // Ensure upload directory exists
        $upload_dir = FCPATH . 'uploads/photos/';
        if (!is_dir($upload_dir)) mkdir($upload_dir, 0755, true);

        // Generate unique filename
        $ext      = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        $filename = 'passport_' . $student_id . '_' . time() . '.' . $ext;
        $dest     = $upload_dir . $filename;

        // Delete old passport file if it exists
        $current = $this->get_student($student_id);
        if ($current && !empty($current->passport)) {
            $old_path = $upload_dir . $current->passport;
            if (file_exists($old_path)) @unlink($old_path);
        }

        if (!move_uploaded_file($file['tmp_name'], $dest)) return 0;

        // Update student record
        $this->db->where('student_id', $student_id);
        return $this->db->update('cf_students', ['passport' => $filename]) ? 1 : 0;
    }

    // ── CV ────────────────────────────────────────────────────

    public function get_student_cv($student_id) {
        if (!$this->db->table_exists('cf_student_cvs')) return null;
        $this->db->where('student_id', $student_id);
        $this->db->where('is_active', 1);
        $this->db->order_by('uploaded_at', 'DESC');
        $q = $this->db->get('cf_student_cvs');
        return $q->num_rows() ? $q->row() : null;
    }

    public function upload_cv($student_id) {
        $file = $_FILES['cv_file'] ?? null;
        if (empty($file['name'])) return 0;

        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        if (!in_array($ext, ['pdf', 'docx', 'doc'])) return -2;
        if ($file['size'] > 5 * 1024 * 1024) return -3;

        $filename = 'CV_' . $student_id . '_' . time() . '.' . $ext;
        $dest     = FCPATH . 'uploads/cvs/' . $filename;

        if (!move_uploaded_file($file['tmp_name'], $dest)) return 0;

        // Deactivate previous CVs
        $this->db->where('student_id', $student_id);
        $this->db->update('cf_student_cvs', ['is_active' => 0]);

        $data = [
            'student_id'    => $student_id,
            'filename'      => $filename,
            'original_name' => $file['name'],
            'file_size'     => $file['size'],
            'is_active'     => 1,
        ];
        return $this->db->insert('cf_student_cvs', $data) ? 1 : 0;
    }

    // ── QR Pass ───────────────────────────────────────────────

    public function get_qr_pass($user_id, $user_type = 'student') {
        if (!$this->db->table_exists('cf_qr_passes')) return null;
        $q = $this->db->get_where('cf_qr_passes', [
            'user_id'    => $user_id,
            'user_type'  => $user_type,
            'is_revoked' => 0,
        ]);
        return $q->num_rows() ? $q->row() : null;
    }

    public function generate_qr_pass($user_id, $user_type = 'student') {
        if (!$this->db->table_exists('cf_qr_passes')) return null;

        // Check if already exists
        $existing = $this->get_qr_pass($user_id, $user_type);
        if ($existing) return $existing->pass_code;

        // Generate a unique code: CF26-STU-XXXXXXXX
        $prefix = strtoupper(substr($user_type, 0, 3));
        $code   = 'CF26-' . $prefix . '-' . strtoupper(substr(md5($user_id . time() . rand()), 0, 8));

        $data = [
            'pass_code'  => $code,
            'fair_id'    => 1,
            'user_type'  => $user_type,
            'user_id'    => $user_id,
            'is_revoked' => 0,
        ];
        $this->db->insert('cf_qr_passes', $data);
        return $code;
    }

    // ── Opportunities ─────────────────────────────────────────

    public function get_recent_opportunities($limit = 5) {
        if (!$this->db->table_exists('cf_job_opportunities')) return [];
        $this->db->select('o.*, e.org_name, e.logo');
        $this->db->from('cf_job_opportunities o');
        $this->db->join('cf_employers e', 'o.employer_id = e.employer_id', 'left');
        $this->db->where('o.status', 'active');
        $this->db->order_by('o.created_at', 'DESC');
        $this->db->limit($limit);
        return $this->db->get()->result();
    }

    public function get_all_opportunities($type = null, $industry_id = null, $q = null) {
        if (!$this->db->table_exists('cf_job_opportunities')) return [];
        $this->db->select('o.*, e.org_name, e.logo');
        $this->db->from('cf_job_opportunities o');
        $this->db->join('cf_employers e', 'o.employer_id = e.employer_id', 'left');
        $this->db->where('o.status', 'active');
        if ($type)        $this->db->where('o.opp_type', $type);
        if ($industry_id) $this->db->where('o.industry_id', (int)$industry_id);
        if ($q)           $this->db->like('o.title', $q);
        $this->db->order_by('o.created_at', 'DESC');
        return $this->db->get()->result();
    }

    // ── Events ────────────────────────────────────────────────

    public function get_upcoming_events($limit = 3) {
        if (!$this->db->table_exists('cf_events')) return [];
        $this->db->where('status', 'upcoming');
        $this->db->order_by('event_date', 'ASC');
        $this->db->limit($limit);
        return $this->db->get('cf_events')->result();
    }

    public function get_all_events() {
        if (!$this->db->table_exists('cf_events')) return [];
        $this->db->order_by('event_date', 'ASC');
        return $this->db->get('cf_events')->result();
    }

    // ── Shortlists (employer shortlisted this student) ────────

    public function get_my_shortlists($student_id) {
        if (!$this->db->table_exists('cf_candidate_shortlists')) return [];
        $this->db->select('s.*, e.org_name, e.logo, e.industry_id');
        $this->db->from('cf_candidate_shortlists s');
        $this->db->join('cf_employers e', 's.employer_id = e.employer_id', 'left');
        $this->db->where('s.student_id', $student_id);
        $this->db->order_by('s.shortlisted_at', 'DESC');
        return $this->db->get()->result();
    }

    // ── Notifications ─────────────────────────────────────────

    public function get_notifications($user_id, $user_type = 'student', $limit = 20) {
        if (!$this->db->table_exists('cf_notifications')) return [];
        $this->db->where('user_id',   $user_id);
        $this->db->where('user_type', $user_type);
        $this->db->order_by('created_at', 'DESC');
        if ($limit) $this->db->limit($limit);
        return $this->db->get('cf_notifications')->result();
    }

    public function get_unread_count($user_id, $user_type = 'student') {
        if (!$this->db->table_exists('cf_notifications')) return 0;
        $this->db->where('user_id',   $user_id);
        $this->db->where('user_type', $user_type);
        $this->db->where('is_read',   0);
        return $this->db->count_all_results('cf_notifications');
    }

    public function mark_notifications_read($user_id, $user_type = 'student') {
        if (!$this->db->table_exists('cf_notifications')) return;
        $this->db->where('user_id',   $user_id);
        $this->db->where('user_type', $user_type);
        $this->db->update('cf_notifications', ['is_read' => 1]);
    }
}
