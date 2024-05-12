<?php

namespace App\Services;

use App\Models\Category;

class CategoryService
{
    public function create($data)
    {
        return Category::create($data);
    }

    public function update($category_id, $data)
    {
        return Category::where('category_id','=', $category_id)->update($data);
    }

    public function listQuery()
    {
        $query = Category::orderBy('categories.category_id', 'ASC');
        return $query;
    }

    public function getCategoryBySlug($slug)
    {
        return Category::where('slug', $slug)->firstOrFail();
    }

    public function getAllCategories()
    {
        return Category::all();
    }

    public function getAllCategoryWithPostCount()
    {
        return Category::withCount(['posts' => function ($query) {
            $query->where('status', 'publish');
        }])->get();
    }
}
