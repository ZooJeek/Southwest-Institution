<!DOCTYPE html>
<html>
<head>
	<title>研究院后台登录系统</title>
	<link rel="stylesheet" href="css/loginStyle.css">

	<!--<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
-->
	<!-- For-Mobile-Apps-and-Meta-Tags -->
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="keywords" content="Simple Login Form Widget Responsive, Login Form Web Template, Flat Pricing Tables, Flat Drop-Downs, Sign-Up Web Templates, Flat Web Templates, Login Sign-up Responsive Web Template, Smartphone Compatible Web Template, Free Web Designs for Nokia, Samsung, LG, Sony Ericsson, Motorola Web Design" />
		<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
	<!-- //For-Mobile-Apps-and-Meta-Tags -->

</head>

<body>
    <h1>后台登录系统</h1>
    <div class="container w3">
        <h2>现在登录</h2>
		<form action="/login" method="post">
			{{ csrf_field() }}
			<div class="userName">
				<span class="username" style="height:19px">用户:</span>
				<input type="text" name="userName" class="name" placeholder="" required="">
				<div class="clear"></div>
			</div>
			<div class="password-agileits">
				<span class="username" style="height:19px">密码:</span>
				<input type="password" name="passWord" class="password" placeholder="" required="">
				<div class="clear"></div>
			</div>
			
			<div class="login-w3">
				<p style="font-size: 15px; color:#902;margin: 0px auto;">{{ $note }}</p>
				<input type="submit" class="login" value="登录">
			</div>
			<div class="clear"></div>
		</form>
	</div>
	<div class="footer-w3l">
		<p>西南山地特色植物种质适应研究与利用研究院</p>
	</div>
</body>
</html>