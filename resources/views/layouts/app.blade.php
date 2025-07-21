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
            <div class="main-content">
                @yield('content')
            </div>
        </div>
        
        <!-- Mobile Bottom Navigation -->
        <div class="bottom-nav">
            <a href="#" class="bottom-nav-item active">
                <i class="fas fa-home"></i>
                <span>Home</span>
            </a>
            <a href="#" class="bottom-nav-item">
                <i class="fas fa-search"></i>
                <span>Search</span>
            </a>
            <a href="#" class="bottom-nav-item">
                <i class="fas fa-plus-square"></i>
                <span>Add</span>
            </a>
            <a href="#" class="bottom-nav-item">
                <i class="far fa-heart"></i>
                <span>Likes</span>
            </a>
            <a href="#" class="bottom-nav-item">
                <i class="far fa-user"></i>
                <span>Profile</span>
            </a>
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
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <script src="/assets/js/custom.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Page Specific JS File -->
    @stack('customScript')
</body>

</html>
