<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class WxQrCode extends Model
{
	use HasDateTimeFormatter;
    use SoftDeletes;

    protected $table = 'wx_qr_code';
    // public $timestamps = false;


    
}
