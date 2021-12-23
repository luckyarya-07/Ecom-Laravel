<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupan extends Model
{
    protected $fillable = ['coupan_name','coupan_code','user_id','coupan_amount','start_date','coupan_validity'];
    protected $table = 'coupan';
    use HasFactory;
}
