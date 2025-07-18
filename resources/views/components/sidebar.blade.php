<div class="d-flex flex-column flex-shrink-0 p-3 bg-light vh-100" style="width: 280px;">
    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
        <span class="fs-4">Instagram</span>
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
            <a href="#" class="nav-link active" aria-current="page">
                <i class="fa fa-home me-2"></i>
                Home
            </a>
        </li>
        <li>
            <a href="#" class="nav-link link-dark">
                <i class="fa fa-search me-2"></i>
                Search
            </a>
        </li>
        <li>
            <a href="#" class="nav-link link-dark">
                <i class="fa fa-compass me-2"></i>
                Explore
            </a>
        </li>
        <li>
            <a href="#" class="nav-link link-dark">
                <i class="fa fa-film me-2"></i>
                Reels
            </a>
        </li>
        <li>
            <a href="#" class="nav-link link-dark">
                <i class="fa fa-paper-plane me-2"></i>
                Messages
            </a>
        </li>
        <li>
            <a href="#" class="nav-link link-dark">
                <i class="fa fa-heart me-2"></i>
                Notifications
            </a>
        </li>
        <li>
            <a href="#" class="nav-link link-dark">
                <i class="fa fa-plus-square me-2"></i>
                Create
            </a>
        </li>
        <li>
            <a href="{{ route('post.create') }}" class="nav-link link-dark">
                <i class="fa fa-plus-square me-2"></i>
                Create
            </a>
        </li>
        <li>
            <a href="#" class="nav-link link-dark"> 
                <img src="{{ asset('assets/img/avatar.png') }}" alt="">
                Profile
            </a>
        </li>
        <li>
            <a href="{{ route('logout') }}" class="nav-link link-dark">
                <i class="fa fa-sign-out me-2"></i>
                Logout
            </a>
        </li>
    </ul>
</aside>
