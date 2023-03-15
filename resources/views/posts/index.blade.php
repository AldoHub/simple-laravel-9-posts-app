@extends("layout")
@section("content")

        <!-- include the partials -->
        @include("partials._hero")
        
        <div class="container">
        
          
        
            <div class="posts-container-wrapper">
                <!-- search bar -->
                @include("partials._search")


                <header>
                    <h1>Laravel Posts</h1>            
                </header>
    
                <div class='posts-container'>
                    <!-- get the posts -->
                    @if (count($posts) == 0)
                        <!-- return a message when the posts are empty -->
                        <p>There are no posts to view at the moment, please add some first</p>

                    @else
                        <!-- return all the posts, use foreach -->
                        @foreach($posts as $post)
                            <!-- display the needed component -->
                            <x-post-card :post="$post" />
                        @endforeach
                    
                    
                      
                    @endif
                </div>
                <div class='pagination'>
                    {{$posts->links()}}
                </div>
            </div>    
            
        </div>
      
@endsection()