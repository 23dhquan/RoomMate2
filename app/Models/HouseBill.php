<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HouseBill extends Model
{
    public $timestamps = false;
    public $table = 'house_bills';
    public $primaryKey ='house_bill_id';
    protected $fillable = [
        'house_id',
        'amount',
        'billing_date',
        'status'
    ];
}
