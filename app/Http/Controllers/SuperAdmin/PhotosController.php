<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Photos\CreateRequest;
use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class PhotosController extends Controller
{
    public function index()
    {
        $photos = Photo::get();
        return view('admin.photos.index')->with('photos', $photos);
    }

    public function create()
    {
        return view('admin.photos.create');
    }

    public function store(CreateRequest $request)
    {
        DB::beginTransaction();

        $user = $request->user();
        $photo = $user->photos()->create($request->all());
        if (!$request->is_active) {
            $photo->update(['is_active' => 0]);
            $photo->save();
        }

        if ($request->file('images')) {
            foreach ($request->file('images') as $image) {
                $name = strtotime(now()) . $image->getClientOriginalName();
                $image->move(public_path() . '/images/', $name);
                $data[] = $name;
            }
            $photo->images = $data;
            $photo->save();
        }

        DB::commit();
        return redirect()->route('admin.photos.index')->with('message', 'Photo Created Successfully')->with('message_type', 'info');
    }

    public function show($id)
    {
        //
    }

    public function edit(Photo $photo)
    {
        return view('admin.photos.edit')->with('photo', $photo);
    }

    public function update(CreateRequest $request, Photo $photo)
    {
        DB::beginTransaction();

        if ($photo->images == true && $request->images) {
            foreach ($photo->images as $image) {
                if ($image) {
                    if (file_exists(public_path() . '/images/' . $image)) {
                        unlink(public_path() . '/images/' . $image);
                    };
                }
            }
        }

        if (!$request->is_active) {
            $photo->update(['is_active' => 0]);
            $photo->save();
        }

        $photo->update($request->all());
        $photo->save();

        if ($request->file('images')) {
            foreach ($request->file('images') as $image) {
                $name = strtotime(now()) . $image->getClientOriginalName();
                $image->move(public_path() . '/images/', $name);
                $data[] = $name;
            }
            $photo->images = $data;
            $photo->save();
        }

        return redirect('admin/photos')->with('message', 'Photo Updated Successfully')->with('message_type', 'info');
    }

    public function destroy(Photo $photo)
    {
        $photo->delete();
        return redirect()->back()->with('message', 'Photo Deleted Successfully')->with('message_type', 'error');
    }
}
