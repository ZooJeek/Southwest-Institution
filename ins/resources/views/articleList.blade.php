@extends('layouts.main')

@section('css')
<link rel="stylesheet" href="/css/articleList.css">
@endsection

@section('content')

<div style="width: 1080px;height: 900px;border: 1px solid #ccc;margin: 0px auto;clear: both;padding: 10px 50px 50px 50px;">
    <p style="font-size: 18px;float: left;margin-left: 20px;">
    	<span class="glyphicon glyphicon-list" style="font-size: 15px;color: #3078cb;"></span> {{$typeName}}
    </p>

    <div class="container" style="width:980px;margin-top: 30px;">
        
        @foreach ($list as $item)
        <a href="/article/{{ $item->article_key }}" style="color: #333;float: left;">
            <div class="item">        
                <span class="article_title">
                    {{ $item->article_title }}
                </span>
                <span class="article_time">
                    {{ $item->article_time }}
                </span>
            </div>
        </a>
        @endforeach
        <div style="width: 90%;text-align: center;">
            {!! $list->links() !!}  
        </div> 
    </div>
</div>
@endsection

@section('js')
@endsection