<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class House extends Model
{
    use HasFactory;
    public $primaryKey ='house_id';
    public $timestamps = false;
    protected $fillable = [
        'name',
        'area_id',
        'price',
        'description',
        'is_rented',

    ];

    public function getAreaName()
    {
        return Area::find($this->area_id)->name ?? 'N/A';
    }
    public function getAreaAddress()
    {
        return Area::find($this->area_id)->address ?? 'N/A';
    }

    // Quan hệ
    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    public function tenants()
    {
        return $this->hasMany(Tenant::class);
    }
    public function images()
    {
        return $this->hasMany(HouseImage::class, 'house_id', 'house_id');
    }
}
