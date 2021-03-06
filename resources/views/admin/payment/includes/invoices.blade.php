<div class="block">
    <div class="block-header with-border">
        <h4 class="block-title">Invoices List</h4>


    </div>
    <!-- /.block-header -->
<div class="block-content">
    <div class="table-responsive">
        <table class="table table-striped table-hover table-vcenter js-dataTable-buttons">
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
                @forelse ($unpaid as $item)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$item->billing }}</td>
                    <td>{{$item->amount}}</td>
                    <td>{{$item->invoice_no}}</td>
                    <td>{{$item->status}}</td>
                    <td>
                        @if(($item->p_status == 'NYP') || ($item->p_status =='partial paid'))
                            <a href="{{route('payment.settle', $item->id)}}" class="text-info">Make Payment  </a>
                        @else
                        <a href="{{route('payment.invoice', $item->id)}}" class="text-info">print Receipt  </a>

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
