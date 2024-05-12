<?php


namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Services\PostService;
use App\Services\TagService;
use App\Services\CategoryService;
use App\Services\CommentServices;
use App\Services\ReactionsService;


use Illuminate\Database\QueryException;

class PostController extends Controller
{
    private $PostService;
    private $categoryService;
    private $tagService;
    private $commentServices;
    private $reactionsService;

    public function __construct (

        CommentServices $commentServices,
        PostService $postService,
        CategoryService $categoryService,
        TagService $tagService,
        ReactionsService $reactionsService,

    ) {
        $this->commentServices = $commentServices;
        $this->postService = $postService;
        $this->categoryService = $categoryService;
        $this->tagService = $tagService;
        $this->reactionsService = $reactionsService;
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
        $getPublishedPosts = $this->postService->getPublishedPost();
        $categoriesWithCount = $this->categoryService->getAllCategoryWithPostCount();
        return view( 'frontend.post.index', compact('getPublishedPosts','categoriesWithCount') );
    }

    /**
     * Display the posts view page.
     *
     */
    public function view($slug)
    {
        if ( $slug ) {
            $getPost = $this->postService->getPostBySlug( $slug );
            if ( $getPost ) {
                $reactionArr = ['like', 'love', 'haha', 'wow', 'sad', 'angry'];
                $categoriesWithCount = $this->categoryService->getAllCategoryWithPostCount();
                return view( 'frontend.post.view', compact('getPost','categoriesWithCount','reactionArr') );        
            }
        }
        abort(404);
    }

    /**
     * Display the posts view page by category slug.
     *
     */
    public function viewByCategory($slug)
    {

        if ( $slug ) {
            $category = $this->categoryService->getCategoryBySlug( $slug );
            $getPublishedPosts = $category->posts()->get();
            $categoriesWithCount = $this->categoryService->getAllCategoryWithPostCount();
            return view( 'frontend.post.index', compact('getPublishedPosts','categoriesWithCount') );
        }
        abort(404);
    }

    /**
     * Display the posts view page by tag slug.
     *
     */
    public function postTag($slug)
    {

        if ( $slug ) {
            $tag = $this->tagService->getViewByTag( $slug );
            $getPublishedPosts = $tag->posts()->get();
            $categoriesWithCount = $this->categoryService->getAllCategoryWithPostCount();
            return view( 'frontend.post.index', compact('getPublishedPosts','categoriesWithCount') );
        }
        abort(404);
    }

    /**
     * add post comment.
     *
     */
    public function postComment( Request $request )
    {
        $input = $request->all();
        $comment = $input['comment'];
        $post_id = $input['post_id'];
        $parent_id = ( isset( $input['comment_id'] ) ) ? $input['comment_id'] : null;
        $data = [
            'comment' => strip_tags( $comment ),
            'post_id' => $post_id,
            'user_id' => authUserId() ?? null,
            'parent_id' => $parent_id
        ];
        $comment = $this->commentServices->create( $data );
        if ( $comment ) {
            return redirect()->back()->with('success', 'Comment added successfully.');    
        }
        return redirect()->back()->with('error', 'Something went wrong.');
    }

    /**
     * Add post reaction.
     *
     */
    public function postReaction ( $post_id, $reaction ) {

        $data = [
            'post_id' => $post_id,
            'user_id' => authUserId() ?? null,
            'reaction_type' => $reaction
        ];
        $reaction = $this->reactionsService->create( $data );

        if ( $reaction ) {
            return redirect()->back()->with('success', 'Reacted successfully.');    
        }
        return redirect()->back()->with('error', 'Something went wrong.');
    }

}