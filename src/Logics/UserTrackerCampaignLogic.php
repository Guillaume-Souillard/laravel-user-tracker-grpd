<?php

namespace Guillaumesouillard\UserTrackerGrpd\Logics;

use Guillaumesouillard\UserTrackerGrpd\UserTrackerCampaign;

class UserTrackerCampaignLogic
{
    public static function incrementRegister(string $campaignName)
    {
        $campaign = UserTrackerCampaign::firstOrCreate(['name' => $campaignName]);
        $campaign->increment('register_total');
    }

    public static function incrementBuy(string $campaignName)
    {
        $campaign = UserTrackerCampaign::firstOrCreate(['name' => $campaignName]);
        $campaign->increment('buy_total');
    }
}