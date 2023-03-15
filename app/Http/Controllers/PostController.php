<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //

    public function index(Request $req){

        //testing with http://localhost:8000/?tag=manga


        //filter data -- get the tag from the request using the name of the tag in the paramenters
        $filteredTags = $req->tag;

        //serach request 
        $search = $req->search;


        //request(['tag', 'search']);

        return view('posts.index', [
            //here pass data to the template (blade in this case)
            //'posts' => Post::all(),
            //use the sorted version, and can also append the filters 
            'posts' => Post::latest()->filter([$filteredTags, $search])->paginate('5')
        ]);
    }


    //this model binding will handle the 404 automatically
    public function show(Post $post){
        //return the single post view with the function that finds one post by 1
        return view('posts.show', [
            'post' => $post
        ]);
    }



    public function create(){
        return view('posts.create');
    }


    public function store(Request $req){
        //ddd($req->all());
       
       
        //validation
        $formFields = $req->validate([
            'title' => 'required',
            'description' => 'required',
            'tags' => 'required',
            'cover' => 'required|image|max:4999'
        ]);
  
        
        //handle file in order to store it
        if($req->hasFile('cover')){
             /**
             * Then you have to create the symbolic link from your public/storage directory to your 
             * storage/app/public directory so you can access the files. You can do that with: php artisan storage:link
             * then the images or files will be visible and available to the template
            */
            
            //custom file processing
            $originalFile = $req->file("cover")->getClientOriginalName();
            $filename = pathinfo($originalFile, PATHINFO_FILENAME);
            $fileExt = $req->file("cover")->getClientOriginalExtension();
            
            $renameFile = $filename . "-" . time() . "." . $fileExt; 
          
            //where to save the file
            $req->file("cover")->storeAs("public/covers", $renameFile);
            
            
            //add it to the form inputs
            $formFields['cover'] = $renameFile; 
           
        }

        Post::create($formFields);

        //response with flash message
        return redirect('/')->with("message", "New Post Created Successfully!");
    
    }



    public function update(Request $req, Post $post){

      
        //validation
        $formFields = $req->validate([
            'title' => 'required',
            'description' => 'required',
            'tags' => 'required',
           
        ]);

        if($req->hasFile('cover')){
           //custom file processing
           $originalFile = $req->file("cover")->getClientOriginalName();
           $filename = pathinfo($originalFile, PATHINFO_FILENAME);
           $fileExt = $req->file("cover")->getClientOriginalExtension();
           
           $renameFile = $filename . "-" . time() . "." . $fileExt; 
         
           //where to save the file
           $req->file("cover")->storeAs("public/covers", $renameFile);
           
           
           //add it to the form inputs
           $formFields['cover'] = $renameFile; 
          

           //delete the prev image
           $prevImage = $req->input("covername");
           $deleteCover = "storage". DIRECTORY_SEPARATOR . "covers" . DIRECTORY_SEPARATOR . $prevImage;
           unlink(public_path($deleteCover));
       }

       //update the current post
       $post->update($formFields);

       //response with flash message
       return back()->with("message", "Post Updated Successfully!");
       
    }



    public function destroy(Post $post){
        
        $prevImage = $post->cover;

        //remove the post and redirect to home
        $post->delete();
        
        //delete the prev image
        $deleteCover = "storage". DIRECTORY_SEPARATOR . "covers" . DIRECTORY_SEPARATOR . $prevImage;
        unlink(public_path($deleteCover));
        
        return redirect('/')->with("message", "Post Deleted Successfully!");
       
    }
}
