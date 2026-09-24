<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Student Controller
 * FUTA Career Services & Career Fair Portal
 * Handles the logged-in student portal pages.
 */
class Student extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('Student_model', 'smodel');
        $this->load->model('Admin_model',   'amodel');
    }

    // ── Auth guard ────────────────────────────────────────────
    private function _guard() {
        $uid  = $this->session->userdata('userid');
        $role = $this->session->userdata('role');
        if (!$uid || $role !== 'student') {
            redirect('home/login');
            return false;
        }
        return true;
    }

    // ── Shared data for all student views ─────────────────────
    private function _data() {
        $uid  = $this->session->userdata('userid');
        $data = [];
        $data['student']  = $this->smodel->get_student($uid);
        $data['cv']       = $this->smodel->get_student_cv($uid);
        $data['qr_pass']  = $this->smodel->get_qr_pass($uid, 'student');
        $data['info']     = $this->amodel->retrievesettings();
        $data['css']      = $this->load->view('student/student_css', '', TRUE);
        $data['sidebar']  = $this->load->view('student/student_sidebar', $data, TRUE);
        return $data;
    }

    // ──────────────────────────────────────────────
    // DASHBOARD
    // ──────────────────────────────────────────────
    public function dashboard() {
        if (!$this->_guard()) return;
        $uid  = $this->session->userdata('userid');
        $data = $this->_data();
        $data['page_title']     = 'My Dashboard';
        $data['opportunities']  = $this->smodel->get_recent_opportunities(5);
        $data['events']         = $this->smodel->get_upcoming_events(3);
        $data['shortlists']     = $this->smodel->get_my_shortlists($uid);
        $data['notifications']  = $this->smodel->get_notifications($uid, 'student', 5);
        $this->load->view('student/dashboard', $data);
    }

    // ──────────────────────────────────────────────
    // PROFILE
    // ──────────────────────────────────────────────
    public function profile() {
        if (!$this->_guard()) return;
        $data = $this->_data();
        $data['page_title'] = 'My Profile';
        $this->load->view('student/profile', $data);
    }

    // ──────────────────────────────────────────────
    // CV
    // ──────────────────────────────────────────────
    public function cv() {
        if (!$this->_guard()) return;
        $uid  = $this->session->userdata('userid');
        $data = $this->_data();
        $data['page_title'] = 'My CV';
        $this->load->view('student/cv', $data);
    }

    // ── AJAX: upload CV ──────────────────────────
    public function upload_cv() {
        if (!$this->_guard()) { echo json_encode(['result'=>-1]); return; }
        $uid    = $this->session->userdata('userid');
        $token  = $this->security->get_csrf_hash();
        $result = $this->smodel->upload_cv($uid);
        echo json_encode(['token' => $token, 'result' => $result]);
        exit;
    }

    // ──────────────────────────────────────────────
    // QR PASS
    // ──────────────────────────────────────────────
    public function qr() {
        if (!$this->_guard()) return;
        $uid  = $this->session->userdata('userid');
        $data = $this->_data();
        $data['page_title'] = 'My QR Event Pass';
        // Auto-generate pass if not yet issued and student is registered
        if (empty($data['qr_pass']) && !empty($data['student']) && $data['student']->fair_registered) {
            $this->smodel->generate_qr_pass($uid);
            $data['qr_pass'] = $this->smodel->get_qr_pass($uid, 'student');
        }
        $this->load->view('student/qr', $data);
    }

    // ── AJAX: upload passport photo ──────────────
    public function upload_passport() {
        if (!$this->_guard()) { echo json_encode(['result'=>-1]); return; }
        $uid    = $this->session->userdata('userid');
        $token  = $this->security->get_csrf_hash();
        $result = $this->smodel->upload_passport($uid);
        echo json_encode(['token' => $token, 'result' => $result]);
        exit;
    }

    // ──────────────────────────────────────────────
    // OPPORTUNITIES
    // ──────────────────────────────────────────────
    public function opportunities() {
        if (!$this->_guard()) return;
        $data = $this->_data();
        $data['page_title']    = 'Opportunities';
        $data['opportunities'] = $this->smodel->get_all_opportunities(
            $this->input->get('type'),
            $this->input->get('industry'),
            $this->input->get('q')
        );
        $this->load->view('student/opportunities', $data);
    }

    // ──────────────────────────────────────────────
    // EVENTS
    // ──────────────────────────────────────────────
    public function events() {
        if (!$this->_guard()) return;
        $data = $this->_data();
        $data['page_title'] = 'Career Fair Events';
        $data['events']     = $this->smodel->get_all_events();
        $this->load->view('student/events', $data);
    }

    // ──────────────────────────────────────────────
    // MESSAGES / NOTIFICATIONS
    // ──────────────────────────────────────────────
    public function messages() {
        if (!$this->_guard()) return;
        $uid  = $this->session->userdata('userid');
        $data = $this->_data();
        $data['page_title']    = 'Messages';
        $data['notifications'] = $this->smodel->get_notifications($uid, 'student');
        // Mark all as read
        $this->smodel->mark_notifications_read($uid, 'student');
        $this->load->view('student/messages', $data);
    }

    // ──────────────────────────────────────────────
    // SETTINGS
    // ──────────────────────────────────────────────
    public function settings() {
        if (!$this->_guard()) return;
        $data = $this->_data();
        $data['page_title'] = 'Account Settings';
        $this->load->view('student/settings', $data);
    }

    // ── AJAX: save profile ───────────────────────
    public function save_profile() {
        if (!$this->_guard()) { echo json_encode(['result'=>-1]); return; }
        $uid    = $this->session->userdata('userid');
        $token  = $this->security->get_csrf_hash();
        $result = $this->smodel->update_profile($uid);
        echo json_encode(['token' => $token, 'result' => $result]);
        exit;
    }

    // ── AJAX: change password ────────────────────
    public function change_password() {
        if (!$this->_guard()) { echo json_encode(['result'=>-1]); return; }
        $uid    = $this->session->userdata('userid');
        $token  = $this->security->get_csrf_hash();
        $result = $this->smodel->change_password($uid);
        echo json_encode(['token' => $token, 'result' => $result]);
        exit;
    }

    // ──────────────────────────────────────────────
    // LOGOUT
    // ──────────────────────────────────────────────
    public function logout() {
        $this->session->sess_destroy();
        redirect('home/login');
    }

}
