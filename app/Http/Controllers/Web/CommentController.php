<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Services\ShopCommentService;
use Illuminate\Http\Request;
use App\Http\Requests\Web\ShopCommentRequest;
use Symfony\Component\HttpFoundation\Response;
use Jenssegers\Agent\Agent;

class CommentController extends Controller
{

    public function __construct(
        ShopCommentService $shopCommentService
    )
    {
        $this->agent = new Agent();
        $this->shopCommentService = $shopCommentService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(ShopCommentRequest $request)
    {
        $this->agent->setUserAgent($request->userAgent());
        $params = $request->all();
        $params['user_agent'] = $request->userAgent();
        $params['device_type'] = $this->agent->device();
        $params['ip_address'] = $request->getClientIp();
        $comment = $this->shopCommentService->store($params);
        if ($comment) {
            return $this->apiSendSuccess($comment, Response::HTTP_OK, 'Thêm bình luận thành công!');
        }
        return $this->apiSendError(null, Response::HTTP_BAD_REQUEST, 'Thêm bình luận thất bại');
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
        //
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
        //
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
