<?php

namespace Guillaumesouillard\UserTrackerGrpd;

use Illuminate\Database\Eloquent\Model;

class UserTrackerCampaign extends Model
{
    const COOKIE_NAME = 'from_ut_source';

    protected $fillable = [
        'name',
        'register_total',
        'buy_total',
    ];
}