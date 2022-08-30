
@extends('layouts.app')
@section('content')

<div class="content-wrapper" style="background-color:#eee; overflow-y:hidden;">
   <br>

   <div class="container-fluid col-lg-12" >

      <div class="row">
         <div class="contaier col-lg-12" style = "height:128px;">
         </div>
      </div>

      <div class="row">
      
         <div class="container col-lg-12">
            <h3 class="text-center fw-bold mt-3">Edit Agent</h3>
         </div>
         <div class="contaier col-lg-12" style = "height:551px;">
            <div class="container col-lg-4 bg-light" style="margin-top:36px; height:300px;width:594px;">
               <main class="form-signin text-center" style="padding-top:80px;padding-right:55px;padding-left:55px;">
                  <form method="POST" action="/edit">
                  
                     @csrf
                     <div class="form-floating">
                        <input type="text" value="{{$name}}"class="form-control" id="floatingInput"  name="name" placeholder="name@example.com" required>
                        <label for="floatingInput">Name</label>
                     </div>
                     <input type="hidden" name ="id" value="{{$id}}">       
                     <button class="w-100 btn btn-lg btn-primary mt-3" type="submit">Update</button>
                  </form>
               </main>
            </div>
         </div>
      </div>

      <div class="row">
         <div class="contaier col-lg-12" style = "height:150px;"></div>
      </div>
   </div>


   <script type="text/javascript">
      setTimeout(function () {
         // Closing the alert
         $('.alert').alert('close');
      }, 5000);
   </script>


</div> 
@endsection
