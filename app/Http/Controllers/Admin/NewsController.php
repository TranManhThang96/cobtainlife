<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\NewsRequest;
use App\Services\ShopNewsService;
use App\Services\TagService;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class NewsController extends Controller
{
    public function __construct(
        ShopNewsService $shopNewsService,
        TagService $tagService
    )
    {
        $this->shopNewService = $shopNewsService;
        $this->tagService = $tagService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $listNews = $this->shopNewService->index($request);
        return view('admin.pages.news.index', compact('listNews'));
    }


    public function search(Request $request)
    {
        $listNews = $this->shopNewService->index($request);
        $view = view('admin.pages.news.list', compact('listNews'))->render();
        return $this->apiSendSuccess($view, Response::HTTP_OK);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = $this->tagService->all();
        return view('admin.pages.news.add', compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NewsRequest $request)
    {
        $params = $request->all();
        $params['title'] = ucwords(strtolower($params['title']));

        // auto create alias by name.
        $alias = Str::slug($params['title'], '-');
        $params['alias'] = $alias;

        // get the number of alias that already exist.
        $aliasExist = $this->shopNewService->checkAliasExist($alias);
        if ($aliasExist) {
            $countAlias = $this->shopNewService->getCountAliasLikeName($alias);
            $params['alias'] = $alias . '-' . ($countAlias + 1);
        }

        // create tags if not exist
        $tags = $this->tagService->syncTag($request->tags);
        $params['tags'] = $tags;

        $news = $this->shopNewService->store($params);
        if ($news) {
            toastr()->success('Thêm bài viết thành công!', '', [
                'positionClass' => 'toast-top-center',
            ]);
            return redirect()->route('admin.news.index');
        }
        toastr()->error('Thêm bài viết thất bại!', '', [
            'positionClass' => 'toast-top-center',
        ]);
        return redirect()->back()->withInput();
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
        $news = $this->shopNewService->find($id);
        $tags = $this->tagService->all();
        return view('admin.pages.news.edit', compact('news', 'tags'));
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
        $params = $request->all();
        $params['title'] = ucwords(strtolower($params['title']));

        // auto create alias by name.
        $alias = Str::slug($params['title'], '-');
        $params['alias'] = $alias;

        // get the number of alias that already exist.
        $aliasExist = $this->shopNewService->checkAliasExist($alias, $id);
        if ($aliasExist) {
            $countAlias = $this->shopNewService->getCountAliasLikeName($alias, $id);
            $params['alias'] = $alias . '-' . ($countAlias + 1);
        }

        if (!isset($params['status'])) {
            $params['status'] = 0;
        }

        // create tags if not exist
        $tags = $this->tagService->syncTag($request->tags);
        $params['tags'] = $tags;

        $result = $this->shopNewService->update($id, $params);
        if ($result) {
            toastr()->success('Sửa bài viết thành công!', '', [
                'positionClass' => 'toast-top-center',
            ]);
            return redirect()->route('admin.news.index');
        }
        toastr()->error('Sửa bài viết thất bại!', '', [
            'positionClass' => 'toast-top-center',
        ]);
        return redirect()->back()->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $isDeleted = $this->shopNewService->delete($id);
        if ($isDeleted) {
            return $this->apiSendSuccess($isDeleted, Response::HTTP_OK, 'Bài viết đã được xóa');
        }
        return $this->apiSendError(null, Response::HTTP_BAD_REQUEST, 'Xóa bài viết bị lỗi');
    }
}
