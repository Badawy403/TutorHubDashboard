<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Exports\SuperAdmin\FAQSExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\SuperAdmin\FAQS\CreateRequest;
use App\Http\Requests\ImportRequest;
use App\Imports\SuperAdmin\FAQSImport;
use App\Models\FAQ;
use App\Models\FAQCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class FAQSController extends Controller
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
            $faqs =  FAQ::withAll();
            if ($req->trash && $req->trash == 'with') {
                $faqs =  $faqs->withTrashed();
            }
            if ($req->trash && $req->trash == 'only') {
                $faqs =  $faqs->onlyTrashed();
            }
            if ($req->column && $req->column != null && $req->search != null) {
                $faqs = $faqs->whereLike($req->column, $req->search);
            } else if ($req->search && $req->search != null) {

                $faqs = $faqs->whereLike(['name', 'description'], $req->search);
            }
            if ($req->sort_field != null && $req->sort_type != null) {
                $faqs = $faqs->OrderBy($req->sort_field, $req->sort_type);
            } else {
                $faqs = $faqs->OrderBy('id', 'desc');
            }
            if ($export != null) { // for export do not paginate
                $faqs = $faqs->get();
                return $faqs;
            }
            $faqs = $faqs->get();
            return $faqs;
        }
        $faqs = FAQ::withAll()->orderBy('id', 'desc')->get();
        return $faqs;
    }


    /*********View All FAQS  ***********/
    public function index(Request $request)
    {
        $faqs = $this->getter($request);
        return view('super_admins.faqs.index')->with('faqs', $faqs);
    }

    /*********View Create Form of FAQ  ***********/
    public function create()
    {
        $faq_categories = FAQCategory::get();

        return view('super_admins.faqs.create',compact('faq_categories'));
    }

    /*********Store FAQ  ***********/
    public function store(CreateRequest $request)
    {
        $data = $request->all();
        try {
            DB::beginTransaction();
            if (!$request->is_active) {
                $data['is_active'] = 0;
            }
            $data['image'] = uploadCroppedFile($request,'image','faqs');

            $faq = FAQ::create($data);
            $faq->slug = Str::slug($faq->name . ' ' . $faq->id, '-');
            $faq->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('super_admin.faqs.index')->with('message', 'Something Went Wrong')->with('message_type', 'error');
        }
        return redirect()->route('super_admin.faqs.index')->with('message', 'FAQ Created Successfully')->with('message_type', 'success');
    }

    /*********View FAQ  ***********/
    public function show(FAQ $faq)
    {
        return view('super_admins.faqs.show', compact('faq'));
    }

    /*********View Edit Form of FAQ  ***********/
    public function edit(FAQ $faq)
    {
        $faq_categories = FAQCategory::get();

        return view('super_admins.faqs.edit', compact('faq','faq_categories'));
    }

    /*********Update FAQ  ***********/
    public function update(CreateRequest $request, FAQ $faq)
    {
        $data = $request->all();
        try {
            DB::beginTransaction();
            if (!$request->is_active) {
                $data['is_active'] = 0;
            }
            if ($request->image) {
                $data['image'] = uploadCroppedFile($request,'image','faqs',$faq->image);

            } else {
                $data['image'] = $faq->image;
            }
            $faq->update($data);
            $faq = FAQ::find($faq->id);
            $slug = Str::slug($faq->name . ' ' . $faq->id, '-');
            $faq->update([
                'slug' => $slug
            ]);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('super_admin.faqs.index')->with('message', 'Something Went Wrong')->with('message_type', 'error');
        }
        return redirect()->route('super_admin.faqs.index')->with('message', 'FAQ Updated Successfully')->with('message_type', 'success');
    }

    /********* Export  CSV And Excel  **********/
    public function export(Request $request)
    {
        $faqs = $this->getter($request, "export");
        if (in_array($request->export, ['csv,xlsx'])) {
            $extension = $request->export;
        } else {
            $extension = 'xlsx';
        }
        $filename = "faqs." . $extension;
        return Excel::download(new FAQSExport($faqs), $filename);
    }
    /********* Import CSV And Excel  **********/
    public function import(ImportRequest $request)
    {
        $file = $request->file('file');
        Excel::import(new FAQSImport, $file);
        return redirect()->back()->with('message', 'Blog Categories imported Successfully')->with('message_type', 'success');
    }


    /*********Soft DELETE FAQ ***********/
    public function destroy(FAQ $faq)
    {
        $faq->delete();
        return redirect()->back()->with('message', 'FAQ Deleted Successfully')->with('message_type', 'success');
    }

    /*********Permanently DELETE FAQ ***********/
    public function destroyPermanently(Request $request, $faq)
    {
        $faq = FAQ::withTrashed()->find($faq);
        if ($faq) {
            if ($faq->trashed()) {
                if ($faq->image && file_exists(public_path($faq->image))) {
                    unlink(public_path($faq->image));
                }
                $faq->forceDelete();
                return redirect()->back()->with('message', 'Blog Category Deleted Successfully')->with('message_type', 'success');
            } else {
                return redirect()->back()->with('message', 'Blog Category is Not in Trash')->with('message_type', 'error');
            }
        } else {
            return redirect()->back()->with('message', 'Blog Category Not Found')->with('message_type', 'error');
        }
    }
    /********* Restore FAQ***********/
    public function restore(Request $request, $faq)
    {
        $faq = FAQ::withTrashed()->find($faq);
        if ($faq->trashed()) {
            $faq->restore();
            return redirect()->back()->with('message', 'Blog Category Restored Successfully')->with('message_type', 'success');
        } else {
            return redirect()->back()->with('message', 'Blog Category Not Found')->with('message_type', 'error');
        }
    }
}
