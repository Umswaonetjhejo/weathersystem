<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>

    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">

</head>
<body style="background-color: {{ $color }}">

    <br>
    <div class="container">

        <div class="row">
            <div class="col">

            </div>
            <div class="col" align="center">
                <h3><b>{{ $todayWeather['name'] }}</b></h3>
                <h1><img style="background-color:transparent; border:transparent;" src="{{url('/assets/xhdpi/'.$image)}}" class="img-thumbnail" alt="temperature">{{ round($todayWeather['main']['temp']) }}&#176;</h1>
                <p>
                    {{ round($todayWeather['main']['temp_max']) }}&#176; / {{ round($todayWeather['main']['temp_min']) }}&#176; Feels like {{ round($todayWeather['main']['feels_like']) }}&#176;<br>
                    {{ $todayWeather['weather'][0]['main'] }}
                </p>

            </div>
            <div class="col">

            </div>
        </div>

        <div class="row">

            <div class="col-md-1">

            </div>

            @for($i = 0; $i < 5; $i++)

                @if($futureDates[$i]['weather'][0]['main'] == 'Clear')

                    <?php
                        $col = '#eabc46';
                        $img = 'ic_sunny.png';
                    ?>

                @elseif($futureDates[$i]['weather'][0]['main'] == 'Rain')

                    <?php
                        $col = '#56565c';
                        $img = 'ic_rainy.png';
                    ?>

                @else

                    <?php
                        $col = '#638593';
                        $img = 'ic_cloudy.png';
                    ?>

                @endif

                <div class="col-md-2 col-sm-12">
                    <div class="card" style="background-color: {{ $col }}">
                        <div class="card-body">
                            <p class="card-text"><b>{{ date('l', strtotime($futureDates[$i]['dt_txt'])) }}</b><br>
                                <img style="background-color:transparent; border:transparent;" src="{{ url('/assets/xhdpi/'.$img) }}" class="img-thumbnail" alt="temperature">
                                {{ $futureDates[$i]['main']['temp'] }}&#176;<br>

                                Main: {{ $futureDates[$i]['weather'][0]['main'] }}<br>
                                Min: {{ $futureDates[$i]['main']['temp_min'] }}<br>
                                Max: {{ $futureDates[$i]['main']['temp_max'] }}<br>
                                Humidity: {{ $futureDates[$i]['main']['humidity'] }}<br>
                                Wind Speed: {{ $futureDates[$i]['wind']['speed'] }}
                            </p>

                        </div>
                    </div>
                </div>

            @endfor

            <div class="col-md-1">

            </div>

        </div>

        <br>
    </div>

    <script src="{{ asset('/js/app.js') }}"></script>
</body>
</html>

