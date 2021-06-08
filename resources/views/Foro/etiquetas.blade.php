
@include('layouts.header')
<!-- MAIN CONTENT -->

    <h1 class="d-inline-block"> {{ $title }} </h1>


    <div class="table-responsive">


        @foreach($entradas as $entrada)
            
            {{$entrada->etiquetas}}



        @endforeach

    </div>

<!-- END MAIN CONTENT -->
@include('layouts.footer')on