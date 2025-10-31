<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Exports\SuperAdmin\ContactsExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\SuperAdmin\Contacts\CreateRequest;
use App\Http\Requests\ImportRequest;
use App\Imports\SuperAdmin\ContactsImport;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class ContactsController extends Controller
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
            $contacts =  Contact::withAll();
            if ($req->trash && $req->trash == 'with') {
                $contacts =  $contacts->withTrashed();
            }
            if ($req->trash && $req->trash == 'only') {
                $contacts =  $contacts->onlyTrashed();
            }
            if ($req->column && $req->column != null && $req->search != null) {
                $contacts = $contacts->whereLike($req->column, $req->search);
            } else if ($req->search && $req->search != null) {

                $contacts = $contacts->whereLike(['name', 'description'], $req->search);
            }
            if ($req->sort_field != null && $req->sort_type != null) {
                $contacts = $contacts->OrderBy($req->sort_field, $req->sort_type);
            } else {
                $contacts = $contacts->OrderBy('id', 'desc');
            }
            if ($export != null) { // for export do not paginate
                $contacts = $contacts->get();
                return $contacts;
            }
            $contacts = $contacts->get();
            return $contacts;
        }
        $contacts = Contact::withAll()->orderBy('id', 'desc')->get();
        return $contacts;
    }


    /*********View All Contacts  ***********/
    public function index(Request $request)
    {
        $contacts = $this->getter($request);
        return view('super_admins.contacts.index')->with('contacts', $contacts);
    }

    /*********View Create Form of Contact  ***********/
    public function create()
    {
        return view('super_admins.contacts.create');
    }

    /*********Store Contact  ***********/
    public function store(CreateRequest $request)
    {
        $data = $request->all();
        try {
            DB::beginTransaction();
            $contact = Contact::create($data);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('super_admin.contacts.index')->with('message', 'Something Went Wrong')->with('message_type', 'error');
        }
        return redirect()->route('super_admin.contacts.index')->with('message', 'Contact Created Successfully')->with('message_type', 'success');
    }

    /*********View Contact  ***********/
    public function show(Contact $contact)
    {
        return view('super_admins.contacts.show', compact('contact'));
    }

    /*********View Edit Form of Contact  ***********/
    public function edit(Contact $contact)
    {
        return view('super_admins.contacts.edit');
    }

    /*********Update Contact  ***********/
    public function update(CreateRequest $request, Contact $contact)
    {
        $data = $request->all();
        try {
            DB::beginTransaction();
            $contact->update($data);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('super_admin.contacts.index')->with('message', 'Something Went Wrong')->with('message_type', 'error');
        }
        return redirect()->route('super_admin.contacts.index')->with('message', 'Contact Updated Successfully')->with('message_type', 'success');
    }

    /********* Export  CSV And Excel  **********/
    public function export(Request $request)
    {
        $contacts = $this->getter($request, "export");
        if (in_array($request->export, ['csv,xlsx'])) {
            $extension = $request->export;
        } else {
            $extension = 'xlsx';
        }
        $filename = "contacts." . $extension;
        return Excel::download(new ContactsExport($contacts), $filename);
    }
    /********* Import CSV And Excel  **********/
    public function import(ImportRequest $request)
    {
        $file = $request->file('file');
        Excel::import(new ContactsImport, $file);
        return redirect()->back()->with('message', 'Blog Categories imported Successfully')->with('message_type', 'success');
    }


    /*********Soft DELETE Contact ***********/
    public function destroy(Contact $contact)
    {
        $contact->delete();
        return redirect()->back()->with('message', 'Contact Deleted Successfully')->with('message_type', 'success');
    }

    /*********Permanently DELETE Contact ***********/
    public function destroyPermanently(Request $request, $contact)
    {
        $contact = Contact::withTrashed()->find($contact);
        if ($contact) {
            if ($contact->trashed()) {
                $contact->forceDelete();
                return redirect()->back()->with('message', 'Blog Category Deleted Successfully')->with('message_type', 'success');
            } else {
                return redirect()->back()->with('message', 'Blog Category is Not in Trash')->with('message_type', 'error');
            }
        } else {
            return redirect()->back()->with('message', 'Blog Category Not Found')->with('message_type', 'error');
        }
    }
    /********* Restore Contact***********/
    public function restore(Request $request, $contact)
    {
        $contact = Contact::withTrashed()->find($contact);
        if ($contact->trashed()) {
            $contact->restore();
            return redirect()->back()->with('message', 'Blog Category Restored Successfully')->with('message_type', 'success');
        } else {
            return redirect()->back()->with('message', 'Blog Category Not Found')->with('message_type', 'error');
        }
    }
}
