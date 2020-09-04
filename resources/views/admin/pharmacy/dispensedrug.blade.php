@extends('admin.admin')
@section('title')
    dispense drugs
@endsection

@section('content')
<div class="content">
    <div class="block">
        <div class="block-header">
            <h3 class="block-title">Dispense Drugs </h3>
        </div>
        <div class="block-content block-content-full">
            <div class="block block-fx-shadow">
                <div class="block-content">
                <form method="POST" class="form form-element" action="{{route('pharmacy.confirmdispense')}}">
                    @csrf
                        <div class="form-group form-row">
                            <div class="col-md-4">
                            <img src="{{asset('backend')}}/images/avatar/{{$pharmreq->clinicalAppointment->user->avatar}}" alt="" >
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
                                        <input type="hidden" name="pharmreq_id" value={{$pharmreq->id}}>

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

                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($pharmreq->pharmacyBill->pharmacyBillDetails as $item)
                                <tr id="row{{$loop->iteration}}">
                                        <td class="drug_name">

                                            {{$item->drugModel->name}}
                                        </td>
                                        <td>
                                        <input type="hidden" name="drug_model_id[]" value="{{$item->drugModel->id}}" class="drug-model">


                                            {{$item->dosage}}

                                        </td>
                                        <td>
                                            {{$item->instruction}}
                                        </td>
                                        <td>
                                            <input type="text" class="form-control unit_cost" value="{{ $item->unit_cost}}" readonly>


                                        </td>
                                        <td>
                                        <input type="number" name="quantity[]" class="form-control quantity" value="{{$item->quantity}}" min="1">
                                        </td>
                                        <td>
                                        <input type="text" class="form-control drug-cost" value="{{$item->amount}}" readonly>

                                        </td>

                                    </tr>

                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                        <div class="form-group">
                            <div class="form-check">
                                <input type="checkbox" class="form-check confirm" id="example-cb-custom-circle-lg1" name="example-cb-custom-circle-lg1">
                                <label for="example-cb-custom-circle-lg1">Confirm Dispense </label>
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
