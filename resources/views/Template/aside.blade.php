<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">
    <title>{{$title}}</title>
    <!-- Simple bar CSS -->
    <link rel="stylesheet" href="css/simplebar.css">
    <!-- Fonts CSS -->
    <link href="https://fonts.googleapis.com/css2?family=Overpass:ital,wght@0,100;0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
      <!-- Icons CSS -->
   <link rel="stylesheet" href="{{ asset('css/feather.css') }}">
<link rel="stylesheet" href="{{ asset('css/select2.css') }}">
<link rel="stylesheet" href="{{ asset('css/dropzone.css') }}">
<link rel="stylesheet" href="{{ asset('css/uppy.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/jquery.steps.css') }}">
<link rel="stylesheet" href="{{ asset('css/jquery.timepicker.css') }}">
<link rel="stylesheet" href="{{ asset('css/quill.snow.css') }}">
<!-- Date Range Picker CSS -->
<link rel="stylesheet" href="{{ asset('css/daterangepicker.css') }}">
<!-- App CSS -->
<link rel="stylesheet" href="{{ asset('css/app-light.css') }}" id="lightTheme">


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

  </head>
  <body class="vertical  light  ">
    <div class="wrapper">
      <nav class="topnav navbar navbar-light">
        <button type="button" class="navbar-toggler text-muted mt-2 p-0 mr-3 collapseSidebar">
          <i class="fe fe-menu navbar-toggler-icon"></i>
        </button>

        <ul class="nav">

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-muted pr-0" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <span class="avatar avatar-sm mt-2">
              @if (!empty($admin))
                  <img src="{{($admin['gambar']) ? config('services.api_url') . '/storage/' . $admin['gambar']  : asset('assets/avatars/face-1.png')  }}" alt="..." class="avatar-img rounded-lg">
                  @elseif (!empty($data))
                    <img src="{{($data['gambar']) ? config('services.api_url') . '/storage/' . $data['gambar']  : asset('assets/avatars/face-1.png')  }}" alt="..." class="avatar-img rounded-lg">
              @endif
                
              </span>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
              <a class="dropdown-item" href="#">Profile</a>
              <form action="/logout-admin" method="POST">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="dropdown-item">Logout</button>
              </form>
            </div>
          </li>
        </ul>
      </nav>

       <aside class="sidebar-left border-right bg-white shadow" id="leftSidebar" data-simplebar>
        <a href="#" class="btn collapseSidebar toggle-btn d-lg-none text-muted ml-2 mt-3" data-toggle="toggle">
          <i class="fe fe-x"><span class="sr-only"></span></i>
        </a>
        <nav class="vertnav navbar navbar-light">
          <!-- nav bar -->
          <div class="w-100 mb-4 d-flex">
            <a class="navbar-brand mx-auto mt-2 flex-fill text-center">
              <img src="{{ asset('assets/images/logo.png') }}" class="h-50" alt="Winni Code Logo"/>
            </a>
            
          </div>

          <ul class="navbar-nav flex-fill w-100 mb-2">
            <li class="nav-item ">
              <a href="/dashboard"class=" nav-link">
                <i class="fe fe-home fe-16"></i>
                <span class="ml-3 item-text">Dashboard</span><span class="sr-only">(current)</span>
              </a>
            </li>
          </ul>

          <p class="text-muted nav-heading mt-4 mb-1">
            <span>Manajemen Berita</span>
          </p>
          <ul class="navbar-nav flex-fill w-100 mb-2">

            <li class="nav-item w-100">
              <a class="nav-link" href="/kelola-berita">
                <i class="fe fe-layers fe-16"></i>
                <span class="ml-3 item-text">Kelola Berita</span>
              </a>
            </li>

               <li class="nav-item w-100">
              <a class="nav-link" href="/kategori-berita">
               <i class="fa-solid fa-table-list"></i>
                <span class="ml-3 item-text">Kategori Berita</span>
              </a>
            </li>

          </ul>
          <p class="text-muted nav-heading mt-4 mb-1">
            <span>Manajemen Akun </span>
          </p>

          <ul class="navbar-nav flex-fill w-100 mb-2">
            <li class="nav-item w-100">
              <a class="nav-link" href="/akun-jurnalis">
                <i class="fe fe-user fe-16"></i>
                <span class="ml-3 item-text">Akun Jurnalis</span>
              </a>
            </li>
          </ul>

          <p class="text-muted nav-heading mt-4 mb-1">
            <span>Kelola Akun Personal</span>
             <ul class="navbar-nav flex-fill w-100 mb-2">
            <li class="nav-item w-100">
              <a class="nav-link" href="/profile">
                <i class="fe fe-user fe-16"></i>
                <span class="ml-3 item-text">Profile</span>
              </a>
            </li>
          </ul>
          </p>

          <div class="btn-box w-100 mt-4 mb-1">
             <form action="/logout-admin" method="POST">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn mb-2 btn-danger btn-lg btn-block">Logout</button>
              </form>
          </div>
        </nav>
      </aside>

        <main role="main" class="main-content">
        @yield('container-main')
         </main>
         
    </div>
    @yield('script')
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/moment.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/simplebar.min.js') }}"></script>
    <script src="{{ asset('js/daterangepicker.js') }}"></script>
    <script src="{{ asset('js/jquery.stickOnScroll.js') }}"></script>
    <script src="{{ asset('js/tinycolor-min.js') }}"></script>
    <script src="{{ asset('js/config.js') }}"></script>
    <script src="{{ asset('js/d3.min.js') }}"></script>
    <script src="{{ asset('js/topojson.min.js') }}"></script>
    <script src="{{ asset('js/datamaps.all.min.js') }}"></script>
    <script src="{{ asset('js/datamaps-zoomto.js') }}"></script>
    <script src="{{ asset('js/datamaps.custom.js') }}"></script>
    <script src="{{ asset('js/Chart.min.js') }}"></script>
    <script>
      /* defind global options */
      Chart.defaults.global.defaultFontFamily = base.defaultFontFamily;
      Chart.defaults.global.defaultFontColor = colors.mutedColor;
    </script>
    <script src="{{ asset('js/gauge.min.js') }}"></script>
    <script src="{{ asset('js/jquery.sparkline.min.js') }}"></script>
    <script src="{{ asset('js/apexcharts.min.js') }}"></script>
    <script src="{{ asset('js/apexcharts.custom.js') }}"></script>
    <script src="{{ asset('js/jquery.mask.min.js') }}"></script>
    <script src="{{ asset('js/select2.min.js') }}"></script>
    <script src="{{ asset('js/jquery.steps.min.js') }}"></script>
    <script src="{{ asset('js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('js/jquery.timepicker.js') }}"></script>
    <script src="{{ asset('js/dropzone.min.js') }}"></script>
    <script src="{{ asset('js/uppy.min.js') }}"></script>
    <script src="{{ asset('js/quill.min.js') }}"></script>
    <script>
      $('.select2').select2(
      {
        theme: 'bootstrap4',
      });
      $('.select2-multi').select2(
      {
        multiple: true,
        theme: 'bootstrap4',
      });
      $('.drgpicker').daterangepicker(
      {
        singleDatePicker: true,
        timePicker: false,
        showDropdowns: true,
        locale:
        {
          format: 'MM/DD/YYYY'
        }
      });
      $('.time-input').timepicker(
      {
        'scrollDefault': 'now',
        'zindex': '9999' /* fix modal open */
      });
      /** date range picker */
      if ($('.datetimes').length)
      {
        $('.datetimes').daterangepicker(
        {
          timePicker: true,
          startDate: moment().startOf('hour'),
          endDate: moment().startOf('hour').add(32, 'hour'),
          locale:
          {
            format: 'M/DD hh:mm A'
          }
        });
      }
      var start = moment().subtract(29, 'days');
      var end = moment();

      function cb(start, end)
      {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
      }
      $('#reportrange').daterangepicker(
      {
        startDate: start,
        endDate: end,
        ranges:
        {
          'Today': [moment(), moment()],
          'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days': [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month': [moment().startOf('month'), moment().endOf('month')],
          'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
      }, cb);
      cb(start, end);
      $('.input-placeholder').mask("00/00/0000",
      {
        placeholder: "__/__/____"
      });
      $('.input-zip').mask('00000-000',
      {
        placeholder: "____-___"
      });
      $('.input-money').mask("#.##0,00",
      {
        reverse: true
      });
      $('.input-phoneus').mask('(000) 000-0000');
      $('.input-mixed').mask('AAA 000-S0S');
      $('.input-ip').mask('0ZZ.0ZZ.0ZZ.0ZZ',
      {
        translation:
        {
          'Z':
          {
            pattern: /[0-9]/,
            optional: true
          }
        },
        placeholder: "___.___.___.___"
      });
    </script>
    <script src="{{ asset('js/apps.js') }}"></script>
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-56159088-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];

      function gtag()
      {
        dataLayer.push(arguments);
      }
      gtag('js', new Date());
      gtag('config', 'UA-56159088-1');
    </script>

  </body>
</html>