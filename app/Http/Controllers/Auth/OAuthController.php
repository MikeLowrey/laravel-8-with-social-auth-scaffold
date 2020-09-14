<?php
namespace App\Http\Controllers\Auth;

use App\Exceptions\EmailTakenException;
use App\Http\Controllers\Controller;
use App\OAuthProvider;
use \App\Models\User;
use Auth;
use Hash;
use Str;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
#use Illuminate\Foundation\Auth\RegistersUsers;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Storage;

class OAuthController extends Controller
{
    use AuthenticatesUsers;
    #use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        config([
            'services.github.redirect' => route('oauth.callback', 'github'),
        ]);
    }

    /**
     * Redirect the user to the provider authentication page.
     *
     * @param  string $provider
     * @return \Illuminate\Http\RedirectResponse
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }


    /**
     * Obtain the user information from the provider.
     *
     * @param  string $driver
     * @return \Illuminate\Http\Response
     * To get more Userinformation use methods bellow:
     * $user->getId() 
     * $user->getNickname() 
     * $user->getName() 
     * $user->getEmail() 
     * $user->getAvatar()
     */
    public function handleProviderCallback($provider)
    {        
        $user = Socialite::driver($provider)->user();
        $_name = $user->getName() ? $user->getName() : $user->getNickname() ? $user->getNickname() : 'Gast';

        $user = User::firstOrCreate(
            [
                'email'=> $user->getEmail()
            ],
            [
                'name' => $_name,
                'profile_photo_path' => $user->getAvatar() ? $user->getAvatar() : $this->getInitialAvatar($_name),
                'password' => Hash::make(Str::random(24))
            ]
        );
        $this->guard()->login($user);
        return redirect($this->redirectTo);
    }


    private function getInitialAvatar($str) {                
        $name = str_replace("_","+",Str::snake(trim('MikeLowrey')));
        return sprintf("https://eu.ui-avatars.com/api/?background=0D8ABC&color=fff&name=%s",$str);        
    }

}
