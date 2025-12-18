<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;
    public  $primaryKey = 'area_id';
    public $timestamps = false;
    protected $fillable = [
        'name',
        'address',
        'status'
    ];

    public function houses()
    {
        return $this->hasMany(House::class);
    }
}
