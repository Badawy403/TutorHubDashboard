<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Exports\SuperAdmin\ContactsExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\SuperAdmin\Gateways\CreateRequest;
use App\Http\Requests\ImportRequest;
use App\Imports\SuperAdmin\ContactsImport;
use App\Models\Gateway;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class GatewaysController extends Controller
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
            $gateways =  Gateway::withAll();
            if ($req->trash && $req->trash == 'with') {
                $gateways =  $gateways->withTrashed();
            }
            if ($req->trash && $req->trash == 'only') {
                $gateways =  $gateways->onlyTrashed();
            }
            if ($req->column && $req->column != null && $req->search != null) {
                $gateways = $gateways->whereLike($req->column, $req->search);
            } else if ($req->search && $req->search != null) {

                $gateways = $gateways->whereLike(['name', 'description'], $req->search);
            }
            if ($req->sort_field != null && $req->sort_type != null) {
                $gateways = $gateways->OrderBy($req->sort_field, $req->sort_type);
            } else {
                $gateways = $gateways->OrderBy('id', 'desc');
            }
            if ($export != null) { // for export do not paginate
                $gateways = $gateways->get();
                return $gateways;
            }
            $gateways = $gateways->get();
            return $gateways;
        }
        $gateways = Gateway::withAll()->orderBy('id', 'desc')->get();
        return $gateways;
    }


    /*********View All Gateways  ***********/
    public function index(Request $request)
    {
        $gateways = $this->getter($request);
        return view('super_admins.gateways.index')->with('gateways', $gateways);
    }

    /*********View Create Form of Gateway  ***********/
    public function create()
    {
        return view('super_admins.gateways.create');
    }

    /*********Store Gateway  ***********/
    public function store(Request $request)
    {
        $data = $request->all();
        try {
            DB::beginTransaction();
            $gateway = Gateway::create($data);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('super_admin.gateways.index')->with('message', 'Something Went Wrong')->with('message_type', 'error');
        }
        return redirect()->route('super_admin.gateways.index')->with('message', 'Gateway Created Successfully')->with('message_type', 'success');
    }

    /*********View Gateway  ***********/
    public function show(Gateway $gateway)
    {
        return view('super_admins.gateways.show', compact('gateway'));
    }

    /*********View Edit Form of Gateway  ***********/
    public function edit(Gateway $gateway)
    {
        return view('super_admins.gateways.edit', compact('gateway'));
    }

    /*********Update Gateway  ***********/
    public function update(Request $request, Gateway $gateway)
    {
        $rules = [
            // 'currency' => 'required',
            'symbol' => 'required',
            'min_amount' => 'required|numeric',
            'max_amount' => 'required|numeric',
            'percentage_charge' => 'required|numeric',
            'fixed_charge' => 'required|numeric',
            'convention_rate' => 'required|numeric',
        ];
        $parameters = [];
        foreach ($request->except('_token', '_method', 'image') as $k => $v) {
            foreach ($gateway->parameters as $key => $cus) {
                if ($k != $key) {
                    continue;
                } else {
                    $rules[$key] = 'required|max:191';
                    $parameters[$key] = $v;
                }
            }
        }
        if ($request->status) {
            $status = true;
        }
        else{
            $status = false;
        }
        $data = $request->all();
        // dd($data);
        $this->validate($request, $rules);
        if ($request->hasFile('image')) {
            $image = uploadFile($request, 'image', 'payment_gateways');
        }
        try {
            DB::beginTransaction();
            $gateway->update(
                [
                    // 'currency' => $request->currency,
                    'symbol' => $request->symbol,
                    'convention_rate' => $request->convention_rate,
                    'min_amount' => $request->min_amount,
                    'max_amount' => $request->max_amount,
                    'percentage_charge' => $request->percentage_charge,
                    'fixed_charge' => $request->fixed_charge,
                    'parameters' => $parameters,
                    'image' => $image ?? $gateway->image,
                    'status' => $status
                ]
            );
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('super_admin.gateways.index')->with('message', 'Something Went Wrong')->with('message_type', 'error');
        }
        return redirect()->route('super_admin.gateways.index')->with('message', 'Gateway Updated Successfully')->with('message_type', 'success');
    }

    /*********Soft DELETE Gateway ***********/
    public function destroy(Gateway $gateway)
    {
        $gateway->delete();
        return redirect()->back()->with('message', 'Gateway Deleted Successfully')->with('message_type', 'success');
    }

    /*********Permanently DELETE Gateway ***********/
    public function destroyPermanently(Request $request, $gateway)
    {
        $gateway = Gateway::withTrashed()->find($gateway);
        if ($gateway) {
            if ($gateway->trashed()) {
                $gateway->forceDelete();
                return redirect()->back()->with('message', 'Gateway Deleted Successfully')->with('message_type', 'success');
            } else {
                return redirect()->back()->with('message', 'Gateway is Not in Trash')->with('message_type', 'error');
            }
        } else {
            return redirect()->back()->with('message', 'Gateway Not Found')->with('message_type', 'error');
        }
    }
    /********* Restore Gateway***********/
    public function restore(Request $request, $gateway)
    {
        $gateway = Gateway::withTrashed()->find($gateway);
        if ($gateway->trashed()) {
            $gateway->restore();
            return redirect()->back()->with('message', 'Gateway Restored Successfully')->with('message_type', 'success');
        } else {
            return redirect()->back()->with('message', 'Gateway Not Found')->with('message_type', 'error');
        }
    }
}
