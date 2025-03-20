<?php
if(isset($_GET['n'])){
    $n = $_GET['n'];
    if($n==""&&$currpage=="account"){
      $dashboardactive='active';
    }
    if($n=="cases-all"||$n=="cases-new"){
      $casesactive='active';
    }
    if($n=="deposit-new"||$n=="withdraw-new"){
      $transactionsactive='active pc-trigger ';
      
      if($n=="deposit-new"){
          $depositactive='active';
      }
      if($n=="withdraw-new"){
          $wdlactive='active';
      } 
    }
    if($n=="deposit-history"||$n=="transaction-log"||$n=="withdraw-history"){
      $historyactive='active pc-trigger ';
      if($n=="deposit-history"){
          $dphactive='active';
      }
      if($n=="transaction-log"){
          $tlhactive='active';
      }
      if($n=="withdraw-history"){
          $wdhactive='active';
      }
    }
    if($n=="edit"){
      $actactive='active';
    }
    if($n=="members"||$n=="deposits"||$n=="cases"||$n=="withdrawals"||$n=="user-activity"||$n=="cms"||$n==""){
      $adminactive='active pc-trigger ';
      if($n=="members"||$n=="user-activity"){
          $admemactive='active';
      }
      if($n=="deposits"){
          $addepactive='active';
      }
      if($n=="cases"){
          $adcasactive='active';
      }
      if($n=="withdrawals"){
          $adwdlactive='active';
      }
      if($n=="cms"){
          $adcmsactive='active';
      }
    }

}else{
  $n=" ";
  if($currpage=="account"){
      $dashboardactive='active';
  }else{
      $adminactive='active pc-trigger ';
  }
  
}


?>
<nav class="pc-sidebar">
  <div class="navbar-wrapper">
    <div class="m-header">
      <a href="index" class="b-brand text-primary">
        <!-- ========   Change your logo from here   ============ -->
        <img src="assets/images/logo.png" class="img-fluid" alt="logo">
        <span class="badge bg-light-success rounded-pill ms-2 theme-version">v9.0</span>
      </a>
    </div>
    <div class="navbar-content">
      <div class="card pc-user-card">
        <div class="card-body">
          <div class="d-flex align-items-center">
            <div class="flex-shrink-0">
              <img src="<?php echo $profile_url; ?>" alt="user-image" class="user-avtar wid-45 rounded-circle" />
            </div>
            <div class="flex-grow-1 ms-3 me-2">
              <h6 class="mb-0"><?php echo $full_name; ?></h6>
              <small><?php echo $user_type; ?></small>
            </div>
            <a class="btn btn-icon btn-link-secondary avtar" data-bs-toggle="collapse" href="#pc_sidebar_userlink">
              <svg class="pc-icon">
                <use xlink:href="#custom-sort-outline"></use>
              </svg>
            </a>
          </div>
          <div class="collapse pc-user-links" id="pc_sidebar_userlink">
            <div class="pt-3">
              <a href="account?n=edit">
                <i class="ti ti-user"></i>
                <span>Profile</span>
              </a>
              
              <a href="logout">
                <i class="ti ti-power"></i>
                <span>Logout</span>
              </a>
            </div>
          </div>
        </div>
      </div>

      <ul class="pc-navbar">
        <li class="pc-item pc-caption">
          <label>Navigation</label>
        </li>
       
        <?php
          if($u_level== 1 ||$u_level== 2){
            include ('sidebaradmin.php');

        }?>
        <li class="pc-item <?php echo $dashboardactive; ?>">
          <a href="account?n=" class="pc-link">
            <span class="pc-micon">
              <svg class="pc-icon">
                <use xlink:href="#custom-story"></use>
              </svg>
            </span>
            <span class="pc-mtext">Dashboard</span>
          </a>
        </li>
        <li class="pc-item <?php echo $casesactive; ?>">
          <a href="account?n=cases-all" class="pc-link">
            <span class="pc-micon">
              <svg class="pc-icon">
                <use xlink:href="#custom-presentation-chart"></use>
              </svg>
            </span>
            <span class="pc-mtext">Cases</span>
          </a>
        </li>
        <li class="pc-item pc-hasmenu <?php echo $transactionsactive; ?>">
          <a href="#!" class="pc-link"
            ><span class="pc-micon">
              <svg class="pc-icon">
                <use xlink:href="#custom-mouse-circle"></use>
              </svg> </span
            ><span class="pc-mtext">Transactions</span><span class="pc-arrow"><i data-feather="chevron-right"></i></span
          ></a>
          <ul class="pc-submenu">
            <li class="pc-item <?php echo $depositactive; ?>"><a class="pc-link" href="account?n=deposit-new">New Deposit</a></li>
            <li class="pc-item <?php echo $wdlactive; ?>"><a class="pc-link" href="account?n=withdraw-new">New Withdrawal</a></li>
          </ul>
        </li>
        <li class="pc-item pc-hasmenu <?php echo $historyactive; ?>">
          <a href="#!" class="pc-link">
            <span class="pc-micon">
              <svg class="pc-icon">
                <use xlink:href="#custom-element-plus"></use>
              </svg>
            </span>
            <span class="pc-mtext">History</span><span class="pc-arrow"><i data-feather="chevron-right"></i></span
          ></a>
          <ul class="pc-submenu">
            <li class="pc-item <?php echo $dphactive; ?>"><a class="pc-link" href="account?n=deposit-history">Deposit</a></li>
            <li class="pc-item <?php echo $wdhactive; ?>"><a class="pc-link" href="account?n=withdraw-history">Withdrawal</a></li>
            <li class="pc-item <?php echo $tlhactive; ?>"><a class="pc-link" href="account?n=transaction-log">Activity Log</a></li>
          </ul>
        </li>
        <li class="pc-item <?php echo $actactive; ?>">
          <a href="account?n=edit" class="pc-link">
            <span class="pc-micon">
              
              <svg class="pc-icon">
                <use xlink:href="#custom-fatrows"></use>
              </svg>
            </span>
            <span class="pc-mtext">Profile</span></a
          >
        </li>
        <li class="pc-item">
          <a href="logout" class="pc-link"
            ><span class="pc-micon">
              <svg class="pc-icon">
                <use xlink:href="#custom-box-1"></use>
              </svg> </span
            ><span class="pc-mtext">Logout</span></a
          >
        </li>
       

      </ul>
    </div>
  </div>
</nav>