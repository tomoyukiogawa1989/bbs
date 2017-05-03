@extends(Auth::guest() ? 'layouts.app' : 'layouts.master')
@section('content')

<script type="text/javascript" src="/ckeditor/ckeditor.js" />
    CKEDITOR.replace( 'editor1');
</script>
<div class="col-md-9">
    <div class="panel panel-default">
        <div class="panel-heading">記事作成</div>
        <div class="panel-body ">
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
            投稿をクリックすると、記事が投稿されます。<br /><br />
            <form class="form-horizontal" role="form" method="POST" action="{{ url('/bbs/create/') }}">
                {{ csrf_field() }}
                <input type="hidden" name="image" value="0">
                <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                    <label for="title" class="col-md-2 control-label">タイトル</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="title" value="{{ old('title') }}" maxlength='255' required>
                        @if ($errors->has('title'))
                            <span class="help-block">
                                <strong>{{ $errors->first('title') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
                    <label for="text" class="col-md-2 control-label">本文</label>
                    <div class="col-md-6">
                        <textarea class="ckeditor" id="editor1" name="content" class="form-control" rows="10" maxlength='10000' required autofocus>{{ old('content') }}</textarea>
                        <!--textarea type="text" class="form-control" name="content" rows="10" maxlength='10000' required autofocus>{{ old('content') }}</textarea-->
                        @if ($errors->has('content'))
                            <span class="help-block">
                                <strong>{{ $errors->first('content') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <br />
                <div class="form-group text-center">
                    <button type="submit" name="action" value="bbs" class="col-md-2 col-md-offset-3 btn btn-default">投稿</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection