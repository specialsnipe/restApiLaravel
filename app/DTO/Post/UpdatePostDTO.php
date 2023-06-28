<?php

namespace App\DTO\Post;

use WendellAdriel\ValidatedDTO\ValidatedDTO;

class UpdatePostDTO extends ValidatedDTO
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
            'name' => 'string',
            'body' => 'string',
        ];
    }
}
