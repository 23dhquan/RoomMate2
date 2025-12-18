<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HouseService extends Model
{
    use HasFactory;
    public $primaryKey ='house_service_id';
    protected $table = 'house_services';
    public $timestamps = false;
    protected $fillable = [
        'house_id',
        'service_id',
        'status',
        'description',

    ];
}
