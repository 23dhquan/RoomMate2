<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    public  $primaryKey = 'payment_id';
    public $timestamps = false;
    protected $fillable = [
        'name',
        'amount',
        'note',
        'payment_date',
        'is_delete'
    ];



}
