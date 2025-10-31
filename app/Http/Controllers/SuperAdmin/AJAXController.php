<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Exports\SuperAdmin\StatesExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\SuperAdmin\States\CreateRequest;
use App\Http\Requests\ImportRequest;
use App\Imports\SuperAdmin\StatesImport;
use App\Models\Country;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class AJAXController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */



    /********* Restore State***********/
    public function getStatesByCountry(Request $request)
    {
        $states = State::active()->where('country_id', $request->country_id)->get();
        return response()->json(['states' => $states]);
    }
}
