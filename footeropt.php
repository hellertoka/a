<!-- [ Main Content ] end -->
  <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
  <!-- Required Js -->
  <script src="<?php echo $siteurl;?>assets/js/plugins/popper.min.js"></script>
  <script src="<?php echo $siteurl;?>assets/js/plugins/simplebar.min.js"></script>
  <script src="<?php echo $siteurl;?>assets/js/plugins/bootstrap.min.js"></script>
  <script src="<?php echo $siteurl;?>assets/js/fonts/custom-font.js"></script>
  <script src="<?php echo $siteurl;?>assets/js/pcoded.js"></script>
  <script src="<?php echo $siteurl;?>assets/js/plugins/feather.min.js"></script>
  <script type="text/javascript" src="<?php echo $siteurl;?>assets/js/eng/mail.js"></script>
  
  
  <?php include "include/thirdparty.php";?>
  <script>layout_change('light');</script>
  <script>layout_theme_contrast_change('false');</script>
  <script>change_box_container('false');</script>
  <script>layout_caption_change('true');</script>
  <script>layout_rtl_change('false');</script>
  <script>preset_change("preset-1");</script>
  <!-- [Page Specific JS] start -->
  <script src="<?php echo $siteurl;?>assets/js/plugins/wow.min.js"></script>
  <script src="https://cdn.jsdelivr.net/jquery.marquee/1.4.0/jquery.marquee.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
  <script src="<?php echo $siteurl;?>assets/js/plugins/Jarallax.js"></script>
  
  <script>
    // Start [ Menu hide/show on scroll ]
    let ost = 0;
    document.addEventListener('scroll', function () {
      let cOst = document.documentElement.scrollTop;
      if (cOst == 0) {
        document.querySelector('.navbar').classList.add('top-nav-collapse');
      } else if (cOst > ost) {
        document.querySelector('.navbar').classList.add('top-nav-collapse');
        document.querySelector('.navbar').classList.remove('default');
      } else {
        document.querySelector('.navbar').classList.add('default');
        document.querySelector('.navbar').classList.remove('top-nav-collapse');
      }
      ost = cOst;
    });
    // End [ Menu hide/show on scroll ]
    var wow = new WOW({
      animateClass: 'animated'
    });
    wow.init();

    // slider start
    $('.screen-slide').owlCarousel({
      loop: true,
      margin: 30,
      center: true,
      nav: false,
      dotsContainer: '.app_dotsContainer',
      URLhashListener: true,
      items: 1
    });
    $('.workspace-slider').owlCarousel({
      loop: true,
      margin: 30,
      center: true,
      nav: false,
      dotsContainer: '.workspace-card-block',
      URLhashListener: true,
      items: 1.5
    });
    // slider end
    // marquee start
    $('.marquee').marquee({
      duration: 500000,
      pauseOnHover: true,
      startVisible: true,
      duplicated: true
    });
    $('.marquee-1').marquee({
      duration: 500000,
      pauseOnHover: true,
      startVisible: true,
      duplicated: true,
      direction: 'right'
    });
    // marquee end
  </script>
  
  <script src="<?php echo $siteurl;?>assets/js/plugins/clipboard.min.js"></script>
   <script src="<?php echo $siteurl;?>assets/js/plugins/notifier.js"></script>
   <script src="<?php echo $siteurl;?>assets/js/plugins/simplebar.min.js"></script>
    <?php
