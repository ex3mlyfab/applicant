@extends('admin.admin')
@section('title')
Revenue &amp; Expenses

@endsection

@section('content')
<div class="content">
    <div class="block">
        <div class="block-header bg-danger-light">
            <h3 class="block-title text-center">Income/ expenditure for the month of {{date('M')}}</h3>
            <div class="block-options">
            <a href="{{route('filter.payment')}}" class="btn btn-sm btn-flat">filter Payments</a>
                <button type="button" class="btn-block-option" data-toggle="block-option" data-action="fullscreen_toggle"></button>
            </div>
        </div>
        <div class="block-content block-content-full">
            <div class="row">
                <div class="col-md-6">
                    <div class="block-header bg-success-light">
                        <h3 class="block-title text-center">Income</h3>
                    </div>
                     <div class="table-responsive">
                         <table class="table table-bordered table-striped">
                             <thead>
                                 <tr>
                                     <th>
                                         S/No
                                     </th>
                                     <th>
                                         Date
                                     </th>
                                     <th>
                                         name
                                     </th>
                                     <th>
                                         Amount
                                     </th>

                                 </tr>
                             </thead>
                             <tbody>
                                 @foreach ($payments as $item)
                                 <tr>
                                     <td>
                                         {{$loop->iteration}}
                                     </td>
                                     <td>
                                         {{$item->created_at->format('d/M/Y')}}
                                     </td>
                                     <td>
                                         {{$item->service}}
                                     </td>
                                     <td class="text-right">
                                        ₦{{$item->amount}}
                                     </td>
                                 </tr>

                                 @endforeach
                             </tbody>
                             <tfoot class="bg-success-light">
                                 <th colspan="3">Total</th>
                                 <th class="text-right"> ₦ {{number_format($payments->sum('amount'),2, '.', ',')}}</th>
                             </tfoot>
                         </table>
                     </div>
                </div>
                <div class="col-md-6">
                    <div class="block-header bg-danger-light">
                        <h3 class="block-title text-center">Expenses</h3>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>
                                        S/No
                                    </th>
                                    <th>
                                        Date
                                    </th>
                                    <th>
                                        Name
                                    </th>
                                    <th>
                                        Amount
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($expenditure as $item)
                                 <tr>
                                     <td>
                                         {{$loop->iteration}}
                                     </td>
                                     <td>
                                         {{$item->created_at->format('d/M/Y')}}
                                     </td>
                                     <td>
                                         {{$item->name}}
                                     </td>
                                     <td>
                                        ₦{{$item->amount}}
                                     </td>
                                 </tr>

                                 @endforeach
                            </tbody>
                            <tfoot class="bg-danger-light text-white">
                                <th colspan="3">Total</th>
                                <th class="text-right"> ₦ {{number_format($expenditure->sum('amount'),2 , '.',',')}}</th>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            <div class="content bg-sucess-light">
                <h3 class="font-w600 text-center">
                    Balance: ₦ {{ number_format($payments->sum('amount') - $expenditure->sum('amount'), 2, '.', ',')}}
                </h3>
            </div>
        </div>
</div>

@endsection
