<?php
    
namespace App\Http\Controllers;
    
use App\Models\Profile;
use App\Models\Addresses;
use App\Models\sms;
use App\Models\Campaign;
use App\Models\CampaignRecipient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Twilio\Rest\Client;
use Twilio\TwiML\MessagingResponse;

class ProfileController extends Controller
{ 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct(){
            $this->middleware('permission:profile-list|profile-create|profile-edit|profile-delete', ['only' => ['index','show']]);
            $this->middleware('permission:profile-create', ['only' => ['create','store']]);
            $this->middleware('permission:profile-edit', ['only' => ['edit','update']]);
            $this->middleware('permission:profile-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
            $fields = array(
                'firstName' => 'First Name',
                'lastName' => 'Last Name',
                'jobTitle' => 'Job Title',
                'company' => 'Company',
                'employeeNumber' => 'Employee Number',
                'departmentNumber' => 'Department Number',
                'department' => 'Department',
                'phoneMobile' => 'Phone (Mobile)',
                'phoneWork' => 'Phone (Work)',
                'email' => 'Email',
                'workgroup' => 'Workgroup',
                'prefix' => 'Prefix',
                'number' => 'Number',
                'street' => 'Street',
                'suburb' => 'Suburb',
                'city_town' => 'City \ Town',
                'country' => 'Country',
                'postcode_zipcode' => 'Postcode \ ZipCode',
            );

            $campaigns = Campaign::all();
            
            $profiles = Profile::latest()->paginate(5);
            return view('profiles.index',compact('profiles','fields','campaigns'))
                ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    //  Filter Profiles 

    public function filter(Request $request){

            $fields = array(
                'firstName' => 'First Name',
                'lastName' => 'Last Name',
                'jobTitle' => 'Job Title',
                'company' => 'Company',
                'employeeNumber' => 'Employee Number',
                'departmentNumber' => 'Department Number',
                'department' => 'Department',
                'phoneMobile' => 'Phone (Mobile)',
                'phoneWork' => 'Phone (Work)',
                'email' => 'Email',
                'workgroup' => 'Workgroup',
                'prefix' => 'Prefix',
                'number' => 'Number',
                'street' => 'Street',
                'suburb' => 'Suburb',
                'city_town' => 'City \ Town',
                'country' => 'Country',
                'postcode_zipcode' => 'Postcode \ ZipCode',
            );

            $query = DB::table('profiles')
            ->leftJoin('addresses', 'profiles.id', '=', 'addresses.profile_id');

            if(isset($request->field) || isset($request->value)){
                $query->where($request->field ,'like',$request->value.'%');
            }

            $profiles = $query->paginate(5);
            
            $old_data = [
                'field' => $request->field,
                'value' => $request->value,
            ];

            $campaigns = Campaign::all();

            return view('profiles.index',compact('profiles','old_data','fields','campaigns'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
            
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
            return view('profiles.create');
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
            request()->validate([
                'firstName' => 'required',
                'lastName' => 'required',
                'jobTitle' => 'required',
                'company' => 'required',
                'employeeNumber' => 'required',
                'departmentNumber' => 'required',
                'department' => 'required',
                'phoneMobile' => 'required',
                'email' => 'required',
                'number' => 'required',
                'street' => 'required',
                'city_town' => 'required',
                'country' => 'required',
                'postcode_zipcode' => 'required',
                'suburb' => 'required',
            ]);
        
            $profile = Profile::create($request->all());

            $address = new Addresses;

            $address->profile_id = $profile->id;
            $address->prefix = $request->prefix;
            $address->number = $request->number;
            $address->street = $request->street;
            $address->suburb = $request->suburb;
            $address->city_town = $request->city_town;
            $address->country = $request->country;
            $address->postcode_zipcode = $request->postcode_zipcode;
            $address->save();
         
            return redirect()->route('profiles.index')
                            ->with('success','Profile created successfully.');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function show(Profile $profile){
            
            $address = Profile::find($profile->id)->getAddresses;;

            return view('profiles.show',compact('profile','address'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function edit(Profile $profile){
            $address = Profile::find($profile->id)->getAddresses;;

            return view('profiles.edit',compact('profile','address'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Profile $profile){
            request()->validate([
                'firstName' => 'required',
                'lastName' => 'required',
                'jobTitle' => 'required',
                'company' => 'required',
                'employeeNumber' => 'required',
                'departmentNumber' => 'required',
                'department' => 'required',
                'phoneMobile' => 'required',
                'email' => 'required',
                'number' => 'required',
                'street' => 'required',
                'city_town' => 'required',
                'country' => 'required',
                'postcode_zipcode' => 'required',
                'suburb' => 'required',
            ]);
        
            $profile->update($request->all());

            $address = Addresses::find($request->address_id);
            
            $address->profile_id = $profile->id;
            $address->prefix = $request->prefix;
            $address->number = $request->number;
            $address->street = $request->street;
            $address->suburb = $request->suburb;
            $address->city_town = $request->city_town;
            $address->country = $request->country;
            $address->postcode_zipcode = $request->postcode_zipcode;
            $address->save();
        
            return redirect()->route('profiles.index')
                            ->with('success','profile updated successfully');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
            Profile::find($id)->delete();
           
            Addresses::where('profile_id',$id)->delete();
            
            sms::where('profile_id',$id)->delete();
        
            return redirect()->route('profiles.index')
                            ->with('success','profile deleted successfully');
    }
    // Display a listing of the sms.
    public function sms($id){
            $profile = Profile::find($id);

            $sms = sms::where('profile_id', $id)->orderBy('created_at', 'desc')->get();

            return view('profiles.sms',compact('profile','sms'));
    }

    public function sendSMS(Request $request){

            request()->validate([
                'message' => 'required',
            ]);

            $sms = new sms;

            $account_sid = getenv("TWILIO_SID");
            $auth_token = getenv("TWILIO_AUTH_TOKEN");
            $twilio_number = getenv("TWILIO_NUMBER");
            $client = new Client($account_sid, $auth_token);
                try {
                    $client->messages->create($request->number, 
                        ['from' => $twilio_number, 'body' => $request->message] );

                    $sms->profile_id = $request->profile_id;
                    $sms->body = $request->message;
                    $sms->status = 'success';
                    $sms->type = 'send';
                    $sms->save();

                } catch (\Exception $e) {
                    return back()->withErrors(['fail'=>$e->getMessage()]);
                }

            return back()->with('success','The message was sent successfully.');
    }
        
    public function receiveSMS(Request $request){
            $sms = new sms;

            $response = new MessagingResponse();

            $profile = Profile::where('phoneMobile',$request->From)->first();
            
            $sms->profile_id = $profile->id;
            $sms->body = $request->Body;
            $sms->status = 'success';
            $sms->type = $request->SmsStatus;
            $sms->save();

            $response->message('Your SMS successfully send.');
    }

    public function campaignSMS(Request $request){
        
        request()->validate([
            'campaign' => 'required',
            'message' => 'required',
            'ids' => 'required'
        ]);

        $account_sid = getenv("TWILIO_SID");
        $auth_token = getenv("TWILIO_AUTH_TOKEN");
        $twilio_number = getenv("TWILIO_NUMBER");
        $client = new Client($account_sid, $auth_token);
        
        foreach($request->ids as $id){
            try {
                    $profile = Profile::find($id);
                    $client->messages->create($profile->phoneMobile, 
                    ['from' => $twilio_number, 'body' => $request->message] );
                   
                    $sms = new sms;
                    
                    $sms->profile_id = $id;
                    $sms->body = $request->message;
                    $sms->status = 'success';
                    $sms->type = 'send';
                    $sms->save();
                    
                    $campaign_recipient = new CampaignRecipient;

                    $campaign_recipient->recipient_id = $id;
                    $campaign_recipient->campaign_id = $request->campaign;
                    $campaign_recipient->save();

            } catch (\Exception $e) {
                return redirect()->route('profiles.index')->withErrors(['fail'=>$e->getMessage()]);
            }
        }
        return redirect()->route('profiles.index')->with('success','The message was sent successfully.');
    }

    public function inbox(){
        $data = array();
        $profiles = Profile::all();

        foreach($profiles as $profile){
            $sms = sms::where('profile_id',$profile->id)->latest()->first();
            if(isset($sms)){
                $data[] = array(
                    'profile_id'     =>$profile->id,
                    'profile'        => $profile->firstName.' '.$profile->lastName,
                    'sms'            => $sms->body
                );
            }
            
        }
        
        return view('profiles.inbox',compact('data'));
    }
}
