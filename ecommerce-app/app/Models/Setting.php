<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'title',
        'keywords',
        'description',
        'company',
        'address',
        'phone',
        'fax',
        'email',
        'smtpserver',
        'smtpemail',
        'smtppassword',
        'smtpport',
        'facebook',
        'instagram',
        'twitter',
        'aboutus',
        'contact',
        'references',
        'status',
    ];
}
