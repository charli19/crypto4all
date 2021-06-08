@include('layouts.header')
<!-- MAIN CONTENT -->
<div class="container">
@if(Auth::guest())
    <!--Sacar favoritos-->
    @else
    <br>
    
        @if($criptomoneda->fav(Auth::user()->id, $criptomoneda->id_criptomoneda))

            <button class="btn btn-success d-block pull-right float-right mb-3"><h4>Criptomoneda Favorita</h4></button></a>
            <form method="POST" action="{{ url('/criptomonedas/'.$criptomoneda->id_criptomoneda.'/desfavorito') }} ">
                {{ method_field('PUT') }}
                {!! csrf_field() !!}

                <input type="text" name="id_criptomoneda" id="id_criptomoneda" value="{{$criptomoneda->id_criptomoneda}}" hidden>
                <input type="text" name="id_usuario" id="id_usuario" value="{{Auth::user()->id}}" hidden>
                <button type="submit" class="btn btn-primary d-block pull-right float-right mb-3"><h4>Quitar Favoritos</h4></button></a>
            </form>
            
        @else
     
            <form method="POST" action="{{ url('/criptomonedas/'.$criptomoneda->id_criptomoneda.'/favorito') }} ">
                {{ method_field('PUT') }}
                {!! csrf_field() !!}

                <input type="text" name="id_criptomoneda" id="id_criptomoneda" value="{{$criptomoneda->id_criptomoneda}}" hidden>
                <input type="text" name="id_usuario" id="id_usuario" value="{{Auth::user()->id}}" hidden>
                <button type="submit" class="btn btn-primary d-block pull-right float-right mb-3"><h4>Añadir Favoritos</h4></button></a>
            </form><br>
        @endif
       

            @endif
            </div>
        <div class="container">
        <div class="content" >

                    <div class="panel panel-headline col-md-12" style="margin-top: 30px">
                <div class="panel-heading">
                    <h3 class="panel-title" style="text-align:center">{{ $criptomoneda->nombre }}</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div>
                        <div class="panel panel-headline col-md-6" style="margin-top: 30px">
                <div class="panel-heading">
                    <h3 class="panel-title" style="text-align:center">Historial completo</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div>
                            <div id="historial" class="ct-chart"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="panel panel-headline col-md-6" style="margin-top: 30px">
                <div class="panel-heading">
                    <h3 class="panel-title" style="text-align:center">Precio a tiempo real</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div>
                            <div id="{{ $criptomoneda->nombre }}" class="ct-chart"></div>
                        </div>
                    </div>
                </div>
            </div>
                        </div>
                    </div>
                </div>
            </div>
            

            <script>
