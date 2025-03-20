<?php require_once('localhost.php');?>

<?php
$site_title = 'Exchange | '.$site_title;
$faqopt=" where ID in ('2','3') ";
?>
<?php include "header.php";?>
  
    <div class="container">
      <?php include "include/msg.php";?>
      <div class="row justify-content-center">
        <div class="col-md-10 text-center">
          <?php
          if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['create_ex'])) {
          ?>
          <div class="row justify-content-center wow fadeInUp mt-1" data-wow-delay="0.5s">
            <div class="card mb-0" >
            <div class="card-body py-0">
              <ul class="nav nav-tabs profile-tabs mb-1" id="myTab" role="tablist">
                <li class="nav-item" style="width:33%;">
                  <span class="nav-link" id="profile-tab-1"  role="tab"
                    aria-selected="true">
                    <i class="ti ti-currency-cent me-2"></i>Currencies
                  </span>
                </li>
                <li class="nav-item" style="width:33%;">
                  <span class="nav-link active" id="profile-tab-2"  role="tab"
                    aria-selected="true">
                    <i class="ti ti-file-text me-2"></i>Address
                  </span>
                </li>
                <li class="nav-item" style="width:33%;">
                  <span class="nav-link" id="profile-tab-3" role="tab"
                    aria-selected="true">
                    <i class="ti ti-id me-2"></i>Exchange
                  </span>
                </li>
                
              </ul>

              <div class="p-3 p-sm-5 hidden-xs">
                <div class="position-relative">
                  <div class="progress" style="height: 3px">
                    <div class="progress-bar" role="progressbar" style="width: 50%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <button type="button" class="position-absolute top-0 start-0 translate-middle btn btn-sm btn-primary rounded-pill" style="width: 3rem; height: 2rem">1 </button>
                  <button type="button" class="position-absolute top-0 start-50 translate-middle btn btn-sm btn-primary rounded-pill" style="width: 3rem; height: 2rem">2</button>
                  <button type="button" class="position-absolute top-0 start-100 translate-middle btn btn-sm btn-secondary rounded-pill" style="width: 3rem; height: 2rem">3</button>
                </div>
              </div>
            </div>
          </div>
          <div class="card">
              <div class="card-header">
                <h5 class="">Add Exchange Details</h5>
              </div>
              <div class="card-body">
                <form method="POST" action="exchangeprocess">
                  <h5 class="mb-3 ">You Send:</h5>
                  <div class="form-group row">
                    <label class="col-lg-2 col-form-label text-lg-end"></label>
                    <div class="col-lg-8" id="ccyholder1">
                      <select
                        type="select-one"
                        class="form-control"
                        onchange="loadCurrencyTwo('','');" 
                        name="choices-single-default"
                        id="choices-single-default"
                        data-trigger
                        required
                      >
                        <option value="" selected>Search for Coin</option>
                        
                      </select>
                      
                    </div>
                    <input type="hidden" class="form-control" id="ccyfrom" name="ccyfrom" placeholder="from" required>
                  </div>
                  <div class="form-group row">
                    <label class="col-lg-2 col-form-label text-lg-end"></label>
                    <div class="col-lg-8">
                      <div class="input-group">
                        <input type="text" class="form-control" id="fromamount" name="fromamount" placeholder="Enter amount" required>

                        <span class="input-group-text"><img alt="ccy" id="ccy1img"  src="<?php echo $siteurl;?>assets/images/money.svg" class="styles__StyledImage-sc-7mvgp0-0 dfoEXf"></span>
                      </div>
                      <small id="estimateHelp" class="form-text text-muted">
                        </small>
                    </div>
                  </div>
                  <hr class="my-4 ">
                  <div class="form-group mb-0 row align-items-center">
                    <label class="col-lg-2 col-form-label text-lg-end"></label>
                    <div class="col-lg-8">
                      <div class="form-check form-check-inline">
                        <a href="javascript:void(0)" onclick="toggle();" class="btn btn-lg"><i class="ti ti-switch-vertical flipcionblack"></i></a>
                         
                      </div>
                      <div class="form-check form-check-inline">
                        <input type="radio" class="form-check-input input-primary" name="ratetype" id="floatrateradio" value="float" checked>
                        <label class="form-check-label " for="ratetype">Floating Rate</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input type="radio" class="form-check-input input-primary" name="ratetype" id="fixedrateradio" value="fixed">
                        <label class="form-check-label " for="ratetype">Fixed Rate</label>
                      </div>
                      
                      
                    </div>
                  </div>
                  <hr class="my-4 ">
                  <h5 class="mb-3 ">You Receive:</h5>
                  <div class="form-group row">
                    <label class="col-lg-2 col-form-label text-lg-end"></label>
                    <div class="col-lg-8" id="ccyholder2">
                      <select
                        type="select-one"
                        class="form-control"
                        name="choices-single-default"
                        id="choices-single-default2"
                        onchange="loadCurrencySecondImage('','');" 
                        required
                        data-trigger
                        
                      >
                        <option value="" >Search for Coin</option>
                      </select>
                      <small id="ccytoHelp" class="form-text text-muted">
                      </small>
                      
                    </div>
                    <input type="hidden" class="form-control" id="ccyto" name="ccyto" placeholder="to" required>
                  </div>
                  <div class="form-group row">
                    <label class="col-lg-2 col-form-label text-lg-end"></label>
                    <div class="col-lg-8">
                      <div class="input-group">
                        <input type="text" class="form-control" id="toamount" name="toamount" placeholder="You receive" required>
                        <span class="input-group-text"><img alt="ccy" id="ccy2img"   src="<?php echo $siteurl;?>assets/images/money.svg" class="styles__StyledImage-sc-7mvgp0-0 dfoEXf"></span>
                      </div>
                      
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-lg-2 col-form-label text-lg-end"></label>
                    <div class="col-lg-8">
                        <input type="text" class="form-control" id="address" name="address" onchange="valRecAddress();" placeholder="Receipient Address" required>
                       
                        <small id="addressHelp" class="form-text text-muted">
                      </small>
                    </div>
                  </div>
                    <div class="form-group row">
                    <label class="col-lg-2 col-form-label text-lg-end"></label>
                    <div class="col-lg-8" id="buttonholder">
                      <button type="button" name="create_ex" id="createbtn" class="btn btn-primary btn-lg mb-4">Exchange</button>
                    </div>
                    </div>
                    <hr class="my-4">
                  <h5 class="mb-3">Additional Information:</h5>
                  <div class="form-group row">
                    <label class="col-lg-3 col-form-label text-lg-end"></label>
                    <div class="col-lg-6">
                      <div class="input-group">
                        <input type="text" class="form-control" placeholder="Enter refund address" onchange="valRecAddress2();" id="refundaddress" name="refundaddress">
                        <span class="input-group-text"><img alt="ccy" id="ccyrefundimg" src= "<?php echo $siteurl;?>assets/images/money.svg" class="styles__StyledImage-sc-7mvgp0-0 dfoEXf"></span>

                      </div>
                      <small id="refundaddressHelp" class="form-text text-muted">We recommend adding your wallet address for a refund.</small>
                      
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-lg-3 col-form-label text-lg-end"></label>
                    <div class="col-lg-6">
                     
                        <input type="hidden" class="form-control" placeholder="Enter email address" id="email" name="email" >
                        <small id="emailHelp" class="form-text text-muted">Get notifications about this exchange.
                        else.</small>
                    </div>
                  </div>
                  </div>
                  
                </form>
              </div>
          </div>
          
          <?php
          }
          ?>
          <?php
          if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['exchange_id'])) {
            $exchangeid=test_input($_GET['exchange_id']);
            $ref=get_simpleref($exchangeid);
            if($ref===0){
              $_SESSION['notifye']="Exchange not found";
              ?>
              <div class="row justify-content-center wow fadeInUp mt-1" data-wow-delay="0.5s">
            <div class="card mb-0" >
            <div class="card-body py-0">
                  <ul class="nav nav-tabs profile-tabs" id="myTab" role="tablist">
                    
                    <li class="nav-item">
                      <a class="nav-link active" id="pc-clipboard-1" role="tab"
                        aria-selected="true">
                        <i class="ti ti-id me-2"></i>Exchange ID : <?php echo $exchangeid;?>
                      </a>
                      <a href="javascript:void(0)" class="btn btn-lg btn-primary" data-clipboard="true" id="exchangeidcopy" data-clipboard-target="#pc-clipboard-1"><i class="feather icon-copy"></i></a>
                    </li>
                    
                  </ul>
                </div>
              </div>
            </div>

              <?php
            }else{

            
            include("simple.php");
            $creex=getExchange($ref);

            $creexarry=explode(";", $creex);
            if($creexarry[0]=="0"){
              $theex=json_decode($creexarry[1],TRUE);
              $amountfrom=$theex['amount_from'];
              $addressfrom=$theex['address_from'];
              $currencyfrom=$theex['currency_from'];
              $currencyto=$theex['currency_to'];
              $userrefundaddress=($theex['user_refund_address']!="")?"Refund: ".$theex['user_refund_address']:"";
              $user_refund_extra_id=($theex['user_refund_extra_id']!="")?$theex['user_refund_extra_id']:"";
              $amountto=$theex['amount_to'];
              $addressto=$theex['address_to'];
              $dte=$theex['timestamp'];
              $ldte=$theex['updated_at'];
              $type=$theex['type'];
              $tstatus=$theex['status'];
              $img="";
              $statushtml='';
              $statbtn='';
              $shstatus="checkExchange";
              $tit="";
              $lab="";
              $refrh='<script type="text/javascript">
                  setTimeout(function(){
                     window.location.reload(1);
                  }, 180000);
                </script>';
              if($tstatus=="waiting"){
                $tit="Exchange Created";
                $lab="Kindly send coins to the address displayed below and let us take care of the rest.";
                $statbtn='<button class="btn btn-warning lh-1" type="button" disabled><span class="spinner-border spinner-border-sm" role="status"></span>
                  Awaiting Deposit... </button>';
                $img="https://chart.googleapis.com/chart?chs=225x225&chld=L|2&cht=qr&chl=$addressfrom";
                $statushtml='<div class="position-relative">
                  <div class="progress" style="height: 3px">
                    <div class="progress-bar" role="progressbar" style="width: 5%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <button type="button" class="position-absolute top-0 start-0 translate-middle btn btn-sm btn-primary rounded-pill" style="width: 3rem; height: 2rem">1 </button>
                  <button type="button" class="position-absolute top-0 start-33 translate-middle btn btn-sm btn-secondary rounded-pill" style="width: 3rem; height: 2rem">2</button>
                  <button type="button" class="position-absolute top-0 start-66 translate-middle btn btn-sm btn-secondary rounded-pill" style="width: 3rem; height: 2rem">3</button>
                  <button type="button" class="position-absolute top-0 start-100 translate-middle btn btn-sm btn-secondary rounded-pill" style="width: 3rem; height: 2rem">4</button>
                </div>'.$refrh;
              }
              if($tstatus=="exchanging"){
                $tit="Deposit Received";
                $lab="We have received your deposit and now exchanging your coins.";
                $statbtn='<button class="btn btn-primary lh-1" type="button" disabled><span class="spinner-border spinner-border-sm" role="status"></span>
                  Exchanging Coins... </button>';
                $img="assets/images/exchange.svg";
                $statushtml='<div class="position-relative">
                  <div class="progress" style="height: 3px">
                    <div class="progress-bar" role="progressbar" style="width: 41%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <button type="button" class="position-absolute top-0 start-0 translate-middle btn btn-sm btn-primary rounded-pill" style="width: 3rem; height: 2rem">1 </button>
                  <button type="button" class="position-absolute top-0 start-33 translate-middle btn btn-sm btn-primary rounded-pill" style="width: 3rem; height: 2rem">2</button>
                  <button type="button" class="position-absolute top-0 start-66 translate-middle btn btn-sm btn-secondary rounded-pill" style="width: 3rem; height: 2rem">3</button>
                  <button type="button" class="position-absolute top-0 start-100 translate-middle btn btn-sm btn-secondary rounded-pill" style="width: 3rem; height: 2rem">4</button>
                </div>'.$refrh;
              }
              if($tstatus=="sending"){
                $tit="Sending Coins";
                $lab="We are now sending coins to the wallet address you provided.";
                $statbtn='<button class="btn btn-warning lh-1" type="button" disabled><span class="spinner-border spinner-border-sm" role="status"></span>
                  Sending Coins... </button>';
                $img="assets/images/sending.svg";
                $statushtml='<div class="position-relative">
                  <div class="progress" style="height: 3px">
                    <div class="progress-bar" role="progressbar" style="width: 80%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <button type="button" class="position-absolute top-0 start-0 translate-middle btn btn-sm btn-primary rounded-pill" style="width: 3rem; height: 2rem">1 </button>
                  <button type="button" class="position-absolute top-0 start-33 translate-middle btn btn-sm btn-primary rounded-pill" style="width: 3rem; height: 2rem">2</button>
                  <button type="button" class="position-absolute top-0 start-66 translate-middle btn btn-sm btn-primary rounded-pill" style="width: 3rem; height: 2rem">3</button>
                  <button type="button" class="position-absolute top-0 start-100 translate-middle btn btn-sm btn-secondary rounded-pill" style="width: 3rem; height: 2rem">4</button>
                </div>
                '.$refrh;
              }
              if($tstatus=="finished"){
                $tit="Exchange Completed";
                $lab="This exchange has been finalised. Contact support for any queries.";
                $shstatus="Completed";
                $statbtn='<a class="btn btn-success lh-1" href="exchange?create_ex=" type="button"></span>
                  Exchange Finished... Create New</a></br>';
                $img="assets/images/finish.svg";
                $statushtml='<div class="position-relative">
                  <div class="progress" style="height: 3px">
                    <div class="progress-bar" role="progressbar" style="width: 100%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <button type="button" class="position-absolute top-0 start-0 translate-middle btn btn-sm btn-primary rounded-pill" style="width: 3rem; height: 2rem">1 </button>
                  <button type="button" class="position-absolute top-0 start-33 translate-middle btn btn-sm btn-primary rounded-pill" style="width: 3rem; height: 2rem">2</button>
                  <button type="button" class="position-absolute top-0 start-66 translate-middle btn btn-sm btn-primary rounded-pill" style="width: 3rem; height: 2rem">3</button>
                  <button type="button" class="position-absolute top-0 start-100 translate-middle btn btn-sm btn-primary rounded-pill" style="width: 3rem; height: 2rem">4</button>
                </div>';
              }
              $apreqtime=date('Y-m-d H:i:s');
              $conn3 = new mysqli($servername, $username, $password, $dbname);
              $stmt = $conn3->prepare("update transactions set simplestatus=?, tstatus=?, obj=?, lastupdate=? where simpleid=? ");

              $stmt->bind_param("sssss", $ssimplestatus, $sstatus, $sobj,$slastupdate,$ssimpleid);
              $ssimplestatus = $tstatus;
              $sstatus = $shstatus;
              $sobj = json_encode($theex);
              $slastupdate = $apreqtime;
              $ssimpleid = $exchangeid;
              
                  try {

                      if (true) {
                        $stmt->execute();
                        $stmt->close();
                         
                      } else {
                        $_SESSION['notifye']="Unable to update Exchange at this time! Internal Service Error.";        
                    }
                  }catch(Exception $e) {
                      $_SESSION['notifye']= "Unable to update Exchange at this time! Internal Service Error.";
                  }
            
          ?>
          
          <div class="row justify-content-center wow fadeInUp mt-1" data-wow-delay="0.5s">
            <div class="card mb-0" >
            <div class="card-body py-0">
              <ul class="nav nav-tabs profile-tabs" id="myTab" role="tablist">
                
                <li class="nav-item">
                  <a class="nav-link active" id="pc-clipboard-1" role="tab"
                    aria-selected="true">
                    <i class="ti ti-id me-2"></i>Exchange ID : <?php echo $exchangeid;?>
                  </a>
                  <a href="javascript:void(0)" class="btn btn-lg btn-primary" data-clipboard="true" id="exchangeidcopy" data-clipboard-target="#pc-clipboard-1"><i class="feather icon-copy"></i></a>
                </li>
                
              </ul>
            </div>
          </div>
          <div class="card">
            <div class="card-header">
              <h5 class=""><?php echo $tit;?></h5>
              <div class="d-flex align-items-center text-muted mt-2">
              
              <span class="text-muted text-sm w-100"><?php echo $lab;?>
               </span>

            </div>
            </div>
            
            <div class="card-body position-relative">
              <div class="position-absolute end-0 top-0 p-3">
                <span class="badge bg-primary"><?php echo $type;?></span>
                 
              </div>

              <div class="row mt-3">
                <div class="offset-md-2 col-md-3 offset-xl-2 col-xl-3 mb-2">
                  <a class="img-post card" data-lightbox="<?php echo $img;?>">
                    <img src="<?php echo $img;?>" alt="img" class="card-img">
                    <div class="card-img-overlay">
                      <i class="ti ti-search"></i>
                    </div>
                  </a>
                </div>
                <div class="col-xl-6">
                  <hr class="my-3 border border-secondary-subtle">
                  <div class="">
                    <div class="d-inline-flex align-items-center text-center justify-content-start w-100 mb-3">
                      <i class="ti ti-report-money me-2"></i>
                      <p class="mb-0 text-left"><h5 class="mb-0" ><span id="pc-clipboard-2"><?php echo $amountfrom;?></span> <span class="text-muted text-sm"> <img alt="ccy"  src="https://static.simpleswap.io/images/currencies-logo/<?php echo $currencyfrom;?>.svg" class="styles__StyledImage-sc-7mvgp0-0 dfoEXf"> </span></h5> <a href="javascript:void(0)" class="" data-clipboard="true" id="amountidcopy" data-clipboard-target="#pc-clipboard-2"><i class="feather icon-copy"></i></a></p>
                    </div>
                    <div class="d-inline-flex align-items-center justify-content-start w-100 mb-3">
                      <i class="ti ti-wallet me-2"></i>
                      <a href="#" >
                        <p class="mb-0 text-left"><span id="pc-clipboard-3" class="link-primary"><?php echo $addressfrom;?></span><a href="javascript:void(0)" class="" data-clipboard="true" id="addressidcopy" data-clipboard-target="#pc-clipboard-3"><i class="feather icon-copy"></i></a></p>
                      </a>
                      
                    </div>
                    <div class="d-inline-flex align-items-center justify-content-start w-100 mb-3">
                      <i class="ti ti-mail me-2"></i>
                      <p class="mb-0 text-left"><?php echo $user_refund_extra_id;?></p>
                    </div>
                    <div class="d-inline-flex align-items-center justify-content-start w-100">
                      <i class="ti ti-receipt-refund me-2"></i>
                      <p class="mb-0 text-left"><?php echo $userrefundaddress;?></p>
                    </div>
                </div>
                </div>

              </div>
              <div class="p-3 p-sm-5 mt-3 mb-3">
                <?php echo $statushtml;?>
              </div>
              <div class="d-flex justify-content-center mb-6">
                
                 <?php echo $statbtn;?>
             
              </div>
              <div class="card mt-2">
                <div class="card-body py-2">
                  <ul class="list-group list-group-flush">
                    <li class="list-group-item px-0">
                      <h5 class="mb-0 text-left">You Get:</h5>
                    </li>
                    <li class="list-group-item px-0 text-left">
                      <div class="float-end">
                        <h5 class="mb-0"><?php echo $amountto;?> <span class="text-muted text-sm"><img alt="ccy"  src="https://static.simpleswap.io/images/currencies-logo/<?php echo $currencyto;?>.svg" class="styles__StyledImage-sc-7mvgp0-0 dfoEXf"> </span></h5>
                      </div><span class="text-muted ">Estimated Delivery</span>
                    </li>
                    <li class="list-group-item px-0 text-left">
                      <div class="float-end">
                        <h5 class="mb-0"><?php echo $addressto;?></h5>
                      </div><span class="text-muted">Recipient Address</span>
                    </li>
                    <li class="list-group-item px-0 text-left">
                      <div class="float-end">
                        <h5 class="mb-0"><?php echo date('jS M Y - h:i:A', strtotime($dte));?></h5>
                      </div><span class="text-muted">Initiated At</span>
                    </li>
                    <li class="list-group-item px-0 text-left">
                      <div class="float-end">
                        <h5 class="mb-0"><?php echo date('jS M Y - h:i:A', strtotime($ldte));?></h5>
                      </div><span class="text-muted">Last Update</span>
                    </li>
                  </ul>
                </div>
                <div style="display: none;">
                 <select
                      type="select-one"
                      class="form-control"
                      name="choices-single-default"
                      id="choices-single-default2"
                      onchange="loadCurrencySecondImage('','');" 
                      required
                      data-trigger
                      
                    >
                      <option value="" >Search for Coin</option>
                    </select>
                     <select
                      type="select-one"
                      class="form-control"
                      name="choices-single-default"
                      id="choices-single-default"
                      onchange="loadCurrencySecondImage('','');" 
                      required
                      data-trigger
                      
                    >
                      <option value="" >Search for Coin</option>
                    </select>
                  </div>
              </div>
            </div>
          </div>
          <?php
          }else{
              $_SESSION['notifye']="Exchange not found";

            
            ?>
            <div class="row justify-content-center wow fadeInUp mt-1" data-wow-delay="0.5s">
            <div class="card mb-0" >
            <div class="card-body py-0">
                  <ul class="nav nav-tabs profile-tabs" id="myTab" role="tablist">
                    
                    <li class="nav-item">
                      <a class="nav-link active" id="pc-clipboard-1" role="tab"
                        aria-selected="true">
                        <i class="ti ti-id me-2"></i>Exchange ID : <?php echo $exchangeid;?>
                      </a>
                      <a href="javascript:void(0)" class="btn btn-lg btn-primary" data-clipboard="true" id="exchangeidcopy" data-clipboard-target="#pc-clipboard-1"><i class="feather icon-copy"></i></a>
                    </li>
                    
                  </ul>
                </div>
              </div>
            </div>
            <?php
            }
          }
          }

          ?>
          
          </div>
          
        </div>
      </div>

    </div>
    
  </header>
  <?php include "faqsection.php";?>
  <?php include "trustedby.php";?>
  
  <!-- [ trusted by ] End -->

   <?php include "footer.php";?>
