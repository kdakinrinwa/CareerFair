<?php
error_reporting(0);
ini_set('max_execution_time',0);
ini_set('memory_limit','256M');

class Admin_model extends CI_Model{
    function _construct() {
        parent::_construct;
    }

    function validate() {
        $username = strtolower($this->input->post('username'));
        $password = $this->input->post('password');
        
        //Check against user table
        $this->db->where('username', $username); 
        $query = $this->db->get_where('profile_user');   
        
        if ($query->num_rows() > 0) {
            $user_data = $query->row_array(); 

            $hashed_pass = md5($password);
            if($user_data['password'] != $hashed_pass){
                return 0;
            }
            
            //Create a fresh, brand new session
            $this->set_session($user_data);
            //$content = $this->set_session($user_data);
            //return $content;
            
            //Chceck if User Logging in is a Student or Staff
            if($user_data['accstatus'] == 'enabled'){ return 1;}
            elseif($user_data['accstatus'] == 'disabled') { return -1; }
        } 
        else 
        {
          return 0;
        }   
    } 


    /* Set Session*/
    public function set_session($user){
        unset($user['password']);
        $this->session->set_userdata('logged_in', true); 
        $this->session->set_userdata('userid',$user['auto_id']);  
        $this->session->set_userdata('userdata',$user);  
        return 1;
    }

    /* unSet Session*/
    public function unset_session(){
        $this->session->unset_userdata('userid',''); 
        $this->session->unset_userdata('userdata',''); 
        return 1;
    }

    
    function signout() {
        $this->session->sess_destroy();
        return 1;
    }

    function resetpassword()
    {
        $auto_id =  $this->input->post('auto_id');
       /* $password = $this->input->post('newpassword');
        return*/ 

        $query = $this->db->get_where('profile_user', array('auto_id' => $auto_id));

        if ($query->num_rows() > 0)
        {
            $password = md5($this->input->post('newpassword'));
            $data = array(
                'password' => $password
            );

            $this->db->where('auto_id', $auto_id);
            if($this->db->update('profile_user', $data))
                return 1;
            else
                return 0;   
        }
        else
            return 0;
    }

    // Ste Setting Management
    function save_siteinfo()   {
        //return print_r($this->input->post());
        $seid           = 1;
        $phone1         = $this->input->post('phone1');
        $phone2         = $this->input->post('phone2');
        $about          = $this->input->post('about');
        $address1       = $this->input->post('address1');
        $address2       = $this->input->post('address2');
        $email1         = $this->input->post('email1');
        $email2         = $this->input->post('email2');
        $facebook       = $this->input->post('facebook'); 
        $twitter        = $this->input->post('twitter');  
        $instagram      = $this->input->post('instagram'); 
        $whatsapp       = $this->input->post('whatsapp'); 
        $youtube        = $this->input->post('youtube');
        $mission        = $this->input->post('mission');
        $vision         = $this->input->post('vision');
        $welcome        = $this->input->post('welcome');
        $privacypolicy  = $this->input->post('privacypolicy');
        $termsncondition= $this->input->post('termsncondition');
 

        $sett = array(
            'phone1'        => $phone1,
            'phone2'        => $phone2,
            'about'         => $about,
            'address1'      => $address1,
            'address2'      => $address2,
            'email1'        => $email1,
            'email2'        => $email2,
            'facebook'      => $facebook,
            'twitter'       => $twitter,
            'whatsapp'      => $whatsapp,
            'instagram'     => $instagram,
            'youtube'       => $youtube,
            'mission'       => $mission,
            'vision'        => $vision,
            'privacypolicy' => $privacypolicy,
            'termsncondition'=> $termsncondition,
            'welcome'           => $welcome
        );

        $this->db->where('seid', $seid);
        if ($this->db->update('settings', $sett))
            return 1;
        else
            return 0;
    }

    // Ste Setting Management
    function save_directors_record()   {
        //return print_r($this->input->post());
        $seid           = 1;
        $directorname     = $this->input->post('directorname');
        $directorlink     = $this->input->post('directorlink');

        $sett = array(
            'directorname' => $directorname,
            'directorlink'=> $directorlink
        );

        $this->db->where('seid', $seid);
        if ($this->db->update('settings', $sett))
            return 1;
        else
            return 0;
    }

    // Ste Setting Management
    function save_policies()   {
        //return print_r($this->input->post());
        $seid           = 1;
        $privacypolicy  = $this->input->post('privacypolicy');
        $termsncondition= $this->input->post('termsncondition');

        $sett = array(
            'privacypolicy' => $privacypolicy,
            'termsncondition'=> $termsncondition
        );

        $this->db->where('seid', $seid);
        if ($this->db->update('settings', $sett))
            return 1;
        else
            return 0;
    }

    public function retrievesettings(){ 
        $query =  $this->db->query("SELECT * FROM settings WHERE seid=1");
        return $query->row();
    }

    // Pages Management Classes
    function retrievepages()
    {
        $query =  $this->db->query("SELECT * FROM pages");
        return $query->result();
    }

