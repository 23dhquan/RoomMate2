<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    public $primaryKey ='service_id';
    public $timestamps = false;
    protected $fillable = [
        'name',         // Tên dịch vụ
        'price',  // Mô tả dịch vụ

    ];
}
