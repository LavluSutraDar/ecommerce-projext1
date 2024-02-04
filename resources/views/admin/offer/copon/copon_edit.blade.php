 <form action="{{route('coupon.update')}}" method="POST" id="edit_form">
     <div class="modal-body">
         @csrf
         <div class="mb-3">
             <label class="form-label">Coupon code</label>
             <input type="text" class="form-control @error('coupon_code') is-invalid @enderror" name="coupon_code" value="{{$coupon->coupon_code}}">
              <input type="hidden" name="id" value="{{$coupon->id}}">

             @error('coupon_code')
                 <span class="invalid-feedback" role="alert">
                     <strong>{{ $message }}</strong>
                 </span>
             @enderror
         </div>

         <div class="mb-3">
             <label class="form-label">Coupon Date</label>
             <input type="date" class="form-control" name="coupon_date" value="{{$coupon->coupon_date}}" @error('coupon_date') is-invalid @enderror">

             @error('coupon_date')
                 <span class="invalid-feedback" role="alert">
                     <strong>{{ $message }}</strong>
                 </span>
             @enderror
         </div>

         <div class="mb-3">
             <label class="form-label">Coupon Type</label>
             <select name="coupon_type" id="" class="form-control">
                 <option style="color: yellow" selected disabled value="hidden">Chosse Category</option>
                 <option value="1" @if ($coupon->coupon_type == 1 ) selected @endif >Fixed</option>
                 <option value="2" @if ($coupon->coupon_type == 2 ) selected @endif >Percentage</option>
             </select>
         </div>

         <div class="mb-3">
             <label for="exampleInputEmail1" class="form-label">Coupon Amount</label>
             <input type="number" class="form-control @error('coupon_amount') is-invalid @enderror"
                 name="coupon_amount" value="{{$coupon->coupon_amount}}">

             @error('coupon_amount')
                 <span class="invalid-feedback" role="alert">
                     <strong>{{ $message }}</strong>
                 </span>
             @enderror
         </div>

         <div class="mb-3">
             <label class="form-label">Coupon Status</label>
             <select name="status" id="" class="form-control">
                 <option style="color: yellow" selected disabled value="hidden">Chosse Category</option>
                 <option value="active" @if ($coupon->status == "active" ) selected @endif >Active</option>
                 <option value="inactive" @if ($coupon->status == "inactive" ) selected @endif >In Active</option>
             </select>
         </div>

         <div class="modal-footer">
             <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
             <button type="submit" class="btn btn-primary">Coupon Update</button>
         </div>
     </div>
 </form>
