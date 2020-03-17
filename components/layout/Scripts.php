<!-- Modals -->
<div class="modal fade" id="SuccessModal" tabindex="-1" role="dialog" aria-labelledby="SuccessModalLabel"
   aria-hidden="true">
   <div class="modal-dialog modal-md" role="document">
      <div class="modal-content bg-gradient-success">
         <div class="modal-body mt-5">
            <center class="mb-4">
               <h1 class="text-white" style="font-size: 60pt;">
                  <i class="fa fa-check" aria-hidden="true"></i>
               </h1>
               <h5 class="text-white font-weight-bold font-italic mb-3">GREAT!</h5>
               <h5 class="text-white font-weight-normal col-10" id="success-modal-msg"></h5>
            </center>
         </div>
         <div>
            <button type="button" class="btn btn-md bg-white float-right m-3" data-dismiss="modal">Ok, got it</button>
         </div>
      </div>
   </div>
</div>

<div class="modal fade" id="ErrorModal" tabindex="-1" role="dialog" aria-labelledby="ErrorModalLabel"
   aria-hidden="true">
   <div class="modal-dialog modal-md" role="document">
      <div class="modal-content bg-gradient-danger">
         <div class="modal-body mt-5">
            <center class="mb-4">
               <h1 class="text-white" style="font-size: 60pt;">
                  <i class="fa fa-times" aria-hidden="true"></i>
               </h1>
               <h5 class="text-white font-weight-bold font-italic mb-3">OOPS!</h5>
               <h5 class="text-white font-weight-normal col-10" id="error-modal-msg"></h5>
            </center>
         </div>
         <div>
            <button type="button" class="btn btn-md bg-white float-right m-3" data-dismiss="modal">Ok, got it</button>
         </div>
      </div>
   </div>
</div>

<div class="modal fade" id="PromptModal" tabindex="-1" role="dialog" aria-labelledby="PromptModalLabel"
   aria-hidden="true">
   <div class="modal-dialog modal-md" role="document">
      <div class="modal-content bg-gradient-danger">
         <div class="modal-body mt-5">
            <center class="mb-4">
               <h1 class="text-white" style="font-size: 60pt;">
                  <i class="fa fa-question-circle" aria-hidden="true"></i>
               </h1>
               <h5 class="text-white font-weight-bold font-italic mb-3">HEY!</h5>
               <h5 class="text-white font-weight-normal col-10" id="prompt-modal-msg"></h5>
            </center>
         </div>
         <div class="mb-3 mr-3">
            <button type="button" class="btn bg--warning text-white float-right px-4 ml-2 font-weight-bold"
               id="yes_prompt">Yes</button>
            <button type="button" class="btn bg-white float-right px-3" data-dismiss="modal">Cancel</button>
         </div>
      </div>
   </div>
</div>

<!-- Login modal -->
<div class="modal fade" id="LoginModal" tabindex="-1" role="dialog" aria-labelledby="LoginModalLabel"
   aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content" style="background-color: #e8f1f8;">
         <div class="modal-header">
            <h5 class="modal-title" id="LoginModalLabel">Login</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form class="roberto-contact-form" id="login_form">
            <div class="modal-body">
               <div class="form-group">
                  <center>
                     <span class="text-danger msg login-msg"></span>
                  </center>
               </div>
               <div class="form-group">
                  <label for="user" class="col-form-label">Username/Email:</label>
                  <input type="text" class="form-control" name="user" id="user">
               </div>
               <div class="form-group">
                  <label for="password" class="col-form-label">Password:</label>
                  <input type="password" class="form-control" name="pass" id="password">
               </div>


            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
               <button type="submit" class="btn roberto-btn px-5">Login</button>
            </div>
         </form>
      </div>
   </div>
</div>
<!-- Modals -->

<!-- jQuery 2.2.4 -->
<script src="./dist/js/jquery.min.js"></script>
<!-- Popper -->
<script src="./dist/js/popper.min.js"></script>
<!-- Bootstrap -->
<script src="./dist/js/bootstrap.min.js"></script>
<!-- All Plugins -->
<script src="./dist/js/roberto.bundle.js"></script>
<!-- Active -->
<script src="./dist/js/default-assets/active.js"></script>
<!-- Neil Francis Bayna -->
<script src="./assets/js/global.js"></script>