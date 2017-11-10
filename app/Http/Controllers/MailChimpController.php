<?php

namespace App\Http\Controllers;

use App\Mail\EmailVerification;
use Mail;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use View;
use Session;
use DB;
use Config;


class MailChimpController extends Controller
{

    public $mailchimp;
    public $listId = '21215';

    public function __construct(\Mailchimp $mailchimp)
    {
        $this->mailchimp = $mailchimp;
    }

    public function manageMailChimp()
    {
        return view('mailchimp');
    }

    public function subscribe(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
        ]);

        try {
            
            $this->mailchimp
            ->lists
            ->subscribe(
                $this->listId,
                ['email' => $request->input('email')]
            );

            return redirect()->back()->with('success','Email Subscribed successfully');

        } catch (\Mailchimp_List_AlreadySubscribed $e) {
            return redirect()->back()->with('error','Email is Already Subscribed');
        } catch (\Mailchimp_Error $e) {
            return redirect()->back()->with('error','Error from MailChimp');
        }
    }

    public function sendCompaign(Request $request)
    {
        $this->validate($request, [
            'subject' => 'required',
            'to_email' => 'required',
            'from_email' => 'required',
            'message' => 'required',
        ]);

        try {

            $options = [
            'list_id'   => $this->listId,
            'subject' => $request->input('subject'),
            'from_name' => $request->input('from_email'),
            'from_email' => 'hardik@itsolutionstuff.com',
            'to_name' => $request->input('to_email')
            ];

            $content = [
            'html' => $request->input('message'),
            'text' => strip_tags($request->input('message'))
            ];

            $campaign = $this->mailchimp->campaigns->create('regular', $options, $content);
            $this->mailchimp->campaigns->send($campaign['id']);

            return redirect()->back()->with('success','send campaign successfully');

            
        } catch (Exception $e) {
            return redirect()->back()->with('error','Error from MailChimp');
        }
    }

    public function sendMail(Request $request)
    {
       dd($request);

        try {

            $options = [
            'list_id'   => $this->listId,
            'subject' => 'Test Mail',
            'from_name' => 'niraj.pathak@xcelance.com',
            'from_email' => 'niraj.pathak@xcelance.com',
            'to_name' => 'andsraj@gmail.com'
            ];

            $content = [
            'html' => 'testinfddsfd ',
            'text' => 'djkshdskjd'
            ];

            $campaign = $this->mailchimp->campaigns->create('regular', $options, $content);
            $this->mailchimp->campaigns->send($campaign['id']);

            return redirect()->back()->with('success','send campaign successfully');

            
        } catch (Exception $e) {
            return redirect()->back()->with('error','Error from MailChimp');
        }
    }
}
