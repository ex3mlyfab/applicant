@extends('admin.admin')
@section('title')
    cost drugs
@endsection

@section('content')
<div class="content">
    <div class="block">
        <div class="block-header">
            <h3 class="block-title">Preview Prescription </h3>
        </div>
        <div class="block-content block-content-full">
            <div class="block block-fx-shadow">
                <div class="block-content">

                        <div class="form-group form-row">
                            <div class="col-md-4">
                            <img src="{{asset('backend')}}/images/avatar/{{$pharmreq->encounter->user->avatar}}" alt="" >
                            </div>
                            <div class="col-md-4">
                                <label for="patient_id"> Patient Name</label>
                                <input type="text" value="{{$pharmreq->encounter->user->full_name}}" class="form-control form-control-lg" disabled>

                            </div>
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="folder_number">folder number</label>
                                    <input type="text"  id="folder_number" value="{{$pharmreq->encounter->user->folder_number}}" class="form-control form-control-lg" disabled>


                                    </div>
                                    <div class="col-md-12">
                                        <label for="sex">Sex</label>
                                    <input type="text"  id="sex" value="{{$pharmreq->encounter->user->sex}}" class="form-control form-control-lg" disabled>


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
                                            Forms/Strength
                                        </th>
                                        <th>
                                            Dosage
                                        </th>
                                        <th>
                                            Duration
                                        </th>
                                        <th>
                                            Qty
                                        <th>
                                            Price
                                        </th>
                                        <th>
                                            line cost
                                        </th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($pharmreq->pharmreqDetails as $item)
                                <tr id="row-{{$item->id}}">
                                        <td class="drug_name">
                                            {{$item->drugModel->name}}
                                        </td>
                                        <td>
                                            {{$item->drugModel->forms}} /{{$item->drugModel->strength}}

                                        </td>
                                        <td>
                                            {{$item->dosage}}
                                        </td>
                                        <td>
                                            {{$item->duration}}


                                        </td>
                                        <td>
                                            {{$item->quantity}}
                                        </td>
                                        <td>
                                            {{$item->cost/$item->quantity}}

                                        </td>
                                        <td>
                                            {{$item->cost}}
                                        </td>
                                    </tr>

                                    @endforeach
                                    <tr>
                                        <td colspan="6" class="font-w700 text-uppercase text-right bg-body-light">Total:</td>
                                        <td>
                                            ₦{{$pharmreq->total}}
                                        </td>

                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        {{-- <form method="POST" class="form form-element" onsubmit="return false;">

                        <button type="submit" class="btn btn-primary underscore" data-user_id="{{$pharmreq->id}}" disabled>Make Payment</button>
                    </form> --}}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('foot_js')
    <script>
        $(function(){


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
