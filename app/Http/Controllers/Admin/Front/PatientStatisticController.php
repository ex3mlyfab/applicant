<?php

namespace App\Http\Controllers\Admin\Front;

use App\Http\Controllers\Controller;
use App\Models\Family;
use App\Models\Organization;
use App\Models\PatientStatistic;
use App\Models\RegistrationType;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PatientStatisticController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $patient = User::all();
        $family = Family::all();
        $statistics = PatientStatistic::whereYear('year', date('Y'))->get();
        $companycount = Organization::all()->count();
        $patient10 = $patient->sortByDesc('created_at')->take(5);
        $weekly = $patient->whereBetween('created_at', [now()->subDay(7), now()])->groupBy(function (User $item) {
            return $item->created_at->format('d/M/Y');
        })->map(function ($row) {
            return $row->count();
        });
        $weeklychart = [];
        foreach ($weekly as $key => $value) {
            $weeklychart['label'][] = $key;
            $weeklychart['registrations'][] = $value;
        }

        $weeklychart['weekly_chart'] = json_encode($weeklychart);

        return view('admin.patient.dashboard', compact('patient', 'family','companycount', 'statistics', 'patient10', 'weeklychart'));
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
