@extends('layouts.main')

@section('content')
<div style="width: 1080px;margin:0px auto;">
	<div id="article_body" style="width: 1080px;float:left;margin:50px auto;">
		<h2>{{ $article->article_title }}</h2>
		<hr>
		<div id="article_content" style="width: 95%;float: left;margin: 0px auto;overflow-y: auto;overflow-x: hidden;padding:50px 20px 100px 20px;">
			{!! $article->article_content !!}
		</div>
	</div>
</div>
	
@endsection