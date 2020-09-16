@extends('adin.admin')
@section('title')
birthdays {{date('Y/m/d')}}

@endsection
@section('head_css')
<link rel="stylesheet" href="{{asset('backend')}}/assets/js/plugins/datatables/dataTables.bootstrap4.css">
<link rel="stylesheet" href="{{asset('backend')}}/assets/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css">
<link rel="stylesheet" href="{{asset('backend')}}/assets/js/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css">

@endsection
@section('content')
<div class="content">
    <div class="block">
    <div class="block-header bg-success-light">
        <h3 class="block-title"> Birthday for today {{date('Y/m/d')}}</h3>
    </div>
    <div class="block-content block-content-full">
        @php
            $results = get_birthdays_today();
        @endphp
        @isset($results)
           <div class="table-responsive">
            <table class="table table-bordered table-striped table-vcenter js-dataTable-buttons">
                <thead class="text-uppercase">
                    <tr>
                        <th>
                            S/No
                        </th>
                        <th>
                            Date
                        </th>
                        <th>
                            name
                        </th>
                        <th>
                            phone
                        </th>
                        <th>
                            Age
                        </th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($results as $item)
                    <tr>
                        <td>
                            {{$loop->iteration}}
                        </td>
                        <td>
                            {{$item->dob->format('d/M/Y')}}
                        </td>
                        <td>
                            {{$item->full_name}}
                        </td>
                        <td>
                           {{$item->phone}}
                        </td>
                        <td>
                           {{$item->age}}
                        </td>
                    </tr>

                    @endforeach
                </tbody>

            </table>
            </table>
        </div>
        @endisset


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


@endsection
