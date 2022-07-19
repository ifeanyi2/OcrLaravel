<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>{{ config('app.name') }} :: @yield('title')</title>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" ></script>
        <link href="{{ asset('assets/admin/css/styles.css') }}" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
         <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" />
    </head>
    <body>
       @include('admin.layouts.nav')
        <div id="layoutSidenav">
            @include('admin.layouts.aside')

            <div id="layoutSidenav_content">
                <main>
                  @yield('content')
                </main>
              @include('admin.layouts.footer')
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="{{ asset('assets/admin/js/scripts.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script>
        @if(Session::has('message'))
          var type = "{{ Session::get('alert-type', 'info') }}"
          switch (type) {
              case 'info':
                  toastr.info(" {{ Session::get('message') }}");
                  break;
              case 'info':
                  toastr.info(" {{ Session::get('message') }}");
                  break;
              case 'success':
                  toastr.success(" {{ Session::get('message') }}");
                  break;
              case 'warning':
                  toastr.warning(" {{ Session::get('message') }}");
                  break;
              case 'error':
                  toastr.error(" {{ Session::get('message') }}");
                  break;
          
             
          }
            
        @endif
    </script>
    <script>
        function setCookie(key, value, expireDays, expireHours, expireMinutes, expireSeconds) {
        var expireDate = new Date();
        if (expireDays) {
            expireDate.setDate(expireDate.getDate() + expireDays);
        }
        if (expireHours) {
            expireDate.setHours(expireDate.getHours() + expireHours);
        }
        if (expireMinutes) {
            expireDate.setMinutes(expireDate.getMinutes() + expireMinutes);
        }
        if (expireSeconds) {
            expireDate.setSeconds(expireDate.getSeconds() + expireSeconds);
        }
        document.cookie = key +"="+ escape(value) +
            ";domain="+ window.location.hostname +
            ";path=/"+
            ";expires="+expireDate.toUTCString();
    }
    </script>


    </body>
</html>
