<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Post;

class NewsRepository
{
    public function getByExternalIdOrNew(int $id, array $data): Post
    {
        $post = Post::query()->firstOrNew(['external_id' => $id], $data);

        $post->mergeFillable($data);

        /**@var $post Post */
        return $post;
    }

    public function save(Post $post)
    {
        $post->save();
    }
}
