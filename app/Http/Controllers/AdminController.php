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


class AdminController extends Controller
{
    public $path, $app_url;

	public function __construct() {       
    	$this->middleware('auth');
        // $ffmpegObj = new FFmpegController;
        // $this->path = $ffmpegObj->path;
        $this->app_url = env('APP_URL');
    }

    public function index(){

    	$name = \Auth::user()->name;
        $user = Auth::user();
        $role = Auth::user()->role;

        $studentList    = DB::table('users')
                    ->where('users.role','=', '0')
                    ->get(); 
		$teacherList      = DB::table('users')
					->where('users.role','=', '1')
					->get(); 
		$moduleList   = DB::table('modules')
					->get();

        $videoAnalytics =  DB::table('reviews')                                                         
                    ->count();

        return View::make('dashboard', compact('studentList','teacherList','moduleList', 'videoAnalytics'));    	
    }

    public function moduleList(){

        $name = \Auth::user()->name;
        $user = Auth::user();
        $role = Auth::user()->role;

        $modulesList = DB::table('modules')                   
                    ->get();
					
        $tmodules = DB::table('modules')                    
                    ->count();

        return View::make('adminModules', compact('modulesList', 'tmodules'));      
    }

    public function createModule(){
			
		$data = Request::all();   
        $name = \Auth::user()->name;
        $user = Auth::user();
        $role = Auth::user()->role;
		$moduleName = $data['module_name'];
		$lastInsertData = DB::table('modules')->insertGetId(
                    ['module_name' => $moduleName]
                  );
				  
		$modulesList = DB::table('modules')                   
                    ->get();

        return View::make('adminModules', compact('modulesList'));      
    }
	
	public function editModule(){
			
		$data = Request::all();   
        $name = \Auth::user()->name;
        $user = Auth::user();
        $role = Auth::user()->role;
		$id   =  $data['mid'];
		$moduleName = $data['edit_module'];
		
		$moduleUpdated=DB::table('modules')->where('id',$id)->update(array('module_name' => $data['edit_module']));
          return redirect('admin/modules');          
    }
   

	public function deleteModule(){
		DB::enableQueryLog();
        $data  = Request::all();
		$user = \Auth::user();     
	    
		$id = $data['mid'];
        $status = DB::table('modules')
                        ->where('modules.id', '=', $id)
                        ->delete();      
        return redirect('admin/modules');
    }
	
	
	public function subModuleList(){
		$data  = Request::all();
        $name = \Auth::user()->name;
        $user = Auth::user();
        $role = Auth::user()->role;
		$moduleID = $data['mid'];
        $subModulesList = DB::table('submodules')
						->where('submodules.module_id', '=', $moduleID)		
						->get();
								
        return View::make('adminSubModule', compact('subModulesList'));      
    }
	
	  public function createSubModule() {			
		$data = Request::all();   
        $name = \Auth::user()->name;
        $user = Auth::user();
        $role = Auth::user()->role;
		
		$moduleID   = $data['mid'];
		$qestion	  = $data['question_name'];
		$content  	  = $data['sub_content'];
		$linksName  = $data['link_name'];
		$linksUrl 	  = $data['link_url'];
		$video  		  = $data['video'];
		
		
		$links = array_filter(array_combine($linksName, $linksUrl));		
	    $links = empty($links) ? "" : json_encode($links);
	
		$lastInsertData = DB::table('submodules')->insertGetId(
                    ['module_id' => $moduleID, 'question' => $qestion, 'content' => $content, 'video' => $video, 'links' => $links]                 
                  );
			  
		$subModulesList = DB::table('submodules')                   
                    ->get();

         return redirect('admin/modules');
    }
	
