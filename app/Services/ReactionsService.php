<?php

namespace App\Services;

use App\Models\Reactions;

class ReactionsService
{
    public function create($data)
    {
        return Reactions::create($data);
    }
}
