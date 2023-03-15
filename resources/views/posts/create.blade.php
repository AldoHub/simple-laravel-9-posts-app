@extends("layout")
@section("content")

<div>
    <h2>Create a New Post </h2>

    <form action='/posts' enctype='multipart/form-data' method="POST">
        @csrf
        <div class='form-control'>
            <label for="title">Post Title: </label>
            <input type="text" name='title' id="title" value="{{old('title')}}" />  
            
            @error('title')
                <span class='error-message'>{{$message}}</span>
            @enderror
        </div>

        <div class='form-control'>
            <label for="description">Post Description: </label>
            <textarea name='description' id="description">
                {{old('description')}}
            </textarea>  
            
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
            <label for="tags">Post Tags (comma separated): </label>
            <input type="text" name='tags' id="tags" value="{{old('tags')}}" />  

            @error('tags')
                <span class='error-message'>{{$message}}</span>
            @enderror
        </div>

        <input type="submit" value='Create Post'>

    </form>
</div>




@endsection