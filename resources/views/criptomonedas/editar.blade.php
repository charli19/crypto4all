
@include('layouts.header')
<!-- MAIN CONTENT -->

   <h1> Edición de Criptomoneda </h1>
   <form method="POST" action=" {{ url('criptomonedas/editar') }} ">
      {{ method_field('PUT') }}
      {!! csrf_field() !!}
      <input type="text" name="id" id="id" value="{{$criptomoneda->id_criptomoneda}}" hidden>


      <label for="nombre">Nombre</label>
      <input type="text" name="nombre" id="nombre" value="{{$criptomoneda->nombre}}">
      <br>

      <button type="submit">Editar Criptomoneda</button>
   </form>

   <a href="{{ route('criptomonedas') }}">Volver</a>


<!-- END MAIN CONTENT -->
@include('layouts.footer')