<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\slider;
use App\Http\Requests\StoresliderRequest;
use App\Http\Requests\UpdatesliderRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    const PATH_VIEW = 'admin.banners.';
    const PATH_UPLOAD = 'banners';

    public function index()
    {
        $data = slider::query()->get();

        // dd($data);

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
    public function store(Request $request)
    {
        // dd($request);

        $data = $request->except(['_token', 'image']);

        // $data['is_active'] = $data['is_active'] ?? 0;
        // dd($data);

        if ($request->hasFile('image')) {
            $data['image'] = Storage::put(self::PATH_UPLOAD, $request->file('image'));
        }

        // dd($data);

        slider::query()->create($data);

        return redirect()->route('admin.banners.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(slider $slider)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(slider $slider)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatesliderRequest $request, slider $slider)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(slider $slider)
    {
        //
    }

    public function changeStatus(string $id)
    {
        $model = slider::query()->where('id', $id)->first();

        // dd($data);

        if ($model->status == 1) {

            $data = [
                'name' => $model->name,
                'image' => $model->image,
                'description' => $model->description,
                'status' => 0
            ];

            // dd($data);

            $model->update($data);
        }
        else if ($model->status == 0) {

            $data = [
                'name' => $model->name,
                'image' => $model->image,
                'description' => $model->description,
                'status' => 1
            ];

            $model->update($data);

        }

        return redirect()->route('admin.banners.index');
    }
}
