<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">


    <title>Login</title>
   </head>

   <body style="background-color:#eee; overflow-y:hidden;">
   
      @if ($errors->any())
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
         <ul>
               @foreach ($errors->all() as $error)
                  <li><strong>{{ $error }}</strong></li>
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
               @endforeach
         </ul>
      </div>
      @endif

      @if(isset($errorMessage))
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
         <strong>{{$errorMessage}}</strong> 
         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      @endif
   
      @if(session('successMessage'))
         <div class="alert alert-success alert-dismissible fade show" role="alert">
         <strong>{{session('successMessage')}}</strong> 
         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
         </div>
      @endif

      @if(session('errorMessage'))
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
         <strong>{{session('errorMessage')}}</strong> 
         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      @endif

      @if(session('password'))
         <div class="alert alert-success alert-dismissible fade show" role="alert">
         <strong>{{session('password')}}</strong> 
         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
         </div>
      @endif

      <div class="container-fluid col-lg-12" >

         <div class="row">
            <div class="contaier col-lg-12" style = "height:128px;">
               <form method="POST" action="/language" style="padding-left: 1595px;margin-top: 6px;">
                  
                  @csrf
                  <select name="language" id="lang" style="height: 31px;border: 2px solid green;">
                  <option value="">{{__('loginPage.Select_Language')}}</option>
                  <option value="en">{{__('loginPage.English')}}</option>
                  <option value="hi">{{__('loginPage.Hindi')}}</option>
                  <option value="ja">{{__('loginPage.Japanese')}}</option>
                  </select>

                  <button type="submit" class="btn btn-success" style="height: 36px;">{{__('loginPage.Submit')}}</button>

               </form>
            </div>
         </div>

         <div class="row">
            <div class="container col-lg-12">
               <h3 class="text-center mt-4"style="color:skyblue;">{{__('loginPage.FAVEO_CHAT')}}</h3>
            </div>
            <div class="container col-lg-12">
               <h3 class="text-center mt-3">{{__('loginPage.Great_to_see_you')}}</h3>
            </div>
            <div class="contaier col-lg-12" style = "height:551px;">
               <div class="container col-lg-4 bg-light" style="margin-top:36px; height:435px;width:594px;">
                  <main class="form-signin text-center" style="padding-top:80px;padding-right:55px;padding-left:55px;">
                     <form method="POST" action="checkuser">
                        <!-- <img class="mb-4" src="/docs/5.1/assets/brand/bootstrap-logo.svg" alt="" width="72" height="57"> -->
                        @csrf
                        <div class="form-floating">
                           <input type="email" class="form-control" id="floatingInput" name="email" placeholder="name@example.com" >
                           <label for="floatingInput">{{__('loginPage.Email')}}</label>
                        </div>
                        <div class="form-floating mt-3">
                           <input type="password" class="form-control" id="floatingPassword" name="password" placeholder="Password" >
                           <label for="floatingPassword">{{__('loginPage.Password')}}</label>
                        </div>
                        <button class="w-100 btn btn-lg btn-primary mt-3 mb-3" type="submit">{{__('loginPage.Login')}}</button>
                        <a class="btn btn-primary w-100 mb-3 btn-lg" href="forgotpass" role="button">{{__('loginPage.Forgot_Password')}}</a>
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