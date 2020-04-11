@extends('admin.admin')
@section('title')
    cost drugs
@endsection

@section('content')
<div class="content">
    <div class="block">
        <div class="block-header">
            <h3 class="block-title">Calculate Drugs </h3>
        </div>
        <div class="block-content block-content-full">
            <div class="block block-fx-shadow">
                <div class="block-content">
                <form method="POST" action="{{route('pharmbill.store')}}" >
                    @csrf
                        <div class="form-group form-row">
                            <div class="col-md-4">
                            <img src="{{asset('public/backend')}}/images/avatar/{{$pharmreq->clinicalAppointment->user->avatar}}" alt="" >
                            </div>
                            <div class="col-md-4">
                                <label for="patient_id"> Patient Name</label>
                                <input type="text" value="{{$pharmreq->clinicalAppointment->user->full_name}}" class="form-control form-control-lg" disabled>

                            </div>
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="folder_number">folder number</label>
                                    <input type="text"  id="folder_number" value="{{$pharmreq->clinicalAppointment->user->folder_number}}" class="form-control form-control-lg" disabled>


                                    </div>
                                    <div class="col-md-12">
                                        <label for="sex">Sex</label>
                                    <input type="text"  id="sex" value="{{$pharmreq->clinicalAppointment->user->sex}}" class="form-control form-control-lg" disabled>
                                    <input type="hidden" name="user_id" value="{{$pharmreq->clinicalAppointment->user->id}}">

                                    </div>
                                </div>
                            </div>



                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-condensed">
                                <thead>
                                    <tr>
                                        <th>
                                            Drug
                                        </th>
                                        <th>
                                            Dosage
                                        </th>
                                        <th>
                                            Instruction
                                        </th>
                                        <th>
                                            Unit Price
                                        </th>
                                        <th>
                                            Quantity
                                        </th>
                                        <th>
                                            Amount
                                        </th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($pharmreq->pharmreqDetails as $item)
                                <tr id="row{{$loop->iteration}}">
                                        <td>
                                            <input type="checkbox" name="dispense[]" class="form-control-check paycheck" data-row="{{$loop->iteration}}">
                                            {{$item->drugModel->name}}
                                        </td>
                                        <td>
                                        <input type="hidden" name="drug_model_id[]" value="{{$item->drugModel->id}}" >
                                        <input type="hidden" name="batch_no[]" value="{{$item->drugModel->batch_no}}" >
                                            {{$item->dosage}}

                                        </td>
                                        <td>
                                            {{$item->duration}}
                                        </td>
                                        <td>
                                            <input type="text" name="unit_cost[]" class="form-control" value="{{ $item->drugModel->price}}" readonly>


                                        </td>
                                        <td>
                                        <input type="number" name="quantity[]" class="form-control quantity" data-price="{{$item->drugModel->price}}" data-row="{{$loop->iteration}}" min="1">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control drug-cost" name="drug_amount[]" readonly>
                                        </td>
                                    </tr>

                                    @endforeach
                                    <tr>
                                        <td colspan="5" class="font-w700 text-uppercase text-right bg-body-light">Total:</td>
                                        <td>
                                            ₦<input type="text" name="amount" class="form-control totalpaid">
                                        </td>

                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="form-group">
                            <div class="form-check">
                                <input type="checkbox" class="form-check confirm" id="example-cb-custom-circle-lg1" name="example-cb-custom-circle-lg1">
                                <label for="example-cb-custom-circle-lg1">Confirm Costing</label>
                            </div>


                        </div>
                        <button type="submit" class="btn btn-primary underscore" disabled>Make Payment</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('foot_js')
    <script>
        $(function(){
            $('.quantity').bind('blur', function(){
                var quantity = $(this).val();
                var price =parseFloat( $(this).data('price'));
                var rowid =  $(this).data('row');
                var amount = quantity * price;
                $('#row'+rowid+ ' .drug-cost').val(amount);

            });
             var totalpaid = 0;

        $(".paycheck").bind('change', function(){
            if(this.checked){
                var rowid =  $(this).data('row');
                 totalpaid += parseFloat($('#row'+rowid+ ' .drug-cost').val());

            }else{
                var rowid =  $(this).data('row');
                totalpaid -= parseInt( $('#row'+rowid+ ' .drug-cost').val());
                console.log(totalpaid);
            }
        });

        $(".confirm").change(function(){
            if(this.checked){
                if(totalpaid != 0)
                $(".underscore").attr('disabled', false);
                $(".totalpaid").val(totalpaid);
            }else{
                $(".underscore").attr('disabled', true);
            }
        });
        });
    </script>
@endsection
