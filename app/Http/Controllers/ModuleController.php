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


class ModuleController extends Controller
{
    public function __construct() {       
        $this->middleware('auth');
    }

    public function index(){
        $name = \Auth::user()->name;

        if(Auth::user()->payment_status == 0 && Auth::user()->role == 0){
            $paymentData = DB::table('payments')
            ->where('payments.user_id', Auth::user()->id)->first();
            $message = 'Please pay pending amount to continue services.';
            return View::make('profile', compact('paymentData', 'message'));
        }else{
            $modulelist = DB::table('modules')->get();
                        
            return View::make('modules', compact('modulelist'));
        }
    }
    
    public function myModulePage($pid = null){
        $user = \Auth::user();
        $data  = Request::all();

        $quizlist = DB::table('modules')
                    ->join('submodules', 'modules.id','=', 'submodules.module_id')
                    ->where('modules.id','=', $data['pid'])
                    ->orderby('modules.id')              
                    ->get();
        $moduleName =  $quizlist[0]->module_name;
		$lesson_text =  $quizlist[0]->lesson_text;
		$lesson_video =  $quizlist[0]->lesson_video;

        $responseData =  DB::table('quiz_response')
                            ->select(DB::raw('fs_quiz_response.quiz'))
                            ->where('quiz_response.user_id','=', $user->id)
                            ->where('quiz_response.module_id','=', $data['pid'])
                            ->get()->toArray();
       $response = array();
       foreach ($responseData as $res) {
           array_push($response, $res->quiz);
       }
        return View::make('moduleview', compact('quizlist', 'moduleName', 'response', 'lesson_text', 'lesson_video'));
    }


    public function moduleEQ($pid = null){
        $user = \Auth::user();
        $data  = Request::all();
        $data['pid'] = 2;

        $quizlist = DB::table('modules')
                    ->join('submodules', 'modules.id','=', 'submodules.module_id')
                    ->where('modules.id','=', $data['pid'])                
                    ->get();
        $moduleName =  $quizlist[0]->module_name;
		$lesson_text =  $quizlist[0]->lesson_text;
		$lesson_video =  $quizlist[0]->lesson_video;

        $responseData =  DB::table('quiz_response')
                            ->select(DB::raw('fs_quiz_response.quiz'))
                            ->where('quiz_response.user_id','=', $user->id)
                            ->where('quiz_response.module_id','=', $data['pid'])
                            ->get()->toArray();
       $response = array();
       foreach ($responseData as $res) {
           array_push($response, $res->quiz);
       }
      
        return View::make('moduleview', compact('quizlist', 'moduleName', 'response', 'lesson_text', 'lesson_video'));
    }

    public function moduleSMB($pid = null){
        $user = \Auth::user();
        $data  = Request::all();
        $data['pid'] = 1;

        $quizlist = DB::table('modules')
                    ->join('submodules', 'modules.id','=', 'submodules.module_id')
                    ->where('modules.id','=', $data['pid'])                
                    ->get();
        $moduleName =  $quizlist[0]->module_name;
		$lesson_text =  $quizlist[0]->lesson_text;
		$lesson_video =  $quizlist[0]->lesson_video;

        $responseData =  DB::table('quiz_response')
                            ->select(DB::raw('fs_quiz_response.quiz'))
                            ->where('quiz_response.user_id','=', $user->id)
                            ->where('quiz_response.module_id','=', $data['pid'])
                            ->get()->toArray();
       $response = array();
       foreach ($responseData as $res) {
           array_push($response, $res->quiz);
       }
      
        return View::make('moduleview', compact('quizlist', 'moduleName', 'response', 'lesson_text', 'lesson_video'));
    }           
}
