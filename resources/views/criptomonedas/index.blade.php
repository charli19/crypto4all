
@include('layouts.header')
<!-- MAIN CONTENT -->
<div class="container ">
@if(Auth::guest() || Auth::user()->hasRole('user') || Auth::user()->hasRole('admin') )
        <div class="container-fluid">

            <div class="  col-md-12" style="margin-top: 40px">
                    <h3 class="" style="text-align:center">Bitcoin</h3>

                    <div class="row">
                        <div>
                            <table id="tabla" style="font-size: 200%;"  class="table table-responsive-md display" style="width:100%">
                                <thead class="blue lighten-3">
                                <tr>
                                    <th><h3>Ranking</h3></th>
                                    <th><h3>Moneda</h3></th>
                                    <th><h3>Precio</h3></th>
                                    <th><h3>Volumen24h</h3></th>
                                    <th><h3>Total circulacion</h3></th>


                                </tr>
                                </thead>
                                <tbody>

                                @foreach($criptomonedas as $criptomoneda)
                                    <tr>
                                        <td><a href="{{ url('/criptomonedas/'.$criptomoneda->nombre)}}">
                                                <h3>{{$criptomoneda->id_criptomoneda}}</h3>
                                            </a></td>
                                        <td><a href="{{ url('/criptomonedas/'.$criptomoneda->nombre)}}">
                                                <h3>{{$criptomoneda->nombre}}</h3>
                                            </a></td>
                                        <td></td>

                                        <td> @if($criptomoneda->porcentaje_24h<0)
                                                <h3 class="text-danger d-inline">{{$criptomoneda->porcentaje_24h}}%  </h3>
                                            @elseif($criptomoneda->porcentaje_24h>0)
                                                <h3 class="text-success d-inline">{{$criptomoneda->porcentaje_24h}}%  </h3>
                                            @endif</td>
                                        <td><h3>{{$criptomoneda->total_circulacion}}</h3></td>

                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot class="blue lighten-3">
                                <tr>
                                    <th><h5>Ranking</h5></th>
                                    <th><h5>Moneda</h5></th>
                                    <th><h5>Precio</h5></th>
                                    <th><h5>Volumen24h</h5></th>
                                    <th><h5>Total circulacion</h5></th>

                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
            </div>

            <hr>







        </div>


        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js">
        </script>
        <script>
            $(document).ready(function() {
                $('#tabla').DataTable( {
                    "language": {
                        "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
                    }
                } );
            } );
        </script>
    @endif
        </div><br><br>
<!-- END MAIN CONTENT -->
@include('layouts.footer')