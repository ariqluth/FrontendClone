@extends('layouts.app')
@section('content')
<div class="content-wrapper">
    <div class="post-feed">
        @if(isset($posts))
            @foreach ($posts as $post)
                <div class="post-card">
                    <div class="post-header">
                        <img src="{{ $post->createdBy->profile_photo_url ?? 'https://via.placeholder.com/32' }}" alt="User Avatar">
                        <span class="username">{{ $post->createdBy->name }}</span>
                    </div>
                    <div class="post-image">
                        <img src="{{ $post->image_url ?? 'https://via.placeholder.com/600' }}" alt="Post Image">
                    </div>
                    <div class="post-actions">
                        <button>
                            <svg aria-label="Suka" class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M16.792 3.904A4.989 4.989 0 0121.5 9.122c0 3.072-2.652 4.959-6.12 8.42a18.227 18.227 0 01-3.38 2.55 1 1 0 01-1.002 0 18.227 18.227 0 01-3.38-2.55C3.152 14.08  .5 12.194.5 9.122a4.989 4.989 0 014.708-5.218 4.21 4.21 0 013.675 1.941c.84 1.175.98 1.763 1.12 1.763s.278-.588 1.118-1.763a4.21 4.21 0 013.675-1.941z"></path></svg>
                        </button>
                        <button>
                            <svg aria-label="Komentar" class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M20.656 17.008a9.993 9.993 0 10-3.59 3.615L22 22z" fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="2"></path></svg>
                        </button>
                    </div>
                    <div class="post-info">
                        <div class="likes">{{ $post->likes->count() }} suka</div>
                        <div class="caption">
                            <span class="username">{{ $post->createdBy->name }}</span>
                            <span>{{ $post->caption }}</span>
                        </div>
                        <div class="comments">Lihat semua {{ $post->comments->count() }} komentar</div>
                        <div class="space-y-1 text-sm">
                            @foreach ($post->comments->take(2) as $comment)
                                <div>
                                    <span class="font-semibold">{{ $comment->user->name }}</span>
                                    <span>{{ $comment->body }}</span>
                                </div>
                            @endforeach
                        </div>
                        <div class="mt-3 pt-3 border-t border-gray-200">
                            <form action="{{ route('comments.store', $post->id) }}" method="POST">
                                @csrf
                                <div class="flex">
                                    <input type="text" name="body" class="w-full border-none text-sm placeholder-gray-500 focus:ring-0" placeholder="Tambahkan komentar...">
                                    <button type="submit" class="text-blue-500 font-semibold ml-4">Kirim</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="text-center text-gray-500">
                <p>Tidak ada postingan untuk ditampilkan.</p>
            </div>
        @endif
    </div>
</div>
@endsection
