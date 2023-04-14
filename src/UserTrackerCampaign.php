<?php

namespace Guillaumesouillard\UserTrackerGrpd;

use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    protected $fillable = [
        'name',
        'register_total',
        'buy_total',
    ];
}