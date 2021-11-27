<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\ShopCommentService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CommentController extends Controller
{
    public function __construct(
        ShopCommentService $shopCommentService
    )
    {
        $this->shopCommentService = $shopCommentService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $comments = $this->shopCommentService->index($request);
        return view('admin.pages.comments.index', compact('comments'));
    }

    public function search(Request $request)
    {
        $comments = $this->shopCommentService->index($request);
        $view = view('admin.pages.comments.list', compact('comments'))->render();
        return $this->apiSendSuccess($view, Response::HTTP_OK);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    public function reply(Request $request)
    {
        $params = $request->all();
        $params['customer_name'] = 'Admin';
        $params['customer_email'] = 'cobtainlife@gmail.com';
        $params['customer_website'] = 'https://cobtainlife.com';
        $comment = $this->shopCommentService->store($params);
        if ($comment) {
            return $this->apiSendSuccess($comment, Response::HTTP_OK, 'Trả lời thành công!');
        }
        return $this->apiSendError(null, Response::HTTP_BAD_REQUEST, 'Trả lời thất bại');
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
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $comment = $this->shopCommentService->find($id);
        $view = view('admin.pages.comments.reply', compact('comment'))->render();
        return $this->apiSendSuccess($view, Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $result = $this->shopCommentService->update($id, $request->all());
        if ($result) {
            return $this->apiSendSuccess(null, Response::HTTP_OK, 'Cập nhật thành công!');
        }
        return $this->apiSendError(null, Response::HTTP_BAD_REQUEST, 'Cập nhật thất bại!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
