<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\BoardgameCategory
 *
 * @property int $boardgame_id
 * @property int $category_id
 * @method static \Database\Factories\BoardgameCategoryFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|BoardgameCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BoardgameCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BoardgameCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder|BoardgameCategory whereBoardgameId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BoardgameCategory whereCategoryId($value)
 * @mixin \Eloquent
 */
class BoardgameCategory extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'boardgame_category';

    protected $guarded = [];
}
