<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Play
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $winner_id
 * @property string $date
 * @property int $boardgame_id
 * @method static \Database\Factories\PlayFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Play newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Play newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Play query()
 * @method static \Illuminate\Database\Eloquent\Builder|Play whereBoardgameId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Play whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Play whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Play whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Play whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Play whereWinnerId($value)
 * @mixin \Eloquent
 */
class Play extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function players(){
        return $this->belongsToMany(User::class);
    }

    public function winner(){
        return $this->belongsTo(User::class);
    }

    public function boardgame(){
        return $this->belongsTo(Boardgame::class);
    }
}
