<?php

namespace App\Http\Controllers;

use App\Mail\EmailPlanUpdate;
use App\Mail\EmailToAdmin;
use Mail;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use DB;
use Hash;
use Response;
use View;
use Session;
use Carbon;


class ProfileController extends Controller
{
    public function __construct() {       
        $this->middleware('auth');
    }

    public function index(){
        $message = '';
        $name = \Auth::user()->name;

        $userData = DB::table('users')
                         ->select(DB::raw('fs_users.*, (SELECT count(fs_reviews.user_id) FROM fs_reviews WHERE fs_users.id = fs_reviews.user_id) AS video_reviews'))
                        ->where('users.id','=', Auth::user()->id)
                        ->first();
        $responseData =  DB::table('quiz_response')                            
                        ->where('quiz_response.user_id','=', Auth::user()->id)                            
                        ->get()->toArray();
        $paymentData = DB::table('payments')
            ->where('payments.user_id', Auth::user()->id)->first();
           
        return View::make('profile', compact('userData', 'paymentData', 'responseData'));
    }

    public function changePassword(){

        $name = \Auth::user()->name;
        return View::make('auth.change.changePassword');
    }

    public function moduleResponse(){

        $data=Request::all();
        $response = json_encode($data);

        $quiz = str_replace('-', ' ', $data['page']);

        $lastInsertData = DB::table('quiz_response')->insertGetId(
                    ['user_id' =>  Auth::user()->id, 'module_id' => $data['mod_id'], 'quiz' => $quiz, 'response' => $response]                 
                  );

        $page = ($data['mod_id'] == '1')? 'EQ':'SMB';
        
        return redirect($page);        
    }    

    public function setPassword(){
        DB::enableQueryLog();
        $data=Request::all();
        $rules = array(
                'cur_password' => 'required',
                'new_password' => 'required',
                'password_confirmation' => 'required|same:new_password'
            );      
        
        $validator = Validator::make($data, $rules);
        
        if($validator->passes()){
            
            if (Auth::check())
            {
                $user = User::findOrFail(Auth::user()->id);
                
                if(Hash::check($data['cur_password'], $user->getAuthPassword())) {                  
                    $user->password = Hash::make($data['new_password']);
                    $user->save();
                    
                    Session::flash('success', 'Password Changed Successfully!');

                    return View::make('auth.thankyou');                 
                }else{
                    
                    $errors[0] = "Your Current Password does not matched with database!";
                    return redirect('/change/password')->withErrors($errors)->withInput();
                }
            }
            else{
                    $errors[0] = "User not logged in!";
                    return redirect('/change/password')->withErrors($errors)->withInput();              
            }

        }else{

            $errors = $validator->errors(); 
            return redirect('/change/password')->withErrors($errors)->withInput();
        }
    }

    public function cancelPlan(){

        $name = \Auth::user()->name;
        \Stripe\Stripe::setApiKey("sk_test_sQma5CJ4V2dVoe4hrOTwGbss");

        $tamount = 150;

        $paymentData = DB::table('payments')
            ->where('payments.user_id', Auth::user()->id)->first();

        $subscription = \Stripe\Subscription::retrieve("$paymentData->subscription_id");        
        $cancelData = $subscription->cancel();
        $cinterval = $subscription->plan->interval_count;
        $amount    = $subscription->plan->amount/100;
        $pendingInt = 3 - $cinterval;
        $pendingAmount = $amount * $pendingInt;

        DB::table('payments')                    
            ->where('payments.user_id', Auth::user()->id)                
            ->update(['pending_amount' => $pendingAmount, 'status' => $subscription->status]);

        DB::table('users')                    
            ->where('users.id', Auth::user()->id)                
            ->update(['payment_status' => '0']);
        
        return View::make('profile');
    }

    public function studentList(){

        $name = \Auth::user()->name;
        $user = Auth::user();
        $role = Auth::user()->role;
        $data  = Request::all();

        if(array_key_exists('sid', $data) && !empty($data['sid'])){
            $sid = $data['sid'];
            $studentData = DB::table('users')
                         ->select(DB::raw('fs_users.*, (SELECT count(fs_reviews.user_id) FROM fs_reviews WHERE fs_users.id = fs_reviews.user_id) AS video_reviews'))
                        ->where('users.id','=', $sid)
                        ->first();
            $responseData =  DB::table('quiz_response')                            
                            ->where('quiz_response.user_id','=', $sid)                            
                            ->get()->toArray();       

            return View::make('students', compact('studentData', 'sid', 'responseData'));
        }else{      
            $studentList = DB::table('users')
                         ->select(DB::raw('fs_users.*, (SELECT count(fs_reviews.user_id) FROM fs_reviews WHERE fs_users.id = fs_reviews.user_id) AS video_reviews'))
                        ->where('users.role','=', '0')
                        ->get();
            $tstudent = DB::table('users')                      
                        ->where('users.role','=', '0')
                        ->count();
                        
            return View::make('students', compact('studentList', 'tstudent'));
        }
    }

