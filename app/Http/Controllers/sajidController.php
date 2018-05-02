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
			$data['update_comment'] = date();
			DB::table('jcm_comments')->where('comment_id',$id)->update($data);
		}else if($request->input('comment')){
			$data['comment'] = $request->input('comment'); 
			$data['commenter_id'] = $request->input('commenter_id');
			DB::table('jcm_comments')->insertGetid($data);
		}
		

		$data = DB::table('jcm_comments')->leftJoin('jcm_users','jcm_users.userId','=','jcm_comments.commenter_id')->where('post_id',$data['post_id'])->where('table_name',$data['table_name'])->get();
			$row ='';
			$url = url('profile-photos/');

			foreach ($data as $comment) {
				if($comment->commenter_id == Session::get('jcmUser')->userId){
                $temp ='<div class="col-md-2">
                        <div class="btns">
                            <button class="btn btn-warning edit-comment-btn">Edit</button>
                            <button class="btn btn-danger">Delete</button>
                        </div>
                        <div class="btns-update" style="display: none">
                            <button commentId="'.$comment->comment_id.'" class="btn btn-success update-comment-btn">Update</button>
                            <button class="btn btn-danger cancel">Cancel</button>
                        </div>
                    </div>';
                }else{
                	$temp = '';
                }

        $row .= '<div class="row">
                    <div class="col-md-12">
                        <div class="comment-area">
                            <div class="col-md-1">
                                <img src="'.$url.'/'.$comment->profilePhoto.'" class="fullwidth img-circle" alt="'.$comment->firstName.'">
                            </div>
                            <div class="col-md-9 append-edit">
                                <p style="border:1px solid #ccc;padding: 5px;min-height: 50px;">'.$comment->comment.'</p>

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
	DB::table('jcm_comments')->where('comment_id',$id)->delete();
	$data = DB::table('jcm_comments')->leftJoin('jcm_users','jcm_users.userId','=','jcm_comments.commenter_id')->where('post_id',$data['post_id'])->get();
			$row ='';
			$url = url('profile-photos/');

			foreach ($data as $comment) {
				if($comment->commenter_id == Session::get('jcmUser')->userId){
                $temp ='<div class="col-md-2">
                        <div class="btns">
                            <button class="btn btn-warning edit-comment-btn">Edit</button>
                            <button class="btn btn-danger">Delete</button>
                        </div>
                        <div class="btns-update" style="display: none">
                            <button commentId="'.$comment->comment_id.'" class="btn btn-success update-comment-btn">Update</button>
                            <button class="btn btn-danger cancel">Cancel</button>
                        </div>
                    </div>';
                }else{
                	$temp = '';
                }

        $row .= '<div class="row">
                    <div class="col-md-12">
                        <div class="comment-area">
                            <div class="col-md-1">
                                <img src="'.$url.'/'.$comment->profilePhoto.'" class="fullwidth img-circle" alt="'.$comment->firstName.'">
                            </div>
                            <div class="col-md-9 append-edit">
                                <p style="border:1px solid #ccc;padding: 5px;min-height: 50px;">'.$comment->comment.'</p>

                            </div>
                            '.$temp.'
                        </div>
                    </div>
                </div>';

            }
            echo $row;
}
}