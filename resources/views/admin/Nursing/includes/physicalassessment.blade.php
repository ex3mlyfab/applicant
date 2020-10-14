<div class="block bg-gray-light get-physical">
    <div class="block-header">
        <h3 class="block-title text-center bg-gray text-white">Physical Assesment (using IPPA technique)</h3>
    </div>
    <div class="block-content block-content-full">
    <form action="{{route('physical-assessment.store')}}" method="post">
            @csrf
            <input type="hidden" name="inpatient_id" value={{$inpatient->id}}>
            <input type="hidden" name="admin_id" value={{auth()->user()->id}}>
            <div class="form-row">

                <div class="form-group col-md-6 bg-success-light p-2">
                    <label for="firstName5">1. Hair</label>
                    <textarea name="hair" class="form-control auto-expand" rows="6" placeholder="hair">{{old('hair') ?? ''}}</textarea>

                </div>
                <div class="form-group col-md-6 bg-info-light p-2">
                    <label for="firstName6">2. eyes </label>
                    <textarea name="eyes" class="form-control auto-expand" rows="6" placeholder="eyes">{{old('eyes') ?? ''}}</textarea>
                </div>
            </div>
            <div class="form-row">

                <div class="form-group col-md-6 bg-flat-lighter p-2">
                    <label for="ears">3. Ears</label>
                    <textarea name="ears" class="form-control auto-expand" rows="6" placeholder="Ears">{{old('ears') ?? ''}}</textarea>

                </div>
                <div class="form-group col-md-6 bg-flat-light p-2">
                    <label for="firstName6">4. face </label>
                    <textarea name="face" class="form-control auto-expand" rows="6" placeholder="face and exercise">{{old('face') ?? ''}}</textarea>
                </div>
            </div>
            <div class="form-row">

                <div class="form-group col-md-6 bg-city-lighter p-2">
                    <label for="elimination">5. neck </label>
                    <textarea name="neck" class="form-control auto-expand" rows="6" placeholder="neck and perception">{{old('neck') ?? ''}}</textarea>

                </div>
                <div class="form-group col-md-6 bg-city-light p-2">
                    <label for="firstName6">6. upper limbs </label>
                    <textarea name="upper_limbs" class="form-control auto-expand" rows="6" placeholder="upper limbs">{{old('upper_limbs') ?? ''}}</textarea>
                </div>
            </div>
            <div class="form-row">

                <div class="form-group col-md-6 bg-amethyst-lighter p-2">
                    <label for="elimination">7. Chest</label>
                    <textarea name="chest" class="form-control auto-expand" rows="6" placeholder="Chest">{{old('chest') ?? ''}}</textarea>

                </div>
                <div class="form-group col-md-6 bg-amethyst-light p-2">
                    <label for="firstName6">8. Abdomen </label>
                    <textarea name="abdomen" class="form-control auto-expand" rows="6" placeholder="Abdomen">{{old('abdomen') ?? ''}}</textarea>
                </div>
            </div>
            <div class="form-row">

                <div class="form-group col-md-6 bg-modern-lighter p-2">
                    <label for="elimination">9. genitals</label>
                    <textarea name="genitals" class="form-control auto-expand" rows="6" placeholder="genitals">{{old('genitals') ?? ''}}</textarea>

                </div>
                <div class="form-group col-md-6 bg-modern-light p-2">
                    <label for="firstName6">10. Lower Limbs </label>
                    <textarea name="lower_limbs" class="form-control auto-expand" rows="6" placeholder="Lower Limbs">{{old('lower_limbs') ?? ''}}</textarea>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12 bg-modern p-2">
                    <label for="firstName6">11. Nurse's Admission Note:</label>
                    <textarea name="nurse_admission_note" class="form-control auto-expand" rows="4" placeholder="nurse admission note">{{old('nurse_admission_note') ?? ''}}</textarea>
                </div>
            </div>


                <button type="submit" class="btn btn-primary btn-lg w-100"><i class="fa fa-2x fa-save"></i> Save</button>
        </form>
    </div>
</div>
