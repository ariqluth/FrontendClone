<!-- DESKTOP / TABLET SIDEBAR -->
<nav class="sidebar" id="sidebar">
    <a href="/" class="d-flex align-items-center pb-3 pl-3 mb-3 text-decoration-none">
        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/2a/Instagram_logo.svg/1280px-Instagram_logo.svg.png" alt="Instagram" style="height: 40px;" class="mr-2">
    </a>
    <ul class="nav flex-column">
      <li class="nav-item">
        <a class="nav-link active" href="#">
          <i class="fas fa-home fa-fw"></i>
          <span>Home</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">
          <i class="fas fa-search fa-fw"></i>
          <span>Search</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">
          <i class="fas fa-compass fa-fw"></i>
          <span>Explore</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">
          <i class="fas fa-paper-plane fa-fw"></i>
          <span>Messages</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">
          <i class="fas fa-heart fa-fw"></i>
          <span>Notifications</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#" data-toggle="modal" data-target="#createPostModal"><i class="fas fa-image mr-2"></i>
          <span>Create</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">
          <i class="fas fa-user-circle fa-fw"></i>
          <span>Profile</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">
          <i class="fas fa-bars fa-fw"></i>
          <span>More</span>
        </a>
      </li>
      <li class="nav-item mt-auto">
        <a class="nav-link" href="#">
          <i class="fas fa-sign-out-alt fa-fw"></i>
          <span>Logout</span>
        </a>
      </li>
    </ul>
  </nav>
  
  <!-- MOBILE BOTTOM BAR -->
  <nav class="bottom-nav" id="bottom-nav">
    <a href="#" class="bottom-nav-item active">
      <i class="fas fa-home"></i>
      <span>Home</span>
    </a>
    <a href="#" class="bottom-nav-item">
      <i class="fas fa-search"></i>
      <span>Search</span>
    </a>
    <a href="#" class="bottom-nav-item" data-toggle="modal" data-target="#createPostModal">
      <i class="fas fa-plus-square"></i>
      <span>Create</span>
    </a>
    <a href="#" class="bottom-nav-item">
      <i class="fas fa-heart"></i>
      <span>Likes</span>
    </a>
    <a href="#" class="bottom-nav-item">
      <i class="fas fa-user-circle"></i>
      <span>Profile</span>
    </a>
  </nav>

<!-- Create Post Modal -->
<div class="modal fade" id="createPostModal" tabindex="-1" role="dialog" aria-labelledby="createPostModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="createPostModalLabel">Create New Post</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="createPostForm" action="{{ route('post.posting') }}" enctype="multipart/form-data" method="POST">
          @csrf
          <div class="form-group">
            <label for="content">Caption</label>
            <textarea class="form-control" id="content" name="content" rows="3" maxlength="1000" required></textarea>
            <div class="invalid-feedback"></div>
          </div>
          <div class="form-group">
            <label for="postImage">Image</label>
            <input class="form-control" type="file" id="imageUrl" name="imageUrl" accept=".jpg,.jpeg,.png,.svg">
            <small class="form-text text-muted">Select an image to upload (JPG, PNG, SVG only)</small>
            <div class="invalid-feedback"></div>
          </div>
          <input type="hidden" name="authorId" id="authorId" value="{{ session('user')['id'] ?? '' }}">
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary" id="submitPost">
              <span class="spinner-border spinner-border-sm d-none" role="status"></span>
              Share
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

@push('customScript')
<script src="{{ asset('assets/js/custom.js') }}"></script>
@endpush
