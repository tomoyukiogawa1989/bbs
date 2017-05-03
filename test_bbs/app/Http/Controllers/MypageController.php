<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class MypageController extends Controller
{
    protected $models;

    public function __construct(MypageModelController $models)
    {
        $this->models = $models;
        $this->middleware('auth');
    }

/* プロフィール編集 */
    public function profile()
    {
        return view('mypage.profile');
    }

    public function profileUpdate(Request $request)
    {
        $input = $request->input();
        // ブラウザリロード等での二重送信防止
        $request->session()->regenerateToken();
        if(isset($input['name'])){
            $res=$this->models->updateUserInfo($input);
            if ($res>0) {
                $data = array(
                    'success' => '更新しました。',
                );
            }else{
                $data = array(
                    'ng' => '正常にデータの更新ができませんでした。',
                );
            }
            return Redirect::to('/mypage/profile/')->with($data);
        }
        return view('mypage.profile');
    }

}
