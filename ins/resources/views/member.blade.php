@extends('layouts.main')
@section('css')

@endsection

@section('content')
<div style="width: 100%;float:left;">
	<div style="width: 1080px;margin: 50px auto;">
		<div style="width: 100%;text-align: center;"><h1>{{ $member->member_name }}</h1></div>
		<div style="width: 100%;text-align: center;">
			<img src="{{ $member->member_face}}" style="height: 200px;margin-top: 10px;">
		</div>
		<div style="width: 100%;padding-top: 20px;padding-bottom: 20px;margin-top: 30px;">
			{!! $member->member_article !!}	
		</div>
	</div>
</div>
@endsection