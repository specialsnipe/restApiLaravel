<?php
declare(strict_types=1);

namespace App\Http\Controllers\API\Post;

use App\DTO\Post\CreatePostDTO;
use App\DTO\Post\UpdatePostDTO;
use App\Http\Controllers\API\BaseController;
use App\Service\Post\PostService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use WendellAdriel\ValidatedDTO\Exceptions\CastTargetException;
use WendellAdriel\ValidatedDTO\Exceptions\MissingCastTypeException;

class PostController extends BaseController
{
    public function __construct(private readonly PostService $postService)
    {
    }

    public function index(): JsonResponse
    {
        $posts = $this->postService->getPosts();
        if ($posts->isEmpty()) {
            return $this->sendError('Posts not found');
        }
        return $this->sendResponse($posts->toArray(), 'Posts retrieved successfully.');
    }

    public function show(int $id): JsonResponse
    {
        try {
            $post = $this->postService->getPost($id);
        } catch (ModelNotFoundException) {
            return $this->sendError('Post not found');
        }
        return $this->sendResponse($post->toArray(), 'Posts retrieved successfully.');
    }

    /**
     * @throws CastTargetException
     * @throws MissingCastTypeException
     * @throws ValidationException
     */
    public function create(Request $request): JsonResponse
    {
        $dto = CreatePostDTO::fromRequest($request);
        $post = $this->postService->create($dto);
        return $this->sendResponse($post->toArray(), 'Post created successfully.');
    }

    /**
     * @throws CastTargetException
     * @throws MissingCastTypeException
     * @throws ValidationException
     */
    public function update(Request $request, int $id): JsonResponse
    {
        $dto = UpdatePostDTO::fromRequest($request);
        try {
            $post = $this->postService->update($id, $dto);
        } catch (ModelNotFoundException) {
            return $this->sendError('Post not found');
        }
        return $this->sendResponse($post->toArray(), 'Post updated successfully.');

    }

    public function destroy(int $id): JsonResponse
    {
        $this->postService->delete($id);
        return $this->sendResponse([], 'Post deleted successfully.');
    }
}
