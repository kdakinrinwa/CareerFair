<?php
/**
 * Employer_model
 * FUTA Career Services & Career Fair Portal
 */
class Employer_model extends CI_Model {

    function __construct() { parent::__construct(); }

    // ── Employer profile ──────────────────────────────────────
    public function get_employer($employer_id) {
        if (!$this->db->table_exists('cf_employers')) return null;
        $q = $this->db->get_where('cf_employers', ['employer_id' => $employer_id]);
        return $q->num_rows() ? $q->row() : null;
    }

    public function update_profile($employer_id) {
        $data = [
            'org_name'            => $this->input->post('org_name'),
            'org_type'            => $this->input->post('org_type'),
            'website'             => $this->input->post('website'),
            'contact_name'        => $this->input->post('contact_name'),
            'contact_phone'       => $this->input->post('contact_phone'),
            'contact_designation' => $this->input->post('contact_designation'),
        ];
        $interests = $this->input->post('recruit_interest');
        if (is_array($interests)) $data['recruit_interest'] = implode(',', $interests);
        $this->db->where('employer_id', $employer_id);
        return $this->db->update('cf_employers', $data) ? 1 : 0;
    }

    // ── CV / Talent search ────────────────────────────────────
    public function search_candidates($school_id = null, $skill = null, $interest = null, $level = null, $q = null) {
        if (!$this->db->table_exists('cf_students')) return [];
        $this->db->select('student_id, fullname, matric_no, school_id, level, skills, career_interest, linkedin_url, github_url, available_for');
        $this->db->from('cf_students');
        $this->db->where('accstatus', 'active');
        if ($school_id) $this->db->where('school_id', (int)$school_id);
        if ($level)     $this->db->where('level', $level);
        if ($skill)     $this->db->like('skills', $skill);
        if ($interest)  $this->db->like('career_interest', $interest);
        if ($q)         $this->db->like('fullname', $q);
        $this->db->order_by('fullname', 'ASC');
        return $this->db->get()->result();
    }

    public function get_cv_matches($employer_id, $limit = 10) {
        // Return students with active CVs for this employer's industry
        if (!$this->db->table_exists('cf_students') || !$this->db->table_exists('cf_student_cvs')) return [];
        $this->db->select('s.student_id, s.fullname, s.matric_no, s.level, s.school_id, s.skills, s.career_interest, c.filename, c.uploaded_at');
        $this->db->from('cf_students s');
        $this->db->join('cf_student_cvs c', 'c.student_id = s.student_id AND c.is_active = 1', 'inner');
        $this->db->where('s.accstatus', 'active');
        $this->db->order_by('c.uploaded_at', 'DESC');
        $this->db->limit($limit);
        return $this->db->get()->result();
    }

    // ── Shortlisting ──────────────────────────────────────────
    public function get_shortlists($employer_id) {
        if (!$this->db->table_exists('cf_candidate_shortlists')) return [];
        $this->db->select('sl.*, s.fullname, s.matric_no, s.level, s.school_id, s.skills, s.career_interest');
        $this->db->from('cf_candidate_shortlists sl');
        $this->db->join('cf_students s', 's.student_id = sl.student_id', 'left');
        $this->db->where('sl.employer_id', $employer_id);
        $this->db->order_by('sl.shortlisted_at', 'DESC');
        return $this->db->get()->result();
    }

    public function add_to_shortlist($employer_id, $student_id, $tag = 'Interested') {
        if (!$this->db->table_exists('cf_candidate_shortlists')) return 0;
        // Check if already shortlisted – update tag instead
        $this->db->where(['employer_id'=>$employer_id, 'student_id'=>$student_id, 'fair_id'=>1]);
        $q = $this->db->get('cf_candidate_shortlists');
        if ($q->num_rows()) {
            $this->db->where(['employer_id'=>$employer_id, 'student_id'=>$student_id, 'fair_id'=>1]);
            return $this->db->update('cf_candidate_shortlists', ['tag'=>$tag]) ? 2 : 0;
        }
        $data = ['employer_id'=>$employer_id, 'student_id'=>$student_id, 'fair_id'=>1, 'tag'=>$tag];
        return $this->db->insert('cf_candidate_shortlists', $data) ? 1 : 0;
    }

    // ── Booth ─────────────────────────────────────────────────
    public function get_booth_request($employer_id) {
        if (!$this->db->table_exists('cf_booth_requests')) return null;
        $q = $this->db->get_where('cf_booth_requests', ['employer_id'=>$employer_id, 'fair_id'=>1]);
        return $q->num_rows() ? $q->row() : null;
    }

    public function submit_booth_request($employer_id) {
        if (!$this->db->table_exists('cf_booth_requests')) return 0;
        $existing = $this->get_booth_request($employer_id);
        if ($existing) return 2; // already requested
        $data = [
            'employer_id'  => $employer_id,
            'fair_id'      => 1,
            'booth_size'   => $this->input->post('booth_size') ?: 'Standard',
            'requirements' => $this->input->post('requirements'),
            'status'       => 'pending',
        ];
        return $this->db->insert('cf_booth_requests', $data) ? 1 : 0;
    }

    // ── Career talk ───────────────────────────────────────────
    public function get_career_talk($employer_id) {
        if (!$this->db->table_exists('cf_career_talks')) return null;
        $q = $this->db->get_where('cf_career_talks', ['employer_id'=>$employer_id, 'fair_id'=>1]);
        return $q->num_rows() ? $q->row() : null;
    }

    // ── Opportunities ─────────────────────────────────────────
    public function get_my_opportunities($employer_id) {
        if (!$this->db->table_exists('cf_job_opportunities')) return [];
        $q = $this->db->get_where('cf_job_opportunities', ['employer_id'=>$employer_id]);
        return $q->result();
    }

    public function save_opportunity($employer_id) {
        if (!$this->db->table_exists('cf_job_opportunities')) return 0;
        $opp_id = (int)$this->input->post('opp_id');
        $data = [
            'employer_id'     => $employer_id,
            'title'           => $this->input->post('title'),
            'opp_type'        => $this->input->post('opp_type'),
            'location'        => $this->input->post('location'),
            'description'     => $this->input->post('description'),
            'req_skills'      => $this->input->post('req_skills'),
            'min_qualification'=> $this->input->post('min_qualification'),
            'deadline'        => $this->input->post('deadline'),
            'status'          => 'active',
        ];
        if ($opp_id) {
            $this->db->where('opp_id', $opp_id);
            $this->db->where('employer_id', $employer_id);
            return $this->db->update('cf_job_opportunities', $data) ? 1 : 0;
        }
        return $this->db->insert('cf_job_opportunities', $data) ? 1 : 0;
    }
}
