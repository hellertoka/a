<?php
$newsletteremail="";
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit-newsletter'])&& isset($_POST['g-recaptcha-response'])) {

    $newsletteremail = test_input($_POST["newsletteremail"]);
    if (!empty($newsletteremail) && filter_var($newsletteremail, FILTER_VALIDATE_EMAIL)){ 
        $recaptcha = $_POST["g-recaptcha-response"];
        $gsecret="6LdUdcYpAAAAAK7OHSZIo6-qLJw-fKNaEJtYT0h9";
        $body = "secret=$gsecret&response=$recaptcha";
        $url="https://www.google.com/recaptcha/api/siteverify?".$body;
        $req=postReq($newsletteremail,"ReCaptcha Verify",$url,$body,'','');
        
        $reqjson=json_decode($req,TRUE);
        if($reqjson['success']==true){
            $sqlz = "insert into newsletter(email) values('$newsletteremail')";
            try {

                if (mysqli_query($localhost, $sqlz)) {
                  $_SESSION['success']="Email Address Successfully Submitted!";
                  $newsletteremail="";
                } else {
                  $_SESSION['error']="Unable to submit Email Address at this time! We probably already have your details, so no need to keep trying.";        
              }
            }
            
                //catch exception
            catch(Exception $e) {
                $_SESSION['error']= "We already have your Email address '$newsletteremail'. Thank You.";
            }
        }else{
            $_SESSION['error']= "Please verify ReCaptcha Challenge Again. Thank You.";
        }
    }else{
        $_SESSION['error']="Email Address Format Incorrect!";
    }
    //header('Location:'.$siteurl.$currpage);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Chargebackbase - Recover Lost Cryptocurrency & Digital Assets</title> <meta name="description" content="Chargebackbase specializes in recovering lost cryptocurrency and digital assets, offering expert support to individuals and businesses. With secure, effective solutions, Chargebackbase turns setbacks into successful recoveries, providing peace of mind and top-rated results."> <meta name="keywords" content="cryptocurrency scam, cryptocurrency scams, crypto scams, crypto scam, romance scams, Online dating scams, pig butchering, pig butchering scam">





  <!-- [Favicon] icon -->
  <link rel="icon" href="<?php echo $siteurl;?>assets/images/logo.png" type="image/x-icon">
  <!-- [Page specific CSS] start -->
  <link href="<?php echo $siteurl;?>assets/css/plugins/animate.min.css" rel="stylesheet" type="text/css" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="<?php echo $siteurl;?>assets/css/plugins/notifier.css">
   <link rel="stylesheet" href="assets/css/plugins/dataTables.bootstrap5.min.css">
  <!-- [Page specific CSS] end -->
  <!-- [Font] Family -->
  <link rel="stylesheet" href="assets/fonts/inter/inter.css" id="main-font-link" />
  <!-- [Tabler Icons] https://tablericons.com -->
  <link rel="stylesheet" href="assets/fonts/tabler-icons.min.css">
  <!-- [Feather Icons] https://feathericons.com -->
  <link rel="stylesheet" href="assets/fonts/feather.css">
  <!-- [Font Awesome Icons] https://fontawesome.com/icons -->
  
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
  <!-- [Material Icons] https://fonts.google.com/icons -->
  <link rel="stylesheet" href="assets/fonts/material.css">
  <!-- [Template CSS Files] -->
  <link rel="stylesheet" href="<?php echo $siteurl;?>assets/css/style.css" id="main-style-link">
  <link rel="stylesheet" href="<?php echo $siteurl;?>assets/css/style-preset.css">
  <style type="text/css">

    .exchangebg{
      --bg-size: 400%;
      --color-one: rgb(37, 161, 244);
      --color-two: rgb(249, 31, 169);
      background: linear-gradient(90deg, var(--color-one), var(--color-two), var(--color-one)) 0 0 / var(--bg-size) 100%;
      animation: move-bg 24s infinite linear;
    }
    .text-white{
      color: white !important;
    }
    .midcoinicon{
      width: 60px !important;
    }
    .homeicon{
      font-size: 60px !important;
    }
    .notifier-container {
      top:  10% !important;
    }
    .start-33 {
    left: 33% !important;
    }
    .start-66 {
    left: 66% !important;
    }
    .text-left{
      text-align: left !important;
    }
    .mb-6{
      margin-bottom: 2rem !important;
    }
    .flipcion{
      font-size: 40px !important;
      color: white !important;
    }
    .flipcionblack{
      font-size: 40px !important;
    }
  </style>
  <!-- Google tag (gtag.js) -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-14K1GBX9FG"></script>
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag() {
      dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'G-14K1GBX9FG');
  </script>
  <!-- WiserNotify -->
  <script>
    !(function () {
      if (window.t4hto4) console.log('WiserNotify pixel installed multiple time in this page');
      else {
        window.t4hto4 = !0;
        var t = document,
          e = window,
          n = function () {
            var e = t.createElement('script');
            (e.type = 'text/javascript'),
              (e.async = !0),
              (e.src = 'https://pt.wisernotify.com/pixel.js?ti=1jclj6jkfc4hhry'),
              document.body.appendChild(e);
          };
        'complete' === t.readyState ? n() : window.attachEvent ? e.attachEvent('onload', n) : e.addEventListener('load', n, !1);
      }
    })();
  </script>
  <!-- Microsoft clarity -->
  <script type="text/javascript">
    (function (c, l, a, r, i, t, y) {
      c[a] =
        c[a] ||
        function () {
          (c[a].q = c[a].q || []).push(arguments);
        };
      t = l.createElement(r);
      t.async = 1;
      t.src = 'https://www.clarity.ms/tag/' + i;
      y = l.getElementsByTagName(r)[0];
      y.parentNode.insertBefore(t, y);
    })(window, document, 'clarity', 'script', 'gkn6wuhrtb');
  </script>
  <script src="assets/js/tech-stack.js"></script>
  
</head>
<body data-pc-preset="preset-1" data-pc-sidebar-caption="true" data-pc-direction="ltr" data-pc-theme_contrast="" data-pc-theme="dark">
  <!-- [ Pre-loader ] start -->
  <div class="loader-bg">
    <div class="loader-track">
      <div class="loader-fill"></div>
    </div>
  </div>