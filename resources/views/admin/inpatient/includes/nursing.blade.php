 <!-- Block Tabs Default Style (Right) -->
 <div class="block">
    <ul class="nav nav-tabs nav-tabs-block" data-toggle="tabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" href="#btabs-static2-home">Treatment Chart</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#btabs-static2-fhp">Functional Health Pattern</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#btabs-static2-physical">Physical Assessment</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="#btabs-static2-profile">Patient History</a>
        </li>

    </ul>
    <div class="block-content tab-content">
        <div class="tab-pane active" id="btabs-static2-home" role="tabpanel">
            @include('admin.inpatient.includes.treatmentsheet')
        </div>
        <div class="tab-pane" id="btabs-static2-profile" role="tabpanel">
           @include('admin.inpatient.includes.nursinghistory')
        </div>
        <div class="tab-pane" id="btabs-static2-fhp" role="tabpanel">
            @include('admin.inpatient.includes.nursingfhp')
        </div>
        <div class="tab-pane" id="btabs-static2-physical" role="tabpanel">
            @include('admin.inpatient.includes.nursingphysical')
        </div>

    </div>
</div>
<!-- END Block Tabs Default Style (Right) -->
