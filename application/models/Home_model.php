<?php
error_reporting(E_ALL);

class Home_model extends CI_Model{
    function _construct() {
        parent::_construct;
    }
    
    public function findslider(){
        if (!$this->db->table_exists('slider')) return [];
        $query = $this->db->query("SELECT * FROM slider WHERE status='show' AND category=1 ");
        return $query->result();
    } 

    public function findhomepics(){
        if (!$this->db->table_exists('gallery')) return null;
        $query = $this->db->query("SELECT * FROM gallery WHERE stid=1 ORDER BY RAND() LIMIT 1");
        return $query->row();
    }

    public function findhomeevent(){
        if (!$this->db->table_exists('news')) return [];
        $query = $this->db->query("SELECT * FROM news ORDER BY newsid DESC LIMIT 3");
        return $query->result();
    }

    public function findevents(){
        if (!$this->db->table_exists('news')) return [];
        $query = $this->db->query("SELECT newsid,title,category, eventday,thumbnail,body FROM news ORDER BY newsid DESC");
        return $query->result();
    }

    public function findeventsfooter(){
        if (!$this->db->table_exists('news')) return [];
        $query = $this->db->query("SELECT newsid,title,category, eventday,thumbnail,body FROM news ORDER BY newsid DESC LIMIT 2");
        return $query->result();
    }

    public function findanevent($eventid){
        $query =  $this->db->query("SELECT * FROM news WHERE newsid='$eventid' ");
        return $query->row();
    }

    public function findotherevents($eventid){
        $query =  $this->db->query("SELECT * FROM news WHERE newsid!='$eventid' ORDER BY newsid DESC LIMIT 4");
        return $query->result();
    }

    public function findpictures(){
        if (!$this->db->table_exists('gallery')) return [];
        $query = $this->db->query("SELECT * FROM gallery WHERE stid !=1 ORDER BY RAND() LIMIT 6");
        return $query->result();
    }

    public function findthreeservices(){
        if (!$this->db->table_exists('services')) return [];
        $query = $this->db->query("SELECT * FROM services WHERE viewstate ='show' ORDER BY RAND() LIMIT 4");
        return $query->result();
    }

    public function findservices(){
        if (!$this->db->table_exists('services')) return [];
        $query = $this->db->query("SELECT * FROM services WHERE viewstate ='show' ORDER BY refdate");
        return $query->result();
    }

    public function find_a_services($service_id){
        $query =  $this->db->query("SELECT * FROM services WHERE service_id = $service_id");
        return $query->row();
    } 

    public function find_other_services($teamId){
        $query =  $this->db->query("SELECT * FROM services WHERE service_id != $teamId");
        return $query->result();
    } 
    
    public function findapage($pageid){
        $query =  $this->db->query("SELECT * FROM pages WHERE pageid= '$pageid'");
        return $query->row();
    }

    public function findvideos(){
        if (!$this->db->table_exists('videoyoutube')) return [];
        $query = $this->db->query("SELECT videocode,description,dateadded FROM videoyoutube WHERE status = 'SHOW' ORDER BY dateadded");
        return $query->result();
    }

    public function findalbum(){
        if (!$this->db->table_exists('projects')) return [];
        $query = $this->db->query("SELECT slid, projecttitle, longtitle, file FROM projects ORDER BY addeddate");
        return $query->result();
    }

    public function findanalbum(){
        if (!$this->db->table_exists('projects')) return null;
        $query = $this->db->query("SELECT slid, projecttitle, longtitle, file FROM projects ORDER BY RAND() LIMIT 1");
        return $query->row();
    }

    public function findaalbumdetails($slid){
        if (!$this->db->table_exists('projects')) return null;
        $query = $this->db->query("SELECT * FROM projects WHERE slid='$slid' ");
        return $query->row();
    }

    public function findaalbum($slid){
        if (!$this->db->table_exists('gallery')) return [];
        $query = $this->db->query("SELECT * FROM gallery WHERE stid= '$slid' ");
        return $query->result();
    }

