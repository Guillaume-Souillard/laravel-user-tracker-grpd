<?php

namespace Guillaumesouillard\UserTrackerGrpd\Http\Controllers;

use Guillaumesouillard\UserTrackerGrpd\Logics\UserTrackerCampaignLogic;
use Guillaumesouillard\UserTrackerGrpd\UserTrackerCampaign;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


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

        return response()->json(['msg' => 'ok']);
    }
}