<div class="block bg-gray-light get-health">
    <div class="block-header">
        <h3 class="block-title">Patient History Taking</h3>
    </div>
    <div class="block-content block-content-full">
    <form action="{{route('patient-history.store')}}" method="post">
            @csrf
            <input type="hidden" name="inpatient_id" value={{$inpatient->id}}>
            <input type="hidden" name="admin_id" value={{auth()->user()->id}}>
                <div class="form-group bg-city-lighter p-2">
                    <label for="firstName5">1. Past Health History </label>
                    <textarea name="past_health_history" class="form-control auto-expand" rows="6" placeholder="Patient's Past History"> {{old('past_health_history') ?? ''}}</textarea>

                </div>
                <div class="form-group bg-smooth-lighter p-2">
                    <label for="firstName6">2. Present Health History </label>
                    <textarea name="present_health_history" class="form-control auto-expand" rows="6" placeholder="Patient Local exam">{{old('present_health_history') ?? ''}}</textarea>
                </div>
                <button type="submit" class="btn btn-primary btn-lg w-100"><i class="fa fa-2x fa-save"></i> Save</button>
        </form>
    </div>
</div>



