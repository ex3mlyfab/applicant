<div class="block block-fx-shadow">
    <div class="block-header bg-info">
        <h3 class="block-title">Follow Up Visit</h3>
    </div>
    <div class="block-content block-content-full">
        <form action="" method="post">
            @csrf
            <div class="form-group">
                <label class="form-control-label-lg">Subjective complaints:</label>
                <textarea name="subjective_complaints"   class="form-control" rows="5">
                    {{old('subjective_complaints') ?? ''}}
                </textarea>
            </div>
            <div class="form-group">
                <label class="form-control-label-lg">Objective findings</label>
                <textarea name="objective_findings"  class="form-control"  rows="5">
                    {{old('objective_findings') ?? ''}}
                </textarea>
            </div>
            <div class="form-group">
                <label >Assessment</label>
                <div class="form-check">
                    <input type="radio" name="assessment" id="Improved" class="form-check-input" value="Improved">
                    <label for="" class="form-check-label">Improved</label>
                </div>
                <div class="form-check">
                    <input type="radio" name="assessment" id="Status_quo" class="form-check-input" value="Status_quo">
                    <label for="" class="form-check-label">Status_quo</label>
                </div>
                <div class="form-check">
                    <input type="radio" name="assessment" id="worsened" class="form-check-input" value="Worsened">
                    <label for="" class="form-check-label">Worsened</label>
                </div>

            </div>
                <button type="submit" class="btn btn-lg btn-outline-info w-100">Submit</button>
        </form>
    </div>
</div>