<?php
declare(strict_types=1);

namespace App\Repository;

use App\DTO\Post\CreatePostDTO;
use App\DTO\Post\UpdatePostDTO;
use App\Models\Post;
use Illuminate\Database\Eloquent\Collection;

class PostRepository
{
    /**
     * @return Collection<Post>
     */
    public function getAll(): Collection
    {
        return Post::all();
    }
    public function findById(int $id): Post
    {
        return Post::findOrFail($id);
    }

    public function create(CreatePostDTO $dto): Post
    {
       return Post::create($dto->toArray());
    }

    public function updateById(int $id, UpdatePostDTO $dto): Post
    {
        $post = Post::findOrFail($id);
        $post->update($dto->toArray());
        return $post;
    }
    public function deleteById(int $id): void
    {
        Post::destroy($id);
    }
}
