<?php

namespace App\Http\Controllers\Api\Membership\Model;

use App\Http\Controllers\Api\Employee\Model\Employee;
use App\Http\Controllers\Api\Member\Model\Member;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Mehradsadeghi\FilterQueryString\FilterQueryString;
use Ramsey\Uuid\Uuid;

class Membership extends Model
{
    use HasFactory, HasUuids,  SoftDeletes, FilterQueryString;
    protected $table = 'memberships';
    protected $primaryKey = 'membership_id';
    protected $filters = [
        'sort',
        'like',
        'in',
    ];
    protected $fillable = [
      'membership_status',
      'member_id',
      'employee_id',
    'expiry_date'
    ];

    public function memberForeign()
    {
        return $this->belongsTo(Member::class, 'member_id');
    }
    public function employeeForeign()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }
    protected $dates = ['deleted_at'];
}
