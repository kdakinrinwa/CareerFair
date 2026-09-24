<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Alumni_portal Controller (named to avoid conflict with public Home alumni page)
 */
class Alumni_portal extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('Admin_model', 'amodel');
    }

    private function _guard() {
        $uid  = $this->session->userdata('userid');
        $role = $this->session->userdata('role');
        if (!$uid || $role !== 'alumni') { redirect('home/login'); return false; }
        return true;
    }

    private function _data() {
        $uid = $this->session->userdata('userid');
        $data = [];
        if ($this->db->table_exists('cf_alumni')) {
            $q = $this->db->get_where('cf_alumni', ['alumni_id' => $uid]);
            $data['alumni'] = $q->num_rows() ? $q->row() : null;
        } else {
            $data['alumni'] = null;
        }
        $data['info']    = $this->amodel->retrievesettings();
        $data['css']     = $this->load->view('alumni_portal/alumni_css', '', TRUE);
        $data['sidebar'] = $this->load->view('alumni_portal/alumni_sidebar', $data, TRUE);
        return $data;
    }

    public function dashboard() {
        if (!$this->_guard()) return;
        $data = $this->_data();
        $data['page_title'] = 'Alumni Dashboard';
        $this->load->view('alumni_portal/dashboard', $data);
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('home/login');
    }
}
