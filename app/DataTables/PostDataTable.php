<?php

namespace App\DataTables;

use App\Models\Post;
use App\Services\PostService;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Services\DataTable;

class PostDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);

        $dataTable->editColumn('description', function (Post $data) {
            return readMore( strip_tags( $data->description ) );
        })
        ->addColumn('action', function (Post $data) {
            return '<a href="" class="btn btn-sm btn-outline-primary"><i class="ri-pencil-line"></i>Edit</a>';
        });

        $columns = array_column($this->getColumns(), 'data');
        $dataTable->rawColumns($columns);
        return $dataTable;
    }

    /**
     * Get query source of dataTable.
     *
     * @param Product $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(PostService $postService)
    {
        return $postService->listQuery();
    }

    /**
     * Optional method if you want to use html builder.
     * @return Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('posts-table')
            ->columns($this->getColumns())
            ->minifiedAjax();
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        $columns = [
            [
                'data' => 'post_id',
                'title' => 'ID',
            ],
            [
                'data' => 'title',
                'title' => 'Title',
            ],
            [
                'data' => 'description',
                'title' => 'Description',
            ],
            [
                'data' => 'action',
                'title' => 'Action',
            ],
        ];
        return $columns;
    }
}
