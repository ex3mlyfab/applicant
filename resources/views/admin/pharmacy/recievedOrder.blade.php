@extends('admin.admin')

@section('title')
Receive orders
@endsection
@section('content')
<div class="content">
    <div class="block pentacare-bg">
        <div class="block-header bg-info-light">All Orders Recieved for {{ date('Y') }}
            <div class="block-options">
            <form action="{{ route('recieveorder.createOne')}}" class="form-inline" method="post">
                @csrf
                <select name="id" id="" class="form-control" required>
                    <option>choose one...</option>
                   @foreach ($approved as $item)
                <option value="{{$item->id}}">{{$item->supplier->name }}</option>
                   @endforeach
                </select>
                <button type="submit" class="btn btn-primary"> Recieve Order</button>

            </form>

            </div>
        </div>
        <div class="block-content block-content-full">
            <h3 class="text-center"> Recieved Orders</h3>
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-vcenter">
                    <thead>
                        <th>S/No</th>
                        <th>Supplier</th>
                        <th>Costs</th>
                        <th>Receipt No</th>
                        <th>P. Status</th>
                        <th> Checked by</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        @foreach ($recieve as $item)
                        <tr>
                            <td>
                                {{$loop->iteration}}
                            </td>
                            <td>
                                {{$item->supplier->name}}
                            </td>
                            <td>
                                {{ $item->costs}}
                            </td>
                            <td>
                                {{$item->receipt_no }}
                            </td>
                            <td>
                                {{ $item->payment_status}}
                            </td>
                            <td>
                                {{ $item->checked_by }}
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
