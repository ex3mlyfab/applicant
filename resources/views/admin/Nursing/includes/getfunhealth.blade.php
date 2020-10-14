
@if ($inpatient->nursingFunctionalhp->count())
   <div class="block block-fx-shadow">
        <div class="block-header">
            <h3 class="block-title">Functional Health Pattern</h3>
            <div class="block-option">
                <button id="show-funhealth">Take new functional health pattern</button>
            </div>
        </div>
        <div class="block-content block-contentful">
            @foreach ($inpatient->nursingFunctionalhp as $item)
            <div class="row gutters-tiny">
                <div class="col-md-6">
                    <div class="block block-themed">
                        <div class="block-header">
                            <h3 class="block-title text-center">1. Health Perception and health management</h3>
                        </div>
                        <div class="block-content">
                        <p>{{$item->health_man}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="block block-themed">
                        <div class="block-header">
                            <h3 class="block-title text-center">2. Nutrition and metabolism</h3>
                        </div>
                        <div class="block-content">
                        <p>{{$item->nutrition}}</p>
                        </div>
                    </div>
                </div>

            </div>
            <div class="row gutters-tiny">
                <div class="col-md-6">
                    <div class="block block-themed">
                        <div class="block-header">
                            <h3 class="block-title text-center">3. Elimination</h3>
                        </div>
                        <div class="block-content">
                        <p>{{$item->elimination}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="block block-themed">
                        <div class="block-header">
                            <h3 class="block-title text-center">4. activity and exercise</h3>
                        </div>
                        <div class="block-content">
                        <p>{{$item->activity}}</p>
                        </div>
                    </div>
                </div>

            </div>
            <div class="row gutters-tiny">
                <div class="col-md-6">
                    <div class="block block-themed">
                        <div class="block-header">
                            <h3 class="block-title text-center">5. Cognition and Perception</h3>
                        </div>
                        <div class="block-content">
                        <p>{{$item->cognition}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="block block-themed">
                        <div class="block-header">
                            <h3 class="block-title text-center">6. Sleep and rest</h3>
                        </div>
                        <div class="block-content">
                        <p>{{$item->sleep}}</p>
                        </div>
                    </div>
                </div>

            </div>
            <div class="row gutters-tiny">
                <div class="col-md-6">
                    <div class="block block-themed">
                        <div class="block-header">
                            <h3 class="block-title text-center">7. Self Perception and self concept</h3>
                        </div>
                        <div class="block-content">
                        <p>{{$item->perception}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="block block-themed">
                        <div class="block-header">
                            <h3 class="block-title text-center">8. Roles And relationship </h3>
                        </div>
                        <div class="block-content">
                        <p>{{$item->roles}}</p>
                        </div>
                    </div>
                </div>

            </div>
            <div class="row gutters-tiny">
                <div class="col-md-6">
                    <div class="block block-themed">
                        <div class="block-header">
                            <h3 class="block-title text-center">9. Sexuality and performance</h3>
                        </div>
                        <div class="block-content">
                        <p>{{$item->sexuality}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="block block-themed">
                        <div class="block-header">
                            <h3 class="block-title text-center">10. coping and stress mechanism </h3>
                        </div>
                        <div class="block-content">
                        <p>{{$item->coping}}</p>
                        </div>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="block block-themed">
                        <div class="block-header">
                            <h3 class="block-title text-center">11. Values and beliefs </h3>
                        </div>
                        <div class="block-content">
                        <p>{{$item->values}}</p>
                        </div>
                    </div>
                </div>


            </div>
            @endforeach




        </div>
    </div>
@endif
