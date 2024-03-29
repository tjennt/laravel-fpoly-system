<!doctype html>
<html lang="en">
  <head>
    <title>TeamProQ</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <base href="{{ asset('') }}">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" >
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" ></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" ></script>  
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/neo-style.css">
</head>
  <body>
      <div class="wrapper">
          <!-- sidebar -->
          <nav id="sidebar">
            <div class="sidebar-header">
                <div class="avatar"></div>
            </div>

    <ul class="list-unstyled components">
        <p class="text-center" style="background-color: #1EBD9E;">Hữu lợi.info</p>
        <li class="active">
            <a href="#">Nhập thông tin <span style="float: left;"><i class="fas fa-user-plus"></i></span>
            </a>
        </li>
        <li>
            <a href="#">Phân lớp <span style="float: left;"><i class="fas fa-divide"></i></span>
            </a>
        </li>
        <li>
            <a href="#">Danh sách <span style="float: left;"><i class="fas fa-list"></i></span> </a>
        </li>
        <li>
            <a href="#">Tổng quát</a>
        </li>
    </ul>

    <ul class="list-unstyled CTAs">
        <li>
            <button href="#" class="btn btn-default logout ml-5">Logout <i class="fas fa-sign-out-alt"></i>

            </button>
        </li>
    </ul>
</nav>
          <!-- page content -->
          <div id="content">
            <nav class="navbar navbar-expand-lg navbar-light bg-light navbar-bg">
                <div class="container-fluid">
                    <div class="col-lg-3 text-h2-navbar my-2 text-center" style="color: #FFFFFF;"><h3>Phòng Đào Tạo</h3></div>
                    <div class="col-lg-7">
                        <div>
                            <form class="form-inline form-search my-2 my-lg-0 mr-5">
                                <span class="icone"> <i class="fas fa-search"></i></span>
                                <input class="form-control col-lg-6 ml-auto input-search" type="search" placeholder="Search..." aria-label="Search">
                              </form>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="nav navbar-nav ml-auto">
                                <li class="nav-item">
                                    <a class="nav-link "style="color:#FFFFFF" href="#"><i class="fas fa-bell"></i></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" style="color:#FFFFFF" href="#"><i class="fas fa-envelope"></i></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#"><i class="fas fa-bars"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    </button>
                </div>
            </nav>
           @yield('content')
          </div>
      </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.js"></script>

    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script> -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="js/script.js" ></script>    
</body>
</html>