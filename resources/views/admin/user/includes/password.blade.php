 <!-- For more info and examples you can check out http://www.dropzonejs.com/#usage -->
 <div class="row">
     <div class="col-md-6">
         <div class="block block-fx-shadow">
             <div class="block-header bg-info-light">
                 <h3 class="block-title">Change Password</h3>
             </div>
             <div class="block-content block-content-full">
                  <form  action="{{route('user.changepassword', $admin->id)}}" method="POST">
                    @csrf
            <div class="py-3">

                        <div class="form-group">
                            <input type="password" class="form-control form-control-lg form-control-alt" id="current-password" name="current_password" placeholder="Current Password">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control form-control-lg form-control-alt" id="password" name="password" placeholder="New Password">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control form-control-lg form-control-alt" id="password-confirm" name="password_confirm" placeholder="Password Confirm">
                        </div>

                    </div>
                    <div class="form-group row">

                            <button type="submit" class="btn btn-block btn-success w-100">
                                <i class="fa fa-fw fa-paper-plane mr-1"></i> Change Password
                            </button>

                    </div>

        </form>
             </div>
         </div>


     </div>
     <div class="col-md-6">
          <div class="block">
    <div class="block-header">
        <h3 class="block-title">Upload Passport</h3>
    </div>
    <div class="block-content block-content-full">
        <h2 class="content-heading border-bottom mb-4 pb-2">Please upload a passport sized photograph</h2>
        <div class="row">
            <div class="col-lg-4">
                <p class="font-size-sm text-muted">
                    Drag and drop sections for your file uploads
                </p>
            </div>
            <div class="col-lg-8 col-xl-5">
                <!-- DropzoneJS Container -->
            <form class="dropzone" action="{{route('user.avatar', $admin->id)}}">
            @csrf
        </form>
            </div>
        </div>
    </div>
</div>
     </div>
 </div>

