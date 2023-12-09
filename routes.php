<?php
ini_set( 'display_errors', 1 );
ini_set( 'display_startup_errors', 1 );
error_reporting( E_ALL );

require_once __DIR__.'/router.php';


//Authentication

get('/', 'auth/login.php');
post('/login', 'auth/plogin.php');
get('/password/reset', 'auth/forgot_password.php');
get('/logout', 'auth/logout.php');
get('/admin/logout', 'auth/plogout.php');
post('/password/reset/mail', 'auth/mail_password_link.php');
get('/password/reset/mail/confirm', 'auth/confirm_mail.php');
get('/password/create/new', 'auth/reset_password.php');
post('/password/create/new', 'auth/create_password.php');



//Admin
get('/admin/dashboard', 'views/pages/admin/dashboard.php');

get('/admin/profile', 'views/pages/admin/profile.php');
post('/admin/profile/update', 'views/pages/admin/update_profile.php');

post('/admin/profile/image/cover', 'views/pages/admin/cover_image.php');
post('/admin/profile/image/picture', 'views/pages/admin/picture_image.php');

post('/admin/profile/password/update', 'views/pages/admin/change_password.php');

get('/admin/user/add', 'views/pages/admin/adduser.php');
post('/admin/user/add', 'views/pages/admin/postAddUser.php');

get('/admin/user/manage', 'views/pages/admin/manageUser.php');

get('/admin/user/edit', 'views/pages/admin/editUser.php');
post('/admin/user/edit', 'views/pages/admin/postEditUser.php');

post('/admin/user/delete', 'views/pages/admin/postDeleteUser.php');


get('/admin/add/student/type', 'views/pages/admin/studentType.php');
post('/admin/add/student/type', 'views/pages/admin/postStudentType.php');

get('/admin/add/student/bachelor', 'views/pages/admin/bachelorStudent.php');
post('/admin/add/student/bachelor', 'views/pages/admin/postBachelorStudent.php');

get('/admin/add/student/masters', 'views/pages/admin/mastersStudent.php');
post('/admin/add/student/masters', 'views/pages/admin/postMastersStudent.php');


get('/admin/manage/student/type', 'views/pages/admin/manageStudentType.php');
post('/admin/manage/student/type', 'views/pages/admin/postManageStudentType.php');


get('/admin/manage/student/bachelor', 'views/pages/admin/manageBachelorStudent.php');
post('/admin/manage/student/bachelor', 'views/pages/admin/postManageBachelorStudent.php');

get('/admin/student/bachelor/edit', 'views/pages/admin/editBachelorStudent.php');
post('/admin/student/bachelor/edit', 'views/pages/admin/postEditBachelorStudent.php');

post('/admin/student/bachelor/delete', 'views/pages/admin/postDeleteBachelorStudent.php');


get('/admin/manage/student/masters', 'views/pages/admin/manageMastersStudent.php');
post('/admin/manage/student/masters', 'views/pages/admin/postManageMastersStudent.php');

get('/admin/student/masters/edit', 'views/pages/admin/editMastersStudent.php');
post('/admin/student/masters/edit', 'views/pages/admin/postEditMastersStudent.php');

post('/admin/student/masters/delete', 'views/pages/admin/postDeleteMastersStudent.php');

//student site

get('/verify-certificate', 'views/pages/student/index.php');
post('/certicate/verification', 'views/pages/student/verify.php');



//Error
get('/500', 'views/500.php');
any('/404', 'views/404.php');