<!DOCTYPE html>
<html lang="en">

    <head>
        @include('layouts.head');
    </head>

    <body>

        <div class="wrapper">
            @include('layouts.navbar');
        </div>
        
        @include('layouts.sidebar');

        @yield('content');

        @include('layouts.footer');
            
        @include('layouts.scripts');

        </div>

    </body>

    

</html>