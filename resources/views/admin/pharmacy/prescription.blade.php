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
                            <img class="rounded" style="max-width: 100%;" src="{{asset('backend')}}/images/avatar/{{$pharmreq->encounter->user->avatar}}" alt="{{$pharmreq->encounter->user->full_name}}" >
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

    </script>
@endsection
