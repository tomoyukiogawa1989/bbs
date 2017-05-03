<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;
use App\Models\Bbs;
use App\Models\BbsComments;

class BbsModelController extends Controller
{

    protected $users;
    protected $bbs;
    protected $bbs_comments;

    public function __construct(User $users ,Bbs $bbs, BbsComments $bbs_comments)
    {
        $this->users = $users;
        $this->bbs = $bbs;
        $this->bbs_comments = $bbs_comments;
    }

    public function getBbs($take = 10)
    {
        $data=$this->bbs->orderBy('created_at', 'desc')->paginate($take);
        return $data;
    }

    public function getBbsOne($id)
    {
        $data=$this->bbs->find($id);
        return $data;
    }

    public function getComment($id)
    {
        $data=$this->bbs_comments->where('bbs_id' ,$id)->orderBy('created_at', 'asc')->paginate(10);
        return $data;
    }

    public function getMyBbs($take = 10)
    {
        $data=$this->bbs->where('user_id' ,\Auth::User()->id)->orderBy('created_at', 'desc')->paginate($take);
        return $data;
    }

    public function insertBbs($input)
    {
        try {
            \DB::transaction(function () use ($input) {
                //インサート
                $data=$this->bbs->create(['user_id' => \Auth::User()->id , 'title' => $input['title'], 'image' => $input['image'], 
                                          'content' => $input['content'], 'comment_count' => '0' ]);
                if (!$data->wasRecentlyCreated) {
                    throw new \Exception();
                }else{
                    $data->save();
                    $data=1;
                }
            });
        }
        catch(\Exception $e)
        {
            $data=0;
            return $data;
        }
    }

    public function updateBbsCount($id)
    {
        $data=$this->bbs->find($id)->increment('comment_count');
        if ($data!=FALSE) {
            $data = array(
                'success' => '更新しました。',
            );
        }else{
            $data = array(
                'ng' => '正常にデータの更新ができませんでした。',
            );
        }
        return $data;
    }

    public function getUser($id)
    {
        $data=$this->users->find($id);
        return $data;
    }

    public function updateBbs($input)
    {
        $data=$this->bbs->find($input['id'])->update([ 'title' => $input['title'], 
                                                       'image' => $input['image'], 'content' => $input['content'] ]);
        if ($data!=FALSE) {
            $data = array(
                'success' => '更新しました。',
            );
        }else{
            $data = array(
                'ng' => '正常にデータの更新ができませんでした。',
            );
        }
        return $data;
    }


    public function insertBbsComments($input)
    {
        try {
            \DB::transaction(function () use ($input) {
                //インサート
                $data=$this->bbs_comments->create(['user_id' => $input['user_id'] , 'bbs_id' => $input['bbs_id'], 'comment' => $input['comment'] ]);
                if (!$data->wasRecentlyCreated) {
                    throw new \Exception();
                }else{
                    $data->save();
                    $data = $data->id;
                }
            });
        }
        catch(\Exception $e)
        {
            $data=['ng' => '予期せぬエラーにより新たなデータを追加できない可能性があります。'];
            return $data;
        }
    }

    public function deleteBbs($input)
    {
        $data=$this->bbs->destroy($input['id']);
        $this->bbs_comments->where('bbs_id' ,$input['id'] )->delete();
        return $data;
    }

}
