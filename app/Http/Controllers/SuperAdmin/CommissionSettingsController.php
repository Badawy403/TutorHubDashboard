<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SuperAdmin\GeneralSettings\UpdateRequest;
use App\Models\AppointmentType;
use App\Models\Commission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class CommissionSettingsController extends Controller
{

    /********* Initialize Permission based Middlewares  ***********/
    public function __construct()
    {
        // $this->middleware('permission:commission.index');
        // $this->middleware('permission:commission.add', ['only' => ['store']]);
        // $this->middleware('permission:commission.edit', ['only' => ['update']]);
        // $this->middleware('permission:commission.delete', ['only' => ['destroy']]);
        // $this->middleware('permission:commission.export', ['only' => ['export']]);
        // $this->middleware('permission:commission.import', ['only' => ['import']]);
    }
    public function index()
    {
        $appointment_types = AppointmentType::with('commission')->get();
        return view('super_admins.commission.index', compact('appointment_types'));
    }

    public function commissionUpdate(Request $request)
    {
        $commision = Commission::all();
        $commision = $commision->each->delete();
        $requestData = $request->all();
        // dd($requestData);
        foreach ($requestData['appointment_type_id'] as $key => $appointment_type_id) {
            $rate = $requestData['rate'][$key];
            $commission_type = $requestData['commission_type'][$key];
            Commission::create([
                'appointment_type_id' =>  $appointment_type_id,
                'rate' =>  $rate,
                'commission_type' =>  $commission_type,
            ]);
        }

        return redirect()->back()->with('message', 'Commission Updated Successfully')->with('message_type', 'success');
    }
}
