@props(['tags'])

@php
  //do some php here    
  $_tags = explode(",", $tags );

@endphp


<ul>
    @foreach($_tags as $tag)
    <li><a href="/?tag={{$tag}}">{{$tag}}</a></li>
    @endforeach
</ul>