    public function videoAnalytic(){

        $name = \Auth::user()->name;
        $user = Auth::user();
        $role = Auth::user()->role;
        $data  = Request::all();
           
        $videoAnalyticList = DB::table('users')
                    ->select(DB::raw('users.*, (SELECT count(fs_reviews.quiz_id) FROM fs_reviews WHERE fs_users.id = fs_reviews.user_id) as videocount'))                                    
                    ->get();

        return View::make('videoanalytic', compact('videoAnalyticList', 'tstudent'));        
    }


    public function setPlan(){

        DB::enableQueryLog();
        $data=Request::all();
        $rules = array(
                'email' => 'required|email',
                'cur_plan' => 'required',
                'new_plan' => 'required|different:cur_plan'
            );      
        
        $validator = Validator::make($data, $rules);

        if($validator->passes()){
            
            if (Auth::check())
            {
                $user = User::findOrFail(Auth::user()->id);
                
                if($data['cur_plan'] == $user->plan) {                  
                    $user->plan = $data['new_plan'];
                    $user->save();
                    $planName = $user->plan == 1? 'Basic':($user->plan == 2? 'Extended':'');

                    $email = new EmailPlanUpdate(new User(['email_token' => $user->email_token, 'name' => $user->name, 'planName' => $planName]));
                    Mail::to($user->email)->send($email);

                    $email = new EmailToAdmin(new User(['email_token' => $user->email_token, 'name' => $user->name, 'planName' => $planName]));
                    Mail::to('andsraj@gmail.com')->send($email);
                                        
                    Session::flash('success', 'Plan Updated Successfully! Please check your mail for admin approval...');

                    return View::make('auth.thankyou');                 
                }else{
                    
                    $errors[0] = "Your Current Plan does not matched with database!";
                    return redirect('/change/plan')->withErrors($errors)->withInput();
                }
            }
            else{
                    $errors[0] = "Please log in!";
                    return redirect('/change/plan')->withErrors($errors)->withInput();              
            }

        }else{

                $errors = $validator->errors(); 
                return redirect('/change/plan')->withErrors($errors)->withInput();
        }
    }   

    public function changeCard(){

        $name = \Auth::user()->name;
        return View::make('auth.change.changeCard');
    }

    public function setCCard(){

        DB::enableQueryLog();
        $data=Request::all();
        $rules = array(
                'email' => 'required|email',                
                'newCreditCard' => 'required|numeric|min:10'
            );      
        
        $validator = Validator::make($data, $rules);
        
        if($validator->passes()){
            
            if (Auth::check())
            {
                $user = User::findOrFail(Auth::user()->id);
                                                    
                $user->cc_number = $data['newCreditCard'];
                $user->cc_updated_at = Carbon\Carbon::now();

                $user->save();
                
                Session::flash('success', 'Card number updated successfully!');

                return View::make('auth.thankyou');                                 
            }
            else{
                    $errors[0] = "Please log in!";
                    return redirect('/change/card')->withErrors($errors)->withInput();              
            }

        }else{

                $errors = $validator->errors(); 
                return redirect('/change/card')->withErrors($errors)->withInput();
        }
    }
    
    public function picturesList(){

        $user = \Auth::user();
        $pictureList = DB::table('images')
                    ->where('images.user_id','=', $user->id)
                    ->get();        
        return View::make('myPictures', compact('pictureList'));
    }

    public function addPicture(){
        $data = Request::all();        
        $user = \Auth::user();
        $ffmpegObj = new FFmpegController;
        $path = $ffmpegObj->path;

        //echo '<pre>'; print_r($data); die;
            
        $recordedlist = '';            
        $file = Input::file('uploadPic');
        $method = "uploadPic";
        $neuraloop   =   new CommonController;
        $filesize = $file->getClientSize();

        if($filesize > 0 && $filesize < 15729000){
            if($file){
                $destinationPath = $path. '/images/';
                $allowedexts = array('jpg', 'png');

                $fileName = $neuraloop->uploadFile($file, $method, $user->id, $destinationPath, $allowedexts); 
                $pictureList = DB::table('images')
                            ->where('images.user_id','=', $user->id)
                            ->get();                

                return View::make('myPictures', compact('pictureList'));
            } 
        }else{
            echo "File size can not less than 0 and greater than 6Mb...";
        }           
    }

    ///////////////////////// DELETE IMAGE ///////////////////////////////
    public function deletePicture(){

        DB::enableQueryLog();
        $data  = Request::all();
        $user = \Auth::user();
        $ffmpegObj = new FFmpegController;
        $path = $ffmpegObj->path;
                        
        if(count($data) > 0){
            if(array_key_exists('imgid', $data) && !empty($data['imgid'])){

                $pictureInfo = (array) DB::table('images')
                    ->where('images.id','=', $data['imgid'])
                    ->where('images.user_id','=', $user->id)
                    ->first();
                
                if(!empty($pictureInfo)){

                    $imgPath = $path.'/images/'.$pictureInfo['image_name'];
                    $imgThumbPath = $path.'/images/thumbs/thumb_'.$pictureInfo['image_name'];
                                         
                    $status = DB::table('images')
                        ->where('id', '=', $data['imgid'])
                        ->where('images.user_id','=', $user->id)
                        ->delete();
                    shell_exec("rm -Rf $imgPath");
                    shell_exec("rm -Rf $imgThumbPath");
                }
                $pictureList = DB::table('images')
                            ->where('images.user_id','=', $user->id)
                            ->get();                

                return View::make('myPictures', compact('pictureList'));  
            }
        }
    }

