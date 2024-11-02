<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Website\BannerRequest;
use App\Http\Requests\Website\CreateNewsRequest;
use App\Http\Requests\Website\IntroduceRequest;
use App\Http\Requests\Website\UpdateNewsRequest;
use App\Models\Banner;
use App\Models\Introduce;
use App\Models\News;
use App\Models\Staff;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WebsiteController extends Controller
{
    protected $banner, $introduce, $news;

    public function __construct(Banner $banner, Introduce $introduce, News $news)
    {
        $this->banner = $banner;
        $this->introduce = $introduce;
        $this->news = $news;
    }

    public function indexBanner(Request $request)
    {
        $banners =  $this->banner->all();
        $staff = Staff::find(Auth::user()->userable_id);
        return view('admin.website.banner', compact('banners', 'staff'));
    }

    public function createBanner()
    {
        $staff = Staff::find(Auth::user()->userable_id);
        return view('admin.website.banner-create', compact('staff'));
    }

    public function storeBanner(BannerRequest $request)
    {
        $dataCreate = $request->all();
        $dataCreate['img'] = $this->banner->saveImage($request);
        $banner = $this->banner->create($dataCreate);
        return to_route('website.banners.index');
    }

    public function destroyBanner($id)
    {
        $banner = $this->banner->findOrFail($id);
        $imageName = $banner->img ? $banner->img : '';
        $banner->delete();
        $this->banner->deleteImage($imageName);
        return to_route('website.banners.index');
    }

    public function showIntroduce()
    {
        $introduce = $this->introduce->first();
        $staff = Staff::find(Auth::user()->userable_id);
        return view('admin.website.introduce', compact('introduce', 'staff'));
    }

    public function editIntroduce()
    {
        $introduce = $this->introduce->first();
        $staff = Staff::find(Auth::user()->userable_id);
        return view('admin.website.introduce-edit', compact('introduce', 'staff'));
    }

    public function updateIntroduce(IntroduceRequest $request)
    {
        $introduce = $this->introduce->first();
        $dataUpdate = $request->all();
        $introduce->update($dataUpdate);
        return to_route('website.introduce.index');
    }

    public function indexNews(Request $request)
    {
        $query = $this->news->latest('id');
        if ($request->has('search') && !empty($request->search)) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $news = $query->paginate(10);
        $staff = Staff::find(Auth::user()->userable_id);
        return view('admin.website.newslist', compact('news', 'staff'))->with('search', $request->search);
    }

    public function showNews($id)
    {
        $news = $this->news->findOrFail($id);
        $staff = Staff::find(Auth::user()->userable_id);
        $poster = $staff->name;
        return view('admin.website.news-detail', compact('news', 'staff', 'poster'));
    }

    public function createNews()
    {
        $staff = Staff::find(Auth::user()->userable_id);
        return view('admin.website.news-create', compact('staff'));
    }

    public function storeNews(CreateNewsRequest $request)
    {
        $dataCreate = $request->all();
        $dataCreate['img'] = $this->banner->saveImage($request);
        $news = $this->news->create($dataCreate);
        return to_route('website.news.index');
    }

    public function editNews($id)
    {
        $staff = Staff::find(Auth::user()->userable_id);
        $news = $this->news->findOrFail($id);
        return view('admin.website.news-edit', compact('news', 'staff'));
    }

    public function updateNews(UpdateNewsRequest $request, $id)
    {
        $news = $this->news->findOrFail($id);
        $dataUpdate = $request->all();
        $currentImange = $news->img ? $news->img : '';
        $dataUpdate['img'] = $this->news->updateImage($request, $currentImange);
        $dataUpdate['highlight'] = $request->has('highlight') ? true : false;
        $news->update($dataUpdate);
        return to_route('website.news.index');
    }

    public function destroyNews($id)
    {
        $news = $this->news->findOrFail($id);
        $imageName = $news->img ? $news->img : '';
        $news->delete();
        $this->news->deleteImage($imageName);
        return to_route('website.news.index');
    }
}
