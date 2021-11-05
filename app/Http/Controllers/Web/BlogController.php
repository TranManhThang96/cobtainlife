<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ShopNewsService;
use App\Services\TagService;
use stdClass;

class BlogController extends Controller
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
        $request->per_page = 3;
        $listNews = $this->shopNewService->index($request);
        $recentNews = $this->shopNewService->recentNews($request);
        $archives = $this->shopNewService->archives();
        $tags = $this->tagService->getNewsTags();
        return view('web.pages.blog.blog', compact('listNews', 'recentNews', 'archives', 'tags'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getNewsByType($type, $value)
    {
        $request = new stdClass();
        if ($type === 'tags') {
            $request->tag_alias = $value;
        } else if ($type === 'date') {
            $request->time = $value;
        }
        $request->per_page = 3;
        $listNews = $this->shopNewService->index($request);
        $recentNews = $this->shopNewService->recentNews($request);
        $archives = $this->shopNewService->archives();
        $tags = $this->tagService->getNewsTags();
        return view('web.pages.blog.blog', compact('listNews', 'recentNews', 'archives', 'tags'));
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($alias)
    {
        $news = $this->shopNewService->findByAlias($alias);
        $listNews = $this->shopNewService->index(null);
        $recentNews = $this->shopNewService->recentNews(null);
        $archives = $this->shopNewService->archives();
        $tags = $this->tagService->getNewsTags();
        return view('web.pages.blog.blog_detail', compact('news', 'recentNews', 'archives', 'tags'));
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
