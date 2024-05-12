<?php

namespace App\DataTables;

use App\Models\User;
use App\Services\UserService;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Services\DataTable;

class UserDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        if(!empty(request('company_id'))){
            $query = $query->where('users.company_id', request('company_id'));
        }

        $dataTable = new EloquentDataTable($query);
        $dataTable->addColumn('role_name', function (User $data) {
            return optional($data->role)->name;
        })
        ->addColumn('company_name', function (User $data) {
            return optional($data->company)->name;
        })
        ->addColumn('store_names', function (User $data) {
            return optional($data->user_stores)->pluck('location_name')->implode(',');
        })
        ->addColumn('creator_name', function (User $data) {
            return optional($data->creator)->name;
        })
        ->addColumn('status', function (User $data) {
            return $data->status ? 'Active' :'In-Active';
        })
        ->editColumn('created_at', function (User $data) {
            return dateFormat($data->created_at);
        })
        ->addColumn('action', function (User $data) {
            return '<a href="' . route('users.edit', ['user_id' => $data->user_id]) . '" class="btn btn-sm btn-outline-primary"><i class="ri-pencil-line"></i> '. trans("translation.edit") .'</a>';
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
    public function query(UserService $UserService)
    {
        return $UserService->listQuery();
    }

    /**
     * Optional method if you want to use html builder.
     * @return Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('users-table')
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
                'data' => 'user_id',
                'title' => 'ID',
            ],
            [
                'data' => 'dni',
                'title' => 'DNI',
            ],
            [
                'data' => 'name',
                'title' => 'Name',
            ],
            [
                'data' => 'role_name',
                'title' => 'Role',
            ],
            [
                'data' => 'company_name',
                'title' => 'Company',
            ],
            [
                'data' => 'store_names',
                'title' => 'Stores',
            ],
            [
                'data' => 'status',
                'title' => 'Status',
            ],
            [
                'data' => 'created_at',
                'title' => 'Creation',
            ],
            [
                'data' => 'creator_name',
                'title' => 'Registered By',
            ],
            [
                'data' => 'action',
                'title' => 'Action',
            ],
        ];
        return $columns;
    }
}
