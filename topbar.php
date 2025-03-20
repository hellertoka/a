<header class="pc-header">
  <div class="header-wrapper"> <!-- [Mobile Media Block] start -->
  <div class="me-auto pc-mob-drp">
    <ul class="list-unstyled">
      <!-- ======= Menu collapse Icon ===== -->
      <li class="pc-h-item pc-sidebar-collapse">
        <a href="#" class="pc-head-link ms-0" id="sidebar-hide">
          <i class="ti ti-menu-2"></i>
        </a>
      </li>
      <li class="pc-h-item pc-sidebar-popup">
        <a href="#" class="pc-head-link ms-0" id="mobile-collapse">
          <i class="ti ti-menu-2"></i>
        </a>
      </li>
      <li class="dropdown pc-h-item">
        <a
          class="pc-head-link dropdown-toggle arrow-none m-0 trig-drp-search"
          data-bs-toggle="dropdown"
          href="#"
          role="button"
          aria-haspopup="false"
          aria-expanded="false"
        >
          <svg class="pc-icon">
            <use xlink:href="#custom-search-normal-1"></use>
          </svg>
        </a>
        <div class="dropdown-menu pc-h-dropdown drp-search">
          <form class="px-3 py-2">
            <input type="search" class="form-control border-0 shadow-none" placeholder="Search here. . ." />
          </form>
        </div>
      </li>
    </ul>
  </div>
  <!-- [Mobile Media Block end] -->
  <div class="ms-auto">
    <ul class="list-unstyled">
      
      <li class="dropdown pc-h-item">
        <a
          class="pc-head-link dropdown-toggle arrow-none me-0"
          data-bs-toggle="dropdown"
          href="#"
          role="button"
          aria-haspopup="false"
          aria-expanded="false"
        >
          <svg class="pc-icon">
            <use xlink:href="#custom-notification"></use>
          </svg>
          <?php
        $stmt2 = mysqli_query($localhost,("SELECT * FROM trac_log  where userid='$userid' and log_type='Case Reply'  order by id desc limit 5"));
        if (mysqli_num_rows($stmt2) > 0) {
            // output data of each row
            $question= '';
            $answer= '';
            $faqid= '';
            ?>
          <span class="badge bg-success pc-h-badge">*</span>
           <?php
         }
         ?>
        </a>
        <div class="dropdown-menu dropdown-notification dropdown-menu-end pc-h-dropdown">
          <div class="dropdown-header d-flex align-items-center justify-content-between">
            <h5 class="m-0">Notifications</h5>
          </div>
          <div class="dropdown-body text-wrap header-notification-scroll position-relative" style="max-height: calc(100vh - 215px)">
            <p class="text-span">All</p>
            <?php
            if (mysqli_num_rows($stmt2) > 0) {
                while($row2 = mysqli_fetch_assoc($stmt2)) {
                $faqid = $row2['ID'];
                $log_type = $row2['log_type'];
                $log_details = $row2['log_details'];
                $link = $row2['link'];
                $status = $row2['status'];
                $dte = $row2['date'];
              ?>
            <a href="account?n=cases-all&ref=<?php echo $link; ?>">  
            <div class="card mb-2">
              <div class="card-body">
                <div class="d-flex">
                  <div class="flex-shrink-0">
                    <svg class="pc-icon text-primary">
                      <use xlink:href="#custom-layer"></use>
                    </svg>
                  </div>
                  <div class="flex-grow-1 ms-3">
                    <span class="float-end text-sm text-muted"><?php echo date('jS M Y - h:i:A', strtotime($row2['date'])); ?></span>
                    <h5 class="text-body mb-2"><?php echo $log_type; ?></h5>
                    <p class="mb-0"
                      ><?php echo $log_details; ?></p
                    >
                  </div>
                </div>
              </div>
            </div>
            </a>
            <?php
                }
              }
            ?>
            
          </div>
          
        </div>
      </li>
      <li class="dropdown pc-h-item header-user-profile">
        <a
          class="pc-head-link dropdown-toggle arrow-none me-0"
          data-bs-toggle="dropdown"
          href="#"
          role="button"
          aria-haspopup="false"
          data-bs-auto-close="outside"
          aria-expanded="false"
        >
          <img src="<?php echo $profile_url; ?>" alt="user-image" class="user-avtar" />
        </a>
        <div class="dropdown-menu dropdown-user-profile dropdown-menu-end pc-h-dropdown">
          <div class="dropdown-header d-flex align-items-center justify-content-between">
            <h5 class="m-0">Profile</h5>
          </div>
          <div class="dropdown-body">
            <div class="profile-notification-scroll position-relative" style="max-height: calc(100vh - 225px)">
              <div class="d-flex mb-1">
                <div class="flex-shrink-0">
                  <img src="<?php echo $profile_url; ?>" alt="user-image" class="user-avtar wid-35" />
                </div>
                <div class="flex-grow-1 ms-3">
                  <h6 class="mb-1"><?php echo $full_name; ?>🖖</h6>
                  <span><?php echo $email; ?></span>
                </div>
              </div>
              <hr class="border-secondary border-opacity-50" />
              
              
              <a href="account" class="dropdown-item">
                <span>
                  <svg class="pc-icon">
                    <use xlink:href="#custom-story"></use>
                  </svg>
                  <span>Dashboard</span>
                </span>
              </a>
              <a href="account?n=cases-all" class="dropdown-item">
                <span>
                  <svg class="pc-icon">
                    <use xlink:href="#custom-presentation-chart"></use>
                  </svg>
                  <span>Cases</span>
                </span>
              </a>
              <a href="account?n=withdraw-address" class="dropdown-item">
                <span>
                  <svg class="pc-icon">
                    <use xlink:href="#custom-share-bold"></use>
                  </svg>
                  <span>Manage Addresses</span>
                </span>
              </a>
              <a href="account?n=edit" class="dropdown-item">
                <span>
                  <svg class="pc-icon">
                    <use xlink:href="#custom-fatrows"></use>
                  </svg>
                  <span>Profile</span>
                </span>
              </a>
              
              <hr class="border-secondary border-opacity-50" />
              <div class="d-grid mb-3">
                <a class="btn btn-primary" href="logout">
                  <svg class="pc-icon me-2">
                    <use xlink:href="#custom-logout-1-outline"></use></svg
                  >Logout
                </a>
              </div>
              
            </div>
          </div>
        </div>
      </li>
    </ul>
  </div>
   </div>
  </header>