$.getJSON(
    '{{ url('/historyall/'.$criptomoneda->id_criptomoneda) }}',
    function (data) {

        Highcharts.chart('historial', {
            chart: {    
                zoomType: 'x'
            },
            title: {
                text: ''
            },

            xAxis: {
                type: 'datetime'
            },
            yAxis: {
                title: {
                    text: 'Precio $'
                }
            },
            legend: {
                enabled: false
            },
            credits: {
                enabled: false
            },
            plotOptions: {
                area: {
                    fillColor: {
                        linearGradient: {
                            x1: 0,
                            y1: 0,
                            x2: 0,
                            y2: 1
                        },
                        stops: [
                            [0, Highcharts.getOptions().colors[0]],
                            [1, Highcharts.Color(Highcharts.getOptions().colors[0]).setOpacity(0).get('rgba')]
                        ]
                    },
                    marker: {
                        radius: 2
                    },
                    lineWidth: 1,
                    states: {
                        hover: {
                            lineWidth: 1
                        }
                    },
                    threshold: null
                }
            },

            series: [{
                type: 'area',
                name: 'Precio $',
                data: data
            }]
        });
    }
);

            </script>

            <script>
                Highcharts.setOptions({
                    global: {
                        useUTC: false
                    }
                });
                $.getJSON("{{ url('/historiall/'.$criptomoneda->id_criptomoneda) }}", function(result){
                    // Create the chart
                    Highcharts.stockChart('{{ $criptomoneda->nombre }}', {
                        chart: {
                            events: {
                                load: function() {
                                    // set up the updating of the chart each second
                                    var series = this.series[0];
                                    setInterval(function() {
                                        var x = (new Date()), // current time
                                            y;
                                        $.ajax({
                                            url: '{{url('/criptomonedas/'.$criptomoneda->id_criptomoneda.'/dato')}}',
                                            type: "GET",
                                            dataType: "json",
                                            async: false,
                                            success: function(result) {
                                                //console.log(result['precio']);
                                                y = parseFloat(result['precio_dolar']);
                                                x = new Date(result['fecha']).getTime();
                                            },
                                            cache: true
                                        });
                                        //console.log("Y: " + y);
                                        //console.log("X: " + x);
                                        series.addPoint([x, y], true, true);
                                    }, 122000);
                                }
                            }
                        },
                        
                rangeSelector: {
                    buttons: [{
                        count: 15,
                        type: 'minute',
                        text: '15M'
                    }, {
                        count: 1,
                        type: 'hour',
                        text: '1H'
                    }, {
                        count: 4,
                        type: 'hour',
                        text: '4H'
                    }, {
                        type: 'all',
                        text: 'All'
                    }],
                    inputEnabled: true,
                    selected: 5
                },


                        title: {
                            text: ''
                        },

                        exporting: {
                            enabled: true
                        },
                        credits: {
                            enabled: false
                        },
                        plotOptions: {
                            area: {
                                fillColor: {
                                    linearGradient: {
                                        x1: 0,
                                        y1: 0,
                                        x2: 0,
                                        y2: 1
                                    },
                                    stops: [
                                        [0, Highcharts.getOptions().colors[0]],
                                        [1, Highcharts.Color(Highcharts.getOptions().colors[0]).setOpacity(0).get('rgba')]
                                    ]
                                },
                                marker: {
                                    radius: 2
                                },
                                lineWidth: 1,
                                states: {
                                    hover: {
                                        lineWidth: 1
                                    }
                                },
                                threshold: null
                            }
                        },
                        series: [{
                            name: 'Precio $',
                            type: 'area',
                            data: (function () {
                                // generate an array of random data
                                var data = [],
                                    time = (new Date()).getTime(),
                                    i;
                                for (i = 0; i<result.length; i += 1) {
                                    //console.log(result[i]['fecha'])
                                    //console.log(result[i]['precio_dolar'])
                                    data.push([
                                        new Date (result[i]['fecha']).getTime(),
                                        parseFloat(result[i]['precio_dolar'])
                                    ]);
                                }
                                //console.log(data)
                                return data;
                            }())
                        }]
                    });
                });

            </script>
            </body>
            @if(Auth::guest() )
            
            @else
            <hr>
            <h3>Puntuación</h3>
            <hr>
            Puntuacion media: {{ $criptomoneda->media }}.<br>
            Total de votos: {{count($criptomoneda->valorCriptomoneda()->get())}}<br>
                @if($criptomoneda->votacion(Auth::user()->id,$criptomoneda->id_criptomoneda) )
                    Tu valoración ha sido {{$criptomoneda->valorCriptomoneda()->get()->where('id_usuario', Auth::user()->id)->first()->valor}}

                    <form method="POST" action="{{ url("/criptomonedas/{$criptomoneda->id_criptomoneda}/desvalorar") }} ">
                        {{ method_field('PUT') }}
                        {!! csrf_field() !!}

                        <input type="text" name="id_criptomoneda" id="id_criptomoneda" value="{{$criptomoneda->id_criptomoneda}}" hidden>
                        <input type="text" name="id_usuario" id="id_usuario" value="{{Auth::user()->id}}" hidden>
                        <button  class="btn btn-danger d-block " type="submit"><h5>Deshacer valoración</h5></button>
                    </form>
                @else
                    <hr>
                    <h3>Puntuar</h3>
                    <hr>
                    
                    <form method="POST" action="{{ url("/criptomonedas/{$criptomoneda->id_criptomoneda}/valorar") }} ">
                        {{ method_field('PUT') }}
                        {!! csrf_field() !!}

                        <input type="text" name="id_criptomoneda" id="id_criptomoneda" value="{{$criptomoneda->id_criptomoneda}}" hidden>
                        <input type="text" name="id_usuario" id="id_usuario" value="{{Auth::user()->id}}" hidden>
                        <p class="valoracion clasificacion text-left" >
                            <input id="radio1" type="radio" name="valor" value="5">
                            <label class="valoracion" for="radio1">★</label>
                            <input id="radio2" type="radio" name="valor" value="4">
                            <label class="valoracion" for="radio2">★</label>
                            <input id="radio3" type="radio" name="valor" value="3">
                            <label  class="valoracion" for="radio3">★</label>
                            <input id="radio4" type="radio" name="valor" value="2">
                            <label class="valoracion" for="radio4">★</label>
                            <input id="radio5" type="radio" name="valor" value="1">
                            <label class="valoracion" for="radio5">★</label>
                        </p>
                        <button class="btn btn-success d-block" type="submit"><h5>Valorar</h5></button>
                    </form>
                    <hr>
                @endif
            <!-- Cambiar valoracion (Solo update) y mostramos el numero de estrellas 5★ -->
