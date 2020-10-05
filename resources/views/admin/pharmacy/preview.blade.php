@extends('admin.admin')
@section('content')
<div class="content">
    <div class="block pentacare-bg">
        <div class="block-header">
            <h3 class="block-title"></h3>
        </div>
        <div class="block-content block-content-full">
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    let tablerow = `
                    <tr>
        
                        <td>
                            <input type="text" value="${drugName}" class="form-control"  readonly >
                            <input type="hidden" name="drug_model_id[]" value="${drug}" class="drug_model">
                        </td>
                        <td>
                            <input type="text"  value="${drugForms}" class="form-control" readonly>
                        </td>
                        <td>
                            <input type="text" name="dosage[]" value="${dosage}" class="form-control drugDosage" readonly>
                        </td>
                        <td>
                            <input type="text" name="duration[]" value="${duration}" class="form-control drugDuration" readonly>
                        </td>
                        <td>
                            <input type="text" name="quantity[]" value="${qty}" class="form-control quantity" readonly>
                        </td>
                        <td>
                            <input type="text" name="price[]" value="${price}" class="form-control dosage" readonly>
                        </td>
        
                        <td>
                            <input type="text" name="linecost[]" value="${lineCost}" class="form-control costLine" readonly>
                        </td>
        
                        <td class="remove" style="text-align: center">
                            <a class="btn btn-danger" onclick="deleteRow()">
                            <i class="fa fa-times-plus text-white mr-1"></i>
                            <span class="text-white"> Delete</span></a>
                        </td>
        
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
    
@endsection