@extends('admin.admin')

@section('title')
Receive orders
@endsection
@section('content')
<div class="content">
    <div class="block pentacare-bg">
        <div class="block-header text-white" style="background: rgb(51, 70, 128, 0.8)">All Orders Recieved for {{ date('Y') }}
            @if ($approved->count())
                <div class="block-options">
                    <form action="{{ route('recieveorder.createOne')}}" class="form-inline" method="post">
                        @csrf
                        <select name="id" id="" class="form-control" required>
                            <option>choose one...</option>
                        @foreach ($approved as $item)
                        <option value="{{$item->id}}">{{$item->supplier->name.' '.$item->time_approved }}</option>
                        @endforeach
                        </select>
                        <button type="submit" class="btn btn-primary"> Recieve Order</button>

                    </form>

                </div>
            @endif

        </div>
        <div class="block-content block-content-full">
            <h3 class="text-center"> Recieved Orders</h3>
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-vcenter">
                    <thead>
                        <th>S/No</th>
                        <th>Supplier</th>
                        <th>Costs( ₦ )</th>
                        <th>Receipt No</th>
                        <th>P. Status</th>
                        <th> Checked by</th>
                    </thead>
                    <tbody>
                        @foreach ($recieve as $item)
                        <tr>
                            <td>
                                {{$loop->iteration}}
                            </td>
                            <td>
                            <a href="{{route('recieveorder.show', $item->id)}}"> {{$item->supplier->name}}</a>
                            </td>
                            <td class="text-right">
                                {{ number_format($item->costs, 2, '.', ',')}}
                            </td>
                            <td>
                                {{$item->receipt_no }}
                            </td>
                            <td>
                                {{ $item->payment_status}}
                            </td>
                            <td>
                                {{ $item->admin->name }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

@endsection