@endif
<div class="comments-list text-center text-md-left mb-5">

<div class="text-center mb-6">
    <h3>Comentarios
        <span class="badge blue">{{count($criptomoneda->comentarioCriptomoneda()->get())}}</span>
    </h3>
</div>
</div>
                <div class="container">
                    @foreach($criptomoneda->comentarioCriptomoneda()->get() as $comentario)
 <!--First row-->
            <div class="row jumbotron text-center">
                        <!--Image column-->
                        <div class="col-md-12">
                            <img src="{{ $comentario->usuario()->get()->first()->imagen }}" widht="150" height="150" class="avatar rounded-circle z-depth-1-half"><br><br>
                        </div>
                        <!--/.Image column-->
                        <!--Content column-->
                        <div class="col-md-12">
                            <a>
                                <h4 class="font-weight-bold">{{ $comentario->usuario()->get()->first()->nick }}</h4>
                            </a>
                            <div class="mt-2 ">
                                <ul class="list-unstyled">
                                    <li class="comment-date">
                                        <i class="fa fa-clock-o "></i> {{ $comentario->created_at }}</li>
                                </ul>
                            </div>

                            <div class="grey-text">
                                {!! $comentario->comentario  !!}
                            </div>
                            
                            @if(Auth::guest())


                            @elseif(Auth::user()->nick == $comentario->usuario()->get()->first()->nick || Auth::user()->hasRole('admin'))

                            <div class="row center-block" style="display: flex;align-items: center;">
                            <form method="POST" action="{{route("eliminarcomentariocriptomoneda", $comentario) }}" method="POST">
                                {{ method_field('DELETE') }}
                                {!! csrf_field() !!}
                                <input type="text" name="id_comentario" id="id_comentario" value="{{$comentario->id_comentario}}" hidden>

                                <a class="btn btn-lg btn-danger pull-right float-right mb-3 " style="margin-top:10px;" type="submit"><h5>Eliminar comentario</h5></a>


                            </form>
                            </div>
                            @endif
                        </div>
                        <!--/.Content column-->
                    </div>

                    <!--/.First row-->



                    @endforeach
                    
                    @if(Auth::guest())

                                                    <h1 class="text-center">Para realizar un comentario tienes que iniciar sesión</h1>

<div class="row center-block" style="display: flex;align-items: center;justify-content: center;">
    <a href="{{url('login')}}"><button class="btn btn-info btn-lg"><h4>Iniciar session</h4></button>&nbsp;</a>
</div>

                    @elseif( Auth::user()->hasRole('user') || Auth::user()->hasRole('admin'))
                    @if(count($criptomoneda->comentarioCriptomoneda()->get())<1)
                    <div class="text-center">
                        Aun no hay comentarios, puedes ser el primero!
                        </div>
                    @endif

                    <fieldset>
                        <legend>Añade un comentario</legend>
                        <form method="POST" action=" {{  url("/criptomonedas/{$criptomoneda->id_criptomoneda}/comentario")}} ">
                            {!! csrf_field() !!}
                            {{ method_field('PUT') }}
                            <input type="text" name="id_criptomoneda" id="id_criptomoneda" value="{{$criptomoneda->id_criptomoneda}}" hidden>
                            <input type="text" name="id_usuario" id="id_usuario" value="{{Auth::user()->id}}" hidden>
                            <label for="comentario">Comentario:</label>
                            <textarea  class="form-control"  name="comentario" id="comentario" rows="3"></textarea>
                            <br>
                            <button class="btn btn-success d-block " type="submit"><h5>Comentar</h5></button>
                        </form>
                    </fieldset>
                </div>
                @endif


        </div>
</div>
<br><br>
<!-- END MAIN CONTENT -->
@include('layouts.footer')