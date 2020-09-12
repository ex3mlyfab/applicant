@extends('admin.admin')

@section('title')
    add charge
@endsection
@section('head_css')
<link rel="stylesheet" href="{{asset('backend')}}/assets/js/plugins/datatables/dataTables.bootstrap4.css">
<link rel="stylesheet" href="{{asset('backend')}}/assets/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css">

<link rel="stylesheet" href="{{asset('backend')}}/assets/js/plugins/select2/css/select2.min.css">
@endsection

@section('content')
<div class="content">
    <div class="row">

        <div class="col-md-12">
            <div class="block block-fx-shadow">
                <div class="block-header bg-info-light">All Purchase Orders for {{ date('Y') }}
                    <div class="block-options">
                        <button id="btn-add" name="btn-add" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#purchase-block-normal">Add New Purchase Order</button>
                    </div>
                </div>
                <div class="block-content block-content-full">
                    <div class="table-responsive ">
                        <table class="table table-bordered table-striped table-vcenter js-dataTable-buttons">
                            <thead>
                                <th>SN</th>
                                <th>Generated By</th>
                                <th>Supplier</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>action</th>
                            </thead>
                            <tbody>
                                @foreach ($purchaseOrder as $item)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$item->generatedBy->fullname}}</td>
                                    <td>{{$item->supplier->name}}</td>
                                    <td>₦ {{$item->amount}}</td>
                                <td> {{ $item->status }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{route('purchaseOrder.edit', $item->id)}}" class="btn btn-sm btn-primary" data-toggle="tooltip" title="Edit">
                                                <i class="fa fa-fw fa-pencil-alt"></i>
                                            </a>
                                            <form action="{{route('purchaseOrder.destroy', $item->id)}}" method="POST" >
                                                @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-sm btn-outline-info" data-toggle="tooltip" data-placement="top" title="delete expense" type="submit"><i class="fa fa-times text-danger ml-auto"></i></button>
                                                </form>
                                        </div>
                                    </td>
                                </tr>

                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal" id="purchase-block-normal" tabindex="-1" role="dialog" aria-labelledby="purchase-block-normal" aria-hidden="true" >
    <div class="modal-dialog modal-lg modal-dialog-top" role="document" >
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-primary-light">
                    <h3 class="block-title">Drug Purchase Order</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content font-size-sm">


                        <form class="form form-element" onsubmit="return false;">
                            @csrf
                            <div class="form-group form-row">
                                <div class="form-group col-md-4">
                                    <label for="supplier">Choose Supplier</label>
                                    <select name="supplier_id" id="supplier" class="form-control form-control-lg" required>
                                        <option value="" selected disabled>Choose</option>
                                        {{ create_option('suppliers', 'id', 'name') }}
                                    </select>
                                </div>
                                <div class="form-group ml-auto">
                                    <label class="ml-auto">Selected Supplier</label>
                                    <input type="text" class="form-control form-control-lg" id="selectedSupplier" readonly>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4 ml-auto">
                                    <label class="ml-auto">Total</label>
                                    <input type="text" id="totalPurchase" readonly placeholder="0" class="form-control form-control-lg">
                                </div>
                            </div>
                            <h2 class="text-center">Fill Purchase Order</h2>



                        <div class="table-responsive">


                                <table class="table table-bordered table-striped" id="drugs">
                                    <thead>
                                    <th>Drug Name - form</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Min/Avail</th>
                                    <th>Cost</th>

                                    <th style="text-align: center;background: #eee">

                                    </th>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td style="width:30%; ">
                                            <select  class="js-select2 form-control" style="width: 100%;" data-placeholder="Choose one.." id="drug-subcategory" required>
                                                <option></option>
                                                {{ create_option('drug_models','id', 'name')}}
                                            </select>
                                        </td>
                                        <td>
                                            <input type="text" id="price" class="form-control form-control-lg">
                                        </td>

                                        <td>
                                            <input type="number" id="qty" class="form-control form-control-lg">
                                        </td>
                                        <td>
                                            <input type="text" id="avail" class="form-control form-control-lg" readonly>
                                        </td>
                                        <td>
                                            <input type="number" id="lineCost" class="form-control form-control-lg" readonly>
                                        </td>

                                        <td  style="text-align: center">
                                                <button type="button" class="btn btn-success" id="addDrug" onclick="rowAdd()">
                                                    <i class="fa fa-plus"> Add Drug</i>
                                                </button>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>





                        <button  id="drugSubmit"  class="btn btn-primary ml-auto" >Submit
                            
                        </button>


                    </form>


                    </div>

                </div>

                <div class="block-content block-content-full text-right border-top">
                    <button type="button" class="btn btn-sm btn-light" data-dismiss="modal">Close</button>

                </div>
            </div>
        </div>
</div>


