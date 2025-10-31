<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Exports\SuperAdmin\FundsExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\SuperAdmin\Funds\CreateRequest;
use App\Http\Requests\ImportRequest;
use App\Imports\SuperAdmin\PricingPlansImport;
use App\Models\BookAppointment;
use App\Models\BookedService;
use App\Models\Fund;

use App\Models\FundBankTransfer;
use App\Models\PricingPlan;
use App\Models\PricingPlanModule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Laravel\Cashier\Cashier;
use Maatwebsite\Excel\Facades\Excel;

class BankTransactionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /********* Initialize Permission based Middlewares  ***********/
    public function __construct()
    {
        // $this->middleware('permission:pricing_plane.add_podcast');
        // $this->middleware('permission:pricing_plane.add_podcast', ['only' => ['store']]);
        // $this->middleware('permission:pricing_plane.add_podcast', ['only' => ['update']]);
        // $this->middleware('permission:pricing_plane.add_podcast', ['only' => ['destroy']]);
        // $this->middleware('permission:pricing_plane.add_podcast', ['only' => ['export']]);
        // $this->middleware('permission:pricing_plane.add_podcast', ['only' => ['import']]);
    }
    /********* Getter For Pagination, Searching And Sorting  ***********/
    public function getter($req = null, $export = null)
    {

        if ($req != null) {
            $bank_transactions =  Fund::withAll();
            if ($req->trash && $req->trash == 'with') {
                $bank_transactions =  $bank_transactions->withTrashed();
            }
            if ($req->trash && $req->trash == 'only') {
                $bank_transactions =  $bank_transactions->onlyTrashed();
            }
            if ($req->column && $req->column != null && $req->search != null) {
                $bank_transactions = $bank_transactions->whereLike($req->column, $req->search);
            } else if ($req->search && $req->search != null) {

                $bank_transactions = $bank_transactions->whereLike(['name', 'description'], $req->search);
            }
            if ($req->sort_field != null && $req->sort_type != null) {
                $bank_transactions = $bank_transactions->OrderBy($req->sort_field, $req->sort_type);
            } else {
                $bank_transactions = $bank_transactions->OrderBy('id', 'desc');
            }
            if ($export != null) { // for export do not paginate
                $bank_transactions = $bank_transactions->get();
                return $bank_transactions;
            }
            $bank_transactions = $bank_transactions->get();
            return $bank_transactions;
        }
        $bank_transactions = Fund::withAll()->orderBy('id', 'desc')->get();
        return $bank_transactions;
    }



    /*********View All PricingPlans  ***********/
    public function index(Request $request)
    {
        $bank_transactions = Fund::withAll()->withChildren()->has('fund_bank_transfers')->latest()->get();

        return view('super_admins.bank_transactions.index')->with('bank_transactions', $bank_transactions);
    }

    /*********View Create Form of PricingPlan  ***********/
    public function create()
    {
        return view('super_admins.bank_transactions.create');
    }

    /*********Store PricingPlan  ***********/
    public function store(Request $request)
    {

        $data = $request->all();
        try {
            DB::beginTransaction();

            $bank_account = Fund::create($data);

            $bank_account->update($data);


            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            dd($e->getMessage(), $e->getTrace(), $e->getLine());
            return redirect()->route('super_admin.bank_transactions.index')->with('message', 'Something Went Wrong')->with('message_type', 'error');
        }
        return redirect()->route('super_admin.bank_transactions.index')->with('message', 'Fund Created Successfully')->with('message_type', 'success');
    }

    /*********View Fund  ***********/
    public function show(Fund $bank_transaction)
    {
        return view('super_admins.bank_transactions.show', compact('bank_transaction'));
    }

    /*********View Edit Form of Fund  ***********/
    public function edit(Fund $bank_account)
    {

        return view('super_admins.bank_transactions.edit', compact('bank_account'));
    }

    /*********Update Fund  ***********/
    public function update(Request $request, Fund $bank_account)
    {
        $data = $request->all();
        try {
            DB::beginTransaction();

            $bank_account->update($data);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('super_admin.bank_transactions.index')->with('message', 'Something Went Wrong')->with('message_type', 'error');
        }
        return redirect()->route('super_admin.bank_transactions.index')->with('message', 'Fund Updated Successfully')->with('message_type', 'success');
    }

    /********* Export  CSV And Excel  **********/
    public function export(Request $request)
    {
        $bank_transactions = $this->getter($request, "export");
        if (in_array($request->export, ['csv,xlsx'])) {
            $extension = $request->export;
        } else {
            $extension = 'xlsx';
        }
        $filename = "bank_transactions." . $extension;
        return Excel::download(new FundsExport($bank_transactions), $filename);
    }
    /********* Import CSV And Excel  **********/
    public function import(ImportRequest $request)
    {
        $file = $request->file('file');
        Excel::import(new FundsImport, $file);
        return redirect()->back()->with('message', 'Blog Categories imported Successfully')->with('message_type', 'success');
    }


    /*********Soft DELETE Fund ***********/
    public function destroy(Fund $bank_transaction)
    {

        if ($bank_transaction->is_default) {
            return redirect()->back()->with('message', 'Default Fund cannot be Deleted')->with('message_type', 'error');
        }
        $bank_transaction->delete();
        return redirect()->back()->with('message', 'Fund Deleted Successfully')->with('message_type', 'success');
    }

    /*********Permanently DELETE Fund ***********/
    public function destroyPermanently(Request $request, $bank_account)
    {
        $bank_account = Fund::withTrashed()->find($bank_account);
        if ($bank_account->is_default) {
            return redirect()->back()->with('message', 'Default Fund cannot be Deleted')->with('message_type', 'error');
        }
        if ($bank_account) {
            if ($bank_account->trashed()) {
                if ($bank_account->image && file_exists(public_path($bank_account->image))) {
                    unlink(public_path($bank_account->image));
                }
                $bank_account->forceDelete();
                return redirect()->back()->with('message', 'Blog Category Deleted Successfully')->with('message_type', 'success');
            } else {
                return redirect()->back()->with('message', 'Blog Category is Not in Trash')->with('message_type', 'error');
            }
        } else {
            return redirect()->back()->with('message', 'Blog Category Not Found')->with('message_type', 'error');
        }
    }
    /********* Restore Fund***********/
    public function restore(Request $request, $bank_account)
    {
        $bank_account = Fund::withTrashed()->find($bank_account);
        if ($bank_account->trashed()) {
            $bank_account->restore();
            return redirect()->back()->with('message', 'Blog Category Restored Successfully')->with('message_type', 'success');
        } else {
            return redirect()->back()->with('message', 'Blog Category Not Found')->with('message_type', 'error');
        }
    }

    public function approve(Request $request, $bank_transaction)
    {

        $fund = Fund::where('id', $bank_transaction)->first();
        $appointmet = BookAppointment::where('fund_id', $bank_transaction)->first();
        $service = BookedService::where('fund_id', $bank_transaction)->first();

        if ($fund) {
            $fund->status = 1;
            $fund->update();
        }

        if ($appointmet) {
            $appointmet->is_paid = 1;
            $appointmet->update();
        }
        if ($service) {
            $service->is_paid = 1;
            $service->update();
        }
        return redirect()->back()->with('message', 'Transaction Approved Successfully')->with('message_type', 'success');
    }
    public function approveapprove(Request $request)
    {
        foreach ($request->selected_ids as $fund_id) {
            $fund = Fund::where('id', $fund_id)->first();
            $appointmet = BookAppointment::where('fund_id', $fund_id)->first();
            // $service = BookedService::where('fund_id', $fund_id)->first();

            if ($fund) {
                $fund->status = 1;
                $fund->update();
            }

            if ($appointmet) {
                $appointmet->is_paid = 1;
                $appointmet->update();
            }
            // if ($service) {
            //     $service->is_paid = 1;
            //     $service->update();
            // }
        }
        return redirect()->back()->with('message', 'Transactions Approved Successfully')->with('message_type', 'success');
    }
}
