<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deposit extends Model
{
    use HasFactory;

    protected $primaryKey = 'deposit_id';
    public $timestamps = false;

    protected $fillable = [
        'tenant_detail_id',
        'house_id',
        'amount',
        'deposit_date',
        'status',
    ];

    public function tenant()
    {
        return $this->belongsTo(Tenant::class, 'tenant_id');
    }

    public function house()
    {
        return $this->belongsTo(House::class, 'house_id');
    }
}
