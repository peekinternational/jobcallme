<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Facade\JobCallMe;
use DB;
use Socialite;
use App\Services\SocialFacebookAccountService;

class SocialAuthFacebookController extends Controller
{
   /**
   * Create a redirect method to facebook api.
   *
   * @return void
   */
    public function fbApi()
    {
        return Socialite::driver('facebook')->redirect();
    }
    /**
     * Return a callback method from facebook api.
     *
     * @return callback URL from facebook
     */
    public function callback($service)
    {
		
        $user = $service->createOrGetUser(Socialite::driver('facebook')->user());
        echo '<pre>';
        print_r($user);
        die();
        auth()->login($user);
        return redirect()->to('/home');
    }
}
