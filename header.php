<?php include "headeropt.php";?>
<link rel="stylesheet" href="assets/css/landing.css" />


  <!-- [ Pre-loader ] End -->
<!-- [ Header ] start -->
  <header id="home" style="">
    <!-- [ Nav ] start -->
    <!-- [ Nav ] start -->
    <nav class="navbar navbar-expand-md navbar-light default">
      <div class="container">
        <a class="navbar-brand" href="index">
          <img src="assets/images/logo.png" alt="logo" />
        </a>
        <button class="navbar-toggler rounded" type="button" data-bs-toggle="collapse"
          data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false"
          aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-center">
            <li class="nav-item px-1">
              <a class="nav-link" href="index#howitworks">How it Works</a>
            </li>
            
            <?php
            if(isset($_SESSION['userid'])){
            ?>
            <li class="nav-item">
              <a class="btn btn btn-success" href="account">My
                Account </a>
            </li>
            <?php
            }else{
              ?>
            <li class="nav-item">
              <a class="btn btn btn-success" href="login">Sign
                In </a>
            </li>
            <?php
            }
            ?>
          </ul>
        </div>
      </div>
    </nav>
    <!-- [ Nav ] start -->

    <!-- [ Nav ] start -->