<div class="block bg-gray-light get-funhealth">
    <div class="block-header">
        <h3 class="block-title text-center bg-gray text-white">gordon's 11 typology of functional health pattern</h3>
    </div>
    <div class="block-content block-content-full">
    <form action="{{route('fun-health.store')}}" method="post">
            <input type="hidden" name="inpatient_id" value={{$inpatient->id}}>
            <input type="hidden" name="admin_id" value={{auth()->user()->id}}>
            @csrf
            <div class="form-row">

                <div class="form-group col-md-6 bg-city-lighter p-2">
                    <label for="firstName5">1. Health Perception and health management</label>
                    <textarea name="health_man" class="form-control auto-expand" rows="6" placeholder="Health Perception and health mangement">{{old('health_man') ?? ''}}</textarea>

                </div>
                <div class="form-group col-md-6 bg-smooth-lighter p-2">
                    <label for="firstName6">2. Nutrition and metabolism </label>
                    <textarea name="nutrition" class="form-control auto-expand" rows="6" placeholder="nutrition">{{old('nutrition') ?? ''}}</textarea>
                </div>
            </div>
            <div class="form-row">

                <div class="form-group col-md-6 bg-amethyst-lighter p-2">
                    <label for="elimination">3. Elimination</label>
                    <textarea name="elimination" class="form-control auto-expand" rows="6" placeholder="Elimination">{{old('elimination') ?? ''}}</textarea>

                </div>
                <div class="form-group col-md-6 bg-amethyst-light p-2">
                    <label for="firstName6">4. activity and exercise </label>
                    <textarea name="activity" class="form-control auto-expand" rows="6" placeholder="activity and exercise">{{old('activity') ?? ''}}</textarea>
                </div>
            </div>
            <div class="form-row">

                <div class="form-group col-md-6 bg-flat-lighter p-2">
                    <label for="elimination">5. Cognition and Perception</label>
                    <textarea name="cognition" class="form-control auto-expand" rows="6" placeholder="Cognition and perception">{{old('cognition') ?? ''}}</textarea>

                </div>
                <div class="form-group col-md-6 bg-flat-light p-2">
                    <label for="firstName6">6. Sleep and rest </label>
                    <textarea name="sleep" class="form-control auto-expand" rows="6" placeholder="Sleep and rest">{{old('sleep') ?? ''}}</textarea>
                </div>
            </div>
            <div class="form-row">

                <div class="form-group col-md-6 bg-flat-lighter p-2">
                    <label for="elimination">7. Self Perception and self concept</label>
                    <textarea name="perception" class="form-control auto-expand" rows="6" placeholder="Self Perception and self concept">{{old('perception') ?? ''}}</textarea>

                </div>
                <div class="form-group col-md-6 bg-success-light p-2">
                    <label for="firstName6">8. Roles And relationship </label>
                    <textarea name="roles" class="form-control auto-expand" rows="6" placeholder="Roles and relationship">{{old('roles') ?? ''}}</textarea>
                </div>
            </div>
            <div class="form-row">

                <div class="form-group col-md-6 bg-modern-lighter p-2">
                    <label for="elimination">9. Sexuality and performance</label>
                    <textarea name="sexuality" class="form-control auto-expand" rows="6" placeholder="sexuality and performance">{{old('sexuality') ?? ''}}</textarea>

                </div>
                <div class="form-group col-md-6 bg-modern-light p-2">
                    <label for="firstName6">10. coping and stress mechanism </label>
                    <textarea name="coping" class="form-control auto-expand" rows="6" placeholder="coping and stress mechanism">{{old('coping') ?? ''}}</textarea>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12 bg-modern p-2">
                    <label for="firstName6">11. Values and beliefs </label>
                    <textarea name="values" class="form-control auto-expand" rows="4" placeholder="Values and beliefs">{{old('values') ?? ''}}</textarea>
                </div>
            </div>

                <button type="submit" class="btn btn-primary btn-lg w-100"><i class="fa fa-2x fa-save"></i> Save</button>
        </form>
    </div>
</div>
