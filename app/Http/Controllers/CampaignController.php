<?php
    
namespace App\Http\Controllers;
    
use App\Models\Campaign;
use App\Models\CampaignRecipient;
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
            'sms_body' => 'required',
            'ids' => 'required',
        ]);

        $Campaign = Campaign::create($request->all());
        $campaign_id = $Campaign->id;

        $account_sid = getenv("TWILIO_SID");
        $auth_token = getenv("TWILIO_AUTH_TOKEN");
        $twilio_number = getenv("TWILIO_NUMBER");
        $client = new Client($account_sid, $auth_token);
        
        foreach($request->ids as $id){
            try {
                    $profile = Profile::find($id);
                    $client->messages->create($profile->phoneMobile, 
                    ['from' => $twilio_number, 'body' => $request->sms_body] );

                    $sms = new sms;
                    
                    $sms->profile_id = $id;
                    $sms->body = $request->sms_body;
                    $sms->status = 'success';
                    $sms->type = 'send';
                    $sms->campaign_id = $campaign_id;
                    $sms->save();

                    $campaign_recipient = new CampaignRecipient;

                    $campaign_recipient->recipient_id = $id;
                    $campaign_recipient->campaign_id = $campaign_id;
                    $campaign_recipient->save();

            } catch (\Exception $e) {
                return redirect()->route('campaigns.index')->withErrors(['fail'=>$e->getMessage()]);
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
        $recipients = CampaignRecipient::leftJoin('profiles', 'campaign_recipients.recipient_id', '=', 'profiles.id')->get();
        
        $results = sms::select('body', sms::raw('count(*) as total'))
        ->groupBy('body')->where('campaign_id',$campaign->id)->WHERE('type','receive')
        ->get();
        
        if($results==false){
            foreach($results as $result){
                $body[] =  $result->body;
                $total[] = $result->total;
            }
        
            return view('campaigns.show',compact('campaign','recipients','body','total'));

        }else{
            return view('campaigns.show',compact('campaign','recipients'));

        }

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

        sms::where('campaign_id',$campaign->id)->delete();
        
        $campaign->delete();
    
        return redirect()->route('campaigns.index')
                        ->with('success','Campaign deleted successfully');
    }

    public function campaignInbox(){
        $data = array();
        $campaigns = Campaign::latest('created_at','desc')->get();

        foreach($campaigns as $campaign){
            $sms = sms::where('campaign_id',$campaign->id)->latest('created_at','desc')->first();
            if(isset($sms)){
                $data[] = array(
                    'campaign_id'     =>$campaign->id,
                    'campaign'        => $campaign->title,
                    'sms'            => $sms->body,
                    'date'            => $campaign->created_at
                );
            }
            
        }
        
        return view('campaigns.inbox',compact('data'));
    }

    public function chat($id){
        $campaign = Campaign::find($id);
        $sms = sms::leftJoin('profiles', 'sms.profile_id', '=', 'profiles.id')
        ->where('sms.campaign_id', $id)->where('sms.type','receive')->orderBy('sms.created_at', 'desc')->get();

        return view('campaigns.sms',compact('sms','campaign'));
}
}