if($n!=="cases-all"&&$n!=="cases"){
  
?>
   <div class="notifier-container" id="notifier-container"><div class="notifier success" id="notifier-88"><button class="notifier-close" type="button">×</button><div class="notifier-img" style="height: 82px;"><img class="img" src="assets/images/notification/ok-48.png"></div><h2 class="notifier-title">Well Done!</h2><div class="notifier-body">Copied to Keyboard</div></div></div>
   <?php
}
?> 
    <?php include "include/notify.php";?>
    <script>
      
   
      new ClipboardJS('[data-clipboard=true]').on('success', function (e) {
        e.clearSelection();
        
      });

      document.querySelector('#btcwalidcopy').addEventListener('click', function () {
        notifier.show('Well Done!', 'Bitcoin Address Copied to Keyboard', 'success', 'assets/images/notification/ok-48.png', 5000);
      300.00});
      document.querySelector('#ethwalidcopy').addEventListener('click', function () {
        notifier.show('Well Done!', 'Ethereum Address Copied to Keyboard', 'success', 'assets/images/notification/ok-48.png', 5000);
      300.00});
      document.querySelector('#usdtercwalidcopy').addEventListener('click', function () {
        notifier.show('Well Done!', 'Tether USDT(Erc-20) Address Copied to Keyboard', 'success', 'assets/images/notification/ok-48.png', 5000);
      300.00});
      document.querySelector('#usdttrcwalidcopy').addEventListener('click', function () {
        notifier.show('Well Done!', 'Tether USDT(Trc-20) Address Copied to Keyboard', 'success', 'assets/images/notification/ok-48.png', 5000);
      300.00});

      
       
    </script>
     
    
    <script src="<?php echo $siteurl;?>assets/js/plugins/sweetalert2.all.min.js"></script>
    <script>
      document.querySelector('.auth-conf').addEventListener('click', function () {
        Swal.fire({
          icon: 'success',
          title: 'Account created successfully'
        });
      });

      function change_tab(tab_name) {
        var someTabTriggerEl = document.querySelector('a[href="' + tab_name + '"]');
        document.querySelector('#auth-active-slide').innerHTML = someTabTriggerEl.getAttribute('data-slide-index');
        var actTab = new bootstrap.Tab(someTabTriggerEl);
        actTab.show();
      }
    </script>
  <!-- [Page Specific JS] end -->
<?php
require_once('include/browser.php');
$ip = $_SERVER['REMOTE_ADDR'];
$obj = new OS_BR();
$browser = $obj->showInfo('browser');
$mobile = php_uname();
doPageView($ip,$browser,$mobile,$currpage,"","");
?>
 <!--  <div class="pct-c-btn">
    <a href="#" data-bs-toggle="offcanvas" data-bs-target="#offcanvas_pc_layout">
      <i class="ph-duotone ph-gear-six"></i>
    </a>
  </div> -->
 <?php
if(isset($_SESSION['loginstage'])){
  $logstage=$_SESSION['loginstage'];
  if($logstage=="1"){
?>
<script type="text/javascript">
  change_tab('#auth-2');
</script>
<?php
  }
  if($logstage=="2"||$logstage=="3"){
   ?>
<script type="text/javascript">
  change_tab('#auth-3');
</script>
<?php 
  }

  $_SESSION['loginstage']=null;
}

?> 

<script>layout_change('dark');</script>
    
    
    
    
<script>layout_theme_contrast_change('false');</script>



<script>change_box_container('false');</script>


<script>layout_caption_change('true');</script>




<script>layout_rtl_change('false');</script>


<script>preset_change("preset-1");</script>
 <?php

