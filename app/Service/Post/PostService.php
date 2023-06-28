<?php
declare(strict_types=1);

namespace App\Service\Post;

use App\DTO\Post\CreatePostDTO;
use App\DTO\Post\UpdatePostDTO;
use App\Models\Post;
use App\Repository\PostRepository;
use Illuminate\Database\Eloquent\Collection;

class PostService
{
    public function __construct(private readonly PostRepository $postRepository)
    {
    }

    /**
     * @return Collection<Post>
     */
    public function getPosts(): Collection
    {
        return $this->postRepository->getAll();
    }

    public function getPost(int $id): Post
    {
        return $this->postRepository->findById($id);
    }

    public function create(CreatePostDTO $dto): Post
    {
        return $this->postRepository->create($dto);
    }

    public function update(int $id, UpdatePostDTO $dto): Post
    {
        return $this->postRepository->updateById($id, $dto);
    }

    public function delete(int $id): void
    {
        $this->postRepository->deleteById($id);
    }
}
