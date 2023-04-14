<?php

namespace Guillaumesouillard\UserTrackerGrpd;

use Illuminate\Database\Eloquent\Model;

class UserTrackerCampaign extends Model
{
    protected $fillable = [
        'name',
        'register_total',
        'buy_total',
    ];
}