    function submit_contact(){
        $fullnames    = $this->input->post('fullnames');
        $subject    = $this->input->post('subject');
        $phonenumber  = $this->input->post('phonenumber');
        $emailaddress = $this->input->post('emailaddress');
        $message    = $this->input->post('message');
       
       
        $biodata = array(
          'fullnames'   => $fullnames,
          'category'    => $subject,
          'phonenumber' => $phonenumber,
          'emailaddress'=> $emailaddress,
          'message'     => $message
        ); 
       
        if($this->db->insert('contactmess', $biodata)){
          $to ="info@afa.org.ng";
          $subject= "Website Enguries";
          $headers = "From: AFA\r\n";
          $headers .= "Reply-To: $emailaddress\r\n";
          $headers .= "Return-Path: $emailaddress\r\n";
          $headers .= "CC:info@afa.org.ng\r\n";
          $headers .= "BCC: info@afa.org.ng\r\n";
          mail($to,$subject,$message,$headers) ;
          return 1;
        }
        else
            return 0;
    }

    function submit_enquiries(){
      //return print_r($this->input->post());
      $subject      = $this->input->post('subject');
      $fullnames    = $this->input->post('fullnames');
      $message  = $this->input->post('message');
      $emailaddress = $this->input->post('emailaddress');
     
        $biodata = array(
            'subject'     => $subject,
            'fullnames'   => $fullnames,
            'message'     => $message,
            'emailaddress'=> $emailaddress
        ); 
     
        if($this->db->insert('users', $biodata)){
            $to ="kennysoft03@yahoo.com";
            $subject= "AFA Enguiries";
            $message ="$fullnames, $emailaddress. sent you thr following message: $message ";
            $headers = "From: AFA\r\n";
            $headers .= "Reply-To: $emailaddress\r\n";
            $headers .= "Return-Path: $emailaddress\r\n";
            $headers .= "CC:info@afa.org.ng\r\n";
            $headers .= "BCC: info@afa.org.ng\r\n";
            mail($to,$subject,$message,$headers) ;
            return 1;
        }
        else
          return 0;
    }

    function insert_newsletter($emailaddress){
        $newsletter = array('emailaddress' => $emailaddress);
        $this->db->where('emailaddress', $emailaddress);
        $query = $this->db->get_where('newsletters');
        if ($query->num_rows() > 0) {
            return 2;
        }
        if ($this->db->insert('newsletters', $newsletter)) {
            return 1;
        } else {
            return 0;
        }
    }

    // ── FUTA Career Fair: Authentication ────────────────────────────────────

    public function login_user($email, $password, $role) {
        $hashed = md5($password);

        if ($role === 'admin') {
            // Admin uses profile_user table
            $this->db->where('username', $email);
            $q = $this->db->get('profile_user');
            if ($q->num_rows() > 0) {
                $user = $q->row_array();
                if ($user['password'] !== $hashed) return 0;
                if ($user['accstatus'] !== 'enabled') return -1;
                $this->session->set_userdata([
                    'logged_in' => true,
                    'userid'    => $user['auto_id'],
                    'role'      => 'admin',
                    'userdata'  => $user,
                ]);
                return 1;
            }
            return 0;
        }

        $table = 'cf_students';
        if ($role === 'employer') $table = 'cf_employers';
        if ($role === 'alumni')   $table = 'cf_alumni';

        $email_col = ($role === 'employer') ? 'contact_email' : 'email';

        $this->db->where($email_col, $email);
        $q = $this->db->get($table);
        if ($q->num_rows() === 0) return 0;

        $user = $q->row_array();
        if ($user['password'] !== $hashed) return 0;
        if (isset($user['accstatus']) && $user['accstatus'] === 'inactive') return -1;

        $id_col = ($role === 'employer') ? 'employer_id' : (($role === 'alumni') ? 'alumni_id' : 'student_id');
        $this->session->set_userdata([
            'logged_in' => true,
            'userid'    => $user[$id_col],
            'role'      => $role,
            'userdata'  => $user,
        ]);
        return 1;
    }

