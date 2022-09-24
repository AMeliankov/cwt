<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property string $name
 * @property string $slug
 */
class Role extends Model
{
    use HasFactory;

    const MODEL_TYPE = 'role';

    protected $table = 'roles';

    public $timestamps = null;

    protected $guarded = [
        'id',
    ];

    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id', 'role_id');
    }
}
