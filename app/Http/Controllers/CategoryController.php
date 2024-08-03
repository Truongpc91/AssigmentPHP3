<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;

class CategoryController extends Controller
{

    const PATH_VIEW = 'categories.';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // pageginate(Hàm phân trang)
        // latest(giá trị mới nhất lên đầu)
        $data = Category::query()->latest(  )->paginate(5);

        // dd($data->toArray());

        //compact() :  Đẩy data ra ngoài view
        return view(self::PATH_VIEW . __FUNCTION__, compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view(self::PATH_VIEW . __FUNCTION__);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        Category::query()->create($request->all());


        //width : dạng SESSION FLASH
        return redirect()
            ->route('categories.index')
            ->with('msg','Thao tác thành công!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        
        return view(self::PATH_VIEW . __FUNCTION__,compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    //Tư lấy dữ liệu
    public function edit(Category $category)
    {
        return view(self::PATH_VIEW . __FUNCTION__,compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $category->update($request->all());

        return back()->with('msg', 'Thao tác thành công!');
        // return view(self::PATH_VIEW . __FUNCTION__);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        
        return back()->with('msg', 'Thao tác thành công!');
    }
}
