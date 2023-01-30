<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\PlayUser
 *
 * @property int $play_id
 * @property int $user_id
 * @method static \Database\Factories\PlayUserFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|PlayUser newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PlayUser newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PlayUser query()
 * @method static \Illuminate\Database\Eloquent\Builder|PlayUser wherePlayId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlayUser whereUserId($value)
 * @mixin \Eloquent
 */
class PlayUser extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'play_user';

    protected $guarded = [];
}
