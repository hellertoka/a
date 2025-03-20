<div class="modal fade modal-lightbox post-modal-lightbox" id="lightboxModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      <div class="modal-body">
        <img src="assets/images/user/avatar-5.jpg" alt="images" class="modal-image w-100 img-fluid" />
      </div>
    </div>
  </div>
</div>
<!-- [ footer apps ] start -->
  <footer class="footer">
    <div class="container title mb-0">
      <div class="row align-items-center wow fadeInUp" data-wow-delay="0.2s">
        <div class="col-md-8">
          <h2 class="mb-3">Stay connected with us</h2>
          <p class="mb-4 mb-md-0">
            Simply submit your email, we share you the top news related to
            <?php echo $domain; ?> feature updates, roadmap, and news.
          </p>
        </div>
        <div class="col-md-4">
          <form class="" action="" method="POST">
            <div class="row">
              <div class="col">
                <input type="email" name="newsletteremail" id="newsletteremail" class="form-control"   value="<?php echo $newsletteremail;?>"  required  placeholder="Enter your email" />
              </div>
              <div class="col-auto">
                <button class="btn btn-primary" name="submit-newsletter">Subscribe</button>
              </div>
              <div class="g-recaptcha" data-sitekey="6LdUdcYpAAAAAOUNVRHTCBV70SmfndVyfE_ZFcZQ" required></div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="border-top border-bottom footer-center">
      <div class="container">
        <div class="row">
          <div class="col-md-4 wow fadeInUp" data-wow-delay="0.2s">
            <img src="<?php echo $siteurl;?>assets/images/logo.png" alt="image" class="img-fluid mb-3" />
            <p class="mb-4">
              <?php echo $site_desc;?>
            </p>
          </div>
          <div class="col-md-8">
            <div class="row">
              <div class="col-sm-4 wow fadeInUp" data-wow-delay="0.6s">
                <h5 class="mb-4">Company</h5>
                <ul class="list-unstyled footer-link">
                  <li>
                    <a href="about" >About</a>
                  </li>
                  <li>
                    <a href="faq">FAQ</a>
                  </li>
                  <li>
                    <a href="faq">Reviews</a>
                  </li>
                  
                </ul>
              </div>
              <div class="col-sm-4 wow fadeInUp" data-wow-delay="0.8s">
                <h5 class="mb-4">Help & Support</h5>
                <ul class="list-unstyled footer-link">

                  <li>
                    <a href="login">Support</a>
                  </li>
                  <li>
                    <a href="contact">Contact Us</a>
                  </li>
                  <li>
                    <a href="mailto:<?php echo $adminemail; ?>" >Email Us</a>
                  </li>
                  
                </ul>
              </div>
              <div class="col-sm-4 wow fadeInUp" data-wow-delay="1s">
                <h5 class="mb-4">Useful Resources</h5>
                <ul class="list-unstyled footer-link">
                  <li>
                    <a href="privacy">Privacy Policy</a>
                  </li>
                  <li>
                    <a href="terms">Terms and Condition</a>
                  </li>
                  <li>
                    <a href="aml">AML/KYC</a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="row align-items-center">
        <div class="col my-1 wow fadeInUp" data-wow-delay="0.4s">
          <p class="mb-0">
            © <?php echo date('Y'); ?> Handcrafted by 
            <a href="index" target="_blank"></a> <?php echo $domain; ?>
          </p>
        </div>
        <div class="col-auto my-1">
          <ul class="list-inline footer-sos-link mb-0">
            <li class="list-inline-item wow fadeInUp" data-wow-delay="0.4s">
              <a href="#">
                <svg class="pc-icon">
                  <use xlink:href="#custom-facebook"></use>
                </svg>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </footer>
  <!-- [ footer apps ] End -->

  <?php include "footeropt.php";?>