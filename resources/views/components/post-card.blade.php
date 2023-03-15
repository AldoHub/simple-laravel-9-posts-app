<!-- define the props needed -->
@props(['post'])
<div class='post-card'>
    <a href='posts/{{$post->id}}'>
        <p class='post-title'>{{$post->title}}</p>
        <img src="../storage/covers/{{$post->cover}}" />
    </a>
    <x-tags-list :tags="$post->tags" />
</div>