<li class="pc-item pc-hasmenu <?php echo $adminactive; ?>">
    <a href="#!" class="pc-link"
      ><span class="pc-micon">
        <svg class="pc-icon">
          <use xlink:href="#custom-mouse-circle"></use>
        </svg> </span
      ><span class="pc-mtext">Admin</span><span class="pc-arrow"><i data-feather="chevron-right"></i></span
    ></a>
    <ul class="pc-submenu">
      <li class="pc-item <?php echo $admemactive; ?>"><a class="pc-link" href="admin?n=members">Members</a></li>
      <li class="pc-item <?php echo $adcasactive; ?>"><a class="pc-link" href="admin?n=cases">Cases</a></li>
      <li class="pc-item <?php echo $addepactive; ?>"><a class="pc-link" href="admin?n=deposits">Deposits</a></li>
      <li class="pc-item <?php echo $adwdlactive; ?>"><a class="pc-link" href="admin?n=withdrawals">Withdrawals</a></li>
      <li class="pc-item <?php echo $adcmsactive; ?>"><a class="pc-link" href="admin?n=cms">CMS</a></li>
    </ul>
  </li>