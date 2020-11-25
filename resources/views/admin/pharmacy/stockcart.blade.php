@extends('admin.admin')

@section('title')
Stock cart
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
            <div class="block block-fx-shadow pentacare-bg">
                <div class="block-header text-white" style="background: rgb(51, 70, 128, 0.8)">All Cart Stocks for {{ date('Y') }}
                    <div class="block-options">
                        <a href="{{route('pharmacy.index')}}" class="btn btn-primary"><i class="fa fa-door-open"></i> Go to Dashboard</a>
                        <button id="btn-add" name="btn-add" style="font-size: 13px" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#purchase-block-normal"><i class="fa fa-plus-circle"></i> Stock Cart</button>
                    </div>
                </div>
                <div class="block-content block-content-full pentacare-bg">
                    <div class="table-responsive pentacare-bg">
                        <table class="table table-bordered table-striped pentacare-bg table-vcenter js-dataTable-buttons">
                            <thead>
                                <th>SN</th>
                                <th>unit</th>
                                <th>Supplied by</th>
                                <th>Received By</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>action</th>
                            </thead>
                            <tbody>
                                @foreach ($carts as $item)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                <td>{{ucfirst($item->cart_type)}}</td>
                                    <td>{{$item->generatedBy->name}}</td>
                                    <td>{{$item->recievedBy->name ?? ''}}</td>
                                    <td>₦ {{number_format($item->costs,2, '.', ',')}}</td>
                                <td> {{ $item->status }}</td>
                                    <td>
                                        <div class="btn-group">
                                        <a href="{{($item->status == 'completed'|| $item->status == 'approved' ) ? route('purchaseOrder.show', $item->id): route('purchaseOrder.edit', $item->id) }}" class="btn btn-sm btn-primary" data-toggle="tooltip" title="{{($item->status == 'completed' || $item->status == 'approved') ? 'preview': 'grant approval'  }}">
                                                <i class="fa fa-fw {{($item->status == 'completed' || $item->status == 'approved') ? 'fa-clipboard': 'fa-pencil-alt'  }}"></i>
                                            </a>
                                            <form action="{{route('purchaseOrder.destroy', $item->id)}}" method="POST" >
                                                @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-sm btn-outline-danger" data-toggle="tooltip" data-placement="top" title="delete expense" type="submit"><i class="fa fa-times ml-auto"></i></button>
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
            <div class="block block-themed pentacare-bg block-transparent mb-0">
                <div class="block-header" style="background: rgb(51, 70, 128, 0.8)">
                    <h3 class="block-title text-white" >stock Cart </h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content font-size-sm">
                <form class="form form-element" action="{{ route('stockcart.store')}}" method="POST">
                            @csrf
                            <div class="form-group form-row">
                                <div class="form-group col-md-4">
                                    <label for="supplier">Select cart</label>
                                    <select style="border: 1px solid rgb(51, 70, 128, 0.8)" name="supplier_id" id="supplier" class="form-control form-control-lg" required>
                                        <option selected disabled>Choose</option>
                                        <option value="emergency">Emergency Cart</option>
                                        <option value="theater">Theater Cart</option>
                                    </select>
                                </div>

                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4 ml-auto">
                                    <label class="ml-auto">Total</label>
                                    <input style="border: 1px solid rgb(51, 70, 128, 0.8)" type="text" id="totalPurchase" name="totalPurchase" readonly placeholder="0" class="form-control form-control-lg">
                                </div>
                            </div>
                            <h2 class="text-center">Stock Cart</h2>
                        <div class="table-responsive">


                                <table class="table table-bordered table-striped" id="drugs">
                                    <thead>
                                    <th>Drug Name</th>
                                    <th>Form</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Cost</th>

                                    <th style="text-align: center;background: #eee">

                                    </th>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td style="width:15%; ">
                                            <select  class="js-select2 form-control" style="width: 100%; border: 1px solid rgb(51, 70, 128, 0.8)" data-placeholder="Choose one.." id="drug-subcategory">
                                                <option class="p-2"></option>
                                                {{ create_option('drug_models','id', 'name')}}
                                            </select>
                                        </td>
                                        <td>
                                            <input style="border: 1px solid rgb(51, 70, 128, 0.8)" type="text" id="drugform" class="form-control form-control-lg mx-0 p-0" style="width:20%; " >
                                        </td>
                                        <td>
                                            <input style="border: 1px solid rgb(51, 70, 128, 0.8)" type="number" id="price" class="form-control form-control-lg p-0">
                                        </td>

                                        <td>
                                            <input style="border: 1px solid rgb(51, 70, 128, 0.8)" type="number" id="qty" class="form-control form-control-lg"  min="0.1" step="0.1">
                                        </td>

                                        <td>
                                            <input style="border: 1px solid rgb(51, 70, 128, 0.8)" type="number" id="lineCost" class="form-control form-control-lg" readonly>
                                        </td>

                                        <td  style="text-align: center">
                                                <button type="button" class="btn btn-success p-3" id="addDrug" onclick="rowAdd()">
                                                    <i class="fa fa-plus-circle"> Add Drug</i>
                                                </button>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>





                        <button  id="drugSubmit" type="submit"  class="btn btn-primary ml-auto" >Submit

                        </button>


                    </form>


                    </div>

                </div>

                <div class="block-content block-content-full text-right border-top">
                    <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Close</button>

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
<script src="{{asset('backend')}}/assets/js/plugins/select2/js/select2.full.min.js"></script>
<script>jQuery(function(){ One.helpers([ 'select2']); });</script>
<script>
    $(function(){

        $('#addDrug').attr('disabled', true);

        $('#qty').blur(function(){
            let price = $('#price').val();
            let quantity = $('#qty').val();

            if(Number(quantity) > 0){
                setTimeout(function(){
                     $('#lineCost').val((parseFloat(price)*parseFloat(quantity)).toFixed(2));
                $('#addDrug').attr('disabled', false);

                }, 200);

            }
        });
        $('#drug-subcategory').select2({
                dropdownParent: $('#purchase-block-normal')
            });
        $('#drugSubmit').attr('disabled', true);
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

                        $('#drugform').val(response.forms+ '-' +response.strength);
                        $('#price').val(response.sales_price);
                        $('#avail').val(response.minimum_level + '/'+ response.available);
                        $('#qty').prop('max', response.available);
                        }
                        });

                    }



            });

    });
     function rowAdd(){

        let drugName =  $("#drug-subcategory option:selected").text();
        let drug = $('#drug-subcategory').val();
        let price =$('#price').val();
        let form = $('#drugform').val();
        let qty= $('#qty').val();
        let avail = $('#avail').val();
        let lineCost = $('#lineCost').val();
        let currentTotal = 0;
        let lineCosts = [];
        $('#drugSubmit').attr('disabled', false);

        setTimeout(function(){
            let tablerow = `
        <tr>

            <td>
                <input type="text" value="${drugName}" class="form-control"  readonly >
                <input type="hidden" name="drug_model_id[]" value="${drug}" class="drug_model">
            </td>
            <td>
                <input type="text" value="${form}" class="form-control instruction" readonly>
            </td>
            <td>
                <input type="text" name="price[]" value="${price}" class="form-control instruction" readonly>
            </td>
            <td>
                <input type="text" name="quantity[]" value="${qty}" class="form-control dosage" readonly>
            </td>
            <td>
                <input type="text" name="linecost[]" value="${lineCost}" class="form-control costLine" readonly>
            </td>

            <td class="remove" style="text-align: center">
            <a class="btn btn-danger" onclick="deleteRow()"> <i class="fa fa-times-plus text-white mr-1"></i><span class="text-white"> Delete</span></a>
            </td>

        </tr>`;


          $('#drugs tbody').append(tablerow);
            $(".costLine").each(function(){
                lineCosts.push(parseFloat($(this).val()));

         });

            let purchase = (Array.isArray(lineCosts) && lineCosts.length) ? lineCosts.reduce((total, amount) => total + amount, 0) : lineCost ;
         $('#totalPurchase').val(parseFloat(purchase).toFixed(2));
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
                setTimeout(function(){
                let lineCosts = [];
                $(".costLine").each(function(){
                lineCosts.push(parseFloat($(this).val()));

            });

            let purchase = (Array.isArray(lineCosts) && lineCosts.length) ? lineCosts.reduce((total, amount) => total + amount, 0) : 0 ;
                $('#totalPurchase').val(parseFloat(purchase).toFixed(2));

                 if(purchase > 0){
                $('#drugSubmit').attr('disabled', false);
            }else{
                 $('#drugSubmit').attr('disabled', true);
            }
            }, 300);

            });

        }
</script>

@endsection
