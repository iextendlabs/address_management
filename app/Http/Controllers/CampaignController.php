<?php
    
namespace App\Http\Controllers;
    
use App\Models\Campaign;
use App\Models\CampaignRecipient;
use App\Models\CampaignSms;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
    
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
        return view('campaigns.create');
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
        ]);
    
        Campaign::create($request->all());
    
        return redirect()->route('campaigns.index')
                        ->with('success','Campaign created successfully.');
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