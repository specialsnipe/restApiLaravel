<?php

namespace App\DTO\Post;

use WendellAdriel\ValidatedDTO\ValidatedDTO;

class CreatePostDTO extends ValidatedDTO
{
    protected function defaults(): array
    {
        return [];
    }

    protected function casts(): array
    {
        return [];
    }

    protected function rules(): array
    {
        return [
            'name' => 'required|string',
            'body' => 'required|string',
        ];
    }
}
