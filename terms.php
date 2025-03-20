<?php require_once('localhost.php');?>
<?php
$site_title = 'Terms and Conditions | '.$site_title;
?>
<?php include "header.php";?>
  
    <div class="container">
      <?php include "include/msg.php";?>
      <div class="row justify-content-center text-center">
          <div class="col-md-5">
            <h2>Terms and Conditions</h2>
            <p class="text-muted"
              >Understanding Our Agreement: Explore Chargebackbase.com's Terms and Conditions to Clarify Your Rights and Responsibilities When Using Our Platform. Clear Guidelines for a Trusted Relationship</p
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
                $myfile = fopen("texts/terms.txt", "r") or die("Unable to open file!");
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