    public function faceList(){

        $user = \Auth::user();
        $faceList = DB::table('faces')
                    ->where('faces.user_id','=', $user->id)
                    ->get();        
        return View::make('myFaces', compact('faceList'));
    }

    public function addFace(){
        $data = Request::all();        
        $user = \Auth::user();
        $ffmpegObj = new FFmpegController;
        $path = $ffmpegObj->path;

        // echo '<pre>'; print_r($data); die;
            
        $recordedlist = '';            
        $file = Input::file('uploadPic');
        $method = "uploadFace";
        $neuraloop   =   new CommonController;
        $filesize = $file->getClientSize();

        if($filesize > 0 && $filesize < 15729000){
            if($file){
                $destinationPath = $path. '/faces/';
                $allowedexts = array('png', 'jpg', 'jpeg');
                $fileName = $neuraloop->uploadFile($file, $method, $user->id, $destinationPath, $allowedexts);
                
                return redirect('myfaces');
            } 
        }else{
            echo "File size can not less than 0 and greater than 6Mb...";
        }           
    }

    ///////////////////////// DELETE FACE ///////////////////////////////
    public function deleteFace(){

        DB::enableQueryLog();
        $data  = Request::all();
        $user = \Auth::user();
        $ffmpegObj = new FFmpegController;
        $path = $ffmpegObj->path;
                        
        if(count($data) > 0){
            if(array_key_exists('imgid', $data) && !empty($data['imgid'])){

                $pictureInfo = (array) DB::table('faces')
                    ->where('faces.id','=', $data['imgid'])
                    ->where('faces.user_id','=', $user->id)
                    ->first();
                
                if(!empty($pictureInfo)){

                    $imgPath = $path.'/faces/'.$pictureInfo['image_name'];
                                         
                    $status = DB::table('faces')
                        ->where('id', '=', $data['imgid'])
                        ->where('faces.user_id','=', $user->id)
                        ->delete();
                    shell_exec("rm -Rf $imgPath");                    
                }                 
            }
            return redirect('myfaces');
        }
    }

    public function myMusic(){

        $user = \Auth::user();
        $audioList = DB::table('audios')
                    // ->where('audios.user_id','=', $user->id)                    
                    ->get();    
        $recordedList = DB::table('recorded_voice')         
                      ->where('recorded_voice.user_id','=', $user->id)           
                      ->get();

        return View::make('myMusic', compact('audioList', 'recordedList'));
    }

    ///////////////////////// DELETE Music ///////////////////////////////
    public function deleteMusic(){

        DB::enableQueryLog();
        $data  = Request::all();
        $user = \Auth::user();
        $ffmpegObj = new FFmpegController;
        $path = $ffmpegObj->path;
                        
        if(count($data) > 0){
            if(array_key_exists('aid', $data) && !empty($data['aid'])){

                $audioInfo = (array) DB::table('audios')
                    ->where('audios.id','=', $data['aid'])
                    ->where('audios.user_id','=', $user->id)
                    ->first();
                
                if(!empty($audioInfo)){

                    $audioPath = $path.'/audios/'.$audioInfo['audioName'];                    
                                         
                    $status = DB::table('audios')
                        ->where('id', '=', $data['aid'])
                        ->where('audios.user_id','=', $user->id)
                        ->delete();
                    shell_exec("rm -Rf $audioPath");                    
                }
                $audioList = DB::table('audios')
                            ->where('audios.user_id','=', $user->id)
                            ->get();                

                return redirect('mymusic');

            }elseif(array_key_exists('rid', $data) && !empty($data['rid'])){ 
                $recordedInfo = (array) DB::table('recorded_voice')
                    ->where('recorded_voice.id','=', $data['rid'])
                    ->where('recorded_voice.user_id','=', $user->id)
                    ->first();
                
                if(!empty($recordedInfo)){

                    $rvoicePath = $path.'/audios/'.$recordedInfo['audioName'];                    
                                         
                    $status = DB::table('recorded_voice')
                        ->where('id', '=', $data['rid'])
                        ->where('recorded_voice.user_id','=', $user->id)
                        ->delete();
                    shell_exec("rm -Rf $rvoicePath");                    
                }
                $recordedList = DB::table('recorded_voice')
                            ->where('recorded_voice.user_id','=', $user->id)
                            ->get();  
                return redirect('mymusic');
            }
        }
    }
}
