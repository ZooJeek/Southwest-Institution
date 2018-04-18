<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>西南山地特色植物种质适应与利用研究所</title>
	<link rel="stylesheet" href="/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="/css/global.css">
	<link rel="stylesheet" href="/css/index.css">
	@yield('css')
</head>
<body style="margin: 0px;">
<div style="width: 100%;padding-top: 2px;background: #666;;color:#ddd;font-size: 12px;">
	<div id='topLear' style="width: 1080px;height: 20px;margin: 0px auto;">
		<p style="float: left;">西南山地特色植物种质适应与利用研究所</p>
		<div style="float: left;">
			<a href='#' onclick="javascript:addFavorite2()" style="font-size: 13px;margin-left: 10px;color: #fff;">加入收藏</a>
		</div>
		<div id="timeBlock" style="float: right;"></div>
	</div>
</div>
<div id="logo" style="width: 100%;height: 150px;background:linear-gradient(to top,#3998db,#29588b);font-size: 22px;float: left;text-align: left;padding-top: 10px;">
	<div style="width: 1200px;margin: 0px auto;">
		<div style="float: left;width: 150px;height: 150px;margin: 8px;color: black;text-align: center;">
			<img src="/img/logoImg.png" style="width: 120px;">
		</div>
		<div id="topContent" style="float: left;">
			<!-- <img src="/img/logo8.png"> -->
			<p style="font-size: 35px;margin-left: 10px;color:#ffdddd;font-family: STKaiti; margin-top: 10px;">
				西南山地特色植物种质适应与利用研究所
			</p>
			<p style="font-size: 16px;margin-left: 15px;color:#efefef;font-family:'Times New Roman',Georgia,Serif">
				Institute of Plant Adaptation and Utilization in Southwest Mountain
			</p>
		</div>
	</div>
</div>
	<div id='mainMenu' style="width: 100%;font-size:18px;float: left;height: 50px;">
		<nav class="navbar navbar-default" role="navigation" style="box-shadow: 0px 0px 5px #777;">
			<div class="container-fluid" style="margin:0px auto;width: 1200px;">
				
					<ul class="nav navbar-nav" id="menuContent">
						<li><a href="/">首页</a></li>
						<li><a href="/Content/5">机构概况</a></li>
						<li><a href="/GZDT">工作动态</a></li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								研究方向
								<b class="caret"></b>
							</a>
							<ul class="dropdown-menu">
								@foreach($fields as $field)
									<li class="menuDrop">
										<a href="/field/{{$field->fie_key}}">{{$field->fie_name}}</a>
									</li>
								@endforeach
							</ul>
						</li>
						<li><a href="/articleList/4">科研成果</a></li>
						<li><a href="/articleList/3">学术交流</a></li>
						<li><a href="/articleList/1">通知公告</a></li>
						<li><a href="/Content/6">联系我们</a></li>
					</ul>
			</div>
		</nav>
	</div>

@yield('content')

<div style="width: 100%; height: 350px; background: #666; float: left; color: #ddd;margin-top: 50px;">
	<div style="margin-left:25%; margin-top: 80px; float: left;">
		<p style="font-size: 20px;margin-bottom: 30px;">网站信息</p>
		<a class="bottomText">注册信息</a>
		<a class="bottomText" href="/manage" style="color: white;">后台管理</a>
		<p class="bottomText">成立时间 : 2017年 12 月</p>
		<p class="bottomText">更新时间 : 2018年 3 月 21日</p>
	</div>

	<div style="margin-left: 12%; margin-top: 80px; float: left;">
		<p style="font-size: 20px;">主办单位</p>
		<p style="font-size: 15px;">
			<br>西华师范大学<br><br>地址：<br>四川省南充市顺庆区华风镇<br>四川省南充市顺庆区莲池路54号
		</p>
	</div>

	<div style="margin-left: 10%; margin-top: 80px; float: left;">
		<p style="font-size: 20px;">友情连接</p>
		<p style="font-size: 15px;"><br>西华师范大学官网<br>西华师范大学生态研究院<br>西华师范大学图书馆<br>西华师大Online Judge  
	</div>
</div>

<script src="/js/jquery-3.1.1.min.js"></script>
<script src="/bootstrap/js/bootstrap.min.js"></script>
<script src="/js/global.js"></script>
@yield('js')
</body>
</html>