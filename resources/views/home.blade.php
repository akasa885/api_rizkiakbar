<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>API Learning</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('/assets/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/assets/main.css') }}">
    <script type="text/javascript" src="{{ asset('/assets/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/assets/bootstrap/js/bootstrap.min.js') }}"></script>
    <style>
      .titleMark{
        font-size: 68px;
      }
    </style>
  </head>
  <body>
    <section id="header_sec">
        <div class="row">
          <div class="col-md-12">
            <h2 class="titleMark">
            Welcome People ! !
          </h2>

          </div>
        </div>
        <div class="row justify-content-center">
          <div class="col-md-4">
            <img src="{{ asset('/pictures/avatar_test.jpg') }}" height="350px" width="350px" alt="" class="rounded-circle">
          </div>
        </div>
        <div class="row justify-content-center">
          <div class="col-md-3">
            <div id="mediaCluster" class="topnav">
              <div class="menu">
                <div class="icon">
                  <a href="#"><li> <i class="fab fa-facebook-square"></i> </li></a>
                  <a href="#"><li> <i class="fab fa-facebook-square"></i> </li></a>
                  <a href="#"><li> <i class="fab fa-facebook-square"></i> </li></a>
                </div>
              </div>
            </div>
          </div>
        </div>
    </section>
  </body>
</html>
