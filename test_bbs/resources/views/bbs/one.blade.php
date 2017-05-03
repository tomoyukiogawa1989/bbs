@extends('layouts.master')
@section('content')

<div class="col-md-9">
    <div class="panel panel-default">
        <div class="panel-heading">{{ $bbs->title }}</div>
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
            <small>投稿日：{{ date("Y年 m月 d日",strtotime($bbs->created_at)) }}</small></p>
            <p><?php echo $bbs->content; ?></p>
            <hr />
            <p>コメント一覧</p>
            @if($empty!="NG")
                    <?php $i=0;$ii=isset($_GET['page']) ? (int) ($_GET['page']-1)*10:0;?>
                @foreach($comments as $comment)
                    <p>◆No.{{ $ii+1 }}　{{ $username[$i] }}</p>
                    <p>{{ $comment->comment }}</p><br />
                    <?php $i++;$ii++;?>
                @endforeach
            @else
            現在、コメントはありません。
            @endif
            <br />
            {!! $comments->render() !!}<br />
            <br /><li>コメントを投稿する</li>
            <form class="form-horizontal" role="form" method="POST" action="{{ url('/bbs/one/$bbs->id') }}">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="commenter" class="">名前</label>
                    <div class="">
                        @if(Auth::guest())
                            <input type="hidden" name="user_id" value="-1" >
                            ゲスト
                        @else
                            <input type="hidden" name="user_id" value="{{ Auth::User()->id }}" >
                            {{ Auth::User()->name }}
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label for="comment" class="">コメント</label>
                        <textarea style="width:60%" type="text" class="form-control" name="comment" rows="5" maxlength='1000' required autofocus>{{ old('comment') }}</textarea>
                        @if ($errors->has('comment'))
                            <span class="help-block">
                                <strong>{{ $errors->first('comment') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <input type="hidden" name="bbs_id" value="{{ $bbs->id }}" >
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">投稿する</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
