<!DOCTYPE html>
<html lang="en">
<head>
	<title>Request Delete Data - Hawas App</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="shortcut icon" type="image/x-icon" href="<?=base_url()?>assets/img/logo-kotak-persegi.png">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/login/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/login/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/login/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/login/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/login/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/login/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/login/vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/login/vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/login/css/util.css">
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/login/css/main.css">
<!--===============================================================================================-->
</head>
<style type="text/css">
	     #pageloader
    {
      background: rgba( 255, 255, 255, 0.8 );
      display: none;
      height: 100%;
      position: fixed;
      width: 100%;
      z-index: 9999;
    }

    #pageloader img {
        left: 51%;
        margin-left: -100px;
        margin-top: -100px;
        position: absolute;
        top: 50%;
    }
</style>
<body>
	<div id="pageloader">
        <img src="<?=base_url()?>assets/img/pageloader2.gif" alt="processing..." />
    </div>
	<div class="limiter">
		<div class="container-login100" style="background-image: url('<?=base_url()?>assets/img/bg_login.jpg');">
				 	
			<div class="wrap-login100 p-l-110 p-r-110 p-t-62 p-b-33" style="width: 600px">
				<div class="login100-form validate-form flex-sb flex-w">
					<span class="login100-form-title p-b-53" style="padding-bottom:5px;margin-top: 20px; font-size: 25px; font-weight: bold;">
						 REQUEST DELETE DATA
					</span>

					<div class="p-t-31 p-b-9">
						<span class="txt1">
							Your email or username
						</span>
					</div>
					<div class="wrap-input100 validate-input" data-validate = "Username is required">
						<input class="input100" type="text" id="username" name="username" style="height: 45px">
						<span class="focus-input100"></span>
					</div>
					
					<div class="p-t-13 p-b-9">
						<span class="txt1">
							Your Password
						</span>

						
					</div>
					<div class="wrap-input100 validate-input" data-validate = "Password is required">
						<input class="input100" id="password" type="password" name="pass" style="height: 45px">
						<span class="focus-input100"></span>
					</div>

					<div class="container-login100-form-btn m-t-17">
						<button class="login100-form-btn" onclick="GoReqDeleteData()">
							Request Delete Data
						</button>
					</div>

					<div class="w-full text-center p-t-55">
						<span class="txt2">
							&nbsp;
						</span>

						<a href="#" class="txt2 bo1">
							&nbsp;
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>
	
<!--===============================================================================================-->
	<script src="<?=base_url()?>assets/login/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="<?=base_url()?>assets/login/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="<?=base_url()?>assets/login/vendor/bootstrap/js/popper.js"></script>
	<script src="<?=base_url()?>assets/login/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="<?=base_url()?>assets/login/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="<?=base_url()?>assets/login/vendor/daterangepicker/moment.min.js"></script>
	<script src="<?=base_url()?>assets/login/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="<?=base_url()?>assets/login/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="<?=base_url()?>assets/login/js/main.js"></script>
	<script src="<?=base_url()?>assets/js/sweetalert.min.js"></script>

</body>
</html>

<script type="text/javascript">
	function GoReqDeleteData(){
		$("#pageloader").fadeIn();
			setTimeout(function() {
				var datasend = new FormData();
		        datasend.append('username',$('#username').val());
		        datasend.append('password',$('#password').val());
		        $.ajax({
		            url: '<?=base_url()?>Web/RequestDeleteData',
		            method: 'POST',
		            contentType: false,
		            processData: false,
		            data: datasend,
		            dataType:'json',
		            cache:true,
		            success: function(data) {
		            	if (data.status=='sukses') {
		            		$("#pageloader").hide();
		            		swal("Informasi",data.pesan,"success");
		            	} else {
		            		$("#pageloader").hide();
		            		swal("Informasi",data.pesan,"error");
		            	}
		                	                
		            },
		            error: function(data) {
		            	$("#pageloader").hide();	             
		                swal("Informasi","Gagal Terhubung Ke Server" ,"error");
		            }
		        });	
			}, 500);

	}
</script>