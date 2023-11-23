<!DOCTYPE html>
<html lang="en">

<head>
	<?php $this->load->view('site/head', $this->data); ?>

</head>
</head>

<body>
	<div class="container">
		<?php $this->load->view('site/header', $this->data); ?>

		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 clearpadding" style="margin-top: 15px;">
				<ol class="breadcrumb">
					<li><a href="#"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> Home</a></li>
					<li class="active">Đăng nhập</li>
				</ol>
				<div class="panel panel-info ">
					<?php if (isset($message_fail) && !empty($message_fail)) { ?>
						<?php echo $message_fail; ?>
					<?php } ?>
					<div class="panel-body">
						<form id="loginForm" class="form-horizontal" method="post" action="<?php echo base_url('user/login'); ?>">
							<div class="form-group">
								<h3 style="color: red"><?php echo form_error('login'); ?></h3>
							</div>
							<div class="form-group">
								<label for="inputEmail3" class=" col-sm-offset-2 col-sm-2 control-label">Email</label>
								<div class="col-sm-4">
									<input type="email" class="form-control" id="inputEmail3" placeholder="" name="email" value="<?php echo set_value('email'); ?>">
								</div>
								<div class="col-sm-3">
									<?php echo form_error('email'); ?>
								</div>
							</div>
							<div class="form-group">
								<label for="password" class="col-sm-offset-2 col-sm-2 control-label">Mật khẩu</label>
								<div class="col-sm-4">
									<input type="password" class="form-control" id="password" placeholder="" name="password">
								</div>
								<div class="col-sm-3">
									<?php echo form_error('password'); ?>
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-offset-4 col-sm-2">
									<button type="submit" class="btn btn-success">Đăng nhập</button>
								</div>
								<div class="col-sm-offset-1 col-sm-2">
									<a href="<?php echo base_url('dang-ky'); ?>">Đăng kí</a>
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-offset-4">
									<button type="button" class="login-with-google-btn" onclick="openGoogleSignInPopup()">Tiếp tục với google</button>
								</div>
							</div>
						</form>
					</div>

				</div>
			</div>
		</div>

	</div>
	<script src="<?php echo public_url('site/'); ?>bootstrap/js/bootstrap.min.js"></script>
	<script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-app.js"></script>
	<script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-auth.js"></script>
	<script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-firestore.js"></script>
	<script src="https://www.gstatic.com/firebasejs/8.6.1/firebase-storage.js"></script>
	<script src="https://www.gstatic.com/firebasejs/8.6.1/firebase-database.js"></script>
	<script>
		// app.js
		const firebaseConfig = {
			apiKey: "AIzaSyANSwlR-gyTKxCBCdhhWHgbB5Fg5-ODJ3c",
			authDomain: "tourism-de1ac.firebaseapp.com",
			databaseURL: "https://tourism-de1ac-default-rtdb.asia-southeast1.firebasedatabase.app",
			projectId: "tourism-de1ac",
			storageBucket: "tourism-de1ac.appspot.com",
			messagingSenderId: "204093368364",
			appId: "1:204093368364:web:88baf7f0e2582e3f4cc989",
			measurementId: "G-XVC8PLLSJF"
		};

		firebase.initializeApp(firebaseConfig);
	</script>
	<script>
		function openGoogleSignInPopup() {
			var provider = new firebase.auth.GoogleAuthProvider();

			firebase.auth().signInWithPopup(provider)
				.then(function(result) {
					// Xử lý khi người dùng đăng nhập thành công
					var user = result.user;
					document.getElementById("inputEmail3").value= user.email
					document.getElementById("password").value= user.uid
					document.getElementById("loginForm").submit()
					console.log(user);
				})
				.catch(function(error) {
					// Xử lý lỗi đăng nhập
					console.error(error);
				});
		}
	</script>
</body>
<?php $this->load->view('site/footer', $this->data); ?>

</html>
<style>
	.login-with-google-btn {
		transition: background-color .3s, box-shadow .3s;

		padding: 12px 16px 12px 42px;
		border: none;
		border-radius: 3px;
		box-shadow: 0 -1px 0 rgba(0, 0, 0, .04), 0 1px 1px rgba(0, 0, 0, .25);

		color: #757575;
		font-size: 14px;
		font-weight: 500;
		font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen, Ubuntu, Cantarell, "Fira Sans", "Droid Sans", "Helvetica Neue", sans-serif;

		background-image: url(data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTgiIGhlaWdodD0iMTgiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGcgZmlsbD0ibm9uZSIgZmlsbC1ydWxlPSJldmVub2RkIj48cGF0aCBkPSJNMTcuNiA5LjJsLS4xLTEuOEg5djMuNGg0LjhDMTMuNiAxMiAxMyAxMyAxMiAxMy42djIuMmgzYTguOCA4LjggMCAwIDAgMi42LTYuNnoiIGZpbGw9IiM0Mjg1RjQiIGZpbGwtcnVsZT0ibm9uemVybyIvPjxwYXRoIGQ9Ik05IDE4YzIuNCAwIDQuNS0uOCA2LTIuMmwtMy0yLjJhNS40IDUuNCAwIDAgMS04LTIuOUgxVjEzYTkgOSAwIDAgMCA4IDV6IiBmaWxsPSIjMzRBODUzIiBmaWxsLXJ1bGU9Im5vbnplcm8iLz48cGF0aCBkPSJNNCAxMC43YTUuNCA1LjQgMCAwIDEgMC0zLjRWNUgxYTkgOSAwIDAgMCAwIDhsMy0yLjN6IiBmaWxsPSIjRkJCQzA1IiBmaWxsLXJ1bGU9Im5vbnplcm8iLz48cGF0aCBkPSJNOSAzLjZjMS4zIDAgMi41LjQgMy40IDEuM0wxNSAyLjNBOSA5IDAgMCAwIDEgNWwzIDIuNGE1LjQgNS40IDAgMCAxIDUtMy43eiIgZmlsbD0iI0VBNDMzNSIgZmlsbC1ydWxlPSJub256ZXJvIi8+PHBhdGggZD0iTTAgMGgxOHYxOEgweiIvPjwvZz48L3N2Zz4=);
		background-color: white;
		background-repeat: no-repeat;
		background-position: 12px 11px;

		&:hover {
			box-shadow: 0 -1px 0 rgba(0, 0, 0, .04), 0 2px 4px rgba(0, 0, 0, .25);
		}

		&:active {
			background-color: #eeeeee;
		}

		&:focus {
			outline: none;
			box-shadow:
				0 -1px 0 rgba(0, 0, 0, .04),
				0 2px 4px rgba(0, 0, 0, .25),
				0 0 0 3px #c8dafc;
		}

		&:disabled {
			filter: grayscale(100%);
			background-color: #ebebeb;
			box-shadow: 0 -1px 0 rgba(0, 0, 0, .04), 0 1px 1px rgba(0, 0, 0, .25);
			cursor: not-allowed;
		}
	}
</style>