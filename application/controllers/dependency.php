<?php
/*
 * dependency.php – Global bootstrap include for all PUBLIC controllers.
 * Loaded via require_once('dependency.php') inside the Home controller constructor.
 * Sets up shared models, fetches global nav/settings data, and pre-renders
 * the four global partials (css, js, header, footer) into $this->data[].
 *
 * NOTE: Admin, Student, Employer, Alumni_portal controllers do NOT use this file.
 *       They manage their own models and view partials independently.
 */

// Load shared models
$this->load->model('Admin_model', 'amodel');
$this->load->model('Home_model',  'hmodel');

// ── Global nav & settings data ────────────────────────────────────────────
$data['info']     = $this->amodel->retrievesettings();   // site settings row
$data['menup']    = $this->amodel->retrievepmenus();     // primary nav menus
$data['menus']    = $this->amodel->retrievesmenus();     // sub-menus
$data['proglink'] = $this->hmodel->findservices();       // services list for nav
$data['eventf']   = $this->hmodel->findeventsfooter();  // 2 recent events for footer widget

// ── Pre-render global view partials ──────────────────────────────────────
$this->data['css']    = $this->load->view('global/public_css',    '',    TRUE);
$this->data['js']     = $this->load->view('global/public_js',     '',    TRUE);
$this->data['header'] = $this->load->view('global/public_header', $data, TRUE);
$this->data['footer'] = $this->load->view('global/public_footer', $data, TRUE);
