 <form action="{{ route('pickuppoint.update', $pickups->id) }}" method="POST" id="edit_form">
     <div class="modal-body">
         @csrf
         <div class="mb-3">
             <label class="form-label">Pickup Point Name</label>
             <input type="text" class="form-control @error('pickup_point_name') is-invalid @enderror"
                 name="pickup_point_name" value="{{$pickups->pickup_point_name}}">

             @error('pickup_point_name')
                 <span class="invalid-feedback" role="alert">
                     <strong>{{ $message }}</strong>
                 </span>
             @enderror
         </div>

         <div class="mb-3">
             <label class="form-label">Pickup point Address </label>
             <textarea name="pickup_point_address" id="" cols="5" rows="5" class="form-control">
              {{$pickups->pickup_point_address}}
             </textarea>
         </div>

         <div class="mb-3">
             <label class="form-label">Pickup Point Phone</label>
             <input type="number" class="form-control" name="pickup_point_phone" value="{{$pickups->pickup_point_phone}}"@error('pickup_point_phone') is-invalid @enderror">

             @error('pickup_point_phone')
                 <span class="invalid-feedback" role="alert">
                     <strong>{{ $message }}</strong>
                 </span>
             @enderror
         </div>

         <div class="mb-3">
             <label class="form-label">Pickup Point Phone Two</label>
             <input type="number" class="form-control" name="pickup_point_phone_two"
                 @error('pickup_point_phone_two') is-invalid @enderror" value="{{$pickups->pickup_point_phone_two}}">
             @error('pickup_point_phone_two')
                 <span class="invalid-feedback" role="alert">
                     <strong>{{ $message }}</strong>
                 </span>
             @enderror
         </div>

         <div class="modal-footer">
             <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
             <button type="submit" class="btn btn-primary">Update</button>
         </div>
     </div>
 </form>

 <script>
          $('#edit_form').submit(function(e) {
              e.preventDefault();
              var url = $(this).attr('action');
              var request = $(this).serialize();
              $.ajax({
                  url: url,
                  type: 'post',
                  data: request,
                  success: function(data) {
                      toastr.success(data);
                      $('#edit_form')[0].reset();
                      $('#pickupPointModal').modal('hide');
                      table.ajax.reload();
                  }
              });
          });
 </script>
