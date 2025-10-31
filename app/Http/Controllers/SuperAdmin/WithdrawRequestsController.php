<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\WithdrawRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WithdrawRequestsController extends Controller
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
            $withdraw_requests =  WithdrawRequest::withAll();
            if ($req->trash && $req->trash == 'with') {
                $withdraw_requests =  $withdraw_requests->withTrashed();
            }
            if ($req->trash && $req->trash == 'only') {
                $withdraw_requests =  $withdraw_requests->onlyTrashed();
            }
            if ($req->column && $req->column != null && $req->search != null) {
                $withdraw_requests = $withdraw_requests->whereLike($req->column, $req->search);
            } else if ($req->search && $req->search != null) {

                $withdraw_requests = $withdraw_requests->whereLike(['name', 'description'], $req->search);
            }
            if ($req->sort_field != null && $req->sort_type != null) {
                $withdraw_requests = $withdraw_requests->OrderBy($req->sort_field, $req->sort_type);
            } else {
                $withdraw_requests = $withdraw_requests->OrderBy('id', 'desc');
            }
            if ($export != null) { // for export do not paginate
                $withdraw_requests = $withdraw_requests->get();
                return $withdraw_requests;
            }
            $withdraw_requests = $withdraw_requests->get();
            return $withdraw_requests;
        }
        $withdraw_requests = WithdrawRequest::withAll()->orderBy('id', 'desc')->get();
        return $withdraw_requests;
    }


    /*********View All WithdrawRequests  ***********/
    public function index(Request $request)
    {
        $withdraw_requests = $this->getter($request);
        return view('super_admins.withdraw_requests.index')->with('withdraw_requests', $withdraw_requests);
    }

    /*********View Create Form of WithdrawRequest  ***********/
    public function create()
    {
        return view('super_admins.withdraw_requests.create');
    }

    /*********Store WithdrawRequest  ***********/
    public function store(Request $request)
    {
        $data = $request->all();
        try {
            DB::beginTransaction();
            $withdraw_request = WithdrawRequest::create($data);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('super_admin.withdraw_requests.index')->with('message', 'Something Went Wrong')->with('message_type', 'error');
        }
        return redirect()->route('super_admin.withdraw_requests.index')->with('message', 'Withdraw Request Created Successfully')->with('message_type', 'success');
    }

    /*********View WithdrawRequest  ***********/
    public function show(WithdrawRequest $withdraw_request)
    {
        return view('super_admins.withdraw_requests.show', compact('withdraw_request'));
    }

    /*********View Edit Form of WithdrawRequest  ***********/
    public function edit(WithdrawRequest $withdraw_request)
    {
        return view('super_admins.withdraw_requests.edit', compact('withdraw_request'));
    }

    /*********Update WithdrawRequest  ***********/
    public function update(Request $request, WithdrawRequest $withdraw_request)
    {
        $rules = [
            // 'currency' => 'required',
            'status' => 'required',
        ];

        $this->validate($request, $rules);

        if ($withdraw_request->status == WithdrawRequest::$Approved) {
            return redirect()->back()->with('message', 'Request already Approved')->with('message_type', 'error');
        }
        if ($request->status == WithdrawRequest::$Approved) {
            $user = $withdraw_request->user;
            $meta = ['details' => 'WithDraw Amount from Wallet'];
            $transaction = $user->withdraw($withdraw_request->amount, $meta);
        }

        try {
            DB::beginTransaction();

            $withdraw_request->update(
                [
                    'status' => $request->status,
                    'rejected_reason' => $request->rejected_reason ?? null,
                ]
            );
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('super_admin.withdraw_requests.index')->with('message', 'Something Went Wrong')->with('message_type', 'error');
        }
        return redirect()->route('super_admin.withdraw_requests.index')->with('message', 'Withdraw Request Updated Successfully')->with('message_type', 'success');
    }

    /*********Soft DELETE WithdrawRequest ***********/
    public function destroy(WithdrawRequest $withdraw_request)
    {
        $withdraw_request->delete();
        return redirect()->back()->with('message', 'Withdraw Request Deleted Successfully')->with('message_type', 'success');
    }

    /*********Permanently DELETE WithdrawRequest ***********/
    public function destroyPermanently(Request $request, $withdraw_request)
    {
        $withdraw_request = WithdrawRequest::withTrashed()->find($withdraw_request);
        if ($withdraw_request) {
            if ($withdraw_request->trashed()) {
                $withdraw_request->forceDelete();
                return redirect()->back()->with('message', 'Withdraw Request Deleted Successfully')->with('message_type', 'success');
            } else {
                return redirect()->back()->with('message', 'Withdraw Request is Not in Trash')->with('message_type', 'error');
            }
        } else {
            return redirect()->back()->with('message', 'Withdraw Request Not Found')->with('message_type', 'error');
        }
    }
    /********* Restore WithdrawRequest***********/
    public function restore(Request $request, $withdraw_request)
    {
        $withdraw_request = WithdrawRequest::withTrashed()->find($withdraw_request);
        if ($withdraw_request->trashed()) {
            $withdraw_request->restore();
            return redirect()->back()->with('message', 'WithdrawRequest Restored Successfully')->with('message_type', 'success');
        } else {
            return redirect()->back()->with('message', 'WithdrawRequest Not Found')->with('message_type', 'error');
        }
    }
}
