@extends('layouts.main')
@section('css')
<link rel="stylesheet" type="text/css" href="/css/article.css">
@endsection

@section('content')
<div style="width: 1080px;margin:0px auto;">
	<div id="article_body" style="width: 1080px;float:left;margin:50px auto;">
		<div id="article_title" style="margin: 0px auto;width: 100%;">
			<h2 style="width: 100%;text-align: center;">{{ $article->article_title }}</h2>
		</div>
		<div id="article_info" style="width: 100%;height: 40px;margin-top:40px;color:#777;">
			<div style="margin:0px auto;width: 800px;text-align: center;">
				<center>
				<p class="info_text">摄影：{{ $article->article_photo }}</p>
				<p class="info_text">作者：{{ $article->article_author }}</p>
				<p class="info_text">来源：{{ $article->article_from }}</p>
				<p class="info_text">备注：{{ $article->article_note }}</p>
				<p class="info_text">审核：{{ $article->article_check }}</p>
				<p class="info_text">阅读：{{ $article->article_read }}</p>
				<p class="info_text">时间：{{ $article->article_time }}</p>
			</center>
			</div>
		</div>
		<div id="article_content" style="width: 95%;float: left;margin: 0px auto;overflow-y: auto;overflow-x: hidden;padding:50px 20px 100px 20px;">
			{!! $article->article_content !!}
		</div>
	</div>
</div>

	
@endsection