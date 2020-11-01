<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Models\AdmitModel;
use App\Models\ClinicalAppointment;
use App\Models\Expense;
use App\Models\Payment;
use App\Models\PaymentReceipt;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $yest_admit =0;
        $admit = AdmitModel::whereDate('created_at', now()->today())->count();
        $operation = $yest_operation = 0;

        $totalPatients = User::whereYear('created_at', date('Y'))->get()->groupBy(function (User $item) {
            return $item->created_at->format('M');
        })->map->count();


        $yest_earning = PaymentReceipt::whereDate('created_at', now()->yesterday())->sum('total');
        $yest_consult = ClinicalAppointment::whereDate('created_at', now()->yesterday())->count();
        $consult = ClinicalAppointment::whereDate('created_at', now()->today())->count();
        $earning = PaymentReceipt::whereDate('created_at', now()->today())->sum('total');
        return view('admin.dashboard.index', compact('consult', 'yest_earning', 'yest_consult', 'earning', 'admit', 'yest_admit', 'yest_operation', 'operation', 'totalPatients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
