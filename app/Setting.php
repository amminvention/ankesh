<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = ['site_name', 'site_logo', 'site_fav', 'mail_driver', 'mail_host', 'mail_port', 'mail_username', 'mail_password', 'mail_from'];
}
