<?php 
namespace App\Http\Middleware;
 
use Closure;
use App\Models\User;
 
class VerifyConfirmed {
    public function handle($request, Closure $next)
    {
        $user = User::where('email', '=', $request->input('email'))->first();
        if ($user) {
            if( $user->status == 0) {
                return redirect()->back()->withInput($request->only('email'))->with(['success' => 'ユーザー登録確認メールから、ユーザーの有効化を行ってください。']);
            }
        }
        return $next($request);
    }
}