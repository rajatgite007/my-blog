<?php

namespace App\Services;

use App\Models\Tag;

class TagService
{
    public function create($data)
    {
        return Tag::create($data);
    }

    public function update($tag_id, $data)
    {
        return Tag::where('tag_id','=', $tag_id)->update($data);
    }

    public function listQuery()
    {
        $query = Tag::orderBy('tags.tag_id', 'ASC');
        return $query;
    }

    public function getViewByTag($slug)
    {
        return Tag::where('slug', $slug)->firstOrFail();
    }

    public function getAllTags()
    {
        return Tag::all();
    }
}
