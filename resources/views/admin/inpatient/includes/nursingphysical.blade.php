
@if ($inpatient->nursingPhysicalAssessments->count())
<div class="block block-fx-shadow">
     <div class="block-header">
         <h3 class="block-title">Physical Assesment (using IPPA technique)

         </h3>

     </div>
     <div class="block-content block-contentful">
         @foreach ($inpatient->nursingPhysicalAssessments as $item)
         <small class="d-block d-sm-inline-block mt-2 mt-sm-0 font-size-base font-w400 text-muted">recorded by {{$item->admin->name}}</small>
         <div class="row gutters-tiny">
             <div class="col-md-6">
                 <div class="block block-themed">
                     <div class="block-header">
                         <h3 class="block-title text-center">1. Hair</h3>
                     </div>
                     <div class="block-content">
                     <p>{{$item->hair}}</p>
                     </div>
                 </div>
             </div>
             <div class="col-md-6">
                 <div class="block block-themed">
                     <div class="block-header">
                         <h3 class="block-title text-center">2. eyes</h3>
                     </div>
                     <div class="block-content">
                     <p>{{$item->eyes}}</p>
                     </div>
                 </div>
             </div>

         </div>
         <div class="row gutters-tiny">
             <div class="col-md-6">
                 <div class="block block-themed">
                     <div class="block-header">
                         <h3 class="block-title text-center">3. Ears</h3>
                     </div>
                     <div class="block-content">
                     <p>{{$item->ears}}</p>
                     </div>
                 </div>
             </div>
             <div class="col-md-6">
                 <div class="block block-themed">
                     <div class="block-header">
                         <h3 class="block-title text-center">4. face</h3>
                     </div>
                     <div class="block-content">
                     <p>{{$item->face}}</p>
                     </div>
                 </div>
             </div>

         </div>
         <div class="row gutters-tiny">
             <div class="col-md-6">
                 <div class="block block-themed">
                     <div class="block-header">
                         <h3 class="block-title text-center">5. neck</h3>
                     </div>
                     <div class="block-content">
                     <p>{{$item->neck}}</p>
                     </div>
                 </div>
             </div>
             <div class="col-md-6">
                 <div class="block block-themed">
                     <div class="block-header">
                         <h3 class="block-title text-center">6. upper limbs </h3>
                     </div>
                     <div class="block-content">
                     <p>{{$item->upper_limbs}}</p>
                     </div>
                 </div>
             </div>

         </div>
         <div class="row gutters-tiny">
             <div class="col-md-6">
                 <div class="block block-themed">
                     <div class="block-header">
                         <h3 class="block-title text-center">7. Chest</h3>
                     </div>
                     <div class="block-content">
                     <p>{{$item->chest}}</p>
                     </div>
                 </div>
             </div>
             <div class="col-md-6">
                 <div class="block block-themed">
                     <div class="block-header">
                         <h3 class="block-title text-center">Abdomen</h3>
                     </div>
                     <div class="block-content">
                     <p>{{$item->abdomen}}</p>
                     </div>
                 </div>
             </div>

         </div>
         <div class="row gutters-tiny">
             <div class="col-md-6">
                 <div class="block block-themed">
                     <div class="block-header">
                         <h3 class="block-title text-center">9. genitals</h3>
                     </div>
                     <div class="block-content">
                     <p>{{$item->genitals}}</p>
                     </div>
                 </div>
             </div>
             <div class="col-md-6">
                 <div class="block block-themed">
                     <div class="block-header">
                         <h3 class="block-title text-center">10. Lower Limbs </h3>
                     </div>
                     <div class="block-content">
                     <p>{{$item->lower_limbs}}</p>
                     </div>
                 </div>
             </div>

         </div>
         <div class="row">
             <div class="col-md-12">
                 <div class="block block-themed">
                     <div class="block-header">
                         <h3 class="block-title text-center">11. Nurse's Admission Note: </h3>
                     </div>
                     <div class="block-content">
                     <p>{{$item->nurse_admission_note}}</p>
                     </div>
                 </div>
             </div>


         </div>
         @endforeach




     </div>
 </div>
@endif
