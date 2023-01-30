<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Vote
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $user_id
 * @property int $boardgame_id
 * @property int $vote
 * @property-read \App\Models\Boardgame $boardgame
 * @property-read \App\Models\User $user
 * @method static \Database\Factories\VoteFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Vote newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Vote newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Vote query()
 * @method static \Illuminate\Database\Eloquent\Builder|Vote whereBoardgameId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vote whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vote whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vote whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vote whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vote whereVote($value)
 * @mixin \Eloquent
 */
class Vote extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function boardgame(){
        return $this->belongsTo(Boardgame::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
