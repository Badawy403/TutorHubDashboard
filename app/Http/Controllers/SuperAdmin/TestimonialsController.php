<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Exports\SuperAdmin\TestimonialsExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\SuperAdmin\Testimonials\CreateRequest;
use App\Http\Requests\ImportRequest;
use App\Imports\SuperAdmin\TestimonialsImport;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class TestimonialsController extends Controller
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
            $testimonials =  Testimonial::withAll();
            if ($req->trash && $req->trash == 'with') {
                $testimonials =  $testimonials->withTrashed();
            }
            if ($req->trash && $req->trash == 'only') {
                $testimonials =  $testimonials->onlyTrashed();
            }
            if ($req->column && $req->column != null && $req->search != null) {
                $testimonials = $testimonials->whereLike($req->column, $req->search);
            } else if ($req->search && $req->search != null) {

                $testimonials = $testimonials->whereLike(['name', 'description'], $req->search);
            }
            if ($req->sort_field != null && $req->sort_type != null) {
                $testimonials = $testimonials->OrderBy($req->sort_field, $req->sort_type);
            } else {
                $testimonials = $testimonials->OrderBy('id', 'desc');
            }
            if ($export != null) { // for export do not paginate
                $testimonials = $testimonials->get();
                return $testimonials;
            }
            $testimonials = $testimonials->get();
            return $testimonials;
        }
        $testimonials = Testimonial::withAll()->orderBy('id', 'desc')->get();
        return $testimonials;
    }


    /*********View All Testimonials  ***********/
    public function index(Request $request)
    {
        $testimonials = $this->getter($request);
        return view('super_admins.testimonials.index')->with('testimonials', $testimonials);
    }

    /*********View Create Form of Testimonial  ***********/
    public function create()
    {
        return view('super_admins.testimonials.create');
    }

    /*********Store Testimonial  ***********/
    public function store(CreateRequest $request)
    {
        $data = $request->all();
        try {
            DB::beginTransaction();
            if (!$request->is_active) {
                $data['is_active'] = 0;
            }
            $data['image'] = uploadCroppedFile($request,'image','testimonials');
            $testimonial = Testimonial::create($data);
            $testimonial->slug = Str::slug($testimonial->name . ' ' . $testimonial->id, '-');
            $testimonial->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            dd($e->getMessage());
            return redirect()->route('super_admin.testimonials.index')->with('message', 'Something Went Wrong')->with('message_type', 'error');
        }
        return redirect()->route('super_admin.testimonials.index')->with('message', 'Testimonial Created Successfully')->with('message_type', 'success');
    }

    /*********View Testimonial  ***********/
    public function show(Testimonial $testimonial)
    {
        return view('super_admins.testimonials.show', compact('testimonial'));
    }

    /*********View Edit Form of Testimonial  ***********/
    public function edit(Testimonial $testimonial)
    {
        return view('super_admins.testimonials.edit', compact('testimonial'));
    }

    /*********Update Testimonial  ***********/
    public function update(CreateRequest $request, Testimonial $testimonial)
    {
        $data = $request->all();
        try {
            DB::beginTransaction();
            if (!$request->is_active) {
                $data['is_active'] = 0;
            }
            if ($request->image) {
                $data['image'] = uploadCroppedFile($request,'image','testimonials',$testimonial->image);
            } else {
                $data['image'] = $testimonial->image;
            }
            $data['slug'] = Str::slug($data['name'] . ' ' . $testimonial->id, '-');
            $testimonial->update($data);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('super_admin.testimonials.index')->with('message', 'Something Went Wrong')->with('message_type', 'error');
        }
        return redirect()->route('super_admin.testimonials.index')->with('message', 'Testimonial Updated Successfully')->with('message_type', 'success');
    }

    /********* Export  CSV And Excel  **********/
    public function export(Request $request)
    {
        $testimonials = $this->getter($request, "export");
        if (in_array($request->export, ['csv,xlsx'])) {
            $extension = $request->export;
        } else {
            $extension = 'xlsx';
        }
        $filename = "testimonials." . $extension;
        return Excel::download(new TestimonialsExport($testimonials), $filename);
    }
    /********* Import CSV And Excel  **********/
    public function import(ImportRequest $request)
    {
        $file = $request->file('file');
        Excel::import(new TestimonialsImport, $file);
        return redirect()->back()->with('message', 'Blog Categories imported Successfully')->with('message_type', 'success');
    }


    /*********Soft DELETE Testimonial ***********/
    public function destroy(Testimonial $testimonial)
    {
        // if ($testimonial->Has('posts')) {
        //     $testimonial->news()->delete();
        // }
        $testimonial->delete();
        return redirect()->back()->with('message', 'Testimonial Deleted Successfully')->with('message_type', 'success');
    }

    /*********Permanently DELETE Testimonial ***********/
    public function destroyPermanently(Request $request, $testimonial)
    {
        $testimonial = Testimonial::withTrashed()->find($testimonial);
        if ($testimonial) {
            if ($testimonial->trashed()) {
                if ($testimonial->image && file_exists(public_path($testimonial->image))) {
                    unlink(public_path($testimonial->image));
                }
                $testimonial->forceDelete();
                return redirect()->back()->with('message', 'Blog Category Deleted Successfully')->with('message_type', 'success');
            } else {
                return redirect()->back()->with('message', 'Blog Category is Not in Trash')->with('message_type', 'error');
            }
        } else {
            return redirect()->back()->with('message', 'Blog Category Not Found')->with('message_type', 'error');
        }
    }
    /********* Restore Testimonial***********/
    public function restore(Request $request, $testimonial)
    {
        $testimonial = Testimonial::withTrashed()->find($testimonial);
        if ($testimonial->trashed()) {
            $testimonial->restore();
            return redirect()->back()->with('message', 'Blog Category Restored Successfully')->with('message_type', 'success');
        } else {
            return redirect()->back()->with('message', 'Blog Category Not Found')->with('message_type', 'error');
        }
    }
}
