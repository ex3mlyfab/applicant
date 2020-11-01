<div class="block">
    <div class="block-header with-border">
        <h4 class="block-title">Payments List</h4>


    </div>
    <!-- /.block-header -->
<div class="block-content">
    <div class="bg-info-light content">
        <div class="row">
            <div class="col-md-7">
                <h4 class="text-center">Today's earning</h4>
                <p class="text-center">₦{{$payments->sum('total')}}</p>
            </div>
            <div class="col-md-5 border border-primary border-2x">
                    <h4>Collectors List</h4>

                @foreach ($collectors as $item =>$values)
                   <h5 class="block-title">{{$item}} - ₦{{$values}}</h5>
                @endforeach
            </div>
        </div>

    </div>
    <div class="table-responsive">
        <table class="table table-striped table-hover table-vcenter js-dataTable-buttons">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Billing to</th>
                    <th>Amount</th>
                    <th>Service</th>
                    <th>Audited</th>
                    <th></th>

                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($payments as $item)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$item->billing }}</td>
                    <td>{{$item->total}}</td>
                    <td>
                        @switch($item->paymentable_type)
                            @case('App\Models\User')
                            @case('App\Models\Family')
                            @case('App\Models\Organization')
                            @case('App\Models\ClinicalAppointment')

                                Registration/Consultation
                                @break
                            @case('App\Models\Pharmreq')
                                Pharmacy
                                @break
                            @default
                                Others
                        @endswitch
                    </td>
                    <td>{{$item->remark}}</td>
                    <td></td>
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
