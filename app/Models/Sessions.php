<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Jenssegers\Agent\Agent;
class Sessions extends Model
{
    public $incrementing = false;
    protected $keyType = 'string';
    protected function userBrowser(): Attribute
    {
        return Attribute::make(
            get: function () {
                $agent = new Agent();
                $agent->setUserAgent($this->user_agent);

                return $agent->browser();
            },
        );
    }
    protected function userPlatform(): Attribute
    {
        return Attribute::make(
            get: function () {
                $agent = new Agent();
                $agent->setUserAgent($this->user_agent);

                return $agent->platform();
            },
        );
    }
    protected function isDesktop(): Attribute
    {
        return Attribute::make(
            get: function () {
                $agent = new Agent();
                $agent->setUserAgent($this->user_agent);

                return $agent->isDesktop();
            },
        );
    }
    protected function isCurrent(): Attribute
    {
        return Attribute::make(
            get: function () {
                return $this->id === session()->getId();
            },
        );
    }
    protected function dateDiff(): Attribute
    {
        return Attribute::make(
            get: function () {
                $date = Carbon::createFromTimestamp($this->last_activity);
                return $date->diffForHumans();
            },
        );
    }
}
