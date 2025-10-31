<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Exports\SuperAdmin\TagsExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\SuperAdmin\Tags\CreateRequest;
use App\Http\Requests\ImportRequest;
use App\Imports\SuperAdmin\TagsImport;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class TagsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /********* Getter For Pagination, Searching And Sorting  ***********/
    public function getter($req = null, $export = null)
    {
        if ($req != null) {
            $tags =  Tag::withAll();
            if ($req->trash && $req->trash == 'with') {
                $tags =  $tags->withTrashed();
            }
            if ($req->trash && $req->trash == 'only') {
                $tags =  $tags->onlyTrashed();
            }
            if ($req->column && $req->column != null && $req->search != null) {
                $tags = $tags->whereLike($req->column, $req->search);
            } else if ($req->search && $req->search != null) {

                $tags = $tags->whereLike(['name', 'description'], $req->search);
            }
            if ($req->sort_field != null && $req->sort_type != null) {
                $tags = $tags->OrderBy($req->sort_field, $req->sort_type);
            } else {
                $tags = $tags->OrderBy('id', 'desc');
            }
            if ($export != null) { // for export do not paginate
                $tags = $tags->get();
                return $tags;
            }
            $tags = $tags->get();
            return $tags;
        }
        $tags = Tag::withAll()->orderBy('id', 'desc')->get();
        return $tags;
    }


    /*********View All Tags  ***********/
    public function index(Request $request)
    {
        $tags = $this->getter($request);
        return view('super_admins.tags.index')->with('tags', $tags);
    }

    /*********View Create Form of Tag  ***********/
    public function create()
    {
        return view('super_admins.tags.create');
    }

    /*********Store Tag  ***********/
    public function store(CreateRequest $request)
    {
        $data = $request->all();
        try {
            DB::beginTransaction();
            if (!$request->is_active) {
                $data['is_active'] = 0;
            }
            $data['image'] = uploadCroppedFile($request,'image','tags');
            $tag = Tag::create($data);
            $tag->slug = Str::slug($tag->name . ' ' . $tag->id, '-');
            $tag->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('super_admin.tags.index')->with('message', 'Something Went Wrong')->with('message_type', 'error');
        }
        return redirect()->route('super_admin.tags.index')->with('message', 'Tag Created Successfully')->with('message_type', 'success');
    }

    /*********View Tag  ***********/
    public function show(Tag $tag)
    {
        return view('super_admins.tags.show', compact('tag'));
    }

    /*********View Edit Form of Tag  ***********/
    public function edit(Tag $tag)
    {
        return view('super_admins.tags.edit', compact('tag'));
    }

    /*********Update Tag  ***********/
    public function update(CreateRequest $request, Tag $tag)
    {
        $data = $request->all();
        try {
            DB::beginTransaction();
            if (!$request->is_active) {
                $data['is_active'] = 0;
            }
            if ($request->image) {
                $data['image'] = uploadCroppedFile($request,'image','tags',$tag->image);
            } else {
                $data['image'] = $tag->image;
            }
            $tag->update($data);
            $tag = Tag::find($tag->id);
            $slug = Str::slug($tag->name . ' ' . $tag->id, '-');
            $tag->update([
                'slug' => $slug
            ]);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('super_admin.tags.index')->with('message', 'Something Went Wrong')->with('message_type', 'error');
        }
        return redirect()->route('super_admin.tags.index')->with('message', 'Tag Updated Successfully')->with('message_type', 'success');
    }

    /********* Export  CSV And Excel  **********/
    public function export(Request $request)
    {
        $tags = $this->getter($request, "export");
        if (in_array($request->export, ['csv,xlsx'])) {
            $extension = $request->export;
        } else {
            $extension = 'xlsx';
        }
        $filename = "tags." . $extension;
        return Excel::download(new TagsExport($tags), $filename);
    }
    /********* Import CSV And Excel  **********/
    public function import(ImportRequest $request)
    {
        $file = $request->file('file');
        Excel::import(new TagsImport, $file);
        return redirect()->back()->with('message', 'Blog Categories imported Successfully')->with('message_type', 'success');
    }


    /*********Soft DELETE Tag ***********/
    public function destroy(Tag $tag)
    {
        // if ($tag->Has('posts')) {
        //     $tag->news()->delete();
        // }
        $tag->delete();
        return redirect()->back()->with('message', 'Tag Deleted Successfully')->with('message_type', 'success');
    }

    /*********Permanently DELETE Tag ***********/
    public function destroyPermanently(Request $request, $tag)
    {
        $tag = Tag::withTrashed()->find($tag);
        if ($tag) {
            if ($tag->trashed()) {
                if ($tag->image && file_exists(public_path($tag->image))) {
                    unlink(public_path($tag->image));
                }
                $tag->forceDelete();
                return redirect()->back()->with('message', 'Blog Category Deleted Successfully')->with('message_type', 'success');
            } else {
                return redirect()->back()->with('message', 'Blog Category is Not in Trash')->with('message_type', 'error');
            }
        } else {
            return redirect()->back()->with('message', 'Blog Category Not Found')->with('message_type', 'error');
        }
    }
    /********* Restore Tag***********/
    public function restore(Request $request, $tag)
    {
        $tag = Tag::withTrashed()->find($tag);
        if ($tag->trashed()) {
            $tag->restore();
            return redirect()->back()->with('message', 'Blog Category Restored Successfully')->with('message_type', 'success');
        } else {
            return redirect()->back()->with('message', 'Blog Category Not Found')->with('message_type', 'error');
        }
    }
}
