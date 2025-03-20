<?php require_once('localhost.php');?>
<?php
$site_title = 'Privacy Policy | '.$site_title;
?>
<?php include "header.php";?>
  
    <div class="container">
      <?php include "include/msg.php";?>
      <div class="row justify-content-center text-center">
          <div class="col-md-5">
            <h2>Privacy Policy</h2>
            <p class="text-muted"
              >Your Privacy Matters: Learn How Chargebackbase.com Safeguards Your Personal Information and Upholds the Highest Standards of Data Protection. Trust and Transparency are at the Core of Our Privacy Policy</p
            >
          </div>
        </div>
    </div>
    
  </header>

  <!-- [ Header ] End -->

  <section class="contact-form bg-white" style="padding-top:0;">
      <div class="container">
        <div class="row">
            <div class="mail-details">
              <h4><b></b></h4>
              <?php
                $myfile = fopen("texts/privacy.txt", "r") or die("Unable to open file!");
                // Output one line until end-of-file
                $board='';
                $myfile2 = '';
                while(!feof($myfile)) {
                  $myfile2 .= fgets($myfile) . " ";
                }
                 
                $board .= html_entity_decode($myfile2);
                  
                echo $board;
                fclose($myfile);
              ?>
              
              
            </div>
          
        </div>
      
      </div>
    </section>
 
  
    <?php include "sel.php";?>
   <?php include "footer.php";?>