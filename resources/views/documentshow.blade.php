
<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Eatio - Document</title>
    <link rel="stylesheet" href="/resources/assets/bootstrap/css/bootstrap-theme.min.css"/>
    <link rel="stylesheet" href="/resources/assets/bootstrap/css/bootstrap.min.css"/>
    <script src="/resources/assets/bootstrap/js/bootstrap.min.js" type="text/javascript"> </script>
    <script src="/resources/assets/jquery/jquery-3.2.1.min.js" type="text/javascript"> </script>
    <link href="https://fonts.googleapis.com/css?family=Lora:100,600" rel="stylesheet" type="text/css">
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Lora', sans-serif;
            font-weight: 100;
            height: 100vh;
            margin: 0;
        }

    </style>
</head>
<body>
    <div class="container">


            {{--@if($route)--}}
                {{--<a href=""> {{$route['uri']}}</a>--}}
            {{--@endif--}}
        <div class="jumbotron">
            <h1 class="h1">Eatio - API Document</h1>
        </div>
        <div class="row" >
            <dl class="dl-horizontal">

                <dt>Name:</dt>
                <dd> {{$route['name']}}</dd>
                <p></p>

                <dt>Description:</dt>
                <dd>{{$route['description']}}</dd>
                <p></p>


                <dt>Uri:</dt>
                <dd>{{$route['uri']}}</dd>
                <p></p>

                <dt>Method:</dt>
                <dd>{{$route['method']}}</dd>
                <p></p>

                <dt>Params:</dt>
                <dd>
                    @foreach($route['params'] as $param)
                        <p> {{$param[0]}} -  {{$param[2]}} - {{$param[1]}}</p>
                    @endforeach
                </dd>
                <p></p>

                <dt>Success Response:</dt>
                <dd>{{$route['success']}}</dd>
                <p></p>

                <dt>Fail Response:</dt>
                <dd>
                    <p>Danh sách mã lỗi</p>
                    <table class="table" width="480px">
                        <thead class="col-mg-10">
                            <tr>
                                <th>Mã</th>
                                <th>Message</th>
                                <th>Lý do:</th>
                            </tr>
                        </thead>
                        <tbody class="col-mg-10">
                            @foreach($route['fail'] as $fail)
                                <tr>
                                    <td class="col-md-1">{{$fail[0]}}</td>
                                    <td class="col-md-2">{{\Responses\ResponseJsonBadRequest::$errosMessage[$fail[0]]}}</td>
                                    <td class="col-md-2">{{$fail[1]}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </dd>
                <p></p>
            </dl>
        </div>

    </div>
</body>
</html>
