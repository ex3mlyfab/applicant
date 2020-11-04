@extends('admin.admin')
@section('title')
    dispense drugs
@endsection

@section('content')
<div class="content">
    <div class="block">
        <div class="block-header">
            <h3 class="block-title">Dispense Drugs </h3>
            <div class="block-option">
                <a href="{{route('pharmacy.index')}}" class="btn btn-primary"><i class="fa fa-door-open"></i> Go to Dashboard</a>
            </div>
        </div>
        <div class="block-content block-content-full">
            <div class="block block-fx-shadow">
                <div class="block-content">
                <form method="POST" class="form form-element" action="{{route('pharmacy.confirmdispense')}}">
                    @csrf
                        <div class="form-group form-row">
                            <div class="col-md-4">
                            <img src="{{asset('backend')}}/images/avatar/{{$pharmreq->encounter->user->avatar}}" alt="{{$pharmreq->encounter->user->full_name}}" style="max-width: 100%;" >
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
                                        <input type="hidden" name="pharmreq_id" value={{$pharmreq->id}}>

                                    </div>
                                </div>
                            </div>



                        </div>
                        <h3 class="text-center text-uppercase">Prescription</h3>
                        <div class="row">
                            <div class="col-md-6">
                                <p>
                                    <strong>Prescribed by:</strong>
                                    {{$pharmreq->seenBy->name}}
                                </p>
                            </div>
                            <div class="col-md-6 text-right">
                                <p class="text-mute">status: {{$pharmreq->status}}</p>
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
                                            Dosage/Duration
                                        </th>
                                        <th>
                                            QTy
                                        </th>
                                        <th>
                                            dispensed
                                        <th>
                                            Price
                                        </th>
                                        <th>
                                            line cost
                                        </th>
                                    </tr>
                                </thead>


                                <tbody>
                                    @foreach ($paidfor as $item)
                                    @if (!$item->dispensed)
                                        <tr id="row{{$loop->iteration}}">
                                            <td class="drug_name">
                                                <input type="hidden" name="pharmreq_detail_id[]" value="{{$item->id}}">
                                                {{$item->drugModel->name}}
                                            </td>
                                            <td>
                                                <input type="hidden" name="drug_model_id[]" value="{{$item->drugModel->id}}" class="drug-model">

                                                {{$item->drugModel->forms}} /{{$item->drugModel->strength}}

                                            </td>
                                            <td>
                                                {{$item->dosage}}/<br>{{$item->duration}}
                                            </td>
                                            <td>
                                                {{$item->quantity}}
                                            </td>
                                            <td>
                                                <input type="number" name="dispensed_quantity[]" class="form-control quantity" value="{{$item->quantity}}" min="0" step="0.1" max="{{$item->quantity}}">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control unit_cost" value=" {{$item->cost/$item->quantity}}" readonly>


                                            </td>

                                            <td>
                                            <input type="text" class="form-control drug-cost" value="{{$item->cost}}" readonly>

                                            </td>

                                        </tr>

                                    @endif


                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                        <div class="form-group">
                            <div class="form-check">
                                <input type="checkbox" class="form-check confirm" id="example-cb-custom-circle-lg1" name="example-cb-custom-circle-lg1">
                                <label for="example-cb-custom-circle-lg1">Confirm Dispense &AMP; Counselling</label>
                            </div>


                        </div>
                        <button type="submit" class="btn btn-primary underscore" disabled>Submit</button>
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




        $(".confirm").change(function(){
            if(this.checked){
                $(".underscore").attr('disabled', false);
            }else{
                $(".underscore").attr('disabled', true);
            }
        });


        });
    </script>
@endsection
