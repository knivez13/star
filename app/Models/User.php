<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Models\Maintenance\Department;
use App\Models\Users\UserDesignation;
use App\Models\Users\UserLevel;
use App\Traits\Uuids;
use Kyslik\ColumnSortable\Sortable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles, Uuids, SoftDeletes, Sortable;
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id')->select('id', 'code', 'description');
    }

    public function userLevel()
    {
        return $this->belongsTo(UserLevel::class, 'user_level_id')->select('id', 'code', 'description');
    }

    public function userDesignation()
    {
        return $this->belongsTo(UserDesignation::class, 'user_designation_id')->select('id', 'code', 'description');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by')->select('id', 'first_name', 'middle_name', 'last_name');
    }
    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by')->select('id', 'first_name', 'middle_name', 'last_name');
    }
}
