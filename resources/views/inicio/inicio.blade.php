
@include('layouts.header')
<!-- MAIN CONTENT -->
<div class="main-content">
    <div class="container-fluid">
        <!-- OVERVIEW -->
        <div class="panel panel-headline col-md-12 text-center">
            <div class="panel-heading">
                <a href="{{url ('/')}}"><h2>Crypto4all</h2></a>
            </div>
        </div>
        <div class="panel panel-headline col-md-6">
            <div class="panel-heading">
                <a href="criptomonedas/bitcoin"><h3 class="panel-title" style="text-align:center">Bitcoin</h3>
                </a>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div>
                        <div id="Bitcoin" class="ct-chart"></div>
                    </div>
                </div>
            </div>
        </div>
<div class="panel panel-headline col-md-6">
  <div class="panel-heading">
  <a href="criptomonedas/ethereum"><h3 class="panel-title" style="text-align:center">Ethereum</h3>
  </a>
  </div>
  <div class="panel-body">
      <div class="row">
          <div>
            <div id="Ethereum" class="ct-chart"></div>
          </div>
        </div>
  </div>
</div>
<div class="panel panel-headline col-md-6">
    <div class="panel-heading">
    <a href="criptomonedas/litecoin">
      <h3 class="panel-title" style="text-align:center">Litecoin</h3>
      </a>
    </div>
    <div class="panel-body">
        <div class="row">
            <div>
              <div id="Litecoin" class="ct-chart"></div>
            </div>
          </div>
    </div>
  </div>
  <div class="panel panel-headline col-md-6">
      <div class="panel-heading">
      <a href="criptomonedas/bitcoin%20cash">
        <h3 class="panel-title" style="text-align:center">Bitcoin Cash</h3>
        </a>
      </div>
      <div class="panel-body">
          <div class="row">
              <div>
                <div id="Bitcoin Cash" class="ct-chart"></div>
              </div>
            </div>
      </div>
    </div>
    <div class="panel panel-headline col-md-6">
        <div class="panel-heading">
          <h3 class="panel-title" style="text-align:center">Volumen de transacciones en 24h</h3>
        </div>
        <div class="panel-body">
            <div class="row">
                <div>
                  <div id="Volumen24h" class="ct-chart"></div>
                </div>
              </div>
        </div>
      </div>
      <div class="panel panel-headline col-md-6">
          <div class="panel-heading">
            <h3 class="panel-title" style="text-align:center">Capital de mercado</h3>
          </div>
          <div class="panel-body">
              <div class="row">
                  <div>
                    <div id="capital" class="ct-chart"></div>
                  </div>
                </div>
          </div>
        </div>
        <!-- END OVERVIEW -->
        <div class="row">
            <div class="col-md-12">
  
  <!--TABLA-->
                
            </div>
        </div>
    </div>
</div>

@php $criptomonedas=\App\Criptomoneda::all() @endphp
@foreach($criptomonedas as $criptomoneda)
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
                                    url: '{{ url('/valor/'.$criptomoneda->id_criptomoneda)}}',
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

    <script type="text/javascript">
        Highcharts.chart('Volumen24h', {
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: ''
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: false
                    },
                    showInLegend: true
                }
            },
            rangeSelector: {
                buttons: [{
                    count: 1,
                    type: 'minute',
                    text: '1Min'
                }, {
                    count: 5,
                    type: 'minute',
                    text: '5Min'
                }, {
                    count: 1,
                    type: 'hour',
                    text: '1H'
                }, {
                    count: 1,
                    type: 'day',
                    text: '1D'
                }, {
                    count: 1,
                    type: 'year',
                    text: '1Y'
                }, {
                    type: 'all',
                    text: 'All'
                }],
                inputEnabled: true,
                selected: 4
            },

            credits: {
                enabled: false
            },
            series: [{
                name: 'Porcentaje',
                colorByPoint: true,
                data: [{
                    name: '{{$criptomoneda::where('id_criptomoneda','1')->get()->last()->nombre}}',
                    y: {{$criptomoneda::where('id_criptomoneda','1')->get()->last()->volumen_24h}}
                }, {
                    name: '{{$criptomoneda::where('id_criptomoneda','2')->get()->last()->nombre}}',
                    y: {{$criptomoneda::where('id_criptomoneda','2')->get()->last()->volumen_24h}}
                }, {
                    name: '{{$criptomoneda::where('id_criptomoneda','3')->get()->last()->nombre}}',
                    y: {{$criptomoneda::where('id_criptomoneda','3')->get()->last()->volumen_24h}}
                }, {
                    name: '{{$criptomoneda::where('id_criptomoneda','4')->get()->last()->nombre}}',
                    y: {{$criptomoneda::where('id_criptomoneda','4')->get()->last()->volumen_24h}}
                }]
            }]
        });
    </script>
    <script>
        Highcharts.chart('capital', {
            chart: {
                type: 'column'
            },
            title: {
                text: ''
            },
            subtitle: {
                text: ''
            },
            xAxis: {
                type: 'category'
            },
            yAxis: {
                title: {
                    text: 'Precio $'
                }
            },
            plotOptions: {
                series: {
                    borderWidth: 0,
                    dataLabels: {
                        enabled: true,
                        format: '{point.y:,.1f} $'
                    }
                }
            },

            tooltip: {
                headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y: ,.1f} $</b><br/>'
            },
            legend: {
                enabled: false
            },
            credits: {
                enabled: false
            },
            "series": [
                {
                    "name": "Total",
                    "colorByPoint": true,
                    "data": [
                        {
                            "name": "{{$criptomoneda::where('id_criptomoneda','1')->get()->last()->nombre}}",
                            "y": {{$criptomoneda::where('id_criptomoneda','1')->get()->last()->capital_mercado_dolar}},
                        },
                        {
                            "name": "{{$criptomoneda::where('id_criptomoneda','2')->get()->last()->nombre}}",
                            "y": {{$criptomoneda::where('id_criptomoneda','2')->get()->last()->capital_mercado_dolar}},
                        },
                        {
                            "name": "{{$criptomoneda::where('id_criptomoneda','3')->get()->last()->nombre}}",
                            "y": {{$criptomoneda::where('id_criptomoneda','3')->get()->last()->capital_mercado_dolar}},
                        },
                        {
                            "name": "{{$criptomoneda::where('id_criptomoneda','4')->get()->last()->nombre}}",
                            "y": {{$criptomoneda::where('id_criptomoneda','4')->get()->last()->capital_mercado_dolar}},
                        },
                    ]
                }
            ],
        });
    </script>

@endforeach

<!-- END MAIN CONTENT -->
@include('layouts.footer')
