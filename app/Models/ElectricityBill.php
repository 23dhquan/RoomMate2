<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ElectricityBill extends Model
{
    use HasFactory;
    public  $primaryKey = 'electricity_bill_id';
    public $timestamps = false;
    protected $fillable = [
        'house_id',
        'amount',
        'billing_date',
'electricity_reading',
        'electricity_image',
        'status'
    ];

    public function house()
    {
        return $this->belongsTo(House::class);
    }
}
