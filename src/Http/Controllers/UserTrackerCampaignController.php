<?php

namespace Guillaumesouillard\UserTrackerGrpd\Http\Controllers;

use Guillaumesouillard\UserTrackerGrpd\Logics\UserTrackerCampaignLogic;
use Guillaumesouillard\UserTrackerGrpd\UserTrackerCampaign;
use Illuminate\Http\Request;

class UserTrackerCampaignController extends Controller
{
    public function incrementBuyTotal(Request $request)
    {
        $request->validate([
            'total_amount' => 'required|int'
        ]);

        $source = $request->cookie(UserTrackerCampaign::COOKIE_NAME);
        if ($source) {
            UserTrackerCampaignLogic::incrementBuy($source, $request->total_amount);
        }

        if ($request->has('forget_cookie') && $request->input('forget_cookie') == 'true') {
            return response()->json(['msg' => 'ok with forget'])->cookie('source', null, -1);
        } else {
            return response()->json(['msg' => 'ok']);
        }
    }
}