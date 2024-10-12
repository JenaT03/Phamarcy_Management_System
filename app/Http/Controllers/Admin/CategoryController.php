<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Categories\CreateCategoryRequest;
use App\Http\Requests\Categories\UpdateCategoryRequest;
use App\Models\Category;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    protected $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = $this->category->latest('id');
        if ($request->has('search') && !empty($request->search)) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $categories = $query->paginate(10);
        $staff = Staff::find(Auth::user()->userable_id);
        return view('admin.categories.index', compact('categories', 'staff'))->with('search', $request->search);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $staff = Staff::find(Auth::user()->userable_id);
        return view('admin.categories.create', compact('staff'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCategoryRequest $request)
    {
        $dataCreate = $request->all();
        $category = $this->category->create($dataCreate);
        return to_route('categories.index')->with(['message' => 'Thêm loại sản phẩm mới thành công']);
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
        $category = $this->category->findOrFail($id);
        $staff = Staff::find(Auth::user()->userable_id);
        return view('admin.categories.edit', compact('category', 'staff'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request, $id)
    {
        $dataUpdate = $request->all();
        $category = $this->category->findOrFail($id);
        if (!$category->update($dataUpdate)) {
            return back()->withErrors(['error' => 'Cập nhật thông tin loại sản phẩm thất bại.']);
        }
        return to_route('categories.index')->with(['message' => 'Cập nhật thông tin loại sản phẩm thành công']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = $this->category->findOrFail($id);
        if (! $category->delete()) {
            return back()->withErrors(['error' => 'Xóa loại sản phẩm thất bại.']);
        }

        return to_route('categories.index')->with(['message' => 'Xóa loại sản phẩm thành công']);
    }
}