    public function register_user($role) {
        $password = md5($this->input->post('password'));

        if ($role === 'student') {
            $email = strtolower(trim($this->input->post('email')));
            // Check duplicate
            $this->db->where('email', $email);
            if ($this->db->get('cf_students')->num_rows() > 0) return 2;

            $data = [
                'matric_no'       => trim($this->input->post('matric_no')),
                'fullname'        => trim($this->input->post('fullname')),
                'email'           => $email,
                'phone'           => trim($this->input->post('phone')),
                'password'        => $password,
                'school_id'       => (int)$this->input->post('school_id'),
                'level'           => $this->input->post('level'),
                'gender'          => $this->input->post('gender'),
                'accstatus'       => 'active',
                'fair_registered' => 1,
            ];
            $interests = $this->input->post('career_interest');
            if (is_array($interests)) {
                $data['career_interest'] = implode(',', $interests);
            }
            return $this->db->insert('cf_students', $data) ? 1 : 0;
        }

        if ($role === 'employer') {
            $email = strtolower(trim($this->input->post('contact_email')));
            $this->db->where('contact_email', $email);
            if ($this->db->get('cf_employers')->num_rows() > 0) return 2;

            $data = [
                'org_name'            => trim($this->input->post('org_name')),
                'org_type'            => $this->input->post('org_type'),
                'website'             => trim($this->input->post('website')),
                'contact_name'        => trim($this->input->post('contact_name')),
                'contact_email'       => $email,
                'contact_phone'       => trim($this->input->post('contact_phone')),
                'contact_designation' => trim($this->input->post('contact_designation')),
                'password'            => $password,
                'industry_id'         => (int)$this->input->post('industry_id'),
                'accstatus'           => 'pending',
            ];
            $interests = $this->input->post('recruit_interest');
            if (is_array($interests)) {
                $data['recruit_interest'] = implode(',', $interests);
            }
            return $this->db->insert('cf_employers', $data) ? 1 : 0;
        }

        if ($role === 'alumni') {
            $email = strtolower(trim($this->input->post('email')));
            $this->db->where('email', $email);
            if ($this->db->get('cf_alumni')->num_rows() > 0) return 2;

            $data = [
                'fullname'          => trim($this->input->post('fullname')),
                'email'             => $email,
                'phone'             => trim($this->input->post('phone')),
                'password'          => $password,
                'grad_year'         => $this->input->post('grad_year'),
                'programme'         => trim($this->input->post('programme')),
                'current_org'       => trim($this->input->post('current_org')),
                'designation'       => trim($this->input->post('designation')),
                'linkedin_url'      => trim($this->input->post('linkedin_url')),
                'mentor_available'  => (int)$this->input->post('mentor_available'),
                'accstatus'         => 'active',
            ];
            return $this->db->insert('cf_alumni', $data) ? 1 : 0;
        }

        return 0;
    }

    // ── FUTA Career Fair: Count helpers ──────────────────────────────────────

    public function count_students() {
        // Returns count from cf_students table if it exists, else 0
        if ($this->db->table_exists('cf_students')) {
            return $this->db->count_all('cf_students');
        }
        return 0;
    }

    public function count_employers() {
        // Returns count from cf_employers table if it exists, else 0
        if ($this->db->table_exists('cf_employers')) {
            return $this->db->count_all('cf_employers');
        }
        return 0;
    }

    public function count_cvs() {
        if ($this->db->table_exists('cf_student_cvs')) {
            return $this->db->count_all('cf_student_cvs');
        }
        return 0;
    }

    public function count_opportunities() {
        if ($this->db->table_exists('cf_job_opportunities')) {
            return $this->db->count_all('cf_job_opportunities');
        }
        return 0;
    }

}