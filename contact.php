<?php require_once('localhost.php');?>
<?php
$site_title = 'Contact | '.$site_title;
?>
<?php include "header.php";?>
  
    <div class="container">
      <?php include "include/msg.php";?>
      <div class="row justify-content-center text-center">
          <div class="col-md-5">
            <h2>Talk to our Expert</h2>
            <p class="text-muted"
              >Connect with Us: Reach Out to Chargebackbase.com's Support Team for Personalized Assistance, Partnership Inquiries, or General Feedback. We're Here to Help You Navigate the World of Cryptocurrency.</p
            >
          </div>
        </div>
    </div>
    
  </header>

  <!-- [ Header ] End -->

  <section class="contact-form bg-white" style="padding-top:0;">
      <div class="container">
        <form action="#" id="contactform">
        <div class="row justify-content-center">
            <div class="alerter"></div>
            <div class="col-12"><h2 class="sr-only">contact form</h2></div>
            <div class="col-xxl-6 col-md-8 col-sm-10">
              <div class="row my-4">
                <?php if(isset($_SESSION['userid'])){
                ?>
                <div class="col-12">
                  <div class="form-group">
                    <input type="hidden" name="name" id="name"  class="form-control" value="<?php echo $_SESSION['fname']." ".$_SESSION['lname']; ?>" placeholder="Full name" required />
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-group">
                    <input type="hidden" id="email" name="email" class="form-control" value="<?php echo $_SESSION['email']; ?>" placeholder="Email id" required/>
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-group">
                    <input type="hidden" id="topic" name="topic" class="form-control" value="<?php echo $_SESSION['pno']; ?>" placeholder="Phone Number" required />
                  </div>
                </div>
                <?php
                }else{
                ?>
                <div class="col-12">
                  <div class="form-group">
                    <label class="form-label">Full name</label>
                    <input type="text" name="name" id="name"  class="form-control" placeholder="Full name" required />
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-group">
                    <label class="form-label">Email id</label>
                    <input type="email" id="email" name="email" class="form-control" placeholder="Email id" required/>
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-group">
                    <label class="form-label">Phone Number</label>
                    <input type="text" id="topic" name="topic" class="form-control" placeholder="Phone Number" required />
                  </div>
                </div>
                <?php
                  }
                ?>
                <div class="col-12">
                  <div class="form-group">
                    <label class="form-label">Message</label>
                    <textarea class="form-control" name="text" id="text" rows="8" placeholder="Message" requireds></textarea>
                  </div>
                </div>
                <div class="col-12">
                  
                  <div class="mt-4 d-grid">
                    <button type="submit" class="btn btn-primary" id="sendform" >Submit</button>
                  </div>
                </div>
              </div>
            </div>
          
        </div>
        </form>
      </div>
    </section>
 
  
  <?php include "sel.php";?>
   <?php include "footer.php";?>