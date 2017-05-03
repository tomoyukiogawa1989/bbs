@extends('layouts.master')
@section('content')

<div class="col-md-9">
    <div class="panel panel-default">
        <div class="panel-heading">プロフィール編集</div>
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
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/mypage/profile') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}" >
                            <label for="name" class="col-md-2 control-label">名前</label>
                            <div class="col-md-6">
                            @if(( old('name') === null ))
                                <input style="width:100%" id="name" type="text" name="name" value="{{ Auth::User()->name }}" witmaxlength='255' required autofocus></td>
                            @else
                                <input style="width:100%" id="name" type="text" name="name" value="{{old('name')}}" maxlength='255' required autofocus></td>
                            @endif
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-2 control-label">メールアドレス</label>

                            <div class="col-md-6">
                                {{ Auth::User()->email }}
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('comment') ? ' has-error' : '' }}">
                            <label for="comment" class="col-md-2 control-label">コメント</label>

                            <div class="col-md-6">
                            @if(( old('name') === null ))
                                <input style="width:100%" id="comment" type="text" name="comment" value="{{ Auth::User()->comment }}" maxlength='255' required autofocus></td>
                            @else
                                <input style="width:100%" id="comment" type="text" name="comment" value="{{old('comment')}}" maxlength='255' required autofocus></td>
                            @endif
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    更新
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
