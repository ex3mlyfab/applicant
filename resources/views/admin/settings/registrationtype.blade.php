@extends('admin.admin')

@section('title')
add regtype

@endsection

@section('content')
<div class="content">
    <div class="block block-fx-shadow">
        <div class="block-header bg-amethyst-lighter">
            <h3 class="block-title">Registration Types</h3>
            <div class="block-options">

                <button id="btn-add" name="btn-add" class="btn btn-primary btn-xs">Add New Registration Type</button>

        </div>
        </div>

        <div class="block-content block-content-full">
            <div class="table-responsive">
                <table class="table table-stripe table-bordered" id="regtypes">
                    <thead>
                        <th>
                            s/no
                        </th>
                        <th> Registration type Name</th>
                        <th>
                            Max Enrollment Count
                        </th>
                        <th>
                            Charges
                        </th>
                        <th>
                            Notes
                        </th>
                        <th>
                            Action
                        </th>
                    </thead>
                    <tbody>
                        @foreach ($regtypes as $item)
                    <tr id="regtype{{ $item->id }}">
                            <td>
                                {{$loop->iteration}}
                            </td>
                            <td>
                                {{$item->name}}
                            </td>
                            <td>
                                {{$item->max_enrollment}}
                            </td>
                            <td>
                                {{$item->charge->amount}}
                            </td>
                            <td>
                                {{$item->note}}
                            </td>
                            <td>
                                <button class="btn btn-info open-modal" value="{{$item->id}}">Edit</button>
                                <button class="btn btn-danger delete-type" value="{{$item->id}}">Delete</button>

                            </td>
                        </tr>

                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="modal fade" id="regtype-block-normal" tabindex="-1" role="dialog" aria-labelledby="modal-block-normal" aria-hidden="true" >
        <div class="modal-dialog modal-dialog-top modal-dialog-popin modal-md" role="document"style=" width: 80%;">
            <div class="modal-content">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-secondary-dark">
                        <h3 class="block-title"  id="linkEditorModalLabel">Add Registration Type</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="fa fa-fw fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content font-size-sm">
                        <form id="formregtypes">
                            <div class="form-group">
                                <label for="registration_type">Registration Type</label>
                                <input type="text" name="name" id="registration_type" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="max_enrollment">Maximum Number of Enrollments</label>
                                <input type="number" name="max_enrollment" id="max_enrollment" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="charges">Select Charges</label>
                                <select name="charge_id" id="charges" class="form-control" required>
                                    <option value=""></option>
                                    {{ create_option('charges', 'id', 'name')}}
                                </select>
                            </div>
                        </form>

                    </div>
                    <div class="block-content block-content-full text-right border-top">
                        <button type="button" class="btn btn-primary" id="btn-save" value="add">Save changes
                        </button>
                        <input type="hidden" id="regtype_id" name="regtype_id" value="0">

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('foot_js')
<script>
    jQuery(document).ready(function($){
    ////----- Open the modal to CREATE a link -----////
        jQuery('#btn-add').click(function () {
            jQuery('#btn-save').val("add");
            jQuery('#formregtypes').trigger("reset");
            jQuery('#regtype-block-normal').modal('show');
        });

         ////----- Open the modal to UPDATE a reg type -----////
    jQuery('body').on('click', '.open-modal', function () {
        var link_id = $(this).val();
        $.get('regtype/' + link_id, function (data) {
            jQuery('#regtype_id').val(data.id);
            jQuery('#registration_type').val(data.name);
            jQuery('#max_enrollment').val(data.max_enrollment);
            jQuery('#charges').val(data.charge_id);

            jQuery('#btn-save').val("update");
            jQuery('#regtype-block-normal').modal('show');
        })
    });

    $("#btn-save").click(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });
        e.preventDefault();
        var formData = {
            name: jQuery('#registration_type').val(),
            max_enrollment: jQuery('#max_enrollment').val(),
            charge_id: jQuery('#charges').val(),
        };
        var state = jQuery('#btn-save').val();
        var type = "POST";
        var link_id = jQuery('#regtype_id').val();

        var ajaxurl = {{url('admin/regtype/create')}};
        if (state == "update") {
            type = "PUT";
            ajaxurl = {{url('admin/regtype/create')}} + link_id;
        }
        $.ajax({
            type: type,
            url: ajaxurl,
            data: formData,
            dataType: 'json',
            success: function (data) {

                var link = '<tr id="regtype' + data.id + '"><td>' + data.id + '</td><td>' + data.name + '</td><td>' + data.max_enrollment + '</td><td>' + data.amount + '</td><td>' + data.status + '</td>';
                link += '<td><button class="btn btn-info open-modal" value="' + data.id + '">Edit</button>&nbsp;';
                link += '<button class="btn btn-danger delete-link" value="' + data.id + '">Delete</button></td></tr>';
                if (state == "add") {
                    jQuery('#regtypes').append(link);
                } else {
                    $("#regtype" + link_id).replaceWith(link);
                }
                jQuery('#formregtypes').trigger("reset");
                jQuery('#regtype-block-normal').modal('hide')
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });
    ////----- DELETE a link and remove from the page -----////
    jQuery('.delete-type').click(function () {
        var link_id = $(this).val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "DELETE",
            url: 'regtype/destroy/' + link_id,
            success: function (data) {
                console.log(data);
                $("#regtype" + link_id).remove();
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });

    });
</script>
@endsection
