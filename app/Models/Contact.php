<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $table = 'contacts';
    public $timestamps = false;
    protected $fillable = [
        'name',
        'email',
        'title',
        'message',
    ];




    public function getFormattedPhoneAttribute()
    {

        return preg_replace('/(\d{3})(\d{3})(\d{4})/', '($1) $2-$3', $this->phone);
    }

    public function getShortMessageAttribute()
    {

        return strlen($this->message) > 50 ? substr($this->message, 0, 50) . '...' : $this->message;
    }
}
