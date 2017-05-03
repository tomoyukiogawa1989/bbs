<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class BbsController extends Controller
{
    protected $models;

    public function __construct(BbsModelController $models)
    {
        $this->models = $models;
    }

    public function create()
    {
        if( \Auth::guest() ){
             return redirect('/login');
        }
        return view('bbs.create');
    }

    public function createPost(Request $request)
    {
        $input = $request->input();
        // ブラウザリロード等での二重送信防止
        $request->session()->regenerateToken();
        if(isset($input['title'])){
            $res=$this->models->insertBbs($input);
            $data = array(
                'success' => '投稿しました。',
            );
        }
        return redirect('/bbs/create/')->with($data);
    }

    public function views()
    {
        $bbs=$this->models->getBbs();
        $chk=$bbs->toArray();
        $empty="";
        if(empty($chk['data'])){
            $empty="NG";
        }
        return view('bbs.views',['bbs' => $bbs ,'empty' => $empty ]);
    }

    public function myviews()
    {
        if( \Auth::guest() ){
             return redirect('/login');
        }

        $bbs=$this->models->getMyBbs();
        $chk=$bbs->toArray();
        $empty="";
        if(empty($chk['data'])){
            $empty="NG";
        }
        return view('bbs.views',['bbs' => $bbs ,'empty' => $empty ]);
    }

    public function one($id)
    {
        $bbs=$this->models->getBbsOne($id);
        $com=$this->models->getComment($id);
        if($bbs==NULL || $bbs==FALSE){
            return redirect('/');
        }
        $chk=$com->toArray();
        $empty="";
        if(empty($chk['data'])){
            $empty="NG";
            $username="";
        }else{
            for($i=0;$i<count($chk['data']);$i++){
                if($chk['data'][$i]['user_id']=="-1"){
                    $username[$i]="ゲスト";
                }else{
                    $user=$this->models->getUser($chk['data'][$i]['user_id']);
                    $username[$i]=$user['name'];
                }
            }
        }
        return view('bbs.one',['bbs' => $bbs ,'comments' => $com ,'username'=>$username,'empty' => $empty ]);
    }

    public function comment(Request $request)
    {
        $input = $request->input();
        // ブラウザリロード等での二重送信防止
        $request->session()->regenerateToken();
        if(isset($input['bbs_id'])){
            $res=$this->models->insertBbsComments($input);
            $res=$this->models->updateBbsCount($input['bbs_id']);
            if ($res>0) {
                $data = array(
                    'success' => '投稿しました。',
                );
            }else{
                $data = array(
                    'ng' => '正常にデータの更新ができませんでした。',
                );
            }
        }
        return redirect('/bbs/one/'.$input['bbs_id'])->with($data);
    }

}
