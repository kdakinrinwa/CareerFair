<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'Home';
$route['404_override']       = 'Home/error';

// ── Check-in system routes ─────────────────────────────────
$route['checkin']                    = 'Checkin/index';
$route['checkin/login']              = 'Checkin/login';
$route['checkin/do_login']           = 'Checkin/do_login';
$route['checkin/logout']             = 'Checkin/logout';
$route['checkin/scan']               = 'Checkin/scan';
$route['checkin/verify']             = 'Checkin/verify';
$route['checkin/attendance']         = 'Checkin/attendance';
$route['checkin/report']             = 'Checkin/report';

// ── Admin panel routes ─────────────────────────────────────
$route['admin']                      = 'Admin/login';
$route['admin/login']                = 'Admin/login';
$route['admin/validate']             = 'Admin/validate';
$route['admin/dashboard']            = 'Admin/dashboard';
$route['admin/signout']              = 'Admin/signout';
$route['admin/changepass']           = 'Admin/changepass';
$route['admin/resetpassword']        = 'Admin/resetpassword';
$route['admin/students']             = 'Admin/students';
$route['admin/view_student/(:num)']  = 'Admin/view_student/$1';
$route['admin/toggle_student_status']= 'Admin/toggle_student_status';
$route['admin/employers']            = 'Admin/employers';
$route['admin/view_employer/(:num)'] = 'Admin/view_employer/$1';
$route['admin/toggle_employer_status']='Admin/toggle_employer_status';
$route['admin/booths']               = 'Admin/booths';
$route['admin/approve_booth']        = 'Admin/approve_booth';
$route['admin/talks']                = 'Admin/talks';
$route['admin/approve_talk']         = 'Admin/approve_talk';
$route['admin/news']                 = 'Admin/news';
$route['admin/add_news']             = 'Admin/add_news';
$route['admin/save_news']            = 'Admin/save_news';
$route['admin/edit_news/(:num)']     = 'Admin/edit_news/$1';
$route['admin/update_news']          = 'Admin/update_news';
$route['admin/delete_news']          = 'Admin/delete_news';
$route['admin/qr_passes']            = 'Admin/qr_passes';
$route['admin/revoke_qr']            = 'Admin/revoke_qr';
$route['admin/opportunities']        = 'Admin/opportunities';
$route['admin/toggle_opp_status']    = 'Admin/toggle_opp_status';
$route['admin/reports']              = 'Admin/reports';
$route['admin/audit_log']            = 'Admin/audit_log';
$route['admin/settings']             = 'Admin/settings';
$route['admin/save_settings']        = 'Admin/save_settings';
$route['admin/messages']             = 'Admin/messages';
$route['admin/admins']               = 'Admin/admins';
$route['admin/save_admin']           = 'Admin/save_admin';
$route['admin/error']                = 'Admin/error';

// ── Student portal routes ──────────────────────────────────
$route['student']                    = 'Student/dashboard';
$route['student/dashboard']          = 'Student/dashboard';
$route['student/profile']            = 'Student/profile';
$route['student/cv']                 = 'Student/cv';
$route['student/qr']                 = 'Student/qr';
$route['student/upload_passport']    = 'Student/upload_passport';
$route['student/opportunities']      = 'Student/opportunities';
$route['student/events']             = 'Student/events';
$route['student/messages']           = 'Student/messages';
$route['student/settings']           = 'Student/settings';
$route['student/logout']             = 'Student/logout';

// ── Employer portal routes ─────────────────────────────────
$route['employer']                   = 'Employer/dashboard';
$route['employer/dashboard']         = 'Employer/dashboard';
$route['employer/logout']            = 'Employer/logout';

// ── Alumni portal routes ───────────────────────────────────
$route['alumni/dashboard']           = 'Alumni_portal/dashboard';
$route['alumni/logout']              = 'Alumni_portal/logout';


