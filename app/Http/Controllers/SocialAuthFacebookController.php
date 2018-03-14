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
    public function callback(Request $request)
    { 
        $user=Socialite::driver('facebook')->user();
     
        if($user->user['verified']!=1):
            die("Facebook account is not verified");
        endif;
        $email=$user->user['email'];
        $fbId=$user->id;
        $userDetails=User::where('email',$email)->first();
        if($userDetails){
            if($userDetails->user_status=='N'){
                $userDetails->user_status='Y';
                $userDetails->fbId=$fbId;
                $userDetails->save();
            }
            elseif(!$userDetails->fbId){
                $userDetails->fbId=$fbId;
                $userDetails->save(); 
            }
        }
        else{
            $userDetails=$this->createUser($user);
        }
 

        if(JobCallMe::isResumeBuild($userDetails->userId) == false):
            $fNotice = 'To apply on jobs please build your resume. <a href="'.url('account/jobseeker/resume').'">Click Here</a> To create your resume';
            $request->session()->put('fNotice',$fNotice);
        endif;
        $request->session()->put('jcmUser', $userDetails);
        setcookie('cc_data', $userDetails->userId, time() + (86400 * 30), "/");
        if($userDetails->subscribe == 'N'): 
            Session()->put('bell_color','#2e6da4'); 
        else:
            session()->put('bell_color','#45c536'); 
        endif;
        
        return redirect('account/jobseeker');
    }

    public function createUser($providerUser){
        $objModel = new User(); 
        $name= explode(' ',$providerUser->user['name']);
        $firstName=$name[0];
        $lastName= (isset($name[1]))?$name[1]:'';
        $email=$providerUser->email;

        $objModel->fbId = $providerUser->id;
        $objModel->companyId = 0;
        $objModel->type = 'User';
        $objModel->secretId = JobCallMe::randomString();
        $objModel->firstName =$firstName;
        $objModel->lastName = $lastName;
        $objModel->email = $email;
        $objModel->username = strtolower($firstName.rand(00,99));
        $objModel->password = md5(rand(1,10000));
        $objModel->phoneNumber = '';
        $objModel->country = '';
        $objModel->state = '';
        $objModel->city = '';
        $objModel->profilePhoto = $providerUser->avatar_original;
        $objModel->about = ''; 
        $objModel->user_status='Y';
        $objModel->subscribe='N';
        $objModel->save();
        $userId=$objModel->userId;
        $cInput = array('companyName' => $firstName.' '.$lastName, 'companyEmail' => $email, 'companyPhoneNumber' => '', 'companyCountry' =>'', 'companyState' => '', 'companyCity' => '', 'category' => '0', 'companyCreatedTime' => date('Y-m-d H:i:s'), 'companyModifiedTime' => date('Y-m-d H:i:s'));
        $companyId = DB::table('jcm_companies')->insertGetId($cInput);
        DB::table('jcm_users')->where('userId','=',$userId)->update(array('companyId' => $companyId));

        return $objModel;
    }
}
