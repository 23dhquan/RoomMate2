<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    public $primaryKey = "user_id";
    public $timestamps = false;
    protected $fillable = [
        'name',         // Tên người dùng
        'email',        // Email người dùng (để đăng nhập)
        'password',     // Mật khẩu
        'note',
        'phone',

        'role',
        'avatar',
        'status',// Quyền người dùng: 'admin' hoặc 'tenant'
        'area_id',
        'area_id_admin'// Khu vực mà người dùng quản lý/thuê (nullable)
    ];

    // Các quan hệ
    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    public function tenant()
    {
        return $this->hasOne(Tenant::class); // Một người dùng có thể là 1 người thuê
    }
}
