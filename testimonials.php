<!-- [ support team apps ] start -->
  <section class="support-team-block">
    <div class="container title">
      <div class="row justify-content-center text-center wow fadeInUp" data-wow-delay="0.2s">
        <div class="col-md-8 col-xl-6">
          <h2 class="mb-3">
            They <span class="text-primary">love</span> <?php echo $domain; ?>, Now your
            turn 😍
          </h2>
          <!-- prettier-ignore -->
          <p class="mb-0">Real Stories, Real Success: Hear What Our Users Have to Say About Their Chargebackbase.com Experience.</p>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="marquee marquee-text wow fadeInUp" data-wow-delay="0.4s">
            <ul class="list-inline marquee-list">
              <?php
                  $stmt = mysqli_query($localhost,("SELECT * FROM testimony WHERE publish = '1' ORDER BY ID DESC LIMIT 12"));
                  if (mysqli_num_rows($stmt) > 0) {
                      // output data of each row
                      $testimony= '';
                      while($row = mysqli_fetch_assoc($stmt)) {
                      $user = $siteurl.$row['url'];
                      $userna = $row['fname'];
              ?>
              <li class="list-inline-item">
                <div class="card support-card">
                  <div class="card-body">
                    <div class="d-flex">
                      <div class="flex-shrink-0">
                        <img src="<?php echo $user; ?>" alt="user-image"
                          class="rounded-circle wid-60 hei-60" />
                      </div>
                      <div class="flex-grow-1 ms-3">
                        <p class="mb-1">
                          “<?php echo $row['testimony']; ?>“
                        </p>
                        <small>
                          <span class="text-muted"><?php echo $userna;?></span></small>
                      </div>
                    </div>
                  </div>
                </div>
              </li>
              <?php
                    }
                  }
              ?>
             
            </ul>
          </div>
        </div>
      </div>
    </div>
  </section>