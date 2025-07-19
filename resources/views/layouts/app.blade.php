<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>{{ config('app.name') }} </title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- CSS Libraries -->
    @stack('customStyle')
    <!-- Template CSS -->
    
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
  
</head>

<body class="sidebar-mini">
    <div id="app">
        <div class="main-layout">
            <x-sidebar title="Instagram" />
            <div class="stories-container">
                @foreach ($stories as $story)
                    <div class="story">
                        <a href="#" class="story-avatar">
                            <img src="{{ $story->user->profile_photo_url }}" alt="User Avatar">
                        </a>
                        <span>{{ $story->user->name }}</span>
                    </div>
                @endforeach 
            </div>  
            <div class="main-content">
                @yield('content')
            </div>
        </div>
    </div>

    <!-- General JS Scripts -->
    <script>
        document.querySelectorAll('.nav-link, .bottom-nav-item').forEach(link => {
          link.addEventListener('click', () => {
            [...link.parentElement.children].forEach(sib => sib.classList.remove('active'));
            link.classList.add('active');
          });
        });
      </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <script src="/assets/js/scripts.js"></script>
    <script src="/assets/js/custom.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <!-- Page Specific JS File -->
    @stack('customScript')
</body>

</html>
