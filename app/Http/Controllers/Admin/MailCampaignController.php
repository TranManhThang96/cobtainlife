<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MailCampaignRequest;
use Illuminate\Http\Request;
use App\Jobs\SendEmail;
use App\Services\MailCampaignService;
use App\Services\ShopConfigService;
use App\Services\ShopCustomerService;
use App\Services\ShopCustomerSubscribeService;

class MailCampaignController extends Controller
{
    public function __construct(
        MailCampaignService $mailCampaignService,
        ShopCustomerService $shopCustomerService,
        ShopCustomerSubscribeService  $shopCustomerSubscribeService,
        ShopConfigService $shopConfigService
    ) {
        $this->mailCampaignService = $mailCampaignService;
        $this->shopCustomerService = $shopCustomerService;
        $this->shopCustomerSubscribeService = $shopCustomerSubscribeService;
        $this->shopConfigService = $shopConfigService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $campaigns = $this->mailCampaignService->index($request);
        return view('admin.pages.campaigns.index', compact('campaigns'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.campaigns.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MailCampaignRequest $request)
    {
        $params = $request->all();
        $mailTo = [];
        if (isset($request->campaign_press_mail)) {
            $mailTo = explode(';', $request->to);
        } else {
            if (in_array('customer', $request->campaign_to_types)) {
                $mailCustomer = $this->shopCustomerService->allMail();
                $mailCustomer = array_column($mailCustomer->toArray(), 'email');
                $mailTo = array_merge($mailTo, $mailCustomer);
            }

            if (in_array('subscribe', $request->campaign_to_types)) {
                $mailSubscribe = $this->shopCustomerSubscribeService->allMail();
                $mailSubscribe = array_column($mailSubscribe->toArray(), 'email');
                $mailTo = array_merge($mailTo, $mailSubscribe);
            }
        }
        $mailTo = array_values(array_map('trim', array_unique($mailTo)));
        $params['to'] = json_encode($mailTo);

        //save campaign
        $campaign = $this->mailCampaignService->store($params);

        // queue send mail
        $allConfigs = $this->shopConfigService->all();
        $configs = (object) array_column($allConfigs->toArray(), null, 'key');
        $emailJob = new SendEmail($configs->email_address['value'], $configs->email_username['value'], $mailTo, $params['subject'], $params['body']);
        dispatch($emailJob);
        if ($campaign) {
            toastr()->success('Gửi mail thành công!', '', [
                'positionClass' => 'toast-top-center',
            ]);
            return redirect()->route('admin.campaigns.index');
        }
        toastr()->error('Gửi mail thất bại!', '', [
            'positionClass' => 'toast-top-center',
        ]);
        return redirect()->back()->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }
}
