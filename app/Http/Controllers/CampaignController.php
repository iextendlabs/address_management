<?php
    
namespace App\Http\Controllers;
    
use App\Models\Campaign;
use App\Models\CampaignRecipient;
use App\Models\CampaignSms;
use App\Models\Profile;
use App\Models\sms;
use Illuminate\Http\Request;
use Twilio\Rest\Client;
    
class CampaignController extends Controller
{ 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct(){
         $this->middleware('permission:campaign-list|campaign-create|campaign-edit|campaign-delete', ['only' => ['index','show']]);
         $this->middleware('permission:campaign-create', ['only' => ['create','store']]);
         $this->middleware('permission:campaign-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:campaign-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $campaigns = Campaign::latest()->paginate(5);
        return view('campaigns.index',compact('campaigns'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $profiles = Profile::all();

        $i = 0;
        return view('campaigns.create',compact('profiles','i'));
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        
        request()->validate([
            'title' => 'required',
            'message' => 'required',
            'ids' => 'required',
        ]);

        $Campaign = Campaign::create($request->all());
        $campaign_id = $Campaign->id;

        $account_sid = getenv("TWILIO_SID");
        $auth_token = getenv("TWILIO_AUTH_TOKEN");
        $twilio_number = getenv("TWILIO_NUMBER");
        $client = new Client($account_sid, $auth_token);
        
        $CampaignSMS = new CampaignSms;

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

                    $CampaignSMS->campaign_id = $campaign_id;
                    $CampaignSMS->sms_body = $request->message;
                    $CampaignSMS->save();
                    $CampaignSMS_id = $CampaignSMS->id;

                    $campaign_recipient = new CampaignRecipient;

                    $campaign_recipient->recipient_id = $id;
                    $campaign_recipient->campaign_id = $campaign_id;
                    $campaign_recipient->campaign_sms_id = $CampaignSMS_id;
                    $campaign_recipient->save();

            } catch (\Exception $e) {
                return redirect()->route('campaigns.create')->withErrors(['fail'=>$e->getMessage()]);
            }
        }
    
        return redirect()->route('campaigns.index')
                        ->with('success','Campaign created successfully And the message was sent successfully.');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Campaign  $Campaign
     * @return \Illuminate\Http\Response
     */
    public function show(Campaign $campaign){
        $campaignSMS = Campaign::find($campaign->id)->getCampaignSMS;

        $recipients = CampaignRecipient::leftJoin('profiles', 'campaign_recipients.recipient_id', '=', 'profiles.id')->get();

        return view('campaigns.show',compact('campaign','campaignSMS','recipients'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Campaign  $campaign
     * @return \Illuminate\Http\Response
     */
    public function edit(Campaign $campaign){
        return view('campaigns.edit',compact('campaign'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Campaign  $campaign
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Campaign $campaign){
         request()->validate([
            'title' => 'required',
        ]);
    
        $campaign->update($request->all());
    
        return redirect()->route('campaigns.index')
                        ->with('success','Campaign updated successfully');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Campaign  $campaign
     * @return \Illuminate\Http\Response
     */
    public function destroy(Campaign $campaign){
        CampaignRecipient::where('campaign_id',$campaign->id)->delete();
        
        CampaignSms::where('campaign_id',$campaign->id)->delete();
        
        $campaign->delete();
    
        return redirect()->route('campaigns.index')
                        ->with('success','Campaign deleted successfully');
    }
}