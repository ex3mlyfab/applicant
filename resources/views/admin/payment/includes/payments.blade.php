<div class="block">
    <div class="block-header with-border">
        <h4 class="block-title">Payments List</h4>


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
                    <th>Audited</th>

                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($payments as $item)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$item->billing }}</td>
                    <td>{{$item->amount}}</td>
                    <td></td>
                    <td>{{$item->status}}</td>
                    <td>

                        <a href="{{route('payment.print', $item->id)}}" class="text-info">Print Receipt</a>




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
