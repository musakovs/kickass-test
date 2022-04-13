<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'news';

    protected $fillable = ['external_id', 'title', 'link', 'points', 'postCreated'];
}
