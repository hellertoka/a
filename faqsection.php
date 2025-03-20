<section id="technologies" class="pt-0">
    <?php
        $stmt = mysqli_query($localhost,("SELECT * FROM faqheader $faqopt"));
        if (mysqli_num_rows($stmt) > 0) {
            // output data of each row
            $text= '';
            $headerid= '';
            while($row = mysqli_fetch_assoc($stmt)) {
            $headerid = $row['ID'];
            $text = $row['text'];
    ?>
    <div class="container title">
      <div class="row justify-content-center text-center wow fadeInUp" data-wow-delay="0.2s">
        <div class="col-md-8 col-xl-6">
          <h2 class="mb-3"><?php echo $text; ?></h2>
        </div>
      </div>
    </div>
    <div class="container technology-block mb-3">
      <!-- Row 1 -->
      <div class="row align-items-center justify-content-start mb-4 mb-sm-2">
        <div class="accordion accordion-flush" id="accordionFlushExample">
          <?php
              $stmt2 = mysqli_query($localhost,("SELECT * FROM faqs where subjectid='$headerid'"));
              if (mysqli_num_rows($stmt2) > 0) {
                  // output data of each row
                  $question= '';
                  $answer= '';
                  $faqid= '';
                  while($row2 = mysqli_fetch_assoc($stmt2)) {
                  $faqid = $row2['ID'];
                  $question = $row2['question'];
                  $answer = $row2['answer'];
          ?>
          <div class="accordion-item">
            <h2 class="accordion-header" id="flush-heading<?php echo $faqid; ?>">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse<?php echo $faqid; ?>" aria-expanded="false" aria-controls="flush-collapse<?php echo $faqid; ?>">
                <?php echo $question; ?>
              </button>
            </h2>
            <div id="flush-collapse<?php echo $faqid; ?>" class="accordion-collapse collapse" aria-labelledby="flush-heading<?php echo $faqid; ?>" data-bs-parent="#accordionFlushExample">
              <div class="accordion-body"><?php echo $answer; ?></div>
            </div>
          </div>

          <?php
                    }
                  }
              ?>

          
        </div>
        
      </div>
    </div>

    <?php
          }
        }
    ?>

    
  </section>