<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\News;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NewsController extends Controller
{
    protected $news;
    public function __construct(News $news)
    {
        $this->news = $news;
    }
    public function show($id)
    {

        $news = $this->news->findOrFail($id);
        $staff = Staff::findOrFail($news->staff_id);
        $poster = $staff->name;

        if (Auth::check() && Auth::user()->userable_type === Customer::class) {
            $customer = Customer::find(Auth::user()->userable_id);
            return view('client.home.news', compact('news', 'poster', 'customer'));
        }

        return view('client.home.news', compact('news', 'poster'));
    }

    public function showAll()
    {
        $query = $this->news->latest('id');
        $news = $query->paginate(20);
        if (Auth::check() && Auth::user()->userable_type === Customer::class) {
            $customer = Customer::find(Auth::user()->userable_id);
            return view('client.home.allnews', compact('news', 'customer'));
        }
        return view('client.home.allnews', compact('news'));
    }
}
