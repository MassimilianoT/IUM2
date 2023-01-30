<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Boardgame
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $name
 * @property int $minPlayers
 * @property int $maxPlayers
 * @property string $editor
 * @property string $description
 * @property string|null $thumbprint
 * @property-read \Illuminate\Database\Eloquent\Collection|Boardgame[] $authors
 * @property-read int|null $authors_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Category[] $categories
 * @property-read int|null $categories_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Vote[] $votes
 * @property-read int|null $votes_count
 * @method static \Database\Factories\BoardgameFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Boardgame filter(array $filters)
 * @method static \Illuminate\Database\Eloquent\Builder|Boardgame newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Boardgame newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Boardgame query()
 * @method static \Illuminate\Database\Eloquent\Builder|Boardgame whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Boardgame whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Boardgame whereEditor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Boardgame whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Boardgame whereMaxPlayers($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Boardgame whereMinPlayers($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Boardgame whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Boardgame whereThumbprint($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Boardgame whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Boardgame extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function authors(){
        return $this->belongsToMany(Author::class);
    }

    public function categories(){
        return $this->belongsToMany(Category::class);
    }

    public function votes(){
        return $this->hasMany(Vote::class);
    }

    public function playes(){
        return $this->hasMany(Play::class, 'play_id');
    }

    public function scopeFilter($query, array $filters) {

        $query->when($filters['search'] ?? false, fn($query, $search) =>
            $query->where(fn($query) =>
                $query->where('name', 'like', '%' . $search . '%')
                ->orWhere('description', 'like', '%' . $search . '%')
            )
        );
    }
}
