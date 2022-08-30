<!doctype html>
<html lang="en">
  <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">

      <!-- Bootstrap CSS -->
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

      <title>Set Password</title>

   </head>

   <body style="background-color:#eee; overflow-y:hidden;">

      <div class="container-fluid col-lg-12" >

         <div class="row">
            <div class="contaier col-lg-12" style = "height:150px;"></div>
         </div>

         <div class="row">
            
            <div class="container col-lg-12">
               <h3 class="text-center mt-3">Set New Password</h3>
            </div>
            <div class="contaier col-lg-12" style = "height:551px;">
               <div class="container col-lg-4 bg-light" style="margin-top:36px; height:371px;width:594px;">
                  <main class="form-signin text-center" style="padding-top:80px;padding-right:55px;padding-left:55px;">
                     <form method="POST" action="setpass">
                     
                        @csrf
                        <div class="form-floating">
                           <input type="password" class="form-control" id="floatingInput" name="password" placeholder="Password" required>
                           <label for="floatingInput">Password</label>
                        </div>
                        <div class="form-floating mt-3">
                           <input type="password" class="form-control" id="floatingInput" name="confirmpassword" placeholder="Confirm Password" required>
                           <label for="floatingInput">Confirm Password</label>
                        </div>

                        <input type="hidden" name="id" value= "{{session('id')}}" >
                        <button class="w-100 btn btn-lg btn-primary mt-3 mb-3" type="submit">Set Password</button>
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
         
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

   </body>
</html>