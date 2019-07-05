<article class="post" data-postid = "{{ $post->id }}">
    <p>{{$post->body}}</p>
    <div class="info">
        Posted by {{$post->user->first_name}} on {{$post->created_at}}
    </div>
    <div class="interaction">
    @if (Auth::user() == $post->user)
        <a href="#" class="edit">Edit</a> |
        <a href="{{ route('post.delete', [ 'post_id' => $post->id ])}}" class="delete">Delete</a>
    @else
        <?php $temp = Auth::user()->likes()->where('post_id', $post->id)->first() ?>
        <a href="#" class="like{{$temp ? $temp->like == 1 ? ' like-bold' : '' : ''}}">{{ $temp ? $temp->like == 1 ? 'Liked' : 'Like' : 'Like' }}</a> |
        <a href="#" class="like{{$temp ? $temp->like == 0 ? ' like-bold' : '' : ''}}">{{ $temp ? $temp->like == 0 ? 'Disliked' : 'Dislike' : 'Dislike' }}</a>
    @endif
    </div>
</article>