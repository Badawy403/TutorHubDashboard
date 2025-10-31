<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Medias\CreateRequest;
use App\Models\Media;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class MediasController extends Controller
{
    public function index()
    {
        $medias = Media::get();
        return view('admin.medias.index')->with('medias', $medias);
    }

    public function create()
    {
        $categories = Category::where('category_type','media')->active()->orderBy('name','asc')->get();
        return view('admin.medias.create')->with('categories', $categories);
    }

    public function store(CreateRequest $request)
    {
        $rules = [
            'images' => 'required',
        ];
        $request->validate($rules);

        DB::beginTransaction();
        $user = $request->user();
        $media = $user->medias()->create($request->all());
        if (!$request->is_active) {
            $media->update(['is_active' => 0]);
            $media->save();
        }
        if ($request->file('images')) {
            foreach ($request->file('images') as $image) {
                $name = strtotime(now()) . $image->getClientOriginalName();
                $image->move(public_path() . '/images/', $name);
                $data[] = $name;
            }
            $media->images = $data;
            $media->save();
        }

        DB::commit();
        return redirect()->route('admin.medias.index')->with('message', 'Media Created Successfully')->with('message_type', 'info');
    }

    public function show($id)
    {
        //
    }

    public function edit(Media $media)
    {
        $categories = Category::where('category_type','media')->active()->get();
        return view('admin.medias.edit')->with('media', $media)->with('categories', $categories);
    }

    public function update(CreateRequest $request, Media $media)
    {
        DB::beginTransaction();

        if ($media->images == true && $request->images) {
            foreach ($media->images as $image) {
                if ($image) {
                    if (file_exists(public_path() . '/images/' . $image)) {
                        unlink(public_path() . '/images/' . $image);
                    };
                }
            }
        }

        if (!$request->is_active) {
            $media->update(['is_active' => 0]);
            $media->save();
        }

        $media->update($request->all());
        $media->save();

        if ($request->file('images')) {
            foreach ($request->file('images') as $image) {
                $name = strtotime(now()) . $image->getClientOriginalName();
                $image->move(public_path() . '/images/', $name);
                $data[] = $name;
            }

            $media->images = $data;
            $media->save();
        }

        return redirect('admin/medias')->with('message', 'Media Updated Successfully')->with('message_type', 'info');
    }

    public function destroy(Media $media)
    {
        $media->delete();
        return redirect()->back()->with('message', 'Media Deleted Successfully')->with('message_type', 'error');
    }
}
