@extends('admin.admin');
@section('title')
    MD's Account
@endsection
@section('head_css')
<link rel="stylesheet" href="{{asset('backend')}}/assets/js/plugins/datatables/dataTables.bootstrap4.css">
<link rel="stylesheet" href="{{asset('backend')}}/assets/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css">

<link rel="stylesheet" href="{{asset('backend')}}/assets/js/plugins/select2/css/select2.min.css">

<link rel="stylesheet" href="{{asset('backend')}}/assets/js/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css">
@endsection

@section('content')
<div class="content">
    <div class="row">

        <div class="col-md-12">
            <div class="block block-fx-shadow">
                <div class="block-header bg-info-light">All MD's Discount Beneficiary
                    <div class="block-options">
                        <button type="button" data-toggle="modal" data-target="#modal-block-normal"><i class="fa fa-add"></i>Add new recipient</button>
                    </div>
                </div>
                <div class="block-content block-content-full">
                    <div class="table-responsive ">
                        <table class="table table-bordered table-striped table-vcenter js-dataTable-buttons">
                            <thead>
                                <th>SN</th>
                                <th>Name</th>
                                <th>Category / Percentage</th>
                                <th>Phone</th>

                                <th>action</th>
                            </thead>
                            <tbody>
                                @foreach ($mdaccounts as $item)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$item->user->full_name}}</td>
                                    <td>
                                    @foreach ($item->mdAccountCovers as $item2)
                                    <span class="badge badge-pill badge-primary">{{$item2->name.' '. $item2->percentage.' '.$item2->starts.' '.$item2->ends }}</span>

                                    @endforeach
                                    </td>


                                    <td>{{$item->user->phone}}</td>
                                    <td>
                                        <div class="btn-group">
                                            <button data-id-key="{{$item->id}}"
                                            class="btn btn-sm btn-primary update"
                                            data-route="{{route('mdaccount.update', $item->id)}}"
                                            data-covers="{{$item->mdAccountCovers}}" data-toggle="tooltip" title="Edit">
                                                <i class="fa fa-fw fa-pencil-alt"></i>
                                            </button>
                                            <form action="{{route('mdaccount.destroy', $item->id)}}" method="POST" >
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
<div class="modal" id="modal-block-normal" tabindex="-1" role="dialog" aria-labelledby="modal-block-normal" aria-hidden="true" >
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-secondary-dark">
                    <h3 class="block-title">Add A Beneficiary</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content font-size-sm">
                <form action="{{route('mdaccount.store')}}" method="post" id="form">
                    @csrf
                        <div class="form-group form-row">
                            <div class="col-md-4">
                                <label for="patient_id"> Patient Name</label>
                                <select name="user_id" id="patient_id" class="js-select2 form-control form-control-lg" style="width: 100%;" data-placeholder="Choose one..." >
                                    <option></option>
                                    @foreach ($patients as $item)
                                       <option value="{{$item->id}}">{{$item->full_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <span id="space">

                                </span>
                            </div>
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="folder_number">folder number</label>
                                        <input type="text" name="folder_number" id="folder_number" class="form-control form-control-lg" disabled>


                                    </div>
                                    <div class="col-md-12">
                                        <label for="sex">Sex</label>
                                        <input type="text" name="sex" id="sex" class="form-control form-control-lg" disabled>


                                    </div>
                                    <div class="col-md-12">
                                        <label for="phone">Phone Number</label>
                                        <input type="text"  id="phone" class="form-control form-control-lg" disabled>


                                    </div>
                                </div>
                            </div>


                        </div>

                        <div class="form-row">
                            <div class="col-md-6">
                                <label for="example-select2-multiple"> Select service type</label>
                                <select class="js-select2 form-control" id="example-select2-multiple" name="service_types[]" style="width: 100%;" data-placeholder="Choose many.." required multiple>
                                    <option></option><!-- Required for data-placeholder attribute to work with Select2 plugin -->
                                    <option value="consultation">consultation</option>
                                    <option value="pharmacy">Pharmacy</option>
                                    <option value="registration">Registration</option>



                                </select>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Duration</label>
                                    <div class="input-daterange input-group" data-date-format="mm/dd/yyyy" data-week-start="1" data-autoclose="true" data-today-highlight="true">
                                        <input type="text" class="form-control" id="example-daterange1" name="starts" placeholder="From" data-week-start="1" data-autoclose="true" data-today-highlight="true">
                                        <div class="input-group-prepend input-group-append">
                                            <span class="input-group-text font-w600">
                                                <i class="fa fa-fw fa-arrow-right"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control" id="example-daterange2" name="ends" placeholder="To" data-week-start="1" data-autoclose="true" data-today-highlight="true">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="percentage">Percentage Off</label>
                                <input type="number" name="percentage" max="100" id="percentage" step="0.1" class="form-control form-control-lg" required>
                            </div>
                        </div>
                        <div class="form-row d-flex">
                            <button type="submit" class="btn btn-lg btn-sucess justify-content-center"><i class="fa fa-save">Save</i></button>
                        </div>

                    </form>


                </div>
                <div class="block-content block-content-full text-right border-top">
                    <button type="button" class="btn btn-sm btn-light" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal"><i class="fa fa-check mr-1"></i>Ok</button>
                </div>
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
<script src="{{asset('backend')}}/assets/js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="{{asset('backend')}}/assets/js/plugins/select2/js/select2.full.min.js"></script>
<script>jQuery(function(){ One.helpers(['datepicker', 'select2']);  });
 </script>
<script>
    $(function(){
        $('.update').bind('click', function(){
            var classID = $(this).data('id-key');
            var link = "{{ url('admin/patient/classajax/') }}";
            var imgPath = "{{ asset('backend')}}/images/avatar";

            let covers = $(this).data('covers');
            let selectedValuesTest = covers.map(function(item){
                return item.name;
            });


            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });


                $.ajax({
                    type:"POST",
                    url:link+"/"+classID,
                    dataType: "json",
                    contentType: "application/json",
                    data: JSON.stringify({
                        avatar : "value",
                        sex: "value",
                        folder_number: "value",
                        phone:"value"
                        }),
                        error : function(data){
                            console.log("error:" + data)
                        },

                        success : function(response) {

                            $('#space').html('');
                        response.forEach(function(data) {
                            $('#space').append('<img src="'+ imgPath + '/' + data.avatar+ '" class="img-fluid img-avatar96">')
                            $('#sex').val(data.sex);
                            $('#folder_number').val(data.folder_number);
                            $('#phone').val(data.phone);
                        });

                        }
            });

            $('#form').append(`<input type="hidden" name="_method" value="PATCH">`);
            $('#form').attr('action', $(this).data('route'));
            $('#modal-block-normal').modal('show');
            $('#patient_id').val(classID).trigger('change');
            $('#percentage').val(covers[0].percentage);
            $('#patient_id').prop('disabled', true);
            $('#example-select2-multiple').select2({
                multiple: true,
            });
            $('#example-select2-multiple').val(selectedValuesTest).select2();
        });
        $('#patient_id').select2({
        dropdownParent: $('#modal-block-normal')
        });
        $('tbody tr:nth-child(odd)').addClass("bg-info-light");
        $('#patient_id').on('change', function(){
            var classID = $(this).val();
            var link = "{{ url('admin/patient/classajax/') }}";
            var imgPath = "{{ asset('backend')}}/images/avatar";

        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        $.ajax({
            type:"POST",
            url:link+"/"+classID,
            dataType: "json",
            contentType: "application/json",
            data: JSON.stringify({
                avatar : "value",
                sex: "value",
                folder_number: "value",
                phone:"value"
                }),
                error : function(data){
                    console.log("error:" + data)
                },

                success : function(response) {

                    $('#space').html('');
                response.forEach(function(data) {
                    $('#space').append('<img src="'+ imgPath + '/' + data.avatar+ '" class="img-fluid img-avatar96">')
                    $('#sex').val(data.sex);
                    $('#folder_number').val(data.folder_number);
                    $('#phone').val(data.phone);
                });

                }
        });

});
    });
</script>

@endsection
