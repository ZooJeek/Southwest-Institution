@extends('layouts.main')
@section('content')
<div style="width: 1200px;margin:0px auto;">
<img src="/img/logoFace.jpg" style="width: 1200px;margin:0px auto;">
</div>
<div style="width: 1200px;margin:0px auto;">
	<!-- 工作动态——轮播 -->
	<div id="workCarousel" class="carousel slide" style="float: left;padding: 0px;width: 350px;height: 250px;">
		<ol class="carousel-indicators">
			<li data-target="#workCarousel" data-slide-to="0" class="active"></li>
			@foreach($work as $workFace)
				@if ($loop->index == 0)
        			@continue
    			@endif
				<li data-target="#workCarousel" data-slide-to=" {{ $loop->index }} "></li>
			@endforeach
		</ol>   

		<div class="carousel-inner" style="margin-top:20px;">
			@foreach($work as $workFace)
				@if ($loop->index == 0)
				<div class="item active">
					<a href="/article/{{ $work[0]->article_key }}">
						<img src="{{$work[0]->article_face}}" style="width: 350px;height: 250px;">
					</a>
				</div>
			
    			@endif
				<div class="item">
					<a href="/article/{{ $workFace->article_key }}">
						<img src="{{$workFace->article_face}}" style="width: 350px;height: 250px;">
					</a>
				</div>
			@endforeach
		</div>
	</div>

	<!-- 工作动态——标题 -->
	<div id="workBlock" style="float: left;height: 300px;width: 400px;">
		<span style="color:#3968cb;margin: 15px 0px 3px 10px;float: left;font-size: 20px;">工作动态</span>
		<a href="/GZDT" style="color: #3998db;float: right;margin: 17px 10px 3px 0px;">更多</a>
		<br>
		<div class="line" style="background: #3968cb;height: 2px;"></div>
		<ul id="workList" style="float: left;margin-left: 20px;margin-top: 10px;" onmouseout="workCaStart();">
			@foreach($work as $w)
				<a href="/article/{{ $w->article_key }}">
					<li class="workTitle" onmousemove="workCajump({{ $loop->index }});">
						{{ $w->article_title }}
					</li>
				</a>
			@endforeach
		</ul>
	</div>
	
	<div id="noteBoard" style="width: 420px;margin-left:30px;height: 270px;float: left;margin-top: 10px;border: 1px solid #ccc;">
		<div style="background: #4f7722;height: 40px;font-size: 20px;color: white;padding-top:5px;float: left;width: 100%;text-align: center;">
			通知公告
		</div>

		<div id="noteBlock" style="width: 420px;height: 230px;overflow: hidden;">

			@foreach($note as $n)
				<a href="/article/{{ $n->article_key }}">
					<div class="mainTitle">
						<div class="articleTitle">
							{{ $n->article_title }}
						</div>
						<div class="article_time">
							{{ date('Y-m-d', strtotime($n->article_time)) }}
						</div>
					</div>
				</a>
			@endforeach
			<a href="articleList/1"><div class="mainTitle" style="font-size: 12px;">————查看全部————</div></a>
		</div>
	</div>

	<div id="teamBlock" style="box-shadow: 4px 4px 10px #666;width: 1px;width: 730px;height: 260px;text-align: center;font-size:20px;float: left;clear: left;border-radius: 8px;background: #fcfcfc;margin-top: 40px;">
	<div style="height: 260px;width: 60px;background:linear-gradient(to right,#81c1f5,#fcfcfc);float: left;font-size: 25px;padding-top: 50px;border-top-left-radius: 8px;border-bottom-left-radius: 8px;">
		研<br>究<br>团<br>队
	</div>

    <div id="list" class="picutre_many" style="overflow: hidden; height: 260px; width: 630px; margin: 0 auto;margin-top: 0px;float: left;margin-left: 2px;">
        <table style="width: 630px; border: 0px;"><tr>
            <td id="list1">
                    <table style="border: 0px;" cellpadding="0" cellspacing="0">
                        <tr id="pic" style="height: 250px;margin-top: 5px;">
							@foreach($member as $person)
                            	<td style="padding-left:3px;">
                            		<a href="/member/{{ $person->member_key }}">
                            			<img class="memberImg" src="{{$person->member_face}}"/>
										<p class="memberName">{{$person->member_name}}</p>
									</a>
                            	</td>
                            @endforeach
                        </tr>
                    </table>
            </td>
            <td id="list2"></td></tr>
        </table>
    </div>

	</div>
	<div id="acadeBlock" style="width: 1px;width: 420px;height: 270px;border: 1px solid #ccc;float: left;margin-left: 50px;margin-top: 40px;">
		<div style="float: left;width: 100%;background: #4f7722;font-size: 20px;color: white;height: 40px;text-align: center;padding-top: 5px;">
			学术交流
		</div>
		<div style="width: 420px;padding: 5px;height: 230px;float: left;">
			@foreach($study as $s)
				<a href="/article/{{ $s->article_key }}">
					<div class="mainTitle">
						<div class="articleTitle">
							{{ $s->article_title }}
						</div>
						<div class="article_time">
							{{ date('Y-m-d', strtotime($s->article_time)) }}
						</div>
					</div>
				</a>
			@endforeach
			<a href="articleList/3"><div class="mainTitle" style="font-size: 12px;">————查看全部————</div></a>
		</div>
	</div>

</div>

@section('js')
	<script src="/js/index.js"></script>
@endsection

@endsection