	public function editSubModule() {			
		$data = Request::all();   
        $name = \Auth::user()->name;
        $user = Auth::user();
        $role = Auth::user()->role;
		
        $subID   	  = $data['sid'];
		$qestion	  = $data['question_name'];
		$content  	  = $data['sub_content'];
		$video  	      = $data['video'];
		$linksName = $data['link_name'];
		$linksUrl 	  = $data['link_url'];
			
		$links = array_filter(array_combine($linksName, $linksUrl));		
	    $links = empty($links) ? "" : json_encode($links);
	
		$subModuleUpdated=DB::table('submodules')->where('id',$subID)->update(array('question' => $qestion, 'content' => $content, 'video' => $video, 'links' => $links));
            return redirect('admin/modules');
       
    }
	
	 public function deleteSubModule(){
		DB::enableQueryLog();
        $data  = Request::all();
		$user = \Auth::user();     
	    
		   $id = $data['sid'];
            $status = DB::table('submodules')
                        ->where('submodules.id', '=', $id)
                        ->delete();      
             return redirect('admin/modules');
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

            return View::make('adminStudents', compact('studentData', 'sid', 'responseData'));
        }else{		
            $studentList = DB::table('users')
                         ->select(DB::raw('fs_users.*, (SELECT count(fs_reviews.user_id) FROM fs_reviews WHERE fs_users.id = fs_reviews.user_id) AS video_reviews'))
                        ->where('users.role','=', '0')
                        ->get();
          
            $tstudent = DB::table('users')
                        ->where('users.role','=', '0')
                        ->count();

            return View::make('adminStudents', compact('studentList', 'tstudent'));
        }
    }

    public function teacherList(){

        $name = \Auth::user()->name;
        $user = Auth::user();
        $role = Auth::user()->role;
        $data  = Request::all();

        if(array_key_exists('tid', $data) && !empty($data['tid'])){
            $tid = $data['tid'];
            $teacherData = DB::table('users')
                        ->where('users.id','=', $tid)
                        ->first();
            return View::make('adminTeachers', compact('teacherData', 'tid'));
        }else{
            $teacherList = DB::table('users')
                        ->where('users.role','=', '1')                    
                        ->get();         
            $tteachers = DB::table('users') 
                        ->where('users.role','=', '1')                                       
                        ->count();  
            
            return View::make('adminTeachers', compact('teacherList', 'tteachers'));
        }
    }

    public function editVideoviewed(){
            
        $data = Request::all();   
        $name = \Auth::user()->name;
        $user = Auth::user();
        $role = Auth::user()->role;
        $mid   =  $data['mid'];       

        if($user->role == '0'){

            $vcount = DB::table('reviews')
                            ->where('reviews.user_id','=', $user->id)
                            ->where('reviews.quiz_id','=', $mid)                        
                            ->count();                  

            if($vcount == 0 ){
                $lastInsertData = DB::table('reviews')->insertGetId(
                        ['user_id' => $user->id, 'quiz_id' => $mid]                 
                      );
            }
        }
    }

    public function userList(){
        DB::enableQueryLog();
        $name = \Auth::user()->name;
        $user = Auth::user();
        $role = Auth::user()->role;        
        $tusers = DB::table('users')
                    ->where('users.role','<>', $role)
                    ->count(); 

        $userList = DB::table('users')
                    ->select(DB::raw('users.*, (SELECT count(videos.user_id) FROM videos WHERE users.id = videos.user_id) as videocount'))                    
                    ->take(10)                    
                    ->get();
        
        // print_r(DB::getQueryLog());
        
        return View::make('adminUsers', compact('userList', 'tusers'));      
    }

    public function studentInfo(){
        DB::enableQueryLog();
        $name = \Auth::user()->name;
        $user = Auth::user();
        $role = Auth::user()->role;
        $data  = Request::all();

        if(array_key_exists('sid', $data) && !empty($data['sid'])){

            $studentData = DB::table('users')
                        ->where('users.id','=', $data['sid'])
                        ->first();

            // $userVideos = DB::table('users')
            //                 ->join('videos', 'users.id','=', 'videos.user_id')
            //                 ->where('videos.user_id','=', $data['uid'])
            //                 ->take(8)                
            //                 ->get();
      
            // $tvideos = DB::table('users')
            //                 ->join('videos', 'users.id','=', 'videos.user_id')
            //                 ->where('videos.user_id','=', $data['uid'])                
            //                 ->count();

            // print_r(DB::getQueryLog());
            
            return View::make('adminStudents', compact('studentData', 'sid'));   
        }else{
            echo "Please check the user id.";
        }   
    }

    public function userListBySize(){
        $data  = Request::all();
        $userData = "";
        
        DB::enableQueryLog();
        $name = \Auth::user()->name;
        $user = Auth::user();
        $role = Auth::user()->role;        
        $startLimit = $data['limit'];
        $endlimit = $data['limit']+5;

        $userList = DB::table('users')
                    ->select(DB::raw('users.*, (SELECT count(videos.user_id) FROM videos WHERE users.id = videos.user_id) as videocount'))
                    ->where('users.role','<>', 2)
                    ->orderBy('id', 'ASC')
                    ->offset($startLimit)
                    ->take(2) 
                    ->get();
        //print_r(DB::getQueryLog());
        
        foreach($userList as $user){
            $plan = $user->plan == '0' ? 'Free' : ($user->plan == '1' ? 'Basic' : 'Extended');

            $userData .= "<tr class=\"user_$user->id\"><td>".$user->name."</td><td>".$user->email."</td><td>".$plan."</td><td>".$user->videocount."</td><td>"."<a href=\"user?uid=$user->id\"><span><i class=\"fa fa-eye\" aria-hidden=\"true\"></i></span></a><a href=\"javascript:void(0);\" data-id=\"$user->id\" class=\"deluser\"><span class=\"edit delete\"><i class=\"fa fa-trash\" aria-hidden=\"true\"></i></span></a></td>
            </tr>";
        }
        echo $userData;
        //print_r($userList);        
    }

    public function videoListBySize(){
        $data  = Request::all();

        $videoData = "";        
        DB::enableQueryLog();
        $name = \Auth::user()->name;
        $user = Auth::user();
        $role = Auth::user()->role;        
        $startLimit = $data['limit'];

        if(array_key_exists('method', $data) && !empty($data['method']) && $data['method'] == 'allvideos'){

            $videoList = DB::table('videos')                    
                        ->orderBy('id', 'ASC')
                        ->offset($startLimit)
                        ->take(4) 
                        ->get();
            //print_r(DB::getQueryLog());
                    
            foreach($videoList as $video){
                $createdDate = Carbon\Carbon::parse($video->uploadDate)->format('d/m/Y');
                $imgThumbPath = $this->app_url.'/storage/app/public/images/thumbs/'.$video->thumbnail;

                $videoData .= "<div class=\"col-md-3 col-sm-6 videocls\"><div class=\"video-first-outer\"><div class=\"video-images\"><a href=\"/vid=$video->id\"><img src=\"$imgThumbPath\"></a></div><div class=\"video-title\"><span class=\"title\">$video->videoTitle</span><a href=\"/deletevideo?vid=$video->id\"><span class=\"edit delete\"><i class=\"fa fa-trash\" aria-hidden=\"true\"></i></span></a></div><div class=\"date-title\"><span class=\"date-title\">created: $createdDate</span></div></div></div>";
            }
        }elseif(array_key_exists('method', $data) && !empty($data['method']) && $data['method'] == 'uservideos'){

            $videoList = DB::table('users')
                            ->join('videos', 'users.id','=', 'videos.user_id')
                            ->where('videos.user_id','=', $data['uid']) 
                            ->orderBy('videos.id', 'ASC') 
                            ->offset($startLimit)
                            ->take(4)               
                            ->get();

            //print_r(DB::getQueryLog()); 
            
            foreach($videoList as $video){
                $createdDate = Carbon\Carbon::parse($video->uploadDate)->format('d/m/Y');
                $imgThumbPath = $this->app_url.'/storage/app/public/images/thumbs/'.$video->thumbnail;

                $videoData .= "<div class=\"col-md-3 col-sm-6 videocls video_$video->id\"><div class=\"video-first-outer\"><div class=\"video-images\"><a href=\"/admin/video?vid=$video->id\"><img src=\"$imgThumbPath\"></a></div><div class=\"video-title\"><span class=\"title\">$video->videoTitle</span><span class=\"edit delete delvideo\" data-id=\"$video->id\" data-uid=\"$video->user_id\"><i class=\"fa fa-trash\" aria-hidden=\"true\"></i></span></div><div class=\"date-title\"><span class=\"date-title\">created: $createdDate</span></div></div></div>";
            }
        }

        echo $videoData;
        //print_r($userList);        
    }

    public function audioListBySize(){
        $data  = Request::all();

        $audioData = "";        
        DB::enableQueryLog();
        $name = \Auth::user()->name;
        $user = Auth::user();
        $role = Auth::user()->role;        
        $startLimit = $data['limit'];

        if(array_key_exists('method', $data) && !empty($data['method']) && $data['method'] == 'allaudios'){

            $audioList = DB::table('audios')                    
                        ->orderBy('id', 'ASC')
                        ->offset($startLimit)
                        ->take(1)
                        ->get();
                    
            foreach($audioList as $audio){
                $createdDate = Carbon\Carbon::parse($audio->upload_at)->format('d/m/Y');
                $audioPath = $this->app_url.'/storage/app/public/audios/'.$audio->audioName;

                $audioData .= "<div id=\"audio-list\" class=\"tab-pane music-name-outer audiol-library audio_$audio->id\">
                            <div class=\"both-music-name music-first\">
                                <audio id=\"aid_$audio->id\" preload='none'>
                                    <source loop=\"false\" src=\"$audioPath\" type='audio/mpeg' />
                                </audio>
                                <span id=\"audioControl$audio->id\" class=\"glyphicon glyphicon-play-circle\" onClick=\"playAudio(this.id);\"></span>
                                <span class=\"title\">$audio->audioTitle</span>
                                <span class=\"edit delete delaudio left-side\" data-id=\"$audio->id\" data-uid=\"$audio->user_id\"><i class=\"fa fa-trash\" aria-hidden=\"true\"></i></span>
                                <div class=\"date-title created\">created: $createdDate</div>
                            </div>
                            <div class=\"music-voice\">
                                <span id=\"staid_$audio->id\">0:00</span> <span id=\"duraid_$audio->id\" class=\"duration\">0:00</span>
                                <input type=\"range\" onchange=\"getVolume(this.id);\" id=\"myRange$audio->id\" class=\"aid_$audio->id\" step=\"any\" value=\"0\">
                            </div>
                        </div>";
            }
        }

        echo $audioData;
        //print_r($userList);        
    }

    public function pictureListBySize(){
        $data  = Request::all();

        $picData = "";        
        DB::enableQueryLog();
        $name = \Auth::user()->name;
        $user = Auth::user();
        $role = Auth::user()->role;        
        $startLimit = $data['limit'];

        if(array_key_exists('method', $data) && !empty($data['method']) && $data['method'] == 'allpictures'){

            $pictureList = DB::table('images')                    
                        ->orderBy('id', 'ASC')
                        ->offset($startLimit)
                        ->take(4) 
                        ->get();
            //print_r(DB::getQueryLog());
                    
            foreach($pictureList as $picture){
                $createdDate = Carbon\Carbon::parse($picture->uploaded_at)->format('d/m/Y');
                $imgThumbPath = $this->app_url.'/storage/app/public/images/thumbs/thumb_'.$picture->image_name;
                $imgPath = $this->app_url.'/storage/app/public/images/'.$picture->image_name;

                $picData .= "<div class=\"col-md-3 col-sm-6 pictCls pict_$picture->id\"><div class=\"video-first-outer\">
                            <div class=\"video-images\"><a href=\"$imgPath\" data-lightbox=\"example-2\"><img src=\"$imgThumbPath\"></a></div>
                            <div class=\"video-title\">
                                <span class=\"date-title\">Created: $createdDate</span>
                                <span class=\"edit delete delpict\" data-id=\"$picture->id\" data-uid=\"$picture->user_id\"><i class=\"fa fa-trash\" aria-hidden=\"true\"></i></span>
                            </div></div></div>";
            }
        }

        echo $picData;
        //print_r($userList);        
    }
    
    public function videoDetail(){
        DB::enableQueryLog();
        $name = \Auth::user()->name;
        $user = Auth::user();
        $role = Auth::user()->role;
        $data  = Request::all();

        if(array_key_exists('vid', $data) && !empty($data['vid'])){

            $videoData = DB::table('videos')
                        ->where('videos.id','=', $data['vid'])
                        ->first();                       
            if(!empty($videoData)){
                return View::make('adminVideo', compact('videoData')); 
            }else{
                echo "Please check the video id.";
            }
        }else{
            echo "Please check the video id.";
        }   
    }

    ///////////////////////// DELETE VIDEO ///////////////////////////////
    public function deleteVideo(){

        DB::enableQueryLog();
        $data  = Request::all();
        $user = \Auth::user();
        
        if(count($data) > 0){
            if(array_key_exists('vid', $data) && !empty($data['vid'])){
                      
                $status = DB::table('videos')->where('id', '=', $data['vid'])
                        ->where('videos.user_id','=', $data['uid'])
                        ->delete();

                if(array_key_exists('page', $data) && !empty($data['page']) && $data['page'] == 'videoinfo'){
                    echo "success";                    
                }elseif(array_key_exists('page', $data) && !empty($data['page']) && $data['page'] == 'allvideos'){
                    $tvideos = DB::table('videos')                                
                                ->count();
                    echo $tvideos;                   
                }elseif(array_key_exists('page', $data) && !empty($data['page']) && $data['page'] == 'uservideos'){
                    
                    $tvideos = DB::table('users')
                                ->join('videos', 'users.id','=', 'videos.user_id')
                                ->where('videos.user_id','=', $data['uid'])                
                                ->count();
                    echo $tvideos;
                }
            }
        }
    }

    ///////////////////////// DELETE USER ///////////////////////////////
    public function deleteUser(){

        DB::enableQueryLog();
        $data  = Request::all();
        $user = \Auth::user();
        $role = Auth::user()->role;
                
        if(count($data) > 0){
            if(array_key_exists('uid', $data) && !empty($data['uid'])){
                      
                $status = DB::table('users')->where('id', '=', $data['uid'])                    
                        ->delete();
                $userList = DB::table('users')
                        ->select(DB::raw('users.*, (SELECT count(videos.user_id) FROM videos WHERE users.id = videos.user_id) as videocount')) 
                        ->get();  

                if($status > 0){
                    echo "";
                }else{
                    echo "Failed!";
                }
            }
        }
    }

    public function addPicture(){
    	$data = Request::all();        
        $user = \Auth::user();
        $ffmpegObj = new FFmpegController;
        $path = $ffmpegObj->path;
        // echo '<pre>'; print_r($data); die;
            
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
                    ->first();
                
                if(!empty($pictureInfo)){

                    $imgPath = $this->path.'/images/'.$pictureInfo['image_name'];
                    $imgThumbPath = $this->path.'/images/thumbs/thumb_'.$pictureInfo['image_name'];
                                         
                    $status = DB::table('images')
                        ->where('id', '=', $data['imgid'])                        
                        ->delete();
                    shell_exec("rm -Rf $imgPath");
                    shell_exec("rm -Rf $imgThumbPath");

                    echo $status = DB::table('images')                        
                                ->count();
                }  
            }
        }
    }

    ///////////////////////// DELETE AUDIO ///////////////////////////////
    public function deleteAudio(){

        DB::enableQueryLog();
        $data  = Request::all();
        $user = \Auth::user();
        $ffmpegObj = new FFmpegController;
        $path = $ffmpegObj->path;
                        
        if(count($data) > 0){
            if(array_key_exists('aid', $data) && !empty($data['aid'])){

                $audioInfo = (array) DB::table('audios')
                    ->where('audios.id','=', $data['aid'])                    
                    ->first();
                
                if(!empty($audioInfo)){
                    $audioPath = $this->path.'/audios/'.$audioInfo['audioName'];
                                         
                    $status = DB::table('audios')
                        ->where('audios.id', '=', $data['aid'])
                        ->delete();
                    shell_exec("rm -Rf $audioPath");                    
                }

                echo $taudios = DB::table('audios')                        
                            ->count();                              
            }
        }
    }

    public function createVideoPage(){

        $name = \Auth::user()->name;
        $ffmpegObj = new FFmpegController;
        $path = $ffmpegObj->path;

        $imgList = DB::table('images')                    
                   ->get();

        return View::make('adminCreateVideo', compact('imgList'));
    }

    public function createVideo(){

        $data = Request::all();

        $name = \Auth::user()->name;
        $ffmpegObj = new FFmpegController;
        $path = $ffmpegObj->path;
        $imgList = DB::table('images')->get(); 
        
        if($data['method'] == 'image2video'){
            $sourceImgPath = '';
            $sourceImgArr = array();
            $text = "";
            $curTime = strtotime("now");
            $finalVideo = "vid_".$curTime.".mp4";
            $imgData = explode(",", $data['imgIdList']);
            $abc = array_shift($imgData);
            $inputFile = $path."/inputs/in".$curTime.".txt";

            foreach($imgData as $val){        
                $text .= "file '".$path.'/images/'.$val."'\n";
            }
            
            $fh = fopen($inputFile, "w") or die("Could not open log file.");
            fwrite($fh, $text) or die("Could not write file!");
            fclose($fh);
            $sourceImgPath = "\"$inputFile\"";           
            
            $ffmpegObj->imagesTOVideo($path, $curTime, $sourceImgPath, $finalVideo);
        }
    } 

