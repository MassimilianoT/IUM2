<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\AuthorBoardgame
 *
 * @property int $author_id
 * @property int $boardgame_id
 * @method static \Database\Factories\AuthorBoardgameFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|AuthorBoardgame newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AuthorBoardgame newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AuthorBoardgame query()
 * @method static \Illuminate\Database\Eloquent\Builder|AuthorBoardgame whereAuthorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AuthorBoardgame whereBoardgameId($value)
 * @mixin \Eloquent
 */
class AuthorBoardgame extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'author_boardgame';

    protected $guarded = [];
}
