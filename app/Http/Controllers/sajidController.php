<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Facade\JobCallMe;
use DB;
use Sajid;
use Mail;
use App;
use Session;
class sajidController extends Controller{
	public function savecomment(Request $request){
		$data['post_id'] = $request->input('post_id');
		$data['table_name'] = $request->input('table_name');
		if($request->input('comment_id')){
			$id = $request->input('comment_id');
			$data['comment'] = $request->input('comment');
			$data['update_comment'] = date("Y-m-d h:i:s");
			DB::table('jcm_comments')->where('comment_id',$id)->update($data);
		}else if($request->input('comment')){
			$data['comment'] = $request->input('comment'); 
			$data['commenter_id'] = $request->input('commenter_id');
			DB::table('jcm_comments')->insertGetid($data);
		}
		

		$data = DB::table('jcm_comments')->leftJoin('jcm_users','jcm_users.userId','=','jcm_comments.commenter_id')->where('post_id',$data['post_id'])->where('table_name',$data['table_name'])->orderBy('jcm_comments.comment_id','desc')->get();
			$row ='';
            $username='';
			$url = url('profile-photos/');
            $link = url('/account/employer/application/applicant');

			foreach ($data as $comment) {
				if($comment->commenter_id == Session::get('jcmUser')->userId){
                $temp ='<div class="col-md-2">
                        <div class="btns">
                                <i class="fa fa-edit edit-comment-btn"></i>
                                <i delcommentId="'.$comment->comment_id.'" class="fa fa-trash del-comment-btn" aria-hidden="true"></i>
              
                        </div>
                        <div class="btns-update" style="display: none">
                            <button commentId="'.$comment->comment_id.'" class="btn btn-success update-comment-btn">Update</button>
                            <button class="btn btn-danger cancel">Cancel</button>
                        </div>
                    </div>';
                }else{
                	$temp = '';
                }
                if($comment->nickName == null){
                    $username = $comment->firstName;
                }
                else{
                  $username = $comment->nickName;
                }

        $row .= '<div class="row">
                    <div class="col-md-12">
                        <div class="comment-area">
                            <div class="col-md-1">
                                <img src="'.$url.'/'.$comment->chatImage.'" class="" alt="'.$comment->firstName.'" style="width:80%;">
                                 
                            </div>
                            <div class="col-md-9 append-edit">
                            <a href="'.$link.'/'.$comment->userId.'">'.$username.'</a> <span style="color: #999999;font-size: 10px;">'.$comment->comment_date.'</span>
                                <p style="padding: 5px;min-height: 50px;">'.$comment->comment.'</p>

                            </div>
                            '.$temp.'
                        </div>
                    </div>
                </div>';

            }
            echo $row;
	}

public function deletecomment(Request $request){
  

	$id = $request->input('comment_id');
	$post_id = $request->input('post_id');
	$table_name = $request->input('table_name');
	DB::table('jcm_comments')->where('comment_id',$id)->delete();

	$post_id = $request->input('post_id');
	$data = DB::table('jcm_comments')->leftJoin('jcm_users','jcm_users.userId','=','jcm_comments.commenter_id')->where('post_id',$post_id)->where('table_name',$table_name)->orderBy('jcm_comments.comment_id','desc')->get();
			$row ='';
            $username='';
			$url = url('profile-photos/');
            $link = url('/account/employer/application/applicant');

			foreach ($data as $comment) {
				if($comment->commenter_id == Session::get('jcmUser')->userId){
                $temp ='<div class="col-md-2">
                        <div class="btns">
                                <i class="fa fa-edit edit-comment-btn"></i>
                                <i delcommentId="'.$comment->comment_id.'" class="fa fa-trash del-comment-btn" aria-hidden="true"></i>
              
                        </div>
                        <div class="btns-update" style="display: none">
                            <button commentId="'.$comment->comment_id.'" class="btn btn-success update-comment-btn">Update</button>
                            <button class="btn btn-danger cancel">Cancel</button>
                        </div>
                    </div>';
                }else{
                	$temp = '';
                }
                if($comment->nickName == null){
                    $username = $comment->firstName;
                }
                else{
                  $username = $comment->nickName;
                }

        $row .= '<div class="row">
                    <div class="col-md-12">
                        <div class="comment-area">
                            <div class="col-md-1">
                                <img src="'.$url.'/'.$comment->chatImage.'" class="" alt="'.$comment->firstName.'" style="width:80%;">
                                 
                            </div>
                            <div class="col-md-9 append-edit">
                            <a href="'.$link.'/'.$comment->userId.'">'.$username.'</a> <span style="color: #999999;font-size: 10px;">'.$comment->comment_date.'</span>
                                <p style="padding: 5px;min-height: 50px;">'.$comment->comment.'</p>

                            </div>
                            '.$temp.'
                        </div>
                    </div>
                </div>';

            }
            echo $row;
}
public function jobreviews($jobid){
    $userId = Session::get('jcmUser')->userId;
    
    if($jobid == 'all'){
        $data = DB::table('comments')->leftJoin('jcm_users','comments.employeer_id','=','jcm_users.userId')->where('employeer_id',$userId)->get();
    }else{
        $data = DB::table('comments')->leftJoin('jcm_users','comments.employeer_id','=','jcm_users.userId')->where('employeer_id',$userId)->where('job_id',$jobid)->get();
    }

    return view('frontend.employer.jobreviews',compact('data'));
}
public function delete(Request $request){
    $table = $request->input('table');
    $field = $request->input('field');
    $id = $request->input('id');
    if(DB::table($table)->where($field,$id)->delete()){
        echo 1;
    }else{
        echo 2;
    }
}
public function update(Request $request){
    $table = $request->input('table');
    $field = $request->input('field');
    $id = $request->input('id');
    $data = $request->input('data');
    
    if(DB::table($table)->where($field,$id)->update($data)){
        echo 1;
    }else{
        echo 2;
    }
}
}