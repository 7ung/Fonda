<?php

namespace App\Http\Controllers;

use App\Model\Comment;
use App\Model\Fonda;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Input;
use Responses\ResponseBuilder;
use Responses\ResponseJsonBadRequest;

require_once __DIR__.'/../../Responses/_loader.php';

class CommentController extends Controller
{
    function __construct()
    {
        $this->middleware('auth_user', ['only' => ['store', 'update', 'destroy']]);
        $this->middleware('comment_res', ['only' => ['update', 'destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return array
     */
    public function index()
    {
        $fonda = \Route::current()->fonda;
        $rs = $fonda->comments()
            ->orderBy('datetime', 'desc')
            ->paginate(Comment::$paging);
        return ResponseBuilder::build($rs->toArray());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function store(Request $request)
    {
        $content = Input::get('content');
        $fondaId = Input::get('fonda_id');

        if (empty($content))
            return ResponseJsonBadRequest::responseBadRequest(40026);
        if (empty($fondaId))
            return ResponseJsonBadRequest::responseBadRequest(40027);
        $fonda = Fonda::find($fondaId);
        if ($fonda == null)
            return ResponseJsonBadRequest::responseBadRequest(40410);

        $comment = new Comment();
        $comment->content = $content;
        $comment->datetime = $_SERVER['REQUEST_TIME'];
        $comment->user_id = $request->route()->user->id;
        $comment->fonda_id = $fondaId;
        $comment->save();
        return ResponseBuilder::build($comment, 200, 'Create success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return array
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return array
     */
    public function update(Request $request, $id)
    {
        $content = Input::get('content');
        if (empty($content))
            return ResponseJsonBadRequest::responseBadRequest(40026);
        $comment = \Route::current()->comment;
        $comment->content = $content;
        $comment->save();
        return ResponseBuilder::build($comment, 200, 'Update success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return array
     */
    public function destroy($id)
    {
        $comment = \Route::current()->comment;
        $comment->delete();
        return ResponseBuilder::build(null, 200, 'Delete success');
    }
}
