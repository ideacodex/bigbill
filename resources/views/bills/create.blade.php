 
 
 
 <!--Modal-->
 <form method="POST" action="">
    @csrf
   <div class="modal-content" id="modalBill{{ route('facturas.store') }}">
       <div class="modal-header">
           <h5 class="modal-title" id="exampleModalLabel">Factura</h5>
           <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
       </div>
       <div class="modal-body p-4">
           <form>
               <!-- 2 column grid layout with text inputs for the first and last names -->
               <div class="row mb-4">
                   <div class="col">
                       <div class="form-outline">
                           <input type="text" id="form6Example1" class="form-control">
                           <label class="form-label" for="form6Example1" style="margin-left: 0px;">First name</label>
                           <div class="form-notch">
                               <div class="form-notch-leading" style="width: 9px;"></div>
                               <div class="form-notch-middle" style="width: 68.8px;"></div>
                               <div class="form-notch-trailing"></div>
                           </div>
                       </div>
                   </div>
                   <div class="col">
                       <div class="form-outline">
                           <input type="text" id="form6Example2" class="form-control">
                           <label class="form-label" for="form6Example2" style="margin-left: 0px;">Last name</label>
                           <div class="form-notch">
                               <div class="form-notch-leading" style="width: 9px;"></div>
                               <div class="form-notch-middle" style="width: 68px;"></div>
                               <div class="form-notch-trailing"></div>
                           </div>
                       </div>
                   </div>
               </div>

               <!-- Text input -->
               <div class="form-outline mb-4">
                   <input type="text" id="form6Example3" class="form-control">
                   <label class="form-label" for="form6Example3" style="margin-left: 0px;">Company
                       name</label>
                   <div class="form-notch">
                       <div class="form-notch-leading" style="width: 9px;"></div>
                       <div class="form-notch-middle" style="width: 97.6px;"></div>
                       <div class="form-notch-trailing"></div>
                   </div>
               </div>

               <!-- Text input -->
               <div class="form-outline mb-4">
                   <input type="text" id="form6Example4" class="form-control">
                   <label class="form-label" for="form6Example4" style="margin-left: 0px;">Address</label>
                   <div class="form-notch">
                       <div class="form-notch-leading" style="width: 9px;"></div>
                       <div class="form-notch-middle" style="width: 55.2px;"></div>
                       <div class="form-notch-trailing"></div>
                   </div>
               </div>

               <!-- Email input -->
               <div class="form-outline mb-4">
                   <input type="email" id="form6Example5" class="form-control">
                   <label class="form-label" for="form6Example5" style="margin-left: 0px;">Email</label>
                   <div class="form-notch">
                       <div class="form-notch-leading" style="width: 9px;"></div>
                       <div class="form-notch-middle" style="width: 40px;"></div>
                       <div class="form-notch-trailing"></div>
                   </div>
               </div>

               <!-- Number input -->
               <div class="form-outline mb-4">
                   <input type="number" id="form6Example6" class="form-control">
                   <label class="form-label" for="form6Example6" style="margin-left: 0px;">Phone</label>
                   <div class="form-notch">
                       <div class="form-notch-leading" style="width: 9px;"></div>
                       <div class="form-notch-middle" style="width: 44px;"></div>
                       <div class="form-notch-trailing"></div>
                   </div>
               </div>

               <!-- Message input -->
               <div class="form-outline mb-4">
                   <textarea class="form-control" id="form6Example7" rows="4"></textarea>
                   <label class="form-label" for="form6Example7" style="margin-left: 0px;">Additional
                       information</label>
                   <div class="form-notch">
                       <div class="form-notch-leading" style="width: 9px;"></div>
                       <div class="form-notch-middle" style="width: 135.2px;"></div>
                       <div class="form-notch-trailing"></div>
                   </div>
               </div>

               <!-- Checkbox -->
               <div class="form-check d-flex justify-content-center mb-4">
                   <input class="form-check-input me-2" type="checkbox" value="" id="form6Example8" checked="">
                   <label class="form-check-label" for="form6Example8"> Create an account? </label>
               </div>

               <!-- Submit button -->
               <button type="submit" class="btn btn-primary btn-block">Place order</button>
           </form>
       </div>
   </div>
</form>
<!--End Modal-->>