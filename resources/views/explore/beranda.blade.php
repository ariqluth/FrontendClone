@extends('layouts.app')
@section('content')
<div class="content-wrapper">
    
    <!-- Stories Section -->
    <div class="stories-container">
        @if(isset($stories) && count($stories) > 0)
            @foreach($stories as $story)
                <div class="story-item {{ isset($story->viewed) && !$story->viewed ? 'unviewed-story' : '' }}">
                    <div class="story-avatar">
                        <img src="{{ $story->user->profilePicture ?? 'https://via.placeholder.com/56' }}" alt="{{ $story->user->username ?? 'User' }}">
                    </div>
                    <span>{{ $story->user->username ?? Str::limit($story->user->name ?? 'user', 8) }}</span>
                </div>
            @endforeach
        @else
            @for($i = 0; $i < 5; $i++)
                <div class="story-item">
                    <div class="story-avatar">
                        <img src="https://via.placeholder.com/56" alt="User">
                    </div>
                    <span>user{{ $i + 1 }}</span>
                </div>
            @endfor
        @endif
    </div>
    
    <!-- Posts Section -->
    <div class="post-feed">
        @if(isset($posts) && $posts->count() > 0)
            @foreach ($posts as $post)
                <div class="post-card">
                    <div class="post-header">
                        <div class="post-user-info">
                            <img src="{{ $post->createdBy->profilePicture ?? 'https://via.placeholder.com/32' }}" alt="User Avatar" class="user-avatar">
                            <span class="username">{{ $post->createdBy->name ?? 'User' }}</span>
                        </div>
                        <div class="post-options">
                            <i class="fas fa-ellipsis-h post-menu-trigger"></i>
                            <div class="post-dropdown-menu" id="dropdown-{{ $post->id }}" style="display: none">
                                <ul>
                                    <li><a href="#" data-post-id="{{ $post->id }}" class="dropdown-item" data-toggle="modal" data-target="#updatePostModal" onclick="editPost({{ $post->id }})">Edit</a></li>
                                    <li>
                                        <a href="#" class="dropdown-item text-danger" onclick="deletePost({{ $post->id }})">Delete</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="post-image">
                        <img src="http://localhost:3000{{ $post->imageUrl ?? 'https://via.placeholder.com/600' }}" alt="Post Image">
                    </div>
                    <div class="post-actions">
                        <div class="action-buttons">
                            <button class="like-button" data-post-id="{{ $post->id }}" onclick="toggleLike({{ $post->id }})">
                                @php
                                    $user = session('user');
                                    $userId = is_array($user) ? $user['id'] : (is_object($user) ? $user->id : null);
                                    $isLiked = $post->likes && $post->likes->where('userId', $userId)->count() > 0;
                                @endphp
                                <svg aria-label="Suka" class="w-6 h-6 {{ $isLiked ? 'liked' : '' }}" fill="{{ $isLiked ? 'red' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24">
                                    <path d="M16.792 3.904A4.989 4.989 0 0121.5 9.122c0 3.072-2.652 4.959-6.12 8.42a18.227 18.227 0 01-3.38 2.55 1 1 0 01-1.002 0 18.227 18.227 0 01-3.38-2.55C3.152 14.08.5 12.194.5 9.122a4.989 4.989 0 014.708-5.218 4.21 4.21 0 013.675 1.941c.84 1.175.98 1.763 1.12 1.763s.278-.588 1.118-1.763a4.21 4.21 0 013.675-1.941z" stroke-width="2"></path>
                                </svg>
                            </button>
                            <button class="comment-button">
                                <svg aria-label="Komentar" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M20.656 17.008a9.993 9.993 0 10-3.59 3.615L22 22z" stroke-linejoin="round" stroke-width="2"></path></svg>
                            </button>
                            <button class="share-button">
                                <svg aria-label="Bagikan" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M22 3L9.218 10.083M11.698 20.334L22 3.001H2L9.218 10.084M11.698 20.334L2 3.001M11.698 20.334L12 12" stroke-linejoin="round" stroke-width="2"></path></svg>
                            </button>
                        </div>
                        <button class="save-button">
                            <svg aria-label="Simpan" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M20 21l-8-7.56L4 21V3h16v18z" stroke-linejoin="round" stroke-width="2"></path></svg>
                        </button>
                    </div>
                    <div class="post-info">
                        <div class="likes">{{ $post->likes ? $post->likes->count() : 0 }} suka</div>
                        <div class="caption">
                            <span class="username">{{ $post->createdBy->name ?? 'Unknown User' }}</span>
                            <span>{{ $post->caption ?? $post->content ?? '' }}</span>
                        </div>
                        <div class="view-comments">Lihat semua {{ $post->comments ? $post->comments->count() : 0 }} komentar</div>
                        @if($post->comments && $post->comments->count() > 0)
                            <div class="comments-preview">
                                @foreach ($post->comments->take(2) as $comment)
                                    <div class="comment">
                                        <span class="username">{{ $comment->user->name ?? 'Unknown User' }}</span>
                                        <span class="comment-text">{{ $comment->body ?? $comment->content ?? '' }}</span>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                        <div class="post-timestamp">{{ isset($post->created_at) ? $post->created_at->diffForHumans() : '1 jam yang lalu' }}</div>
                        <div class="comment-form">
                            <form action="{{ route('comment.store', $post->id) }}" method="POST">
                                @csrf
                                <div class="input-group">
                                    <input type="text" name="body" class="comment-input" placeholder="Tambahkan komentar...">
                                    <button type="submit" class="submit-comment">Kirim</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="no-posts">
                @if(isset($error))
                    <p class="error-message">{{ $error }}</p>
                @else
                    <p>Tidak ada postingan untuk ditampilkan.</p>
                @endif
            </div>
        @endif
    </div>
</div>

<!-- update Post Modal -->
<div class="modal fade" id="updatePostModal" data-post-id="{{ $post->id }}" tabindex="-1" role="dialog" aria-labelledby="updatePostModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="updatePostModalLabel">Create New Post</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="createPostForm" action="{{ route('post.update', $post->id) }}" enctype="multipart/form-data" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
              <label for="content">Caption</label>
              <textarea class="form-control" id="content" name="content" rows="3" maxlength="1000" required value="{{ $post->content }}"></textarea>
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
<!-- Debug Information (remove in production) -->
{{-- @if(config('app.debug'))
    <div class="debug-info">
        <strong>Debug Info:</strong><br>
        Posts count: {{ isset($posts) ? $posts->count() : 'not set' }}<br>
        Stories count: {{ isset($stories) ? count($stories) : 'not set' }}<br>
        @if(isset($error))
            Error: {{ $error }}<br>
        @endif
    </div>
@endif --}}
@endsection