public function editVideoPage($vid = null){
        DB::enableQueryLog();
        $data = Request::all();
        $page = 'allvideos';
        $vid = $data['vid'];
        $user = \Auth::user();
        $ffmpegObj = new FFmpegController;
        $path = $ffmpegObj->path;
        $imgList = DB::table('images')->get(); 
        $audioList = DB::table('audios')->get();         
        $videoData = DB::table('videos')                    
                    ->where('videos.id','=', $vid)                
                    ->first();  

        $myRecordedList = DB::table('recorded_voice')                    
                   ->where('recorded_voice.user_id','=', $user->id)
                   ->get(); 
        return View::make('adminEditVideo', compact('imgList', 'videoData', 'audioList', 'myRecordedList', 'page'));
    }

    public function editVideo($vid = null){

        $data = Request::all();
        $vid = $data['vid'];
        $user = \Auth::user();
        $ffmpegObj = new FFmpegController;
        $path = $ffmpegObj->path;
        $app_url = $ffmpegObj->app_url;
        $imgList = DB::table('images')->get(); 
        $audioList = DB::table('audios')->get();         
        $videoData = DB::table('videos')                    
                    ->where('videos.id','=', $vid)                
                    ->first();
        $myRecordedList = DB::table('recorded_voice')                    
                    ->where('recorded_voice.user_id','=', $user->id)->get();
        
        //echo '<pre>'; print_r($data); die;
        
        if($data['method'] == 'editvideo'){            
            $faceName = "";
            $filters = array();
            $curTime = strtotime("now");
            $finalVideo = $videoData->videoName; 
            $imgPosObj = json_decode($data['imgPos']);
            $imgPosData = (array) $imgPosObj;
            //print_r($imgPosData);
            
            if(count($imgPosData) > 0){
                $i=0;
                $j=1;

                foreach ($imgPosData as $key => $value) {
                    $facePos = explode(", ", $value);
                    $faceName .= " -i ".$path.'/faces/'.$facePos[3];
                    $xPos = $facePos[0];
                    $yPos = $facePos[1];
                    $sTFrame = $facePos[2];
                    $eTFrame = $facePos[2]+5;
                    
                    if($i > 0){
                         $filters[$i] =  "[tmp][$j:v] overlay=$xPos:$yPos:enable='between(t,$sTFrame,$eTFrame)'";

                    }else{
                         $filters[$i] =  "[0:v][1:v] overlay=$xPos:$yPos:enable='between(t,$sTFrame,$eTFrame)'";
                    }
                    $i++; $j++;
                }

                if(count($filters)>1){
                    $complexFilter = implode(" [tmp];", $filters);
                }else{
                    $complexFilter = implode("", $filters);
                }
            }
                        
            $ffmpegObj->addFacesTOVideo($path, $faceName, $complexFilter, $finalVideo, $vid);
        }elseif($data['method'] == 'addtext'){     
                        
            $finalVideo = $videoData->videoName;            
            $facePos = explode(", ", $data['imgPos']);
            $textData = $data['datatext'];
            $textSize = $data['datasize'];
            $fontName = $data['fontName'];
                        
            $ffmpegObj->addTextTOVideo($path, $textData, $textSize, $fontName, $facePos, $finalVideo, $vid);

        }elseif($data['method'] == 'addmusic'){     
                        
            $finalVideo = $videoData->videoName;            
            $audData    = explode(",", $data['audiodata']);
            $audioId    = $audData[0];            
            $audioData = DB::table('audios')                    
                    ->where('audios.id','=', $audioId)                
                    ->first();
            $audioName  = $audioData->audioName;
                    
            if(!empty(trim($audioData->audioName))){
                
                $ffmpegObj->combineAudioTOVideo($path, $audioName, $finalVideo, $vid);
            }else{
                echo "Filename did not entered correctly!!";
            }
            
        }elseif($data['method'] == 'addvoice'){
            // print_r($data); die;

            $audData    = explode(",", $data['recordedData']);
            $audioId    = $audData[0];
            $finalVideo = $videoData->videoName;
            $audioFile = $videoData->audioName;
            $audioData = DB::table('recorded_voice')                    
                    ->where('recorded_voice.id','=', $audioId)
                    ->first();

            $myvoice  = $audioData->audioName;
                    
            if(!empty(trim($myvoice))){                
                $ffmpegObj->addMyVoice($path, $myvoice, $audioFile, $finalVideo, $vid);
            }else{
                echo "Filename did not entered correctly!!";
            }
        }elseif($data['method'] == 'uploadRecording'){
            // echo '<pre>'; print_r($data); die;
            //print_r($data['upload']);
            $recordedlist = '';
            $vid = $data['vid'];
            $file = Input::file('upload');
            $neuraloop   =   new CommonController;
            $filesize = $file->getClientSize();

            if($filesize > 0 && $filesize < 15729000){
                if($file){
                    $destinationPath = $path. '/audios/';
                    $allowedexts = array('wav', 'mp3');
                    $fileName = $neuraloop->uploadFile($file, 'uploadFile', $user->id,$destinationPath,$allowedexts); 

                    $myRecordingList = DB::table('recorded_voice')                    
                        ->where('recorded_voice.user_id','=', $user->id)->get();

                    return Redirect("/admin/videos/editvideo?vid=$vid");                 
                } 
            }else{
                echo "File size can not less than 0 and greater than 6Mb...";
            }           
        }
    }

    public function myVideos(){

        $user = \Auth::user();
        $page = 'adminvideos';
        $videoList = DB::table('videos')                    
                    ->where('videos.user_id','=', $user->id)                
                    ->get();

        $tvideos = DB::table('videos')                    
                    ->where('videos.user_id','=', $user->id)                
                    ->count();

        return View::make('adminVideos', compact('videoList', 'tvideos', 'page'));
    }
}
