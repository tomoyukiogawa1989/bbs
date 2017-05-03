@extends('layouts.master')
@section('content')

<div class="col-md-9">
    <div class="panel panel-default">
        <div class="panel-heading">記事一覧</div>
        <div class="panel-body">
            @if(Session::has('success'))
                <h3 class="success">{{Session::get('success')}}</h3>
            @elseif(Session::has('ng'))
                <div class="alert alert-danger"><ul><li>{{Session::get('ng')}}</li></ul></div>
            @elseif(count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if($empty!="NG")
            @foreach($bbs as $post)
                <li>タイトル：<?php echo mb_strimwidth($post->title, 0, 50, "..."); ?> 　　<small>投稿日：{{ date("Y年 m月 d日",strtotime($post->created_at)) }}</small></li>
                <p><?php echo  mb_strimwidth($post->content, 0, 200, "..."); ?></p>
                <p>{{ link_to("/bbs/one/$post->id", '続きを読む', array('class' => 'btn btn-primary')) }}　コメント数：{{ $post->comment_count }}</p>
                <hr />
            @endforeach
            @else
            現在、投稿はありません。
            @endif
            <br />
            {!! $bbs->render() !!}<br />
        </div>
    </div>
</div>
@endsection
