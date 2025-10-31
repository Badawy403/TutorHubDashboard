<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Exports\SuperAdmin\AcademiesExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\SuperAdmin\Academies\CreateRequest;
use App\Http\Requests\ImportRequest;
use App\Http\Requests\SuperAdmin\Academies\UpdateRequest;
use App\Imports\SuperAdmin\AcademiesImport;
use App\Http\Resources\Web\AcademiesResource;
use Inertia\Inertia;
use App\Models\Academy;
use App\Models\PricingPlan;
use App\Models\AcademyCategory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use Session;

class AcademiesController extends Controller
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
            $academies =  Academy::withAll();
            if ($req->trash && $req->trash == 'with') {
                $academies =  $academies->withTrashed();
            }
            if ($req->trash && $req->trash == 'only') {
                $academies =  $academies->onlyTrashed();
            }
            if ($req->column && $req->column != null && $req->search != null) {
                $academies = $academies->whereLike($req->column, $req->search);
            } else if ($req->search && $req->search != null) {

                $academies = $academies->whereLike(['name', 'description'], $req->search);
            }
            if ($req->sort_field != null && $req->sort_type != null) {
                $academies = $academies->OrderBy($req->sort_field, $req->sort_type);
            } else {
                $academies = $academies->OrderBy('is_approved', 'ASC');

            }
            if ($export != null) { // for export do not paginate
                $academies = $academies->get();
                return $academies;
            }
            $academies = $academies->get();
            return $academies;
        }
        $academies = Academy::withAll()->OrderBy('is_approved', 'ASC')->get();
        return $academies;
    }


    /*********View All Academies  ***********/
    public function index(Request $request)
    {
        $academies = $this->getter($request);
        return view('super_admins.academies.index')->with('academies', $academies);
    }

    /*********View Create Form of Academy  ***********/
    public function create()
    {

        $pricing_plans = PricingPlan::Academy()->get();
        $academy_categories = AcademyCategory::active()->get();
        return view('super_admins.academies.create',compact('pricing_plans' , 'academy_categories'));
    }

    /*********Store Academy  ***********/
    public function store(CreateRequest $request)
    {
        $data = $request->all();
        try {
            DB::beginTransaction();
            if (!$request->is_active) {
                $data['is_active'] = 0;
            }
            if (!$request->is_featured) {
                $data['is_featured'] = 0;
            }
            $data['image'] = uploadCroppedFile($request,'image','academies');

            $academy = Academy::create($data);
            $user = User::where('email',$request->email)->first();
            if($user){
                $user->roles()->attach(['academy']);
                $academy->update(['user_id' => $user->id]);
            }
            else{
                $user = $academy->user()->create([
                    'name' => $academy->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                ]);
                $user->markEmailAsVerified();
                $academy->update(['user_id' => $user->id]);
                $user->roles()->attach(['academy']);
            }
            $academy->academy_categories()->attach($request->academy_category_ids);
            $academy->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('super_admin.academies.index')->with('message', 'Something Went Wrong')->with('message_type', 'error');
        }
        return redirect()->route('super_admin.academies.index')->with('message', 'Academy Created Successfully')->with('message_type', 'success');
    }

    /*********View Academy  ***********/
    public function show(Academy $academy)
    {
        return view('super_admins.academies.show', compact('academy'));
    }

    /*********View Edit Form of Academy  ***********/
    public function edit(Academy $academy)
    {
        $academy_categories = AcademyCategory::active()->get();
        $pricing_plans = PricingPlan::Academy()->get();
        return view('super_admins.academies.edit', compact('academy','pricing_plans' , 'academy_categories'));
    }

    /*********Update Academy  ***********/
    public function update(UpdateRequest $request, Academy $academy)
    {
        $data = $request->all();
        try {
            DB::beginTransaction();
            if (!$request->is_active) {
                $data['is_active'] = 0;
            }
            if (!$request->is_featured) {
                $data['is_featured'] = 0;
            }
            if ($request->image) {
                $data['image'] = uploadCroppedFile($request,'image','academies',$academy->image);

            } else {
                $data['image'] = $academy->image;
            }
            if(isset($request->academy_category_ids)){
                $academy->academy_categories()->sync($request->academy_category_ids);
            }
            $academy->update($data);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('super_admin.academies.index')->with('message', 'Something Went Wrong')->with('message_type', 'error');
        }
        return redirect()->route('super_admin.academies.index')->with('message', 'Academy Updated Successfully')->with('message_type', 'success');
    }

    /********* Export  CSV And Excel  **********/
    public function export(Request $request)
    {
        $academies = $this->getter($request, "export");
        if (in_array($request->export, ['csv,xlsx'])) {
            $extension = $request->export;
        } else {
            $extension = 'xlsx';
        }
        $filename = "academies." . $extension;
        return Excel::download(new AcademiesExport($academies), $filename);
    }
    /********* Import CSV And Excel  **********/
    public function import(ImportRequest $request)
    {
        $file = $request->file('file');
        Excel::import(new AcademiesImport, $file);
        return redirect()->back()->with('message', 'Blog Categories imported Successfully')->with('message_type', 'success');
    }


    /*********Soft DELETE Academy ***********/
    public function destroy(Academy $academy)
    {
        $academy->delete();
        return redirect()->back()->with('message', 'Academy Deleted Successfully')->with('message_type', 'success');
    }

    /*********Permanently DELETE Academy ***********/
    public function destroyPermanently(Request $request, $academy)
    {
        $academy = Academy::withTrashed()->find($academy);
        if ($academy) {
            if ($academy->trashed()) {
                if ($academy->image && file_exists(public_path($academy->image))) {
                    unlink(public_path($academy->image));
                }
                $academy->forceDelete();
                return redirect()->back()->with('message', 'Academy Deleted Successfully')->with('message_type', 'success');
            } else {
                return redirect()->back()->with('message', 'Academy is Not in Trash')->with('message_type', 'error');
            }
        } else {
            return redirect()->back()->with('message', 'Academy Not Found')->with('message_type', 'error');
        }
    }
    /********* Restore Academy***********/
    public function restore(Request $request, $academy)
    {
        $academy = Academy::withTrashed()->find($academy);
        if ($academy->trashed()) {
            $academy->restore();
            return redirect()->back()->with('message', 'Academy Restored Successfully')->with('message_type', 'success');
        } else {
            return redirect()->back()->with('message', 'Academy Not Found')->with('message_type', 'error');
        }
    }
        /*********Approve Academy ***********/
        public function approve(Academy $academy)
        {
            if(!$academy->is_approved){
                $academy->update(['is_approved' => 1,'approved_at' => now()]);
            }
            return redirect()->back()->with('message', 'Academy Approved Successfully')->with('message_type', 'success');
        }


        public function profile(Request $request,$academy)
        {
            $academy = Academy::withChildrens()->withAll()->where('id',$academy)->first();
            if(!$academy){
                abort(404);
            }
            $academy = new AcademiesResource($academy);
            return Inertia::render('Academies/Profile',[
                'academy' => $academy
            ]);
        }

        public function bulkActionAcademies(Request $request , $type)
        {
            if ($type == 'approve') {
                Academy::whereIn('id', $request->selected_ids)->update([
                    'is_approved' => 1
                ]);
            } elseif ($type == 'disapprove') {
                Academy::whereIn('id', $request->selected_ids)->update([
                    'is_approved' => 0
                ]);
            }
            elseif ($type == 'inactive') {
                Academy::whereIn('id', $request->selected_ids)->update([
                    'is_active' => 0
                ]);
            } elseif ($type == 'active') {
                Academy::whereIn('id', $request->selected_ids)->update([
                    'is_active' => 1
                ]);
            } elseif ($type == 'delete') {
                foreach ($request->selected_ids as $userId){
                    $business = Academy::where('id' , $userId)->first();
                    $this->destroy($business);
                }
            } elseif ($type == 'feature') {
                Academy::whereIn('id', $request->selected_ids)->update([
                    'is_featured' => 1
                ]);
            } else {
                Session::flash('message', 'Some Thing Went Wrong !');
                return response()->json('Success', 200);
            }
            Session::flash('message', 'Updated Successfully');
            return response()->json('Success', 200);
        }
}
