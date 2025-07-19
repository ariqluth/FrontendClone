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
                            <i class="fas fa-ellipsis-h"></i>
                        </div>
                    </div>
                    <div class="post-image">
                        <img src="{{ $post->image ?? 'https://via.placeholder.com/600' }}" alt="Post Image">
                    </div>
                    <div class="post-actions">
                        <div class="action-buttons">
                            <button class="like-button">
                                <svg aria-label="Suka" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M16.792 3.904A4.989 4.989 0 0121.5 9.122c0 3.072-2.652 4.959-6.12 8.42a18.227 18.227 0 01-3.38 2.55 1 1 0 01-1.002 0 18.227 18.227 0 01-3.38-2.55C3.152 14.08.5 12.194.5 9.122a4.989 4.989 0 014.708-5.218 4.21 4.21 0 013.675 1.941c.84 1.175.98 1.763 1.12 1.763s.278-.588 1.118-1.763a4.21 4.21 0 013.675-1.941z" stroke-width="2"></path></svg>
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
