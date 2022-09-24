<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property string $come
 * @property string $quit
 * @property int $minutes
 * @property string $date
 * @property int $role_id
 */
class Visit extends Model
{
    use HasFactory;

    const MODEL_TYPE = 'visit';

    public $timestamps = null;

    protected $table = 'visits';

    protected $guarded = [
        'id',
        'user_id'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
