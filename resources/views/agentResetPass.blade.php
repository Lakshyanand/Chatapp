<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Reset Password</title>
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

    @if(session('resetError'))
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>{{session('resetError')}}</strong> 
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif

    <div class="container-fluid col-lg-12" >

      <div class="row">
        <div class="contaier col-lg-12" style = "height:150px;">
        </div>
      </div>

      <div class="row">
      
        <div class="container col-lg-12">
          <h3 class="text-center mt-3">Reset Password</h3>
        </div>
        <div class="contaier col-lg-12" style = "height:551px;">
          <div class="container col-lg-4 bg-light" style="margin-top:36px; height:454px;width:594px;">
            <main class="form-signin text-center" style="padding-top:41px;padding-right:55px;padding-left:55px;">
              <form method="POST" action="resetpassword">
                
                @csrf
              
                <input type="hidden" value= "{{session('idd')}}"name="id">
                <div class="form-floating mt-3">
                  <input type="text" class="form-control" id="floatingInput" name="oldpassword" placeholder="Old Password" required>
                  <label for="floatingInput">Old Password</label>
                </div>
                <div class="form-floating mt-3">
                  <input type="password" class="form-control" id="floatingPassword" name="newpassword" placeholder="New Password" required>
                  <label for="floatingPassword">New Password</label>
                </div>
                <div class="form-floating mt-3">
                  <input type="password" class="form-control" id="floatingPassword" name="confirmpassword" placeholder="Confirm Password" required>
                  <label for="floatingPassword">Confirm Password</label>
                </div>

                <button class="w-100 btn btn-lg btn-primary mt-3 mb-3" type="submit">Reset</button>
                <a class="btn btn-primary w-100 mb-3 btn-lg" href="/login" role="button">Login</a>

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