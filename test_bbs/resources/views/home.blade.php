@extends(Auth::guest() ? 'layouts.master' : 'layouts.master')
@section('content')
<div class="col-md-9">
    <div class="panel panel-default">
        <div class="panel-heading">Home Topics</div>
        <div class="panel-body">
            ようこそ。{{ Auth::guest() ? "ゲスト":Auth::user()->name }}さん。
        </div>
    </div>
</div>
@endsection
