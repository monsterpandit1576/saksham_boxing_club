<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\LoggedHistory;
use App\Models\TraineeDetail;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\TrainerDetail;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $user=\App\Models\User::find(1);
        // \App::setLocale($user->lang);

        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        $google_recaptcha=getSettingsValByName('google_recaptcha');
        if($google_recaptcha == 'on')
        {
            $validation['g-recaptcha-response'] = 'required|captcha';
        }else{
            $validation = [];
        }
        $this->validate($request, $validation);

        $request->authenticate();
        $request->session()->regenerate();

        if(Auth::user()->type == 'trainer'){
            $id=Auth::user()->id;
            $status = TrainerDetail::where('user_id',$id)->first();
            if($status->status == 0)
            {
                auth()->logout();
                return redirect()->back()->with('error', __('Your account is inactive.'));
            }
        }

        if(Auth::user()->type == 'trainee'){
            $id=Auth::user()->id;
            $status = TraineeDetail::where('user_id',$id)->first();
            if($status->status == 0)
            {
                auth()->logout();
                return redirect()->back()->with('error', __('Your account is inactive.'));
            }
        }

        $loginUser = Auth::user();
        if($loginUser->is_active == 0)
        {
            auth()->logout();
        }
        userLoggedHistory();


        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
