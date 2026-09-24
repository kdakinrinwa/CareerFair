<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Home Controller
 * FUTA Career Services & Career Fair Portal (FCCP)
 * Handles all public-facing pages.
 */
class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        // Load shared models + pre-render global partials (header, footer, css, js)
        require_once('dependency.php');
    }

    // ──────────────────────────────────────────────
    // HOME PAGE
    // ──────────────────────────────────────────────
    public function index() {
        // Hero / news / events from DB
        $this->data['events']  = $this->hmodel->findhomeevent();   // latest 3 news for news strip

        // Stats (basic counts; expand once new tables are created)
        $this->data['stat_students']  = $this->hmodel->count_students();
        $this->data['stat_employers'] = $this->hmodel->count_employers();

        $this->load->view('public/home', $this->data);
    }

    // ──────────────────────────────────────────────
    // ABOUT
    // ──────────────────────────────────────────────
    public function about() {
        $this->load->view('public/about', $this->data);
    }

    // ──────────────────────────────────────────────
    // STUDENTS INFO PAGE
    // ──────────────────────────────────────────────
    public function students() {
        $this->load->view('public/students', $this->data);
    }

    // ──────────────────────────────────────────────
    // EMPLOYERS INFO PAGE
    // ──────────────────────────────────────────────
    public function employers() {
        $this->load->view('public/employers', $this->data);
    }

    // ──────────────────────────────────────────────
    // ALUMNI INFO PAGE
    // ──────────────────────────────────────────────
    public function alumni() {
        $this->load->view('public/alumni', $this->data);
    }

    // ──────────────────────────────────────────────
    // CAREER FAIR INFO PAGE
    // ──────────────────────────────────────────────
    public function careerfair() {
        $this->data['events'] = $this->hmodel->findevents();
        $this->load->view('public/careerfair', $this->data);
    }

    // ──────────────────────────────────────────────
    // VENUE & DIRECTIONS
    // ──────────────────────────────────────────────
    public function venue() {
        $this->data['page_title'] = 'Venue & Directions';
        $this->load->view('public/venue', $this->data);
    }

    // ──────────────────────────────────────────────
    // REGISTRATION – route: home/register OR home/register/student|employer
    // ──────────────────────────────────────────────
    public function register() {
        $type = $this->uri->segment(3); // student | employer | alumni | ''
        $this->data['reg_type'] = in_array($type, ['student', 'employer', 'alumni']) ? $type : 'student';
        $this->load->view('public/register', $this->data);
    }

    // ──────────────────────────────────────────────
    // LOGIN
    // ──────────────────────────────────────────────
    public function login() {
        $this->load->view('public/login', $this->data);
    }

    // ──────────────────────────────────────────────
    // CV SUBMISSION / INFO
    // ──────────────────────────────────────────────
    public function cv() {
        $this->load->view('public/cv', $this->data);
    }

    // ──────────────────────────────────────────────
    // DONATE
    // ──────────────────────────────────────────────
    public function donate() {
        $this->load->view('public/donate', $this->data);
    }

    // ──────────────────────────────────────────────
    // PROGRAMMES / SERVICES
    // ──────────────────────────────────────────────
    public function programmes() {
        $this->data['progr'] = $this->hmodel->findservices();
        $this->load->view('public/programmes', $this->data);
    }

    public function aprogramme() {
        $progID = (int) $this->uri->segment(3);
        $this->data['aprogr'] = $this->hmodel->find_a_services($progID);
        $this->data['progr']  = $this->hmodel->find_other_services($progID);
        $this->data['events'] = $this->hmodel->findhomeevent();
        $this->load->view('public/aprogramme', $this->data);
    }

    // ──────────────────────────────────────────────
    // CONTACT
    // ──────────────────────────────────────────────
    public function contact() {
        $letters = 'abcde123456789';
        $this->data['capcha2'] = substr(str_shuffle($letters), 0, 4);
        $this->load->view('public/contact', $this->data);
    }

    // ──────────────────────────────────────────────
    // EVENTS / NEWS
    // ──────────────────────────────────────────────
    public function events() {
        $this->data['events'] = $this->hmodel->findevents();
        $this->load->view('public/events', $this->data);
    }

    public function viewevent() {
        $eventid = (int) $this->uri->segment(3);
        $this->data['anevent']  = $this->hmodel->findanevent($eventid);
        $this->data['oevent']   = $this->hmodel->findotherevents($eventid);
        $this->data['pictures'] = $this->hmodel->findpictures();
        $this->data['progr']    = $this->hmodel->findservices();
        $this->load->view('public/anevent', $this->data);
    }

    // ──────────────────────────────────────────────
    // GALLERY / ALBUM
    // ──────────────────────────────────────────────
    public function album() {
        $this->data['albums'] = $this->hmodel->findalbum();
        $this->load->view('public/album', $this->data);
    }

    public function aalbum() {
        $slid = (int) $this->uri->segment(3);
        $this->data['analbum']      = $this->hmodel->findaalbumdetails($slid);
        $this->data['gallery_pics'] = $this->hmodel->findaalbum($slid);
        $this->load->view('public/gallery', $this->data);
    }

    // ──────────────────────────────────────────────
    // VIDEOS
    // ──────────────────────────────────────────────
    public function videos() {
        $this->data['video'] = $this->hmodel->findvideos();
        $this->load->view('public/videos', $this->data);
    }

    // ──────────────────────────────────────────────
    // DYNAMIC CMS PAGES
    // ──────────────────────────────────────────────
    public function page() {
        $pageid = $this->uri->segment(3);
        $this->data['events']  = $this->hmodel->findhomeevent();
        $this->data['progr']   = $this->hmodel->findservices();
        $this->data['pictures']= $this->hmodel->findpictures();
        $this->data['page']    = $this->hmodel->findapage($pageid);
        $this->load->view('public/page', $this->data);
    }

    // ──────────────────────────────────────────────
    // PARTNER / SPONSOR
    // ──────────────────────────────────────────────
    public function partner() {
        $letters = 'abcde123456789';
        $this->data['capcha2'] = substr(str_shuffle($letters), 0, 4);
        $this->load->view('public/partner', $this->data);
    }

    // ──────────────────────────────────────────────
    // AJAX: NEWSLETTER SUBSCRIPTION
    // ──────────────────────────────────────────────
    public function submit_newsletter() {
        $emailadd = $this->input->post('emailadd');
        $this->form_validation->set_rules('emailadd', 'Email Address', 'required|valid_email');
        if ($this->form_validation->run()) {
            $result = $this->hmodel->insert_newsletter($emailadd);
            echo $result;
        } else {
            echo 0;
        }
    }

    // ──────────────────────────────────────────────
    // AJAX: DO LOGIN
    // ──────────────────────────────────────────────
    public function do_login() {
        $newtoken = $this->security->get_csrf_hash();
        $email    = strtolower(trim($this->input->post('email')));
        $password = $this->input->post('password');
        $role     = $this->input->post('role');

        $result   = $this->hmodel->login_user($email, $password, $role);
        $redirect = base_url();

        if ($result == 1) {
            switch ($role) {
                case 'admin':    $redirect = base_url() . 'admin/dashboard'; break;
                case 'employer': $redirect = base_url() . 'employer/dashboard'; break;
                case 'alumni':   $redirect = base_url() . 'alumni/dashboard'; break;
                default:         $redirect = base_url() . 'student/dashboard';
            }
        }        echo json_encode([
            'token'    => $newtoken,
            'result'   => $result,
            'redirect' => $redirect,
        ]);
        exit;
    }

    // ──────────────────────────────────────────────
    // POST: DO REGISTER
    // ──────────────────────────────────────────────
    public function do_register() {
        $role   = $this->input->post('role');
        $result = $this->hmodel->register_user($role);

        if ($result == 1) {
            // Redirect to success / login
            redirect('home/login?registered=1');
        } elseif ($result == 2) {
            // Email already exists
            $this->data['reg_type'] = $role;
            $this->data['reg_error'] = 'An account with this email already exists. <a href="' . base_url() . 'home/login">Login instead</a>.';
            $this->load->view('public/register', $this->data);
        } else {
            $this->data['reg_type'] = $role;
            $this->data['reg_error'] = 'Registration failed. Please check your details and try again.';
            $this->load->view('public/register', $this->data);
        }
    }

    // ──────────────────────────────────────────────
    // FORGOT PASSWORD
    // ──────────────────────────────────────────────
    public function forgot() {
        $this->load->view('public/forgot', $this->data);
    }

    // ──────────────────────────────────────────────
    // AJAX: CONTACT FORM
    // ──────────────────────────────────────────────
    public function submit_contact() {
        $fullnames    = $this->input->post('fullnames');
        $phonenumber  = $this->input->post('phonenumber');
        $emailaddress = $this->input->post('emailaddress');
        $subject      = strtoupper($this->input->post('subject'));
        $message      = $this->input->post('message');

        $biodata = array(
            'fullnames'    => $fullnames,
            'category'     => $subject,
            'phonenumber'  => $phonenumber,
            'emailaddress' => $emailaddress,
            'message'      => $message,
        );

        if ($this->db->insert('contactmess', $biodata)) {
            echo 1;
        } else {
            echo 0;
        }
    }

    // ──────────────────────────────────────────────
    // ERROR / 404 override
    // ──────────────────────────────────────────────
    public function error() {
        $this->data['page_title'] = 'Page Not Found';
        http_response_code(404);
        $this->load->view('public/error_404', $this->data);
    }

}
