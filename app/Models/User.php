<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Lumen\Auth\Authorizable;

/**
 * @property int $id
 * @property string $name
 * @property string $login
 * @property string $avatar
 * @property string $phone
 * @property string $password
 * @property int $role_id
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 */
class User extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable, HasFactory, SoftDeletes;

    const MODEL_TYPE = 'user';

    protected $table = 'users';

    protected $guarded = [
        'id',
        'role_id',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $hidden = [
        'password'
    ];

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }

    public function visits(): HasMany
    {
        return $this->hasMany(Visit::class, 'user_id', 'id');
    }
}
