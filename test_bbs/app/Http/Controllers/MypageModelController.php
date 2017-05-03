<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;

class MypageModelController extends Controller
{
    protected $users;

    public function __construct(User $users)
    {
        $this->users = $users;
    }

    public function updateUserInfo($input)
    {
        $data = $this->users->find(\Auth::User()->id)->update(['name' => $input['name'], 'comment' => $input['comment'] ]);
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

}
