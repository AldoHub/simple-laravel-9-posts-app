
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel Posts</title>

        <!-- use the asset() to import stuff from the PUBLIC folder -->
        <link href='{{ asset('css/style.css'); }}' rel="stylesheet" />
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body>

       <!--add navigation in here -->
       <nav>
        <ul>
            <li><a href='/'>Laravel Posts</a></li>
            <li><a href='/posts/create'>Create a New Post</a></li>
        </ul>
       </nav>
       <div>
            <!-- outputs the sections added using the yield decorator -->
            @yield("content") 
       </div>
    
       <!-- adds the flash message component to the view -->
       <x-flash-message />

       <script>
        setTimeout(function() {
          console.log('timeout ran');

          let flash_message = document.querySelector("#flash-message");
          console.log(flash_message)
          flash_message.remove();
 
        }, 3000); 
        </script>
    </body>
</html>
