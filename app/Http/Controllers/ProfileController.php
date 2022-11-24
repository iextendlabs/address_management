<?php
    
namespace App\Http\Controllers;
    
use App\Models\Profile;
use App\Models\Addresses;
use App\Models\sms;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use ClickSend;
    
class ProfileController extends Controller
{ 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
        {
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
    public function index()
        {
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
            
            $profiles = Profile::latest()->paginate(5);
            return view('profiles.index',compact('profiles','fields'))
                ->with('i', (request()->input('page', 1) - 1) * 5);
        }

    //  Filter Profiles 

    public function filter(Request $request)
        {

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

            return view('profiles.index',compact('profiles','old_data','fields'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
            
        }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
        {
            return view('profiles.create');
        }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
        {
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
    public function show(Profile $profile)
        {
            
            $address = Profile::find($profile->id)->getAddresses;;

            return view('profiles.show',compact('profile','address'));
        }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function edit(Profile $profile)
        {
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
    public function update(Request $request, Profile $profile)
        {
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
    public function destroy(Profile $profile)
        {
            $profile->delete();

            DB::table('addresses')->where('profile_id', $profile->id)->delete();
        
            return redirect()->route('profiles.index')
                            ->with('success','profile deleted successfully');
        }
    // Display a listing of the sms.
    public function sms($id)
        {
            $profile = Profile::find($id);

            $sms = DB::table('sms')->where('profile_id', $id)->orderBy('created_at', 'desc')->get();

            return view('profiles.sms',compact('profile','sms'));
        }
    // Send sms.
    public function sendSMS(Request $request)
        {

            request()->validate([
                'message' => 'required',
            ]);

            $sms = new sms;
            
            // Configure HTTP basic authorization: BasicAuth
            $config = ClickSend\Configuration::getDefaultConfiguration()
                        ->setUsername(env("CLICKSEND_USERNAME"))
                        ->setPassword(env("CLICKSEND_API_KEY"));

            $apiInstance = new ClickSend\Api\SMSApi(new \GuzzleHttp\Client(),$config);
            $msg = new \ClickSend\Model\SmsMessage();
            $msg->setBody($request->message); 
            $msg->setTo($request->number);
            $msg->setSource("sdk");
            // \ClickSend\Model\SmsMessageCollection | SmsMessageCollection model
            $sms_messages = new \ClickSend\Model\SmsMessageCollection(); 
            $sms_messages->setMessages([$msg]);

            try {
                $result = $apiInstance->smsSendPost($sms_messages);

                $status = json_decode($result)->data->messages['0']->status;

                $sms->profile_id = $request->profile_id;
                $sms->body = $request->message;
                if($status == 'SUCCESS'){
                    $sms->status = 'success';
                }else{
                    $sms->status = 'fail';
                }
                $sms->save();

                if($status == 'SUCCESS'){
                    return back()->with('success','Message successfully Send.');
                }else{
                    return back()->with('fail','Something went wrong.');
                }
            } catch (Exception $e) {
                echo 'Exception when calling SMSApi->smsSendPost: ', $e->getMessage(), PHP_EOL;
            }


            
        }
}