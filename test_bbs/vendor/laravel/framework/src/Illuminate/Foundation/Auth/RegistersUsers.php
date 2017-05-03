<?php

namespace Illuminate\Foundation\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;

use Carbon\Carbon;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Contracts\Config\Repository as Config;

trait RegistersUsers
{
    use RedirectsUsers;

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request, Mailer $mailer, Config $config)
    {
        $this->validator($request->all())->validate();
        event(new Registered($user = $this->create($mailer,$request->all(),$config->get('app.key'))));
        #$this->create($mailer, $request->all(), $config->get('app.key'));

        return redirect($this->redirectPath())->with(['success' => 'ユーザー登録確認メールを送信しました']);

        //event(new Register($request));
        //postRegister(Request $request, Mailer $mailer, Config $config)
        //event(new Registered($user = $this->create($request->all())));

        //$this->guard()->login($user);
        //同じ画面にリダイレクト
        return redirect($this->redirectPath())->with(['success' => '新規ユーザーを登録しました。']);

        return $this->registered($request, $user)
            ?: redirect($this->redirectPath());
    }


    public function getConfirm($token) {
        $user = User::where('confirmation_token', '=', $token)->first();
        if (! $user) {
            \Session::flash('flash_message', '無効なトークンです。');
            return redirect('login');
        }

        $user->confirm();
        $user->save();

        \Session::flash('flash_message', 'ユーザー登録が完了しました。ログインしてください。');
        return redirect('login');
    }

    /**
     * Get the guard to be used during registration.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard();
    }

    /**
     * The user has been registered.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function registered(Request $request, $user)
    {
        //
    }
}
