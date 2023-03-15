@extends("layout")
@section("content")
<div class='single-post'>
    <h2>{{$post->title}}</h2>
    <img src="../storage/covers/{{$post->cover}}" />
    <div>
        {{$post->description}}



        <hr/>


        <!-- edit form -->
        <div class='edit-form'>
            <form action='/posts/edit/{{$post->id}}' enctype='multipart/form-data' method="POST">
               
                @csrf
                @method('PUT')

                <div class='form-control'>
                    <label for="title">Post Title: </label>
                    <input type="text" name='title' id="title" value="{{$post->title}}" />  
                    
                    @error('title')
                        <span class='error-message'>{{$message}}</span>
                    @enderror
                </div>

                <div class='form-control'>
                    <label for="description">Post Description: </label>
                    <textarea name='description' id="description">{{$post->description}}</textarea>  
                    
                    @error('description')
                        <span class='error-message'>{{$message}}</span>
                    @enderror
                </div>

                <div class='form-control'>
                    <label for="cover">Post Description: </label>
                    <input type='file' name='cover' id="cover" />
                    @error('cover')
                    <span class='error-message'>{{$message}}</span>
                    @enderror
                    
                </div>

                <div class='form-control'>
                    <input type='hidden' name='covername' id="covername" value="{{$post->cover}}" />                        
                </div>

                <div class='form-control'>
                    <label for="tags">Post Tags (comma separated): </label>
                    <input type="text" name='tags' id="tags" value="{{$post->tags}}" />  

                    @error('tags')
                        <span class='error-message'>{{$message}}</span>
                    @enderror
                </div>

                <input type="submit" value='Update Post'>

            </form>
        </div>



        <!-- delete form -->
        <div>
            <form action='/posts/delete/{{$post->id}}' method="POST">

                @csrf
                @method('DELETE')    
                
                <input class='delete' type="submit" value='Delete Post'>

            </form>
        </div>
    </div>


</div>
@endsection