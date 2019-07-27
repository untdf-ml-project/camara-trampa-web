<!doctype html>
<html lang="es_ar">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <style>

        .main {
            background-image: url(https://scontent-cdt1-1.cdninstagram.com/vp/baf27f34a624fb2fff067114627e0f7f/5D9DA4DD/t51.2885-15/e35/58453645_2361008257491079_1214305112089397849_n.jpg?_nc_ht=scontent-cdt1-1.cdninstagram.com&se=7&ig_cache_key=MjAzNDQ5ODA1NzIxNjY1OTUzNw%3D%3D.2);
            background-size: cover;
            background-position: center;
        }

        .landing {
            color: white;
        }

        .footer { height: 120px; }
        .footer img { margin: 0 1em; }

        h1 {
            font-size: 1.8em;
            text-shadow: 2px 2px 10px rgba(0,0,0,0.3);
        }
        p {
            font-size: 1em;
            text-shadow: 2px 2px 10px rgba(0,0,0,0.3);
        }

        @media (min-width: 576px) {
            .landing { padding-top: 20vh; }
            p { font-size: 1.2em; }
            h1 { font-size: 2.1em; }
            .main { height: calc(100vh - 120px); }
        }

    </style>

    <title>Cámaras trampa</title>
</head>
<body>
    <div class="main">
        <div class="container landing">

            <div class="row">
                <div class="col-12 col-lg-6 mb-3" style="background-color: rgba(0,0,0,0.5); padding: 1em;">
                    <h1>Tu ayuda para la ciencia</h1>
                    <p>Estamos analizando 100.000 imágenes del bosque de Tierra del Fuego para conocer los impactos que los animales causan. Es sólo un minuto. <strong>¿Nos ayudas a catalogarlas?</strong></p>
                    <a href="{{route('pictures.index')}}" class="btn btn-success">Catalogar fotos</a>

                    @if (auth()->user())
                    <a href="{{route('classify', 1)}}" class="btn btn-warning ml-3">Ver clasificadas</a>
                    @endif

                </div>

                <div class="col-12 col-lg-6">
                    <div class="embed-responsive embed-responsive-16by9">
                        <iframe width="560" height="315" src="https://www.youtube-nocookie.com/embed/3TNK916Pjto?controls=0" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="footer d-flex align-items-center justify-content-center">
        <a href="https://cadic.conicet.gov.ar/"><img src="{{asset('images/logo-cadic.png')}}" alt="CADIC CONICET" height="60px"></a>
        <a href="http://www.untdf.edu.ar/"><img src="{{asset('images/logo-untdf.png')}}" alt="Universidad Nacional de Tierra del Fuego" height="60px"></a>
        <a href="https://panalsoft.com/"><img src="{{asset('images/logo-panal.png')}}" alt="Panalsoft" height="60px"></a>
    </div>

</body>
</html>