     // Applicant Classes Classes
    function retrieve_applicants()
    {
        $query =  $this->db->query("SELECT * FROM pty_users u 
        Left JOIN counrywest cw ON u.nationalty=cw.cid 
        Left JOIN country c ON u.birthcountry=c.coid");
        return $query->result();
    }

    public function retreive_my_details($user_id){ 
      $query =  $this->db->query("SELECT * FROM pty_users u 
        Left JOIN counrywest cw ON u.nationalty=cw.cid 
        Left JOIN country c ON u.birthcountry=c.coid WHERE id='$user_id' ");
        return $query->row_array();
    }
    
    function retrieve_aapplicants($id)
    {
        $query =  $this->db->query("SELECT * FROM pty_users WHERE id = $id");
        return $query->row();
    }

    public function retreive_my_referee($user_id){ 
      $query =  $this->db->query("SELECT * FROM applicant_referee WHERE applicant_id='$user_id' ");
        return $query->result();
    }

    public function retreive_a_referee($ref_id){ 
      $query =  $this->db->query("SELECT * FROM applicant_referee WHERE id='$ref_id' ");
        return $query->row();
    }

    public function retreive_my_education($user_id){ 
      $query =  $this->db->query("SELECT * FROM applicant_educations WHERE applicant_id='$user_id' ");
        return $query->result();
    }

    public function retreive_my_award($user_id){ 
      $query =  $this->db->query("SELECT * FROM applicant_awards WHERE applicant_id='$user_id' ");
        return $query->result();
    }

    public function retreive_my_membership($user_id){ 
      $query =  $this->db->query("SELECT * FROM applicant_membership WHERE applicant_id='$user_id' ");
        return $query->result();
    }

    public function retreive_my_publication($user_id){ 
      $query =  $this->db->query("SELECT * FROM applicant_publication WHERE applicant_id='$user_id' ");
        return $query->result();
    }

    public function retreive_my_english($user_id){ 
      $query =  $this->db->query("SELECT * FROM applicant_english_test WHERE applicant_id='$user_id' ");
        return $query->result();
    }
    /*  END APPLICANt ClaLAsses*/


    function retrieveauser_pages($userclass)
    {
        $query =  $this->db->query("SELECT * FROM pages  WHERE dept = '_$userclass' ");
        return $query->result();
    }

    #Retrieve a Pages Information
    public function retrievea_page(){ 
        $pid= $this->input->post('pid');

        $sqlstm="SELECT * FROM pages WHERE pid='$pid'";
        $q=$this->db->query($sqlstm);
        if($q->num_rows() > 0) {
            $row=$q->row_array();
            $jsonformat=json_encode($row);
            return $jsonformat;
        }else{
            return 0;
        }
    }

    #Retrieve a Pages Information
    function deletea_page()
    {
        $pageid= $this->input->post('pageid');
        $query =  $this->db->query("DELETE FROM pages WHERE pageid= $pageid");
        return 1;
    }

    function deletepag($pageid)
    {
        $query =  $this->db->query("DELETE FROM pages WHERE pageid= $pageid");
        return 1;
    }


    //Submit a Page
    function submit_page($filename)
    {
        $creatorid = $this->input->post('creatorid');
        $pagetitle  = TRIM($this->input->post('pagetitle'));
        $menutext  = TRIM($this->input->post('menutext'));
        $message = $this->input->post('message');
        $keywords    = $this->input->post('keywords');
        $uniqufield    = $menutext.'|_'.$pagetitle;
        
        $pgdata = array(
            'pagetitle'=> $pagetitle,
            'menutext'=> $menutext,            
            'pagebody'=> $message,
            'pagekeywords'=> $keywords,
            'creatorid'=> $creatorid,
            'pageheadimg' => $filename,
            'uniqufield'=> $uniqufield
        );

        $this->db->where('uniqufield', $uniqufield);
        $query = $this->db->get_where('pages');
        
        if($query->num_rows > 0 )
            {  return -2;   }
        else
        {
            if($this->db->insert('pages', $pgdata))
                return $this->db->insert_id(); 
            else
                return 0; 
        }     
    }

    function update_page($filename)
    {
        $pageid     =   $this->input->post('pageid');
        $creatorid  =   $this->input->post('creatorid');
        $pagetitle  =   TRIM($this->input->post('pagetitle'));
        $menutext   =   TRIM($this->input->post('menutext'));
        $message    =   $this->input->post('pagebody');
        $keywords   =   $this->input->post('pagekeywords');
        
        $pgdata = array(
            'creatorid'=> $creatorid,
            'pagetitle'=> $pagetitle,
            'menutext'=> $menutext,
            'pagebody'=> $message,
            'pageheadimg' => $filename,
            'pagekeywords'=> $keywords
        );
        
        $this->db->where('pageid', $pageid);
        if ($this->db->update('pages', $pgdata))
            return 1;
        else
            return 0;   
        
    }

    // Menu Management Classes
    function retrievesmenus()
    {
        $query =  $this->db->query("SELECT * FROM menusub WHERE viewstate ='show' ORDER BY menuposition ASC");
        return $query->result();
    }

    function retrievepmenus()
    {
        $query =  $this->db->query("SELECT * FROM menu WHERE viewstate ='show' ORDER BY menuposition ASC");
        return $query->result();
    }

    function retrieveuerprimenus($userclass)
    {
        $query =  $this->db->query("SELECT * FROM menu WHERE ownerclass = '$userclass' AND category='1' OR category=2");
        return $query->result();
    }

    function retrieveprimarymenus()
    {
        $query =  $this->db->query("SELECT * FROM menu WHERE  category=1 ");
        return $query->result();
    }

    function retrieveauser_menus($userclass)
    {
        $query =  $this->db->query("SELECT * FROM menu WHERE ownerclass = '$userclass'");
        return $query->result();
    }

    #Retrieve a Pages Information
    public function retrievea_menup(){
        $menu_id= $this->input->post('menu_id');

        $sqlstm="SELECT * FROM menu WHERE menu_id='$menu_id'";
        $q=$this->db->query($sqlstm);
        if($q->num_rows() > 0) {
            /*$row=$q->row_array();
            $jsonformat=json_encode($row);*/
            return $q->row_array();
        }else{
            return 0;
        }
    }

    #Retrieve a Pages Information
    public function retrievea_menus(){
        $subm_id= $this->input->post('menu_id');

        $sqlstm="SELECT * FROM menusub WHERE subm_id='$subm_id'";
        $q=$this->db->query($sqlstm);
        if($q->num_rows() > 0) {
            /*$row=$q->row_array();
            $jsonformat=json_encode($row);*/
            return $q->row_array();
        }else{
            return 0;
        }
    }

    //Submit a Menu
    function submit_menu()
    {
        $menu_id        = $this->input->post('menu_id');
        $auto_id        = $this->input->post('auto_id');
        $usergroup      = $this->input->post('usergroup');
        $category       = $this->input->post('category');
        $menutext       = TRIM($this->input->post('menutext'));
        $alttext        = TRIM($this->input->post('alttext'));
        $menulinks      = $this->input->post('menulinks');
        $tpage          = $this->input->post('tpage');
        $targetoption   = $this->input->post('targetoption');
        $viewstate      = $this->input->post('viewstate');
        $menuposition   = $this->input->post('menuposition');
        $menuparent     = $this->input->post('menuparent');
        $menulinks     = $this->input->post('menulinks');
               
        if ($category == 1 ) {
            $mndata = array(
                'menutext'=> $menutext,
                'alttext'=> $alttext,
                'targetpage'=> $tpage,
                'targetoption'=> $targetoption,
                'category'=> $category,
                'viewstate'=> $viewstate,
                'menuposition'=> $menuposition
            );

            $mnupdata = array(
                'menutext'=> $menutext,
                'alttext'=> $alttext,
                'targetpage'=> $tpage,
                'category'=> $category,
                'targetoption'=> $targetoption,
                'viewstate'=> $viewstate,
                'menuposition'=> $menuposition
            );

            $query =  $this->db->query("SELECT * FROM menu WHERE menutext = '$menutext'");
            if ($menu_id == 0 ) {
                if($query->num_rows > 0 )
                    {  return 2;   }
                else
                {
                    if($this->db->insert('menu', $mndata))
                        return 1; 
                    else
                        return 0; 
                }
            }
            elseif($menu_id != 0 ){
                $this->db->where('menu_id', $menu_id);
                if ($this->db->update('menu', $mnupdata))
                    return 3;
                else
                    return 0;
                        
            }
        }
        elseif ($category == 2){
          $mndata = array(
                'menutext'=> $menutext,
                'alttext'=> $alttext,
                'targetpage'=> $tpage,
                'targetoption'=> $targetoption,
                'category'=> $category,
                'viewstate'=> $viewstate,
                'pmenuid'=> $menuparent,
                'menuposition'=> $menuposition
            );

            $mnupdata = array(
                'menutext'=> $menutext,
                'alttext'=> $alttext,
                'targetpage'=> $tpage,
                'targetoption'=> $targetoption,
                'category'=> $category,
                'viewstate'=> $viewstate,
                'pmenuid'=> $menuparent,
                'menuposition'=> $menuposition
            );

            $query1 = $this->db->query("SELECT * FROM menusub WHERE menutext='$menutext' AND pmenuid='$menuparent'");
            if ($menu_id == 0 ) {
                if($query1->num_rows > 0 )
                    {  return 2;   }
                else
                {
                    if($this->db->insert('menusub', $mndata))
                        return 1; 
                    else
                        return 0; 
                }
            }
            elseif($menu_id != 0 ){
                $this->db->where('subm_id', $menu_id);
                if ($this->db->update('menusub', $mnupdata))
                    return 3;
                else
                    return 0;
                        
            }
        }
        elseif ($category == 3){
          $mndata = array(
                'menutext'=> $menutext,
                'alttext'=> $alttext,
                'targetpage'=> $menulinks,
                'targetoption'=> $targetoption,
                'category'=> $category,
                'viewstate'=> $viewstate,
                'pmenuid'=> $menuparent,
                'menuposition'=> $menuposition
            );

            $mnupdata = array(
                'menutext'=> $menutext,
                'alttext'=> $alttext,
                'targetpage'=> $menulinks,
                'targetoption'=> $targetoption,
                'category'=> $category,
                'viewstate'=> $viewstate,
                'pmenuid'=> $menuparent,
                'menuposition'=> $menuposition
            );

            $query1 = $this->db->query("SELECT * FROM menusub WHERE menutext='$menutext' AND pmenuid='$menuparent'");
            if ($menu_id == 0 ) {
                if($query1->num_rows > 0 )
                    {  return 2;   }
                else
                {
                    if($this->db->insert('menusub', $mndata))
                        return 1; 
                    else
                        return 0; 
                }
            }
            elseif($menu_id != 0 ){
                $this->db->where('subm_id', $menu_id);
                if ($this->db->update('menusub', $mnupdata))
                    return 3;
                else
                    return 0;
                        
            }
        }    
    }

    function delmenu($menu_id)
    {
        $query =  $this->db->query("DELETE FROM menu WHERE menu_id= $menu_id");
        return 1;
    }

    function delmenus($subm_id)
    {
        $query =  $this->db->query("DELETE FROM menusub WHERE subm_id = $subm_id");
        return 1;
    }


    function fetch_page($pageid)
    {
        $query =  $this->db->query("SELECT * FROM pages WHERE pageid = '$pageid'");
        return $query->row();
    }
    // RCCG News Sermon
    function retrievesermon()
    {
        $query =  $this->db->query("SELECT sermonid,title FROM sermon");
        return $query->result();
    }

    function findasermon($sermonid)
    {
        $query =  $this->db->query("SELECT * FROM sermon WHERE sermonid='$sermonid'");
        return $query->row();
    }

    function submit_sermon($filename){
        
        $title    = $this->input->post('title');
        $author    = $this->input->post('author');
        $body = $this->input->post('body');
        $viewstate     = $this->input->post('viewstate');
        $ownerclass     = $this->input->post('ownerclass');

        $query =  $this->db->query("SELECT * FROM sermon WHERE title = '$title' AND ownerid='$ownerclass'");
        if ($query->num_rows > 0 ) { 
            return 0;
        }

        $sermondata = array(
           'title'        => $title,
           'body'         => $body, 
           'viewstate'    => $viewstate,  
           'author'    => $author,  
           'ownerid'    => $ownerclass,  
           'thumbnail'    => $filename  
        );

        if($this->db->insert('sermon', $sermondata)){
            return 1; 
        }
        else 
            return 0;
    }

    function update_sermon($sermonid,$filename){
        
        $title    = $this->input->post('title');
        $author    = $this->input->post('author');
        $body = $this->input->post('body');
        $viewstate     = $this->input->post('viewstate');
        $ownerclass     = $this->input->post('ownerclass');


        $sermondata = array(
            'title'        => $title,
            'body'         => $body, 
            'viewstate'    => $viewstate,  
            'author'       => $author,  
            'ownerid'      => $ownerclass,  
            'thumbnail'    => $filename  
        );

        $this->db->where('sermonid', $sermonid);
        if ($this->db->update('sermon', $sermondata))
            return 1;
        else
            return 0;
    }

    function deleteasermon()
    {
        $sermonid= $this->input->post('sermonid');
        $query =  $this->db->query("DELETE FROM sermon WHERE sermonid = '$sermonid' ");
        return 1;
    }


    // RCCG News Classes
    function retrievenews()
    {
        $query =  $this->db->query("SELECT newsid,title FROM news");
        return $query->result();
    }

    function findanews($newsid)
    {
        $query =  $this->db->query("SELECT * FROM news WHERE newsid='$newsid'");
        return $query->row();
    }

    function submit_news($filename){
        
        $title          = $this->input->post('title');
        $category       = $this->input->post('category');
        $body           = $this->input->post('body');
        $newskeywords   = $this->input->post('newskeywords');
        $videolink      = $this->input->post('videolink');
        $creator        = $this->input->post('creator');
        $eventday        = $this->input->post('eventday');
        $viewstate      = $this->input->post('viewstate');
        
        $newsdata = array(
           'title'          => $title,
           'category'       => $category,
           'body'           => $body,
           'newskeywords'   => $newskeywords, 
           'videolink'      => $videolink, 
           'ownerid'        => $creator, 
           'eventday'        => $eventday, 
           'viewstate'      => $viewstate,  
           'thumbnail'      => $filename  
        );

        if($this->db->insert('news', $newsdata)){
            return 1; 
        }
        else 
            return 0;
    }

    function update_news($newsid,$filename){
        
        $title         = $this->input->post('title');
        $category      = $this->input->post('category');
        $body          = $this->input->post('body');
        $newskeywords  = $this->input->post('newskeywords');
        $videolink      = $this->input->post('videolink');
        $creator        = $this->input->post('creator');
        $eventday        = $this->input->post('eventday');
        $viewstate     = $this->input->post('viewstate');

        $newsdata = array(
           'title'        => $title,
           'category'     => $category,
           'body'         => $body,
           'newskeywords' => $newskeywords, 
           'videolink'    => $videolink, 
            'ownerid'     => $creator, 
           'viewstate'    => $viewstate,
           'eventday'        => $eventday,   
           'thumbnail'    => $filename  
        );

        $this->db->where('newsid', $newsid);
        if ($this->db->update('news', $newsdata))
            return 1;
        else
            return 0;
    }

    function deleteanews()
    {
        $newsid= $this->input->post('newsid');
        $query =  $this->db->query("DELETE FROM news WHERE newsid = '$newsid' ");
        return 1;
    }

    // Slider Classes
    function retrieveslider()
    {
        $query =  $this->db->query("SELECT * FROM slider");
        return $query->result();
    }

    function findaslider($slid)
    {
        $query =  $this->db->query("SELECT * FROM slider WHERE slid='$slid'");
        return $query->row();
    }

    function submit_slider($filename){
        
        $title      = $this->input->post('title');
        $longtitle  = $this->input->post('longtitle');
        $link       = $this->input->post('link');
        $linktext   = $this->input->post('linktext');
        //$description= $this->input->post('description');
        $status     = $this->input->post('status');
        $creator    = $this->input->post('creator'); 

        $sliderata = array(
           'title'      => $title,
           'longtitle'  => $longtitle,
           'link'       => $link,
           'linktext'   => $linktext,
           //'description'=> $description,
           'file'       => $filename,
           'category'   => 1,
           'status'     => $status,
           'creator'    => $creator
        );

        if($this->db->insert('slider', $sliderata)){
            return 1; 
        }
        else 
            return 0;
    }
    
    function update_slider($slid){
        $title      = $this->input->post('title');
        $longtitle  = $this->input->post('longtitle');
        $link       = $this->input->post('link');
        $linktext   = $this->input->post('linktext');
        //$description= $this->input->post('description');
        $status     = $this->input->post('status');
        $creator    = $this->input->post('creator'); 

        $slidedata = array(
            'title'      => $title,
            'longtitle'  => $longtitle,
            'link'       => $link,
            'linktext'   => $linktext,
            //'description'=> $description,
            'category'   => 1,
            'status'     => $status,
            'creator'    => $creator
        );

        $this->db->where('slid', $slid);
        if ($this->db->update('slider', $slidedata))
            return 1;
        else
            return 0;
    }

    function deleteaslider()
    {
        $slid= $this->input->post('slid');
        $query =  $this->db->query("DELETE FROM slider  WHERE slid = '$slid' ");
        return 1;
    }


    // Staff Management 
    function retrievestaff()
    {
        $query =  $this->db->query("SELECT * FROM staff");
        return $query->result();
    }

    function findastaff($slid)
    {
        $query =  $this->db->query("SELECT * FROM staff WHERE slid='$slid'");
        return $query->row();
    }

    function submit_staff($filename){
        
        $title          = $this->input->post('title');
        $description    = $this->input->post('description');
        $status         = $this->input->post('status');
        $currentposition= $this->input->post('currentposition');
        $position       = $this->input->post('position');
        $creator        = $this->input->post('creator'); 

        $staffata = array(
           'title'          => $title,
           'description'    => $description,
           'file'           => $filename,
           'currentposition'=> $currentposition,
           'status'         => $status,
           'position'       => $position,
           'creator'        => $creator
        );

        if($this->db->insert('staff', $staffata)){
            return 1; 
        }
        else 
            return 0;
    }
    
    function update_staff($slid){
        $title      = $this->input->post('title');
        $description= $this->input->post('description');
        $currentposition= $this->input->post('currentposition');
        $status     = $this->input->post('status');
        $position   = $this->input->post('position');
        $creator    = $this->input->post('creator'); 

        $slidedata = array(
            'title'             => $title,
            'description'       => $description,
            'currentposition'   => $currentposition,
            'status'            => $status,
            'position'          => $position,
            'creator'           => $creator
        );

        $this->db->where('slid', $slid);
        if ($this->db->update('staff', $slidedata))
            return 1;
        else
            return 0;
    }

    function deleteastaff()
    {
        $slid= $this->input->post('slid');
        $query =  $this->db->query("DELETE FROM staff  WHERE slid = '$slid' ");
        return 1;
    }

    
    // Manage Staff Publications
    function retrievepublications($auto_id)
    {
        $query =  $this->db->query("SELECT * FROM profile_publication  WHERE userid = '$auto_id' ");
        return $query->result();
    }

    public function retrievea_pub(){
        $auto_id= $this->input->post('auto_id');

        $sqlstm="SELECT * FROM profile_publication WHERE auto_id='$auto_id'";
        $q=$this->db->query($sqlstm);
        if($q->num_rows() > 0) {
            $row=$q->row_array();
            $jsonformat=json_encode($row);
            return $jsonformat;
        }else{
            return 0;
        }
    }

    function submit_publication()
    {
        $auto_id    = $this->input->post('auto_id');
        $userid    = $this->input->post('userid');
        $type  = $this->input->post('type');
        $title   = TRIM($this->input->post('title'));
        $authors  = TRIM($this->input->post('authors'));
        $abstract  = TRIM($this->input->post('abstract'));
        $links     = TRIM($this->input->post('links'));
        $yearpublished   = $this->input->post('yearpublished');
        $publisher    = $this->input->post('publisher');
        $keywords     = $this->input->post('keywords');
        $dept     = strtolower('_'.$this->input->post('dept'));                   
              
        
        $pudata = array(
            'userid'=> $userid,
            'type'=> $type,
            'title'=> $title,
            'authors'=> $authors,
            'abstract'=> $abstract,
            'links'=> $links,
            'yearpublished'=> $yearpublished,
            'publisher'=> $publisher,
            'keywords'=> $keywords,
            'dept'=> $dept
        );

        $query =  $this->db->query("SELECT * FROM profile_publication WHERE title = '$title' AND userid='$userid'");
        
        if ($auto_id == 0 ) {
            if($query->num_rows > 0 )
                {  return 2;   }
            else
            {
                if($this->db->insert('profile_publication', $pudata))
                    return 1; 
                else
                    return 0; 
            }
        }
        elseif($auto_id != 0 ){
            $this->db->where('auto_id', $auto_id);
            if ($this->db->update('profile_publication', $pudata))
                return 3;
            else
                return 0;
                    
        }
    }

    function deletepublication()
    {
        $auto_id= $this->input->post('auto_id');
        $query =  $this->db->query("DELETE FROM profile_publication  WHERE auto_id = '$auto_id' ");
        return 1;
    }

    // Manage Staff Experience
    function retrieveexperience($auto_id)
    {
        $query =  $this->db->query("SELECT * FROM profile_experience  WHERE userid = '$auto_id' ");
        return $query->result();
    }

    public function retrievea_exp(){
        $auto_id= $this->input->post('auto_id');

        $sqlstm="SELECT * FROM profile_experience WHERE auto_id='$auto_id'";
        $q=$this->db->query($sqlstm);
        if($q->num_rows() > 0) {
            $row=$q->row_array();
            $jsonformat=json_encode($row);
            return $jsonformat;
        }else{
            return 0;
        }
    }

    function submit_experience()
    {
        $auto_id    = $this->input->post('auto_id');
        $userid    = $this->input->post('userid');
        $organisation   = TRIM($this->input->post('organisation'));
        $position  = TRIM($this->input->post('position'));
        $duties  = TRIM($this->input->post('duties'));
        $fromyear   = $this->input->post('fromyear');
        $toyear    = $this->input->post('toyear');
        $dept     = strtolower('_'.$this->input->post('dept'));                   
              
        
        $pudata = array(
            'userid'        => $userid,
            'organisation'  => $organisation,
            'position'      => $position,
            'duties'        => $duties,
            'fromyear'      => $fromyear,
            'toyear'        => $toyear,
            'dept'          => $dept
        );

        $query =  $this->db->query("SELECT * FROM profile_experience WHERE position = '$position' AND organisation = '$organisation' AND userid='$userid'");
        
        if ($auto_id == 0 ) {
            if($query->num_rows > 0 )
                {  return 2;   }
            else
            {
                if($this->db->insert('profile_experience', $pudata))
                    return 1; 
                else
                    return 0; 
            }
        }
        elseif($auto_id != 0 ){
            $this->db->where('auto_id', $auto_id);
            if ($this->db->update('profile_experience', $pudata))
                return 3;
            else
                return 0;
                    
        }
    }

    function deleteexperience()
    {
        $auto_id= $this->input->post('auto_id');
        $query =  $this->db->query("DELETE FROM profile_experience  WHERE auto_id = '$auto_id' ");
        return 1;
    }


    // Manage Staff Awards
    function retrieveawards($auto_id)
    {
        $query =  $this->db->query("SELECT * FROM profile_award  WHERE userid = '$auto_id' ");
        return $query->result();
    }

    public function retrievean_award(){
        $auto_id= $this->input->post('auto_id');

        $sqlstm="SELECT * FROM profile_award WHERE auto_id='$auto_id'";
        $q=$this->db->query($sqlstm);
        if($q->num_rows() > 0) {
            $row=$q->row_array();
            $jsonformat=json_encode($row);
            return $jsonformat;
        }else{
            return 0;
        }
    }

    public function custom_send_mail($from_email,$to_email,$subject,$mailbody){
        $this->load->library('email');
        $this->email->from($from_email, SITE_TITLE);
        $this->email->to($to_email);
        $this->email->subject($subject);
        $this->email->message($mailbody);
        $this->email->send();
    }

    function submit_award()
    {
        $auto_id    = $this->input->post('auto_id');
        $userid    = $this->input->post('userid');
        $award   = TRIM($this->input->post('award'));
        $awardbody   = TRIM($this->input->post('awardbody'));
        $yearobtained  = TRIM($this->input->post('yearobtained'));
        $dept     = strtolower('_'.$this->input->post('dept'));                   
              
        
        $pudata = array(
            'userid' => $userid,
            'award'  => $award,
            'awardbody'  => $awardbody,
            'yearobtained' => $yearobtained,
            'dept' => $dept
        );

        $query =  $this->db->query("SELECT * FROM profile_award WHERE award = '$award' AND yearobtained = '$yearobtained' AND userid='$userid'");
        
        if ($auto_id == 0 ) {
            if($query->num_rows > 0 )
                {  return 2;   }
            else
            {
                if($this->db->insert('profile_award', $pudata))
                    return 1; 
                else
                    return 0; 
            }
        }
        elseif($auto_id != 0 ){
            $this->db->where('auto_id', $auto_id);
            if ($this->db->update('profile_award', $pudata))
                return 3;
            else
                return 0;
                    
        }
    }

    function deleteaward()
    {
        $auto_id= $this->input->post('auto_id');
        $query =  $this->db->query("DELETE FROM profile_award  WHERE auto_id = '$auto_id' ");
        return 1;
    }
    

    // Manage Staff Academic History
    function retrieveacademics($auto_id)
    {
        $query =  $this->db->query("SELECT * FROM profile_academic  WHERE userid = '$auto_id' ");
        return $query->result();
    }

    public function retrievean_academic(){
        $auto_id= $this->input->post('auto_id');

        $sqlstm="SELECT * FROM profile_academic WHERE auto_id='$auto_id'";
        $q=$this->db->query($sqlstm);
        if($q->num_rows() > 0) {
            $row=$q->row_array();
            $jsonformat=json_encode($row);
            return $jsonformat;
        }else{
            return 0;
        }
    }

    function submit_academic()
    {
        $auto_id    = $this->input->post('auto_id');
        $userid    = $this->input->post('userid');
        $qualification   = TRIM($this->input->post('qualification'));
        $institution   = TRIM($this->input->post('institution'));
        $classofgrade   = TRIM($this->input->post('classofgrade'));
        $yearobtained   = TRIM($this->input->post('yearobtained'));
        $field  = TRIM($this->input->post('field'));
        $dept     = strtolower('_'.$this->input->post('dept'));                   
              
        
        $pudata = array(
            'userid' => $userid,
            'qualification'  => $qualification,
            'institution'  => $institution,
            'classofgrade'  => $classofgrade,
            'yearobtained' => $yearobtained,
            'field' => $field,
            'dept' => $dept
        );

        $query =  $this->db->query("SELECT * FROM profile_academic WHERE qualification = '$qualification' 
            AND institution = '$institution' AND yearobtained = '$yearobtained' AND userid='$userid'");
        
        if ($auto_id == 0 ) {
            if($query->num_rows > 0 )
                {  return 2;   }
            else
            {
                if($this->db->insert('profile_academic', $pudata))
                    return 1; 
                else
                    return 0; 
            }
        }
        elseif($auto_id != 0 ){
            $this->db->where('auto_id', $auto_id);
            if ($this->db->update('profile_academic', $pudata))
                return 3;
            else
                return 0;
                    
        }
    }

    function deleteacademic()
    {
        $auto_id= $this->input->post('auto_id');
        $query =  $this->db->query("DELETE FROM profile_academic  WHERE auto_id = '$auto_id' ");
        return 1;
    }

    public function retrievemedia()
    {
      $query = $this->db->get_where('media');
      return  $query->result();     
    }

    function submit_media($filename){
        
        $userid    = $this->input->post('creator');

        $mediadata = array(
           'userid' => $userid, 
           'image'   => $filename
        );

        if($this->db->insert('media', $mediadata)){
            return 1; 
        }
        else 
            return 0;
    }

    function delete_apics($picid)
    {
      $this->load->helper("url");

      $this->db->where('picid', $picid);
      $query = $this->db->get_where('media');

      $result   = $query->row_array();
      $image = $result['image'];

      $path = './uploads/'.$image.'.jpg';

      $this->db->where('picid', $picid);
      if($this->db->delete('media')){
        unlink($path);
        return 1;
      }
    }

    public function retrievedocs()
    {
      $query = $this->db->get_where('documents');
      return  $query->result();     
    }

    function submit_doc($filename){
        
        $userid    = $this->input->post('creator');
        $title    = $this->input->post('title');

        $mediadata = array(
           'title' => $title, 
           'userid' => $userid, 
           'file'   => $filename
        );

        if($this->db->insert('documents', $mediadata)){
            return 1; 
        }
        else 
            return 0;
    }

    function delete_docs($picid)
    {
      $this->load->helper("url");

      $this->db->where('picid', $picid);
      $query = $this->db->get_where('documents');

      $result   = $query->row_array();
      $file = $result['file'];

      $path = './uploads/'.$file.'.pdf';

      $this->db->where('picid', $picid);
      if($this->db->delete('documents')){
        unlink($path);
        return 1;
      }
    }


    // Gallery Album Classess
    function submit_album($filename){
        $projecttitle       = $this->input->post('projecttitle');
        $longtitle       = $this->input->post('longtitle');
        $status    = $this->input->post('status');
        $creator    = $this->input->post('creator'); 

        $sliderata = array(
           
           'projecttitle'=> $projecttitle,
           'file'        => $filename,
           'longtitle'   => $longtitle,
           'status'      => $status,
           'creator'     => $creator
        );

        if($this->db->insert('projects', $sliderata)){
            return $this->db->insert_id();
        }
        else 
            return 0;
    }

    function update_album($slid){
        $projecttitle       = $this->input->post('projecttitle');
        $longtitle       = $this->input->post('longtitle');
        $status    = $this->input->post('status');

        $slidedata = array(
           'projecttitle'=> $projecttitle,
           'longtitle'   => $longtitle,
           'status'      => $status
        );

        $this->db->where('slid', $slid);
        if ($this->db->update('projects', $slidedata))
            return 1;
        else
            return 0;
    }

    function retrievealbum()
    {
        $query =  $this->db->query("SELECT * FROM projects");
        return $query->result();
    }

    function retrieveprojectsltd()
    {
        $query =  $this->db->query("SELECT * FROM projects WHERE company='PS LIMITED' AND status='show' ORDER BY addeddate DESC");
        return $query->result();
    }

    function retrieveprojectscon()
    {
        $query =  $this->db->query("SELECT * FROM projects WHERE company='PS CONSULT' AND status='show' ORDER BY addeddate DESC");
        return $query->result();
    }

    function findaproject($slid)
    {
        $query =  $this->db->query("SELECT * FROM projects WHERE slid='$slid'");
        return $query->row();
    }

    function deleteaproject()
    {
        $slid= $this->input->post('slid');
        $query =  $this->db->query("DELETE FROM projects  WHERE slid = '$slid' ");
        return 1;
    }


    function delete_agallerypics($picid)
    {
      $this->load->helper("url");

      $this->db->where('picid', $picid);
      $query = $this->db->get_where('gallery');

      $result   = $query->row_array();
      $image = $result['image'];

      $path = './uploads/'.$image.'.jpg';

      $this->db->where('picid', $picid);
      if($this->db->delete('gallery')){
        unlink($path);
        return 1;
      }
    }

    public function findaprojectimages($slid)
    {
      $this->db->where('stid', $slid);
      $query = $this->db->get_where('gallery');
      return  $query->result();     
    }
    
    public function submit_galleryimage($stid, $filename)
    {
      $userid = $this->input->post('creator');
      
      $galleryinfo = array(
         'stid'    => $stid,
         'userid'  => $userid,
         'image'   => $filename
      );
               
      $this->db->set($galleryinfo); 
      if($this->db->insert('gallery'))
      {
        return 1;
      }
      else
        return 0;
    }
    

    //Video Management

    function submit_video()
    {
        $vid            = $this->input->post('vid');
        $userid         = $this->input->post('userid');
        $userclass      = $this->input->post('userclass');
        $videocode      = $this->input->post('videocode');
        $description    = $this->input->post('description');                  
        $status         = $this->input->post('status');                  
              
        $videodata = array(
            'userid'        => $userid,
            'userclass'     => $userclass,
            'videocode'     => $videocode,
            'description'   => $description,
            'status'        => $status
        );
        
        if ($vid == 0 ) {
            if($this->db->insert('videoyoutube', $videodata))
                return 1; 
            else
                return 0; 
        }
        elseif($vid != 0 ){
            $this->db->where('vid', $vid);
            if ($this->db->update('videoyoutube', $videodata))
                return 3;
            else
                return 0;
                    
        }
    }

    # Manage Video Methods
    public function retrievea_video(){
        $vid= $this->input->post('vid');

        $sqlstm="SELECT * FROM videoyoutube WHERE vid='$vid'";
        $q=$this->db->query($sqlstm);
        if($q->num_rows() > 0) {
            /*$row=$q->row_array();
            $jsonformat=json_encode($row);*/
            return $q->row_array();
        }else{
            return 0;
        }
    }

    function view_managevideos($userclass)
    {
        $query =  $this->db->query("SELECT * FROM videoyoutube WHERE userclass = '$userclass'");
        return $query->result();
    }

    function view_managevideosall()
    {
        $query =  $this->db->query("SELECT * FROM videoyoutube");
        return $query->result();
    }


    function deletevideo()
    {
        $vid= $this->input->post('vid');
        $query =  $this->db->query("DELETE FROM videoyoutube  WHERE vid = '$vid' ");
        return 1;
    }

    // Services Classes
    function retrievetraining()
    {
        $query =  $this->db->query("SELECT * FROM trainings");
        return $query->result();
    }

    function submit_training()
    {
        $training_id    = $this->input->post('training_id');
        $title         = $this->input->post('title');
        $description          = $this->input->post('description');
        $position      = $this->input->post('position');
        $creator       = $this->input->post('creator');
        $viewstate     = $this->input->post('viewstate');
           
        $trainingdata = array(
            'title'          => $title,
            'description'    => $description, 
            'position'       => $position, 
            'ownerid'        => $creator, 
            'viewstate'      => $viewstate 
        );

        $query =  $this->db->query("SELECT * FROM trainings WHERE title = '$title'");
        if ($training_id == 0 ) {
            if($query->num_rows > 0 )
                {  return 2;   }
            else
            {
                if($this->db->insert('trainings', $trainingdata))
                    return 1; 
                else
                    return 0; 
            }
        }
        elseif($training_id != 0 ){
            $this->db->where('training_id', $training_id);
            if ($this->db->update('trainings', $trainingdata))
                return 3;
            else
                return 0;    
        }
    }

    #Retrieve a Service Information
    public function retrievea_training(){
        $training_id= $this->input->post('training_id');

        $sqlstm="SELECT * FROM trainings WHERE training_id='$training_id'";
        $q=$this->db->query($sqlstm);
        if($q->num_rows() > 0) {
            $row=$q->row_array();
            $jsonformat=json_encode($row);
            return $jsonformat;
        }else{
            return 0;
        }
    }

    function deleteatraining()
    {
        $training_id= $this->input->post('training_id');
        $query =  $this->db->query("DELETE FROM trainings WHERE training_id = '$training_id' ");
        return 1;
    }

    function changestatus($user_id,$status)
    {
        $this->db->where('id', $user_id)->update('pty_users', array('status' =>$status));
        return 1;
    }

    function completestatus($user_id,$status)
    {
        $this->db->where('id', $user_id)->update('pty_users', array('completed' =>$status));
        return 1;
    }
    
    // Division Classes
    function retrievedivision()
    {
        $query =  $this->db->query("SELECT * FROM division");
        return $query->result();
    }

    function retrievecat_division()
    {
        $query =  $this->db->query("SELECT divcat_id,dc.division_id as division_id, divisioncat_name, division_name FROM division_categories dc 
            INNER JOIN division d ON dc.division_id=d.division_id");
        return $query->result();
    }

    function submit_division()
    {
        $divcat_id          = $this->input->post('divcat_id');
        $division_id        = $this->input->post('division_id');
        $divisioncat_name   = $this->input->post('divisioncat_name');
        $description        = $this->input->post('description');
        $position           = $this->input->post('position');
        $creator            = $this->input->post('creator');
        $viewstate          = $this->input->post('viewstate');
           
        $trainingdata = array(
            'division_id'       => $division_id,
            'divisioncat_name'  => $divisioncat_name,
            'description'       => $description, 
            'position'          => $position, 
            'ownerid'           => $creator, 
            'viewstate'         => $viewstate 
        );

        $query =  $this->db->query("SELECT * FROM division_categories WHERE divisioncat_name = '$divisioncat_name'");
        if ($divcat_id == 0 ) {
            if($query->num_rows > 0 )
                {  return 2;   }
            else
            {
                if($this->db->insert('division_categories', $trainingdata))
                    return 1; 
                else
                    return 0; 
            }
        }
        elseif($divcat_id != 0 ){
            $this->db->where('divcat_id', $divcat_id);
            if ($this->db->update('division_categories', $trainingdata))
                return 3;
            else
                return 0;    
        }
    }

    #Retrieve a Division Information
    public function retrievea_division(){
        $divcat_id= $this->input->post('divcat_id');

        $sqlstm="SELECT * FROM division_categories WHERE divcat_id='$divcat_id'";
        $q=$this->db->query($sqlstm);
        if($q->num_rows() > 0) {
            /*$row=$q->row_array();
            $jsonformat=json_encode($row);*/
            return $q->row_array();
        }else{
            return 0;
        }
    }

    function deleteadivision()
    {
        $divcat_id= $this->input->post('divcat_id');
        $query =  $this->db->query("DELETE FROM division_categories WHERE divcat_id = '$divcat_id' ");
        return 1;
    }

    // Services Classes
    public function retrieveservices()
    {
      $query = $this->db->get_where('services');
      return  $query->result();     
    }

    function submit_service($filename){
        
        $service_id     = $this->input->post('service_id');
        $userid         = $this->input->post('creator');
        $title          = $this->input->post('title');
        $viewstate      = $this->input->post('viewstate');
        $description    = $this->input->post('description');
        $position    = $this->input->post('position');

        
        
        $servicedata = array(
           'userid'     => $userid, 
           'title'      => $title, 
           'viewstate'  => $viewstate, 
           'description'=> $description, 
           'position'=> $position, 
           'image'      => $filename
        );

        if ($service_id==0) {
            $query =  $this->db->query("SELECT * FROM services WHERE title = '$title'");
            if($query->num_rows > 0 ){  return -2;   }
            if($this->db->insert('services', $servicedata)){
                return $this->db->insert_id(); 
            }
            else 
                return 0;
        }else{
            $query1 =  $this->db->query("SELECT * FROM services WHERE title = '$title' AND service_id!=$service_id");
            if($query1->num_rows > 0 ){  return -2;   }
            $this->db->where('service_id', $service_id);
            if ($this->db->update('services', $servicedata))
                return 1;
            else
                return 0;
        }
           
    }

    function retrieve_a_service($service_id)
    {
        $query =  $this->db->query("SELECT * FROM services WHERE service_id = '$service_id'");
        return $query->row();
    }

    function deletea_service()
    {
        $service_id= $this->input->post('service_id');
        $query =  $this->db->query("DELETE FROM services  WHERE service_id = '$service_id' ");
        return 1;
    }

    // JOBS Classes
    function retrievejob()
    {
        $query =  $this->db->query("SELECT * FROM jobs");
        return $query->result();
    }

    function submit_job()
    {
        $job_id    = $this->input->post('job_id');
        $title         = $this->input->post('title');
        $description          = $this->input->post('description');
        $position      = $this->input->post('position');
        $creator       = $this->input->post('creator');
        $viewstate     = $this->input->post('viewstate');
           
        $jobdata = array(
            'title'          => $title,
            'description'    => $description, 
            'position'       => $position, 
            'ownerid'        => $creator, 
            'viewstate'      => $viewstate 
        );

        $query =  $this->db->query("SELECT * FROM jobs WHERE title = '$title'");
        if ($job_id == 0 ) {
            if($query->num_rows > 0 )
                {  return 2;   }
            else
            {
                if($this->db->insert('jobs', $jobdata))
                    return 1; 
                else
                    return 0; 
            }
        }
        elseif($job_id != 0 ){
            $this->db->where('job_id', $job_id);
            if ($this->db->update('jobs', $jobdata))
                return 3;
            else
                return 0;    
        }
    }

    #Retrieve a Job Information
    public function retrievea_job(){
        $job_id= $this->input->post('job_id');

        $sqlstm="SELECT * FROM jobs WHERE job_id='$job_id'";
        $q=$this->db->query($sqlstm);
        if($q->num_rows() > 0) {
            $row=$q->row_array();
            $jsonformat=json_encode($row);
            return $jsonformat;
        }else{
            return 0;
        }
    }

    function deleteajob()
    {
        $job_id= $this->input->post('job_id');
        $query =  $this->db->query("DELETE FROM jobs WHERE job_id = '$job_id' ");
        return 1;
    }

    public function retrieve_contact_messages(){ 
        $query =  $this->db->query("SELECT * FROM contactmess ORDER BY datesent DESC");
        return $query->result();
    }
    
    public function retrieve_newsletter(){ 
        $query =  $this->db->query("SELECT * FROM newsletters ORDER BY datesent DESC");
        return $query->result();
    }


}