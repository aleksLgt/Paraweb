<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\RolePermission
 *
 * @property int $id
 * @property int $role_id
 * @property int $permission_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|RolePermission newModelQuery()
 * @method static Builder|RolePermission newQuery()
 * @method static Builder|RolePermission query()
 * @method static Builder|RolePermission whereCreatedAt($value)
 * @method static Builder|RolePermission whereId($value)
 * @method static Builder|RolePermission wherePermissionId($value)
 * @method static Builder|RolePermission whereRoleId($value)
 * @method static Builder|RolePermission whereUpdatedAt($value)
 * @mixin Eloquent
 */
class RolePermission extends Model
{
    use HasFactory;

    protected $fillable =   [
        'role_id',
        'permission_id'
    ];

    protected $casts = [
        'created_at'        =>  'datetime: Y-m-d H:i:s',
        'updated_at'        =>  'datetime: Y-m-d H:i:s',
    ];

    protected $table = 'role_permission';
}
