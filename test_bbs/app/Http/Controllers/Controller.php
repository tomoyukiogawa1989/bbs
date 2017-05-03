<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

     //継承した全てのページでログインチェック
     /*
     public function __construct()
    {
        $this->middleware('auth');
    }
    */

    protected $common;

    public function __construct(CommonController $common)
    {
        $this->common = $common;
        //$this->middleware('auth');
    }

    // メールの認証(とりあえず有効期限はなし)
    public function getConfirm($token)
    {
        $data=$this->common->updateUserConfirmation($token);
        if($data=="update"){
            return redirect('login')->with(['success' => 'メール認証が完了しました。該当のアドレスでログインが可能です。']);;
        }else{
            return redirect('/');
        }
    }

    // メールの認証
    public function deleteConfirm($token)
    {
        $data=$this->common->deleteUserConfirmation($token);
        if($data=="delete"){
            return redirect('login')->with(['success' => '登録情報を削除しました。登録する場合は再度、新規で登録してください。']);;
        }else{
            return redirect('/');
        }
    }


}
