<?php


namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\DataTables\CategoryDataTable;
use App\Services\CategoryService;
use Illuminate\Database\QueryException;

class CategoryController extends Controller
{
    private $CategoryDataTable;
    private $CategoryService;

    public function __construct (

        CategoryDataTable $categoryDataTable,
        CategoryService $categoryService,

    ) {
        $this->categoryDataTable = $categoryDataTable;
        $this->categoryService = $categoryService;
    }

    /**
     * Display the posts index page.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return mixed
     */
    public function index(Request $request)
    {
        return $this->categoryDataTable->render('backend.post.index');
    }

    /**
     * Show the form for creating a new post.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function create( Request $request )
    {
    	return view( 'backend.post.create', get_defined_vars() );	
    }
}