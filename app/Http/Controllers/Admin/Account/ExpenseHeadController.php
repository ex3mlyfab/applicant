<?php

namespace App\Http\Controllers\Admin\Account;

use App\Http\Controllers\Controller;
use App\Models\ExpenseHead;
use Illuminate\Http\Request;

class ExpenseHeadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $expenseheads = ExpenseHead::all()->sortByDesc('name');
        return view('admin.account.expensehead', compact('expenseheads'));
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
        $data = $request->validate([
            'name' => 'required|unique:expense_heads',
        ]);

        ExpenseHead::create($data);
        $notification = [
            'message' => 'ExpenseHead created successfully',
            'alert-type' => 'success'
        ];
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
    public function edit(ExpenseHead $expensehead)
    {
        //
        $expenseheads = ExpenseHead::all()->sortByDesc('name');
        $task = $expensehead;

        return view('admin.account.expensehead', compact('expenseheads', 'task'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ExpenseHead $expensehead)
    {
        //
        $data = $request->validate([
            'name' => 'required',
        ]);
        $expensehead->update($data);

        $notification = [
            'message' => 'ExpenseHead updated successfully',
            'alert-type' => 'success'
        ];
        return redirect('admin/expensehead')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ExpenseHead $expensehead)
    {
        //
        $expensehead->delete();
        $notification = [
            'message' => 'ExpenseHead updated successfully',
            'alert-type' => 'info'
        ];
        return redirect('admin/expensehead')->with($notification);
    }
}
