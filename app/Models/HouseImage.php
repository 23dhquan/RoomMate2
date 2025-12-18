<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HouseImage extends Model
{
    // Khai báo các cột có thể gán dữ liệu hàng loạt
    public $timestamps = false;
    protected $table = 'house_image';

    public $primaryKey = 'house_image_id';
    protected $fillable = ['house_id', 'image_path'];

    // Định nghĩa quan hệ với model House
    public function house()
    {
        return $this->belongsTo(House::class);
    }
    // Trong mô hình House
    public function images()
    {
        return $this->hasMany(HouseImage::class, 'house_id');
    }

}
