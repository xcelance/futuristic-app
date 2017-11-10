<?php

namespace App\Http\Controllers;

use App\Mail\EmailVerification;
use Mail;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use URL;
use Session;
use Redirect;
use Input;
use App\User;
use View;
use DB;


class PaymentController extends Controller
{
    public function __construct()
    {       
        $this->user = new User;
    }
    
    /**
     * Show the application paywith stripe.
     *
     * @return \Illuminate\Http\Response
     */
    public function payWithStripe()
    {
        return view('paywithstripe');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postPaymentWithStripe(Request $request)
    {
        $fullAmt = '8500';
        $subAmt = '2833.33';

        $validator = Validator::make($request->all(), [
            'card_no' => 'required',
            'ccExpiryMonth' => 'required',
            'ccExpiryYear' => 'required',
            'cvvNumber' => 'required',           
        ]);
        
        $input = $request->all();

        if ($validator->passes()) {           
            $stripe = array(
              "secret_key"      => "sk_test_sQma5CJ4V2dVoe4hrOTwGbss",
              "publishable_key" => "pk_test_4CaNA0zUUGVJAw3nlM2i2fyo"
            );
            \Stripe\Stripe::setApiKey("sk_test_sQma5CJ4V2dVoe4hrOTwGbss");

            try {

                $token  =   \Stripe\Token::create(array(
                  "card" => array(
                    "number" => $request->get('card_no'),
                    "exp_month" => $request->get('ccExpiryMonth'),
                    "exp_year" => $request->get('ccExpiryYear'),
                    "cvc" => $request->get('cvvNumber')
                  )
                ));

                $customer = \Stripe\Customer::create(array(
                    'source'  => $token->id,
                    'description' => 'testing...121'
                    //'email' => $_POST['stripeEmail']           
                ));


                if($request->get('payment') == 'R'){

                   $planc  = \Stripe\Plan::create(array(
                      "amount" => 2833.33,
                      "interval" => "month",
                      "name" => $customer->id,
                      "currency" => "usd",
                      "id" => $customer->id)
                    );

                   $planlist = \Stripe\Plan::all(array("limit" => 3));

                   $subs = \Stripe\Subscription::create(array(
                      "customer" => $customer->id,
                      "items" => array(
                        array(
                          "plan" => $customer->id,
                        ),
                      )
                    ));
             
                    $userData = User::find($request->get('user_id')); 
                    $createdDate = date('Y-m-d H:i:s', $subs->created);

                   $lastInsertData = DB::table('payments')->insertGetId(
                    ['user_id' => $userData->id, 'customer_id' => $subs->customer, 'subscription_id' => $subs->id, 'customer_email' =>'naveen.dogra@xcelance.com',  
                    'transaction_id' => $subs->items->data[0]->id, 'amount' => '50', 'transaction_at' =>  $createdDate]
                  );

                }else{

                    $charges = \Stripe\Charge::create(array(
                        'customer' => $customer->id,
                        'amount'   => $request->get('amount'),
                        'currency' => 'usd'
                    ));

                    $userData = User::find($request->get('user_id')); 
                    $createdDate = date('Y-m-d H:i:s', $charges->created);

                    $lastInsertData = DB::table('payments')->insertGetId(
                      ['user_id' => $userData->id, 'customer_id' => $charges->customer, 'customer_email' =>'naveen.dogra@xcelance.com',  
                      'transaction_id' => $charges->balance_transaction, 'amount' =>  $charges->amount, 'transaction_at' =>  $createdDate]
                    );
                }           

                DB::table('users')                    
                    ->where('users.id', $userData->id)                
                    ->update(['payment_status' => '1', 'payment_mode' => $request->get('payment')]);

                $email = new EmailVerification(new User(['email_token' => $userData->email_token, 'firstname' => $userData->firstname]));
                $sentStatus = Mail::to($userData->email)->send($email);

                Session::flash('success', 'Signup successfully! Please check your mail for verification...');

                return View::make('auth.thankyou');

            } catch(Stripe_CardError $e) {
                \Session::put('error','All fields are required!!');
                return redirect()->route('paywithstripe');
            }
        }        
    } 


    public function postPendingPaymentWithStripe(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'card_no' => 'required',
            'ccExpiryMonth' => 'required',
            'ccExpiryYear' => 'required',
            'cvvNumber' => 'required',           
        ]);
        
        $input = $request->all();

        if ($validator->passes()) {           
            $stripe = array(
              "secret_key"      => "sk_test_sQma5CJ4V2dVoe4hrOTwGbss",
              "publishable_key" => "pk_test_4CaNA0zUUGVJAw3nlM2i2fyo"
            );
            \Stripe\Stripe::setApiKey("sk_test_sQma5CJ4V2dVoe4hrOTwGbss");

            try {

                $charges = \Stripe\Charge::create(array(
                    'customer' => $request->get('customer'),
                    'amount'   => $request->get('amount'),
                    'currency' => 'usd'
                ));

                $createdDate = date('Y-m-d H:i:s', $charges->created);

                DB::table('users')                    
                    ->where('users.id', Auth::user()->id)                
                    ->update(['payment_status' => '2', 'payment_mode' => $request->get('payment')]);

                DB::table('payments')                    
                    ->where('payments.id', $request->get('pid'))
                    ->update(['transaction_id' => $charges->balance_transaction, 'pending_amount' => 'Null', 'status' => 'done', 'transaction_at'=> $createdDate]);

                Session::flash('success', 'Signup successfully! Please check your mail for verification...');

                return View::make('profile');

            } catch(Stripe_CardError $e) {
                \Session::put('error','All fields are required!!');
                return redirect()->route('profile');
            }
        }        
    }


}
