<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Exports\SuperAdmin\BankAccountsExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\SuperAdmin\BankAccounts\CreateRequest;
use App\Http\Requests\ImportRequest;
use App\Imports\SuperAdmin\BankAccountsImport;
use App\Imports\SuperAdmin\PricingPlansImport;
use App\Models\BankAccount;
use App\Models\FundBankTransfer;
use App\Models\PricingPlan;
use App\Models\PricingPlanModule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Laravel\Cashier\Cashier;
use Maatwebsite\Excel\Facades\Excel;

class BankAccountsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /********* Initialize Permission based Middlewares  ***********/
    public function __construct()
    {
        // $this->middleware('permission:bank_accounts.index');
        // $this->middleware('permission:bank_accounts.add', ['only' => ['store']]);
        // $this->middleware('permission:bank_accounts.edit', ['only' => ['update']]);
        // $this->middleware('permission:bank_accounts.delete', ['only' => ['destroy']]);
        // $this->middleware('permission:bank_accounts.export', ['only' => ['export']]);
        // $this->middleware('permission:bank_accounts.import', ['only' => ['import']]);
    }
    /********* Getter For Pagination, Searching And Sorting  ***********/
    public function getter($req = null, $export = null)
    {
        if ($req != null) {
            $bank_accounts =  BankAccount::withAll();
            if ($req->trash && $req->trash == 'with') {
                $bank_accounts =  $bank_accounts->withTrashed();
            }
            if ($req->trash && $req->trash == 'only') {
                $bank_accounts =  $bank_accounts->onlyTrashed();
            }
            if ($req->column && $req->column != null && $req->search != null) {
                $bank_accounts = $bank_accounts->whereLike($req->column, $req->search);
            } else if ($req->search && $req->search != null) {

                $bank_accounts = $bank_accounts->whereLike(['name', 'description'], $req->search);
            }
            if ($req->sort_field != null && $req->sort_type != null) {
                $bank_accounts = $bank_accounts->OrderBy($req->sort_field, $req->sort_type);
            } else {
                $bank_accounts = $bank_accounts->OrderBy('id', 'desc');
            }
            if ($export != null) { // for export do not paginate
                $bank_accounts = $bank_accounts->get();
                return $bank_accounts;
            }
            $bank_accounts = $bank_accounts->get();
            return $bank_accounts;
        }
        $bank_accounts = BankAccount::withAll()->orderBy('id', 'desc')->get();
        return $bank_accounts;
    }



    /*********View All PricingPlans  ***********/
    public function index(Request $request)
    {
        $bank_accounts = $this->getter($request);
        return view('super_admins.bank_accounts.index')->with('bank_accounts', $bank_accounts);
    }

    /*********View Create Form of PricingPlan  ***********/
    public function create()
    {
        // $teacher_modules = PricingPlanModule::teacher()->get();
        // $academy_modules = PricingPlanModule::academy()->get();

        return view('super_admins.bank_accounts.create');
    }

    /*********Store PricingPlan  ***********/
    public function store(Request $request)
    {

        $data = $request->all();
        try {
            DB::beginTransaction();

            $bank_account = BankAccount::create($data);

            $bank_account->update($data);


            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            dd($e->getMessage(), $e->getTrace(), $e->getLine());
            return redirect()->route('super_admin.bank_accounts.index')->with('message', 'Something Went Wrong')->with('message_type', 'error');
        }
        return redirect()->route('super_admin.bank_accounts.index')->with('message', 'BankAccount Created Successfully')->with('message_type', 'success');
    }

    /*********View BankAccount  ***********/
    public function show(BankAccount $bank_account)
    {
        return view('super_admins.bank_accounts.show', compact('bank_account'));
    }

    /*********View Edit Form of BankAccount  ***********/
    public function edit(BankAccount $bank_account)
    {

        return view('super_admins.bank_accounts.edit', compact('bank_account'));
    }

    /*********Update BankAccount  ***********/
    public function update(Request $request, BankAccount $bank_account)
    {
        $data = $request->all();
        try {
            DB::beginTransaction();

            $bank_account->update($data);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('super_admin.bank_accounts.index')->with('message', 'Something Went Wrong')->with('message_type', 'error');
        }
        return redirect()->route('super_admin.bank_accounts.index')->with('message', 'BankAccount Updated Successfully')->with('message_type', 'success');
    }

    /********* Export  CSV And Excel  **********/
    public function export(Request $request)
    {
        $bank_accounts = $this->getter($request, "export");
        if (in_array($request->export, ['csv,xlsx'])) {
            $extension = $request->export;
        } else {
            $extension = 'xlsx';
        }
        $filename = "bank_accounts." . $extension;
        return Excel::download(new BankAccountsExport($bank_accounts), $filename);
    }
    /********* Import CSV And Excel  **********/
    public function import(ImportRequest $request)
    {
        $file = $request->file('file');
        Excel::import(new BankAccountsImport, $file);
        return redirect()->back()->with('message', 'bank_accounts imported Successfully')->with('message_type', 'success');
    }


    /*********Soft DELETE BankAccount ***********/
    public function destroy(BankAccount $bank_account)
    {
        if ($bank_account->is_default) {
            return redirect()->back()->with('message', 'Default BankAccount cannot be Deleted')->with('message_type', 'error');
        }
        $bank_account->delete();
        return redirect()->back()->with('message', 'BankAccount Deleted Successfully')->with('message_type', 'success');
    }

    /*********Permanently DELETE BankAccount ***********/
    public function destroyPermanently(Request $request, $bank_account)
    {
        $bank_account = BankAccount::withTrashed()->find($bank_account);
        if ($bank_account->is_default) {
            return redirect()->back()->with('message', 'Default BankAccount cannot be Deleted')->with('message_type', 'error');
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
    /********* Restore BankAccount***********/
    public function restore(Request $request, $bank_account)
    {
        $bank_account = BankAccount::withTrashed()->find($bank_account);
        if ($bank_account->trashed()) {
            $bank_account->restore();
            return redirect()->back()->with('message', 'Blog Category Restored Successfully')->with('message_type', 'success');
        } else {
            return redirect()->back()->with('message', 'Blog Category Not Found')->with('message_type', 'error');
        }
    }


}
