<?php


namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\DataTables\PostDataTable;
use App\Services\PostService;
use App\Services\TagService;
use App\Services\CategoryService;
use Illuminate\Database\QueryException;
use HTMLPurifier;
use Carbon\Carbon;

class PostController extends Controller
{
    private $PostDataTable;
    private $PostService;

    public function __construct (

        PostDataTable $postDataTable,
        PostService $postService,
        CategoryService $categoryService,
        TagService $tagService,

    ) {
        $this->postDataTable = $postDataTable;
        $this->postService = $postService;
        $this->categoryService = $categoryService;
        $this->tagService = $tagService;
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
        return $this->postDataTable->render('backend.post.index');
    }

    /**
     * Show the form for creating a new post.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function create( Request $request )
    {
        $categories = $this->categoryService->getAllCategories();
        $tags = $this->tagService->getAllTags();
    	return view( 'backend.post.create', compact( 'categories', 'tags' ) );	
    }

    public function store( Request $request )
    {
        try {

            DB::beginTransaction();

            $input = $request->all();
            $purifier = new HTMLPurifier();
            $title = $input['title'];
            $description = $purifier->purify($input['description']);
            $slug = generateSlug($title);
            $categoryIds = $input['category'];
            $tagIds = $input['tag'];

            $currentDateTime = Carbon::now();
           $scheduledDateTime = Carbon::createFromFormat('Y-m-d H:i:s', $input['date'] . ' ' . $input['time'] . ':00');
            $status = $scheduledDateTime->isFuture() ? 'draft' : 'publish';

            // Handle file upload
            if ($request->hasFile('post_img')) {
                $image = $request->file('post_img');
                $originName = $image->getClientOriginalName();
                $fileName = pathinfo($originName, PATHINFO_FILENAME);
                $extension = $image->getClientOriginalExtension();
                $imageUrl = $fileName . '.' . $extension;
            } else {
                $imageUrl = null;
            }

            $data = [
                'title' => $title,
                'description' => $description,
                'slug' => $slug,
                'user_id' => authUserId(),
                'img_path' => $imageUrl,
                'scheduled_at' => $scheduledDateTime->toDateTimeString(),
                'status' => $status,
            ];
            $post = $this->postService->create($data);

            if ($post && $post->post_id) {
                $post->categories()->attach($categoryIds);
                $post->tags()->attach($tagIds);
            }

            DB::commit();

            return redirect()->route('admin.posts')->with('success', 'Post created succssfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return Redirect::back()->with('error', $e->getMessage())->withInput();
        }
    }
}