@endsection
@section('foot_js')
<script src="{{asset('backend')}}/assets/js/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{asset('backend')}}/assets/js/plugins/datatables/dataTables.bootstrap4.min.js"></script>
<script src="{{asset('backend')}}/assets/js/plugins/datatables/buttons/dataTables.buttons.min.js"></script>
<script src="{{asset('backend')}}/assets/js/plugins/datatables/buttons/buttons.print.min.js"></script>
<script src="{{asset('backend')}}/assets/js/plugins/datatables/buttons/buttons.html5.min.js"></script>
<script src="{{asset('backend')}}/assets/js/plugins/datatables/buttons/buttons.flash.min.js"></script>
<script src="{{asset('backend')}}/assets/js/plugins/datatables/buttons/buttons.colVis.min.js"></script>

<!-- Page JS Code -->
<script src="{{asset('backend')}}/assets/js/pages/be_tables_datatables.min.js"></script>
<script>
    $(function(){
        $('#supplier').on("change", function(){
            let classID = $("#supplier option:selected").text();
            let selected = $('#selectedSupplier');

            selected.val(classID);
        });
        $('#addDrug').attr('disabled', true);

        $('#qty').blur(function(){
            let price = $('#price').val();
            let quantity = $('#qty').val();

            if(Number(price) > 0){
                setTimeout(function(){
                     $('#lineCost').val((parseFloat(price)*parseFloat(quantity)).toFixed(2));
                $('#addDrug').attr('disabled', false);
                }, 200);

            }
        });

        $('#drug-subcategory').on("change", function(){
            var classID = $(this).val();
            var link = "{{ url('admin/selectdrug/') }}";
            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            if(classID) {
                $.ajax({
                    url: link+"/"+classID,
                    type: "GET",
                    dataType: "json",
                    contentType: "application/json",
                    data: JSON.stringify({
                        id : "value",
                        name: "value",
                        forms : "value"
                        }),
                    success:function(response) {


                        $('#price').val(response.price);
                        $('#avail').val(response.minimum_level + '/'+ response.maximum_level);

                        }
                        });

                    }



            });
    $("#drugSubmit").click(function(e){
            var drugname = [];
            var quantity = [];
            var price = [];


            $(".drug_model").each(function(){
                drugname.push($(this).val());

            });

            $(".dosage").each(function(){
                dosage.push($(this).val());
            });
            $(".instruction").each(function(){
                instruction.push($(this).val());
            });

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                    }
                    });

                    e.preventDefault();
                    var type = "POST";
                    var ajaxurl = 'pharmreq/create';
                        $.ajax({
                            type: type,
                            url: ajaxurl,
                            data: {
                                clinical_appointment: appointment,
                                drug_model_id:drugname,
                                dosage:dosage,
                                instruction:instruction
                                    },
                            dataType: 'json',
                            success: function (data){
                                let link =`
                                <li>
                                    <a class="text-dark media py-2" href="javascript:void(0)">
                                        <div class="mr-3 ml-2">

                                        </div>
                                        <div class="media-body">
                                            <div class="font-w600">${data.type}</div>
                                            <div class="text-success">${data.status}</div>
                                            <small class="text-muted">${ data.created_at}</small>
                                        </div>
                                    </a>
                                </li>`;
                                $("#recenttest").append(link);
                                $("#pharmacy-block-normal").modal('hide');


                            },
                            error: function (data) {
                                console.log('Error:', data);
                            }
                        });

                        });






    });
     function rowAdd(){

        let drugName =  $("#drug-subcategory option:selected").text();
        let drug = $('#drug-subcategory').val();
        let price =$('#price').val();
        let qty= $('#qty').val();
        let avail = $('#avail').val();
        let lineCost = $('#lineCost').val();
        let currentTotal = 0;
        let lineCosts = [];


        setTimeout(function(){
            let tablerow = `
        <tr>

            <td>
                <input type="text" value="${drugName}" class="form-control"  readonly >
                <input type="hidden" name="drug_model_id[]" value="${drug}" class="drug_model">
            </td>
            <td>
                <input type="text" name="price[]" value="${price}" class="form-control instruction" readonly>
            </td>
            <td>
                <input type="text" name="quantity[]" value="${qty}" class="form-control dosage" readonly>
            </td>

            <td>
                <input type="text"  value="${avail}" class="form-control" readonly>
            </td>
            <td>
                <input type="text" name="linecost[]" value="${lineCost}" class="form-control costLine" readonly>
            </td>

            <td class="remove" style="text-align: center">
            <a class="btn btn-danger" onclick="deleteRow()" > <i class="fa fa-times mr-1"></i>Delete</a>
            </td>

        </tr>`;
            $('#drugs tbody').append(tablerow);
            $(".costline").each(function(){
                lineCosts.push($(this).val());

         });

            let purchase = (Array.isArray(lineCosts) && lineCosts.length) ? lineCosts.reduce((total, amount) => total + amount, 0) : lineCost ;
         $('#totalPurchase').val(purchase);
        }, 200);

        $('#drug-subcategory').val('');
        $('#price').val('');
        $('#qty').val('');
        $('#avail').val('');
        $('#lineCost').val('');
        $('#addDrug').attr('disabled', true);



    }
    function deleteRow()
    {
        $(document).on('click', '.remove', function()
        {
            $(this).parent('tr').remove();
        });
    }
</script>


@endsection
