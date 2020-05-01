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
                <form method="POST" class="form form-element" onsubmit="return false;">

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
                                        <th>
                                            Select
                                        </th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($pharmreq->pharmreqDetails as $item)
                                <tr id="row{{$loop->iteration}}">
                                        <td class="drug_name">

                                            {{$item->drugModel->name}}
                                        </td>
                                        <td>
                                        <input type="hidden" name="drug_model_id[]" value="{{$item->drugModel->id}}" class="drug-model">
                                        <input type="hidden"  value="{{$item->drugModel->batch_no}}" class="batch_no">

                                            {{$item->dosage}}

                                        </td>
                                        <td>
                                            {{$item->duration}}
                                        </td>
                                        <td>
                                            <input type="text" class="form-control unit_cost" value="{{ $item->drugModel->price}}" readonly>


                                        </td>
                                        <td>
                                        <input type="number" name="quantity[]" class="form-control quantity" data-price="{{$item->drugModel->price}}" data-row="{{$loop->iteration}}" min="1">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control drug-cost"  readonly>

                                        </td>
                                        <td>
                                            <input type="checkbox" name="dispense[]" class="form-control-check paycheck" data-row="{{$loop->iteration}}">
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
                        <button type="submit" class="btn btn-primary underscore" data-user_id="{{$pharmreq->id}}" disabled>Make Payment</button>
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
                if(totalpaid != 0){
                     $(".underscore").attr('disabled', false);
                }

                $(".totalpaid").val(totalpaid);
            }else{
                $(".underscore").attr('disabled', true);
            }
        });

        $(".underscore").click(function(e){
                    var drugmodel = [];
                    var choosen =[];
                    var quantity = [];
                    var batch_no =[];
                    var unit_cost = [];
                    var drug_cost =[];
                    var drug_name =[];

                    var nurl = "{{route('pharmacy.index')}}";

                    var pharmreq_id = $(this).data('user_id');

                    $(".drug-model").each(function(){
                        drugmodel.push($(this).val());

                    });
                    $(".drug_name").each(function(){
                        drug_name.push($(this).text());
                    });
                    $(".batch_no").each(function(){
                        batch_no.push($(this).val());

                    });
                    $(".unit_cost").each(function(){
                        unit_cost.push($(this).val());

                    });
                    $(".drug-cost").each(function(){
                        drug_cost.push($(this).val());

                    });
                    $(".quantity").each(function(){
                        quantity.push($(this).val());

                    });
                    $(".paycheck").each(function(){
                        choosen.push($(this).val());

                    });
                    console.log(drug_cost, choosen, quantity, drugmodel);
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                            }
                            });

                            e.preventDefault();
                            var type = "POST";
                            var ajaxurl = 'calculate-drugs';
                                $.ajax({
                                    type: type,
                                    url: ajaxurl,
                                    data: {
                                        pharmid: pharmreq_id,
                                        drug_id:drugmodel,
                                        choosen:choosen,
                                        quantity:quantity,
                                        amount:totalpaid,
                                        batch_no: batch_no,
                                        unit_cost:unit_cost,
                                        drug_amount: drug_cost,
                                        drug_name: drug_name
                                            },
                                    dataType: 'json',
                                    success: function (data){


                                        $(location).attr('href',nurl);


                                    },
                                    error: function (data) {
                                        console.log('Error:', data);
                                    }
                                });

                                });

        });
    </script>
@endsection
