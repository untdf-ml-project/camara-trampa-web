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
            background-image: linear-gradient(rgba(0,0,0,0.3), rgba(0,0,0,0.1)), url(https://media.elpatagonico.com/adjuntos/193/imagenes/011/356/0011356036.jpg);
            background-size: cover;
            background-position: center;
        }

        .landing {
            padding-top: 1em;
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
            h1 { font-size: 3.4em; }
            .main { height: calc(100vh - 120px); }
        }

    </style>

    <title>Cámaras trampa</title>
</head>
<body>
    <div class="main">
        <div class="container landing">

            <div class="row">
                <div class="col-sm mb-3">
                    <h1>Tu granito de arena para la ciencia</h1>
                    <p>Hola! Estamos analizando 100.000 imágenes del bosque de Tierra del Fuego para conocer los impactos que los animales causan. Necesitamos ayuda para catalogarlas. Es super sencillo <strong>¿Contamos con vos?</strong></p>
                    <a href="{{route('pictures.index')}}" class="btn btn-success">Quiero colaborar</a>
                </div>

                <div class="col-sm">
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
