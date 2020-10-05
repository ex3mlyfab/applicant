@extends('admin.admin')

@section('title')
{{$insurance->name  }}
@endsection
@section('head_css')
<!-- Page JS Plugins CSS -->

<link rel="stylesheet" href="{{asset('backend')}}/assets/js/plugins/select2/css/select2.min.css">

@endsection

@section('content')
    <div class="content">
        <div class="block block-fx-shadow pentacare-bg">
            <div class="block-header" style="background: rgb(51, 70, 128, 0.8)">
                <h3 class="block-title text-white">{{$insurance->name  }}</h3>
                <div class="block-options">
                    <button type="button" data-toggle="modal" data-target="#modal-block-normal"><i class="fa fa-add"></i>Add new Package</button>
                </div>

            </div>
            <div class="block-content block-content-full pentcare-bg">
                <div class="block block-bordered">
                    <div class="block-content block-content-full">
                        <div class="row no-gutters">
                            <div class="col-md-12">
                                <p class="mr-2" style="font-size: 17px">HMO Name</p>
                                <h3 class="mr-2" style="font-size: 18px">{{$insurance->name}}</h3>

                            </div>
                        </div>
                        <div class="pentacare-bg border-top">
                            <div class="content content-boxed">
                                <div class="row items-pus text-center">
                                    <div class="col-md-4 border-right">
                                        <div class="font-size-sm font-w600 text-muted text-uppercase bg-success-light">Company contact Phone</div>
                                        <a href="javascript:void(0)" class="link-fx font-size-h3">
                                          <span class="badge badge-pill badge-success">{{$insurance->contact_telephone}}</span>
                                        </a>
                                    </div>
                                    <div class="col-md-4 border-right">
                                        <div class="font-size-sm font-w600 text-muted text-uppercase bg-danger-light">Type</div>
                                        <a href="javascript:void(0)" class="link-fx font-size-h3">
                                            <span class="badge badge-pill badge-danger">{{$insurance->insuranceCategory->name}}</span>
                                        </a>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="font-size-sm font-w600 text-muted text-uppercase bg-warning-light">Address</div>
                                        <a href="javascript:void(0)" class="link-fx font-size-h3">
                                            <span class="badge badge-pill badge-warning">{{$insurance->address}}</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                    <hr>
                    <div class="table-responsive pentacare-bg">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <th>
                                    s/no
                                </th>
                                <th>
                                    Package name
                                </th>
                                <th>
                                    Percentage coverage
                                </th>
                                <th>
                                    services covered
                                </th>

                                <th>
                                    Actions
                                </th>
                            </thead>
                            <tbody>
                                @foreach ($insurance->insurancePackages as $item)
                                    <tr>
                                        <td>
                                            {{$loop->iteration}}
                                        </td>
                                        <td>
                                        <a href="{{route('insurancepackage.show', $item->id)}}">{{$item->name}}</a>
                                        </td>
                                        <td>
                                            {{$item->percentage}}
                                        </td>
                                        <td>
                                            @foreach ($item->insuranceServices as $item2)
                                            <span class="badge badge-pill badge-success">{{$item2->service_type}}</span>
                                            @endforeach
                                        </td>



                                        <td>
                                            <div class="btn-group">
                                            <button class="btn btn-sm btn-primary update" data-toggle="tooltip" title="Edit" data-name="{{$item->name}}" data-percentage="{{$item->percentage}}" data-services="{{$item->insuranceServices}}" data-note="{{$item->note}}" data-route="{{route('insurancepackage.update',$item->id)}}">
                                                    <i class="fa fa-fw fa-pencil-alt"></i>
                                                </button>
                                                <button type="button" class="btn btn-sm btn-danger" data-toggle="tooltip" title="Delete">
                                                    <i class="fa fa-fw fa-times"></i>
                                                </button>
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
    <div class="modal" id="modal-block-normal" tabindex="-1" role="dialog" aria-labelledby="modal-block-normal" aria-hidden="true" >
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-secondary-dark">
                    <h3 class="block-title">Add a Package for {{ $insurance->name}}</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="fa fa-fw fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content font-size-sm">
                    <form action="{{route('insurancepackage.store')}}" method="post" id="form">
                            @csrf
                            <div class="form-group form-row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="package">Package Name</label>
                                        <input type="text" name="name" id="package" class="form-control form-control-lg" required>
                                    <input type="hidden" name="insurance_id" value="{{$insurance->id}}">
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="percentage">Percentage Coverage</label>
                                        <input type="number" name="percentage" id="percentage" class="form-control form-control-lg" required>
                                    </div>
                                </div>

                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="example-select2-multiple"> Select service type</label>
                                        <select class="js-select2 form-control form-control-lg" id="example-select2-multiple" name="service_types[]" style="width: 100%;" data-placeholder="Choose many.." required multiple>
                                            <option></option><!-- Required for data-placeholder attribute to work with Select2 plugin -->
                                            <option value="consultation">consultation</option>
                                            <option value="pharmacy">Pharmacy</option>
                                            <option value="registration">Registration</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4 ml-auto">
                                    <label for="note">Note</label>
                                    <input type="text" name="note" id="note" class="form-control form-control-lg">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-outline-success btn-lg">Submit</button>

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
<script src="{{asset('backend')}}/assets/js/plugins/select2/js/select2.full.min.js"></script>
<script>jQuery(function(){
    One.helpers([ 'select2' ]);
    $('.update').bind('click', function(){
        $('#package').val($(this).data('name'));
        $('#percentage').val($(this).data('percentage'));
        $('#percentage').val($(this).data('percentage'));
        let covers = $(this).data('services');
        let selectedValuesTest = covers.map(function(item){
                return item.service_type;
            });
        $('#form').append(`<input type="hidden" name="_method" value="PATCH">`);
        $('#form').attr('action', $(this).data('route'));
        $('#modal-block-normal').modal('show');
        $('#example-select2-multiple').select2({
                multiple: true,
            });
        $('#example-select2-multiple').val(selectedValuesTest).select2();

    });

});</script>

@endsection