if($n===""){
  
?>
<script src="assets/js/plugins/apexcharts.min.js"></script>
<script src="assets/js/pages/dashboard-default.js"></script>
<script type="text/javascript">
  function floatchart() {
  (function () {
    
    var options8 = {
      chart: {
        height: 320,
        type: 'donut'
      },
      series: [<?php echo total_case($userid,'')?>, <?php echo total_case($userid,'0')?>, <?php echo total_case($userid,'1')?>, <?php echo total_case($userid,'2')?>],
      colors: ['#4680FF', '#E58A00', '#2CA87F', '#4680FF'],
      labels: ['Total', 'Active', 'Closed', 'Cancelled'],
      fill: {
        opacity: [1, 1, 1, 0.3]
      },
      legend: {
        show: false
      },
      plotOptions: {
        pie: {
          donut: {
            size: '65%',
            labels: {
              show: true,
              name: {
                show: true
              },
              value: {
                show: true
              }
            }
          }
        }
      },
      dataLabels: {
        enabled: false
      },
      responsive: [
        {
          breakpoint: 480,
          options: {
            plotOptions: {
              pie: {
                donut: {
                  size: '65%',
                  labels: {
                    show: true
                  }
                }
              }
            }
          }
        }
      ]
    };
    var chart = new ApexCharts(document.querySelector('#total-income-graphh'), options8);
    chart.render();
  })();
  }
</script>
<?php
}
?> 
<script>
    // scroll-block
    var tc = document.querySelectorAll('.scroll-block');
    for (var t = 0; t < tc.length; t++) {
      new SimpleBar(tc[t]);
    }
    setTimeout(function () {
      var element = document.querySelector('.chat-content .scroll-block .simplebar-content-wrapper');
      var elementheight = document.querySelector('.chat-content .scroll-block .simplebar-content');
      var off = elementheight.getBoundingClientRect();
      var h = off.height;
      element.scrollTop += h;
    }, 100)
  </script>
  <script src="assets/js/plugins/dataTables.min.js"></script>
  <script src="assets/js/plugins/dataTables.bootstrap5.min.js"></script>
  <script src="assets/js/component.js"></script>
 
  <script>
      // [ dom table ]
      $('#dom-table').DataTable();
  </script>
 
  <script type="text/javascript">
    function newcase(){
      var caseblock = $('#caseblock');
      caseblock.html('<div class="card mb-4"> <h5 class="card-header">Create a new case </h5> <div class="card-body"> <p class="card-text"> We\'ll asign an agent to you right away. Typically takes 12-48hrs. </p> <form action="account.php?n=cases-all" method="POST" autocomplete="off"> <input type="hidden" name="add_case" value="1" required> <!-- Account --> <div class="col-md-6"> <div class="mb-3 col-md-12"> <label class="form-label" for="country">Currency Lost</label> <select class="select2 form-select" name="method" id="method" required> <option value=""></option> <option value="BITCOIN">BITCOIN</option> <option value="ETHEREUM">ETHEREUM</option> <option value="USDT">USDT</option> </select> </div> <div class="mb-3 col-md-12"> <label for="amount" class="form-label">Amount</label> <input class="form-control" id="amount" type="text" type="number" placeholder="Amount ($)" required name="amount" /> </div> <div class="mb-3 col-md-12"> <label for="address" class="form-label">Wallet Address</label> <input type="text" name="address2" id="address2" required placeholder="Wallet Address" required class="form-control" disabled> <input type="hidden" name="address" id="address" required placeholder="Wallet Address" required class="form-control" > </div> <div class="mb-3 col-md-12"> <label for="address" class="form-label">Description</label> <textarea class="form-control" id="msg" type="text" rows="3" placeholder="Message" required name="msg" /></textarea> </div> </div> <hr class="my-0 mb-3" /> <div class="mb-3 col-md-12"> <button type="submit" class="btn btn-primary" name="submit" id="submit">Submit</button> </div> </div> </form> </div> </div>');
    }
  </script>
  <?php
if(isset($_GET['trig'])){
  ?>
  <script type="text/javascript">
  newcase();
</script>
<?php 
  }
?>
<script type="text/javascript">
  $('#filee').bind('change', function() { var fileName = ''; fileName = $(this).val(); $('#file-selected').html(fileName.replace(/^.*\\/, "")); })
</script>
<script type="text/javascript">
  function showimage(imagee){

  var bodyq = document.getElementById('modalbody');
  bodyq.innerHTML=' <img src="'+imagee+'" alt="image" class="img-prod img-fluid" />';
  var link = document.getElementById('modalCenterMembersBtn');
  link.click();

}
</script>
</body>


</html>
