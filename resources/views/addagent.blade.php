@extends('layouts.app')
@section('content')

<div class="content-wrapper" style="background-color:#eee; overflow-y:hidden;">

   @if ($errors->any())
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
         @foreach ($errors->all() as $error)
            <p class="msg"><strong> {{ $error }}</strong></p>
         @endforeach
         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
   @endif

   @if(session('successMessage'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>{{session('successMessage')}}</strong> 
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
   @endif

   <br>

   <div class="container-fluid col-lg-12" >

      <div class="row">
         <div class="contaier col-lg-12" style = "height:128px;">
         </div>
      </div>

      <div class="row">
      
         <div class="container col-lg-12">
            <h3 class="text-center fw-bold mt-3">Add Agent</h3>
         </div>
         <div class="contaier col-lg-12" style = "height:551px;">
            <div class="container col-lg-4 bg-light" style="margin-top:36px; height:366px;width:594px;">
               <main class="form-signin text-center" style="padding-top:80px;padding-right:55px;padding-left:55px;">
                  <form method="POST" action="addagent">
                  
                     @csrf
                     <div class="form-floating">
                        <input type="email" class="form-control" id="floatingInput" name="email" placeholder="name@example.com" required>
                        <label for="floatingInput">Email Address</label>
                     </div>
                     <div class="form-floating mt-3">
                        <input type="text" class="form-control" id="floatingname" name="name" placeholder="Enter name" required>
                        <label for="floatingPassword">Name</label>
                     </div>

                     <button class="w-100 btn btn-lg btn-primary mt-3" type="submit">Add Agent</button>
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