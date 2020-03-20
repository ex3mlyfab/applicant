@extends('admin.admin')

@section('title')
all Payments
@endsection

@section('content')
    <div class="content">
        <div class="col-12">
            <div class="block">
                <div class="block-header with-border">
                    <h4 class="block-title">Invoices List</h4>


                </div>
            <!-- /.block-header -->
            <div class="block-content">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Billing to</th>
                                <th>Amount</th>
                                <th>Invoice No</th>
                                <th>Status</th>

                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($invoices as $item)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$item->billing }}</td>
                                <td>{{$item->amount}}</td>
                                <td>{{$item->invoice_no}}</td>
                                <td>{{$item->status}}</td>
                                <td>
                                    @if(($item->status == Null))
                                        <a href="{{route('invoice.edit', $item->id)}}" class="text-info">Make Payment  </a>
                                    @else
                                    <a href="#">PRINT REPORT </a>
                                    <a href="#" data-toggle="modal" data-target="#comment-dialog" class="text-info">Comment  </a>
                                    @endif

                                </td>

                            </tr>
                            @empty

                            @endforelse
                        </tbody>
                        </table>
                </div>
            </div>
            <!-- /.block-body -->
            </div>
            <!-- /.block -->
        </div>
    </div>


@endsection
