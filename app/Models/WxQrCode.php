<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
class WxQrCode extends Model
{
	use HasDateTimeFormatter;
    use SoftDeletes;
    use  Notifiable,HasFactory;
    protected $table = 'wx_qr_code';
    // public $timestamps = false;


    
}
