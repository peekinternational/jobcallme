<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Facade\JobCallMe;
use DB;
use Socialite;  
use Laravel\Socialite\Contracts\User as ProviderUser;
use App\User;
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
    public function callback($user)
    {
        //die('hmmm');
		//ProviderUser
        echo '<pre>';
        print_r($user);
        $user=Socialite::driver('facebook')->user();
       // $user = $service->createOrGetUser(Socialite::driver('facebook')->user());
        echo '<pre>';
        print_r($user);
        die();
        $email=$user->getEmail();
        $userDetails=User::where('email',$email)->first();
        if($userDetails){
            if($userDetails->user_status=='N'){
                $userDetails->user_status='Y';
                $userDetails->fbId=$user->getId();
                $userDetails->save();
            }
            elseif(!$userDetails->fbId){
                $userDetails->fbId=$user->getId();
                $userDetails->save(); 
            }
        }
        else{
            $userDetails=$this->createUser($user);
        }

        auth()->login($userDetails);
        return redirect()->to('/home');
    }

    public function createUser($providerUser){
        $objModel = new User();
        $firstName= $providerUser->getFirstName();
        $lastName= $providerUser->getLastName();
        $email=$providerUser->getEmail();

        $objModel->companyId = 0;
        $objModel->type = 'User';
        $objModel->secretId = JobCallMe::randomString();
        $objModel->firstName =$firstName;
        $objModel->lastName = $lastName;
        $objModel->email = $email;
        $objModel->username = strtolower($providerUser->getName().$providerUser->getName().rand(00,99));
        $objModel->password = md5(rand(1,10000));
        $objModel->phoneNumber = '';
        $objModel->country = '';
        $objModel->state = '';
        $objModel->city = '';
        $objModel->profilePhoto = $providerUser->getAvatar();
        $objModel->about = ''; 
        $objModel->user_status='Y';
        $objModel->subscribe='Y';
        $userId=$objModel->save();

        extract($providerUser->all());
        $cInput = array('companyName' => $firstName.' '.$lastName, 'companyEmail' => $email, 'companyPhoneNumber' => '', 'companyCountry' =>'', 'companyState' => '', 'companyCity' => '', 'category' => '0', 'companyCreatedTime' => date('Y-m-d H:i:s'), 'companyModifiedTime' => date('Y-m-d H:i:s'));
        $companyId = DB::table('jcm_companies')->insertGetId($cInput);
        DB::table('jcm_users')->where('userId','=',$userId)->update(array('companyId' => $companyId));

        return $objModel;
    }
}
