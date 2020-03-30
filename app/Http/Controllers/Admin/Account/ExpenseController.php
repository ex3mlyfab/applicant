<?php

namespace App\Http\Controllers\Admin\Account;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use App\Models\ExpenseHead;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $expenses = Expense::whereMonth('created_at', '=', date('m'))->get();
        $expenseheads = ExpenseHead::all();
        return view('admin.account.expense', compact('expenses', 'expenseheads'));
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
        $data = $request->validate([
            'expense_head_id' => 'required',
            'name' => 'required',
            'received_by' => 'nullable',
            'amount' => 'required',
            'status' => 'nullable',
        ]);
        $data['academic_term_id'] = get_option('current_term');
        Expense::create($data);
        $notification = [
            'message' => 'Expense Recorded successfully',
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
    public function edit(Expense $expense)
    {
        //
        $expenses = Expense::whereMonth('created_at', '=', date('m'))->get();
        $expenseheads = ExpenseHead::all();
        $task = $expense;
        return view('admin.account.expense', compact('expenses', 'expenseheads', 'task'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Expense $expense)
    {
        //
        $data = $request->validate([
            'expense_head_id' => 'required',
            'name' => 'required',
            'received_by' => 'nullable',
            'amount' => 'required',
            'status' => 'nullable',
        ]);
        $data['academic_term_id'] = get_option('current_term');
        $expense->update($data);
        $notification = [
            'message' => 'Expense Updated successfully',
            'alert-type' => 'success'
        ];
        return redirect('admin/expense')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Expense $expense)
    {
        $expense->delete();
        $notification = [
            'message' => 'Expense deleted successfully',
            'alert-type' => 'success'
        ];
        return redirect('admin/expense')->with($notification);
    }
}
