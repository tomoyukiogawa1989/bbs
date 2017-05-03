<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use App\Models\User;
use App\Models\UserConfirmation;

class CommonController extends Controller
{
    protected $users;
    protected $userConf;

    public function __construct(User $users, UserConfirmation $userConf)
    {
        $this->users = $users;
        $this->userConf = $userConf;
    }

    public function deleteUserConfirmation($token)
    {
        $myConf=$this->userConf->where('token' ,$token)->get()->toArray();
        if(isset($myConf[0])){
            $this->users->destroy($myConf[0]['user_id']);
            $this->userConf->where('token' ,$token)->delete();
            $data="delete";
        }else{
            $data="";
        }
        return $data;
    }

    public function updateUserConfirmation($token)
    {
        $myConf=$this->userConf->where('token' ,$token)->get()->toArray();
        if(isset($myConf[0])){
            $this->users->where('id' , $myConf[0]['user_id'])->update(['status' => '1' ]);
            $this->userConf->where('token' ,$token)->delete();
            $data="update";
        }else{
            $data="";
        }
        return $data;
    }


}
