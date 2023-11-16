<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- ===============================================-->
<!--    Favicons-->
<!-- ===============================================-->

<!--<link rel="apple-touch-icon" sizes="180x180" href="/assets/img/favicons/apple-tosuch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="/assets/img/favicons/favsicon-32x32.png">-->
<link rel="icon" type="image/png" sizes="16x16" href="/assets/img/<?= $_ENV['TITLE_LOGO']; ?>">
<!--<link rel="shortcut icon" type="image/x-icon" href="/assets/img/favicons/favicon.ico">-->
<link rel="manifest" href="/assets/img/favicons/manifest.json">
<meta name="msapplication-TileImage" content="/assets/img/favicons/mstile-150x150.png">
<meta name="theme-color" content="#ffffff">
<script src="/assets/js/config.js"></script>
<script src="/vendors/simplebar/simplebar.min.js"></script>


<!-- ===============================================-->
<!--    Stylesheets-->
<!-- ===============================================-->

<link rel="preconnect" href="https://fonts.gstatic.com/">
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,500,600,700%7cPoppins:300,400,500,600,700,800,900&amp;display=swap" rel="stylesheet">
<link href="/vendors/simplebar/simplebar.min.css" rel="stylesheet">
<link href="/assets/css/theme-rtl.min.css" rel="stylesheet" id="style-rtl">
<link href="/assets/css/theme.min.css" rel="stylesheet" id="style-default">
<link href="/assets/css/user-rtl.min.css" rel="stylesheet" id="user-style-rtl">
<link href="/assets/css/user.min.css" rel="stylesheet" id="user-style-default">
<link rel="stylesheet" type="text/css" href="/assets/fontawesome/css/all.css">
<link href="/vendors/choices/choices.min.css" rel="stylesheet" />
<link href="/vendors/swiper/swiper-bundle.min.css" rel="stylesheet" />

<script>
var isRTL = JSON.parse(localStorage.getItem('isRTL'));
if (isRTL) {
    var linkDefault = document.getElementById('style-default');
    var userLinkDefault = document.getElementById('user-style-default');
    linkDefault.setAttribute('disabled', true);
    userLinkDefault.setAttribute('disabled', true);
    document.querySelector('html').setAttribute('dir', 'rtl');
} else {
    var linkRTL = document.getElementById('style-rtl');
    var userLinkRTL = document.getElementById('user-style-rtl');
    linkRTL.setAttribute('disabled', true);
    userLinkRTL.setAttribute('disabled', true);
}
</script>

<link href="/vendors/prism/prism-okaidia.css" rel="stylesheet">

<link rel="stylesheet" href="/assets/js/sweetalert2.min.css">
<link href="/vendors/datatables.net-bs5/dataTables.bootstrap5.min.css" rel="stylesheet">

<script src="/vendors/select2/select2.min.css"></script>
<script src="/vendors/select2-bootstrap-5-theme/select2-bootstrap-5-theme.min.css"></script>

<script src="/vendors/jquery/jquery.min.js"></script>


<script src="/assets/js/sweetalert2.all.min.js"></script>