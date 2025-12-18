<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penalty extends Model
{
    use HasFactory;
    public  $primaryKey = 'penalty_id';
    public $timestamps = false;
    protected $fillable = [
        'house_id',
        'amount',
        'description',
        'penalty_date',
        'status'
    ];


    public function house()
    {
        return $this->belongsTo(House::class, 'house_id'); // Giả sử house_id là khóa ngoại trong bảng penalties
    }
}
