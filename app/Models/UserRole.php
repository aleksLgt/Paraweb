<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\UserRole
 *
 * @property int $id
 * @property int $user_id
 * @property int $role_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|UserRole newModelQuery()
 * @method static Builder|UserRole newQuery()
 * @method static Builder|UserRole query()
 * @method static Builder|UserRole whereCreatedAt($value)
 * @method static Builder|UserRole whereId($value)
 * @method static Builder|UserRole whereRoleId($value)
 * @method static Builder|UserRole whereUpdatedAt($value)
 * @method static Builder|UserRole whereUserId($value)
 * @mixin Eloquent
 */
class UserRole extends Model
{
    use HasFactory;

    protected $table = 'user_role';

    protected $fillable =   [
        'user_id',
        'role_id',
    ];

    protected $casts = [
        'created_at'        =>  'datetime: Y-m-d H:i:s',
        'updated_at'        =>  'datetime: Y-m-d H:i:s',
    ];
}
