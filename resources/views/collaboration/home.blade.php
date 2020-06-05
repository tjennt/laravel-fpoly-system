
<!doctype html>
<html lang="en">
  <head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <base href="{{ asset('') }}">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css" >
    <script defer src="js/solid.min.js" ></script>
    <script defer src="js/fontawesome.min.js" ></script>  
    <link rel="stylesheet" href="css/styles.css">
    {{--  <link rel="stylesheet" href="css/bootstrap.css">  --}}
    {{--  <link rel="stylesheet" href="css/bootstrap.min.css">  --}}
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script src="https://js.pusher.com/6.0/pusher.min.js"></script>
    <style>
      @media screen and (max-width:655px){
        #responsive-td1{
          min-width: 160px;
          max-width: 190px;
        }
        #responsive-td3{
          min-width: 160px;
          max-width: 190px;
        }
        #responsive-td4{
          min-width: 230px;
          max-width: 190px;
        }
        #chartRadian{
          width:100%;
          height:10vh
        }
        #note-teachers{
         margin-top: 20px
        }
        .myChart{
          height:50vh !important;
        }
        #dashboard-radius{
          height:45vh !important;
        }
      }
      .myChart{
        border-radius: 20px;
      /* padding: 20px; */
      box-shadow: 3px 3px 5px rgba(0, 0, 0, 0.5);
      font-size: 1.5em;
      background-color: white;
      }
      #dashboard-radius{
        box-shadow: 3px 3px 5px rgba(0, 0, 0, 0.5);
        font-size: 1.5em;
        background-color: white;
        border-radius: 20px;
        width:100%;
        height:90vh
        }
        #note-teachers{
          box-shadow: 3px 3px 5px rgba(0, 0, 0, 0.5);
          font-size: 1.5em;
          background-color: white;
          border-radius: 20px;
          margin-bottom: 20px
        }

    </style>

</head>
  <body>
      <div class="wrapper">
          <!-- sidebar -->
          @include('collaboration.sidebar')
          <!-- page content -->
          <div id="content">
              {{--  navbar  --}}
            @include('collaboration.navbar')
<!-- hàng 1 - các Nút tổng số lượng  -->
        @yield('content.collaboration')
          </div>
      </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    {{-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    {{-- <script src="js/script.js" ></script> --}}
    <script src="js/script.js"></script>

    
</body>
</html>