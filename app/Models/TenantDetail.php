<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TenantDetail extends Model
{
    use HasFactory;
    protected $table = 'tenants_details';
    public $primaryKey ='tenant_detail_id';
    public $timestamps = false;
    protected $fillable = [
        'tenant_id ',      // Mã người dùng (foreign key từ bảng users)
        'leader',     // Mã nhà trọ thuê (foreign key từ bảng houses)
        'full_name',   // Ngày bắt đầu thuê
        'phone ',      // Mã người dùng (foreign key từ bảng users)
        'email',     // Mã nhà trọ thuê (foreign key từ bảng houses)
        'identity_card',       // Mã người dùng (foreign key từ bảng users)
        'identity_card_image',     // Mã nhà trọ thuê (foreign key từ bảng houses)
        'portrait_image',
        'gender',     // Mã nhà trọ thuê (foreign key từ bảng houses)
        'date_of_birth',// Ngày kết thúc thuê (nullable)

    ];

    // Quan hệ
    public function tenant()
    {
        return $this->belongsTo(Tenant::class); // Người thuê là 1 người dùng
    }


}
