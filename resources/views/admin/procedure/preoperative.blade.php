@extends('admin.admin')

@section('title')
   Operation Report
@endsection

@section('content')
<div class="content">
    <div class="block pentacare-bg">
        <div class="block-header">
            <h3 class="block-title">Operation Report</h3>
            <div class="block-option">
            <a href="{{route('surgicalpatient.index')}}" class="btn btn-primary"><i class="fa fa-door-open"></i>
            Back</a>
            </div>
        </div>
        <div class="block-content block-content-full">
            <div class="row">
                <div class="col-md-4">
                    <img class="w-100 rounded" id="pictures">
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="name">Patient Name</label>
                        <input type="text" id="name" class="form-control form-control-lg" readonly>
                    </div>
                    <div class="form-group">
                      <label>Age</label>
                      <input type="text" id="age" class="form-control form-control-lg" readonly>
                    </div>

                </div>
                <div class="col-md-4">
                    <div class="col-md-12">
                        <label for="folder_number">folder number</label>
                        <input type="text" id="folder_number" class="form-control form-control-lg" readonly>


                    </div>
                    <div class="col-md-12">
                        <label for="sex">Sex</label>
                        <input type="text" id="sex" class="form-control form-control-lg" readonly>


                    </div>
                    <div class="col-md-12">
                        <label for="phone">Phone Number</label>
                        <input type="text" id="phone" class="form-control form-control-lg" readonly>


                    </div>
                </div>
            </div>
            <h3 class="block-title text-center bg-dark text-white">Operation Report</h3>
            <div class="row">
                <div class="col-md-4">
                    <div class="block block-themed">
                                <div class="block-header">
                                    <h3 class="block-title text-center">Operation Name :</h3>
                                </div>
                                <div class="block-content">
                                    <p>{{ ucfirst($report->operation_name)}}</p>
                                </div>
                            </div>
                </div>
                <div class="col-md-4">
                    <div class="block block-themed">
                                <div class="block-header">
                                    <h3 class="block-title text-center">Position</h3>
                                </div>
                                <div class="block-content">
                                    <p>{{ ucfirst($report->position)}}</p>
                                </div>
                            </div>
                </div>
                <div class="col-md-4">
                    <div class="block block-themed">
                        <div class="block-header">
                            <h3 class="block-title text-center">Incision</h3>
                        </div>
                        <div class="block-content">
                            <p>{{ ucfirst($report->incision)}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="block block-themed">
                        <div class="block-header">
                            <h3 class="block-title text-center">Pre operative pcv</h3>
                        </div>
                        <div class="block-content">
                            <p>{{ $report->pre_operative_pcv}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="block block-themed">
                        <div class="block-header">
                            <h3 class="block-title text-center">Findings</h3>
                        </div>
                        <div class="block-content">
                            <p>{{ ucfirst($report->findings)}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="block block-themed">
                        <div class="block-header">
                            <h3 class="block-title text-center">Procedure</h3>
                        </div>
                        <div class="block-content">
                            <p>{{ ucfirst($report->procedure)}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="block block-themed">
                        <div class="block-header">
                            <h3 class="block-title text-center">Estimated blood Loss</h3>
                        </div>
                        <div class="block-content">
                            <p>{{ $report->estimated_blood_loss}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="block block-themed">
                        <div class="block-header">
                            <h3 class="block-title text-center">Lead Surgeon</h3>
                        </div>
                        <div class="block-content text-uppercase">
                            <p>{{ $report->estimated_blood_loss}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>


@endsection
