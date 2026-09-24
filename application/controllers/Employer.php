<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Employer Controller
 * FUTA Career Services & Career Fair Portal
 */
class Employer extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('Employer_model', 'emodel');
        $this->load->model('Admin_model',    'amodel');
    }

    private function _guard() {
        $uid  = $this->session->userdata('userid');
        $role = $this->session->userdata('role');
        if (!$uid || $role !== 'employer') {
            redirect('home/login');
            return false;
        }
        return true;
    }

    private function _data() {
        $uid  = $this->session->userdata('userid');
        $data = [];
        $data['employer'] = $this->emodel->get_employer($uid);
        $data['info']     = $this->amodel->retrievesettings();
        $data['css']      = $this->load->view('employer/employer_css', '', TRUE);
        $data['sidebar']  = $this->load->view('employer/employer_sidebar', $data, TRUE);
        return $data;
    }

    public function dashboard() {
        if (!$this->_guard()) return;
        $uid  = $this->session->userdata('userid');
        $data = $this->_data();
        $data['page_title']   = 'Employer Dashboard';
        $data['cv_matches']   = $this->emodel->get_cv_matches($uid, 5);
        $data['shortlists']   = $this->emodel->get_shortlists($uid);
        $data['booth']        = $this->emodel->get_booth_request($uid);
        $data['talk']         = $this->emodel->get_career_talk($uid);
        $data['opportunities']= $this->emodel->get_my_opportunities($uid);
        $this->load->view('employer/dashboard', $data);
    }

    public function candidates() {
        if (!$this->_guard()) return;
        $uid  = $this->session->userdata('userid');
        $data = $this->_data();
        $data['page_title']  = 'Talent Vault – CV Search';
        $data['candidates']  = $this->emodel->search_candidates(
            $this->input->get('school'),
            $this->input->get('skill'),
            $this->input->get('interest'),
            $this->input->get('level'),
            $this->input->get('q')
        );
        $this->load->view('employer/candidates', $data);
    }

    public function shortlist() {
        if (!$this->_guard()) return;
        $uid  = $this->session->userdata('userid');
        $data = $this->_data();
        $data['page_title'] = 'My Shortlist';
        $data['shortlists'] = $this->emodel->get_shortlists($uid);
        $this->load->view('employer/shortlist', $data);
    }

    // AJAX: add student to shortlist
    public function add_shortlist() {
        if (!$this->_guard()) { echo json_encode(['result'=>-1]); return; }
        $uid    = $this->session->userdata('userid');
        $sid    = (int)$this->input->post('student_id');
        $tag    = $this->input->post('tag') ?: 'Interested';
        $token  = $this->security->get_csrf_hash();
        $result = $this->emodel->add_to_shortlist($uid, $sid, $tag);
        echo json_encode(['token'=>$token, 'result'=>$result]);
        exit;
    }

    public function booth() {
        if (!$this->_guard()) return;
        $uid  = $this->session->userdata('userid');
        $data = $this->_data();
        $data['page_title'] = 'Booth Request';
        $data['booth']      = $this->emodel->get_booth_request($uid);
        $this->load->view('employer/booth', $data);
    }

    // AJAX: submit booth request
    public function request_booth() {
        if (!$this->_guard()) { echo json_encode(['result'=>-1]); return; }
        $uid    = $this->session->userdata('userid');
        $token  = $this->security->get_csrf_hash();
        $result = $this->emodel->submit_booth_request($uid);
        echo json_encode(['token'=>$token, 'result'=>$result]);
        exit;
    }

    public function profile() {
        if (!$this->_guard()) return;
        $data = $this->_data();
        $data['page_title'] = 'Company Profile';
        $this->load->view('employer/profile', $data);
    }

    // AJAX: save profile
    public function save_profile() {
        if (!$this->_guard()) { echo json_encode(['result'=>-1]); return; }
        $uid    = $this->session->userdata('userid');
        $token  = $this->security->get_csrf_hash();
        $result = $this->emodel->update_profile($uid);
        echo json_encode(['token'=>$token, 'result'=>$result]);
        exit;
    }

    public function opportunities() {
        if (!$this->_guard()) return;
        $uid  = $this->session->userdata('userid');
        $data = $this->_data();
        $data['page_title']   = 'Job / Internship Postings';
        $data['opportunities']= $this->emodel->get_my_opportunities($uid);
        $this->load->view('employer/opportunities', $data);
    }

    // AJAX: post opportunity
    public function post_opportunity() {
        if (!$this->_guard()) { echo json_encode(['result'=>-1]); return; }
        $uid    = $this->session->userdata('userid');
        $token  = $this->security->get_csrf_hash();
        $result = $this->emodel->save_opportunity($uid);
        echo json_encode(['token'=>$token, 'result'=>$result]);
        exit;
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('home/login');
    }
}
