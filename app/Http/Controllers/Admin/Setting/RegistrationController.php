<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Http\Resources\RegistrationTypesResource;
use App\Models\RegistrationType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class RegistrationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $regtypes = RegistrationType::all();
        return view('admin.settings.registrationtype', compact('regtypes'));
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
        $link = RegistrationType::create($request->all());

        $notification = [
            'message' => 'Regtype added succesfully',
            'alert-type' => 'success'
        ];
        // return Response::json($link);
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $regtype = RegistrationType::findOrFail($id);
        return Response::json($regtype);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RegistrationType $regtype)
    {
        $data = $request->except('_token');
        $regtype->update($data);

        $link = $regtype->with('charge:id, amount');
        $link = json_encode($link);
        return Response::json($link);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(RegistrationType $regtype)
    {
        $regid = $regtype->id;
        $regtype->delete();
        return Response::json($regid);
    }
}
