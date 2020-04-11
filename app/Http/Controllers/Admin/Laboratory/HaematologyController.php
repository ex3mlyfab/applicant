<?php

namespace App\Http\Controllers\Admin\Laboratory;

use App\Http\Controllers\Controller;
use App\Models\Charge;
use App\Models\Consult;
use App\Models\Haematologyreq;
use App\Models\Invoice;
use Illuminate\Http\Request;

class HaematologyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $haemreqs = Haematologyreq::where('status', '!=', 'completed')->get();
        // dd($haemreqs);

        return view('admin.laboratories.haematology.index', compact('haemreqs'));
    }
    public function completed()
    {
        $haemreqs = Haematologyreq::where('status', 'completed')->get();

        return view('admin.laboratories.haematology.index', compact('haemreqs'));
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
        $data = $request->except('_token');
        $data['status'] = 'waiting';
        $id = Haematologyreq::create($data);

        $status = $id->clinical_appointment_id;
        $consult = Consult::firstOrCreate(['clinical_appointment_id' => $status]);
        $consult->consultTests()->create([
            'test_id' => $id->id,
            'type' => $request->investigation_required . ' in haematology',
            'status' => 'waiting',
        ]);
        $notification = array(
            'message' => 'Haematology test requested successfully!',
            'alert-type' => 'success'
        );
        return back()->with($notification);
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
    public function prepareInvoice(Request $request)
    {
        // dd($request->all());
        $invoice = Invoice::where('user_id', $request->user_id)->where('created_at', now()->today())->first();
        if (!(isset($invoice))) {
            $invoice =  Invoice::create([
                'user_id' => $request->user_id,
                'invoice_no' => generate_invoice_no(),

            ]);
        }
        $haempay = Haematologyreq::findOrFail($request->haem_id);
        $haempay->invoices()->create([
            'invoice_id' => $invoice->id,
            'item_description' => $request->item_description,
            'amount' => $request->amount,
            'charge_id' => $request->charge_id,
        ]);

        $haempay->update([
            'status' => 'invoice generated',
        ]);
        $notification = [
            'message' => 'Invoice Generated Successfully',
            'alert-type' => 'success'
        ];
        return redirect()->route('haematology.index')->with($notification);
    }

    public function invoice($id)
    {
        $item = Haematologyreq::findOrFail($id);
        $charge = Charge::where('name', $item->investigation_required)->first();
        return view('admin.laboratories.haematology.invoice', compact('item', 'charge'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $number = Haematologyreq::findOrFail($id);
        return view('admin.laboratories.haematology.test', compact('number'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Haematologyreq $haematology)
    {
        $data = $request->except('_token');
        $data['status'] = "completed";
        $haematology->update($data);
        $notification = [
            'message' => 'record saved successfuly',
            'alert-type' => 'success'
        ];
        return redirect()->route('haematology.index')->with($notification);
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
