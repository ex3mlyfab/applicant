<?php

namespace App\Http\Controllers\Admin\Pharmacy;

use App\Http\Controllers\Controller;
use App\Models\DrugModel;
use App\Models\Inpatient;
use App\Models\PharmacyBill;
use App\Models\PharmacyBillDetail;
use App\Models\Pharmreq;
use App\Models\PharmreqDetail;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;


class PharmacyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $total_items = DrugModel::all()->sortBy('name');
        $reorder = $total_items->filter(function($item){
            return $item->available <= $item->reorder_level;
        });

        $minlevel = $total_items->filter(function($item){
            return $item->available <= $item->minimum_level;
        });

        $maxlevel = $total_items->filter(function($item){
            return $item->available >= $item->maximum_level;
        });

        $expired = $total_items->filter(function($item){
            return $item->drugBatchDetails->where('quantity_available','>=', 1)->where('expiry_date','<=', now()->today())->count();
            });

        $dispensed = PharmacyBill::whereDate('created_at', now()->today())->get();
        $awaiting = Pharmreq::where('status', '!=', 'dispensed')->get();
        $awaiting5 = $awaiting->take(5);
        $topselling = 0;
        return view('admin.pharmacy.dashboard', compact('reorder','minlevel','maxlevel', 'expired',
            'total_items','awaiting5', 'dispensed', 'awaiting', 'topselling'));
    }
    public function stockReport()
    {
        $beginning = Carbon::create(Null,Null,1, Null,Null);
        // hack to get beginning of month;
        // dd($beginning, now()->today());
        $drugs = DrugModel::all()->sortBy('name');
        $drugs->toArray();
        $stockreports = [];
        foreach ($drugs as $key => $value) {
            $stockreports[$key]['drug_name'] = $value;
            $stockreports[$key]['inpatient'] =$value->pharmacyBillDetails->where('status', 'inpatient')->whereBetween('created_at',[$beginning, now() ])->sum('amount');
            $stockreports[$key]['old_stock'] = ($value->drugBatchDetails->where('available_quantity', '>', 0)->where('purchase_date', '<', $beginning)->sum('available_quantity') + $value->pharmacyBillDetails->where('created_at','>=',$beginning)->where('created_at','<=', now())->sum('quantity')-
            $value->drugBatchDetails->whereBetween('purchase_date',[$beginning, now()->today()])->sum('quantity_supplied'));
            $stockreports[$key]['purchases'] = $value->drugBatchDetails->whereBetween('purchase_date',[$beginning, now()->today()])->sum('quantity_supplied');
            $stockreports[$key]['issued'] = $value->pharmacyBillDetails->where('created_at','>=',$beginning)->where('created_at','<=', now())->sum('quantity');
            $stockreports[$key]['sales_total'] = $value->pharmacyBillDetails->whereBetween('created_at',[$beginning, now() ])->sum('amount');
        }

        $stockreports = collect($stockreports);
        $totalopening = 0;
        $totalnew =0;
        $totalstock =0;
        $totalsales = 0;
        $totalinpatient =0;
        for ($i=0; $i < $stockreports->count() ; $i++) {
            $totalopening += $stockreports[$i]['drug_name']->sales_price * $stockreports[$i]['old_stock'];
            $totalnew += ($stockreports[$i]['drug_name']->sales_price * $stockreports[$i]['purchases']);
            $totalstock += $stockreports[$i]['drug_name']->sales_price * $stockreports[$i]['drug_name']->available;
            $totalsales += $stockreports[$i]['sales_total'];
            $totalinpatient += $stockreports[$i]['inpatient'];
        }
        $end = now()->today();
        return view('admin.pharmacy.stockreport', compact('beginning','end','stockreports','totalopening','totalstock',
    'totalnew', 'totalsales', 'totalinpatient'));
    }
    public function filterStock(Request $request)
    {

        if($request->has('date')){


            $beginning = Carbon::parse(date('Y-m-d', strtotime($request->date)));
            $end = Carbon::parse(date('Y-m-d', strtotime($request->date)));

        }else if($request->has('daterange1')){
            $beginning = Carbon::parse(date('Y-m-d', strtotime($request->daterange1)));
            $end = Carbon::parse(date('Y-m-d', strtotime($request->daterange2)));
        }else{
            $beginning = Carbon::create($request->year,1,1, 0,0);
            $end = Carbon::create($request->year, 12, 31,0,0);
        }
        // dd($beginning, $end);
        // hack to get beginning of month;
        // dd($beginning, now()->today());
        $drugs = DrugModel::all()->sortBy('name');
        $drugs->toArray();
        $stockreports = [];
        foreach ($drugs as $key => $value) {
            $stockreports[$key]['drug_name'] = $value;
            $stockreports[$key]['inpatient'] = $value->pharmacyBillDetails->where('status', 'inpatient')->whereBetween('created_at',[$beginning, $end ])->sum('amount');
            $stockreports[$key]['old_stock'] = ($value->drugBatchDetails->where('available_quantity', '>', 0)->where('purchase_date', '<', $beginning)->sum('available_quantity') + $value->pharmacyBillDetails->where('created_at','>=',$beginning)->where('created_at','<=', now())->sum('quantity')-
                $value->drugBatchDetails->whereBetween('purchase_date',[$beginning, $end])->sum('quantity_supplied'));
            $stockreports[$key]['stock_balance'] = $stockreports[$key]['old_stock'] - $value->pharmacyBillDetails->where('created_at','>=',$beginning)->where('created_at','<=', $end)->sum('quantity');
            $stockreports[$key]['purchases'] = $value->drugBatchDetails->whereBetween('purchase_date',[$beginning, $end])->sum('quantity_supplied');
            $stockreports[$key]['issued'] = $value->pharmacyBillDetails->where('created_at','>=',$beginning)->where('created_at','<=', $end)->sum('quantity');
            $stockreports[$key]['sales_total'] = $value->pharmacyBillDetails->whereBetween('created_at',[$beginning, $end ])->sum('amount');
        }

        $stockreports = collect($stockreports);
        $totalopening = 0;
        $totalnew =0;
        $totalstock =0;
        $totalsales = 0;
        $totalinpatient = 0;
        for ($i=0; $i < $stockreports->count() ; $i++) {
            $totalopening += $stockreports[$i]['drug_name']->sales_price * $stockreports[$i]['old_stock'];
            $totalnew += ($stockreports[$i]['drug_name']->sales_price * $stockreports[$i]['purchases']);
           $totalstock += $stockreports[$i]['drug_name']->sales_price * $stockreports[$i]['stock_balance'];
            $totalsales += $stockreports[$i]['sales_total'];
            $totalinpatient += $stockreports[$i]['inpatient'];
        }

        return view('admin.pharmacy.stockreport', compact('beginning','end','stockreports','totalopening','totalstock',
    'totalnew', 'totalsales', 'totalinpatient'));
    }
    public function billdrug()
    {
        $results = PharmacyBill::whereDate('created_at', now()->today())->get();

        return view('admin.pharmacy.dispensed', compact('results'));
    }
    public function dispensedrug(Pharmreq $pharmreq)
    {
        $paidfor = [];
        foreach ($pharmreq->pharmreqDetails as $key => $value) {
            if($pharmreq->encounter->encounterable_type == 'App\Models\Inpatient'|| ($value->status != NULL) ){
                    array_unshift($paidfor, $value);
            }
        }

        return view('admin.pharmacy.dispensedrug', compact('pharmreq', 'paidfor'));
    }
    public function confirmdispense(Request $request)
    {
        // dd($request->except('_token'));

        $pharmreq = Pharmreq::find($request->pharmreq_id);

        if($pharmreq->encounter->encounterable_type == 'App\Models\Inpatient'){
            $inpatient = Inpatient::find($pharmreq->encounter->encounterable_id);
            $pharmacy = $inpatient->inpatientBill->inpatientBillDetails->filter(function($value){
                return $value->service == 'Pharmacy';
            });
            if($pharmacy->count()=== 0){
                $inpatient->inpatientBill->inpatientBillDetails()->create([
                    'service' => 'Pharmacy',
                    'amount' => $pharmreq->total,
                ]);
            }else{
                $initial = $pharmacy->first()->amount;
                $pharmacy->first()->update([
                    'amount' => $initial + $pharmreq->total
                ]);
            }
        }
        $dispense = PharmacyBill::create([
            'user_id' => $pharmreq->encounter->user->id,
            'consultant_id' => $pharmreq->seen_by,
            'pharmacist_id' => auth()->user()->id,
            'pharmreq_id' => $pharmreq->id,
            'total' => (isset($pharmreq->payments->last()->total))?$pharmreq->payments->last()->total : 0

        ]);
        foreach ($request->pharmreq_detail_id as $key => $value) {
            $drug = PharmreqDetail::find($request->pharmreq_detail_id[$key]);
            $data = array(
                'pharmacy_bill_id' => $dispense->id,
                'drug_model_id' => $request->drug_model_id[$key],
                'quantity' => $request->dispensed_quantity[$key],
                'unit_cost' => $drug->drugModel->price,
                'amount' => $drug->drugModel->price * $request->dispensed_quantity[$key],
                'dosage' =>$drug->dosage,
                'duration' => $drug->duration,
                'status' => $pharmreq->status
            );
            PharmacyBillDetail::create($data);

            $remaining = $drug->drugModel->drugBatchDetails()->firstWhere('available_quantity', '>', (int) $request->quantity[$key]);

            $remaining->decrement('available_quantity', (float) $request->dispensed_quantity[$key]);
            $drug->update(['dispensed'=> true]);
        }

        $pharmreq->update([
            'status' => 'dispensed'
        ]);

        $pharmreq->testable->update([
            'status' => 'Drug dispensed',
        ]);

        $notification = [
            'message' => 'Drug dispensed successfully',
            'alert-type' => 'success'
        ];
        return redirect()->route('pharmacy.index')->with($notification);
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

    public function prepare()
    {
       $prescriptions = Pharmreq::where('status', '!=', 'dispensed')->orWhere('status', NULL)->get()->sortByDesc('created_at');

        return view('admin.pharmacy.index', compact('prescriptions'));
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
