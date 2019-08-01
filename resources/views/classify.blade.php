<!doctype html>
<html lang="es_ar">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- iCheck Material -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/icheck-material@1.0.0/icheck-material.min.css">

    <!-- Font Awsome -->
    <script src="https://kit.fontawesome.com/8633ab122b.js"></script>

    <style>
        body { background: #efefef; }
        h1 { font-size: 1.8em; }
        .main { padding-top: 1em; }
        img { max-width: 100%; }
    </style>

    <title>Cámaras trampa</title>
</head>
<body>
    <div class="float-right pt-1">
        <a class="btn btn-outline-info" href="{{ route('logout') }}"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
        >
            {{ __('Logout') }}
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>
    <div class="container main">

        <div class="row justify-content-center">
            <div class="col text-center">
                <h1>Resumen del sistema</h1>
                <p>Tenemos <strong>{{$responses}} respuestas</strong> para {{$photos}} fotos</p>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col">
                @if ( $status->has(0) )
                <a href="{{route('classify', 0)}}" class="btn btn-outline-danger btn-block">{{$status[0]->count}} sin validar <i class="fas fa-times-circle"></i></a>
                @else
                <a href="#" class="btn btn-outline-danger btn-block">0 sin validar <i class="fas fa-times-circle"></i></a>
                @endif
            </div>
            <div class="col">
                @if ( $status->has(1) )
                <a href="{{route('classify', 1)}}" class="btn btn-outline-success btn-block">{{$status[1]->count}} validadas <i class="fas fa-check-circle"></i></a>
                @else
                <a href="#" class="btn btn-outline-success btn-block">0 validadas <i class="fas fa-check-circle"></i></a>
                @endif
            </div>
        </div>

        <div class="row">
            @foreach ($pictures as $picture)

            <div class="col-md-6 col-lg-4 mb-3">
                <div class="card">
                    <img class="card-img-top" src="{{Storage::url($picture->filename)}}">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <p>{{$picture->hits}} Respuestas</p>
                            </div>
                            <div class="col">
                                <p class="text-right">
                                        <i class="fas fa-{{$picture->validated ? "check" : "times"}}-circle"></i>
                                        {{$picture->validated ? "Validada" : "Sin validar"}}
                                </p>
                            </div>
                        </div>

                        @if ($picture->isValidated())
                        <div class="row justify-content-center">
                            <div class="col">
                                <div class="btn-group mb-3 btn-block" data-toggle="buttons">
                                    <label class="btn btn-outline-success active">
                                        @if ($picture->day)
                                            <img src="{{asset('images/sun.png')}}"> Es de día
                                        @else
                                            <img src="{{asset('images/moon.png')}}"> Es de noche
                                        @endif
                                    </label>

                                    <label class="btn btn-outline-success active">
                                        @if ($picture->animal)
                                            <img src="{{asset('images/cow.png')}}"> Con animales
                                        @else
                                            <img src="{{asset('images/tree.png')}}"> Sin animales
                                        @endif
                                    </label>
                                </div>
                            </div>
                        </div>
                       @endif

                        <a href="{{route('pictures.edit', $picture->filename)}}" class="btn btn-outline-success btn-block">Validar</a>
                    </div>
                </div>
            </div>

            @endforeach
        </div>


        <div class="row justify-content-center">
            <div class="col text-center">
                <p><a href="{{route('about')}}" class="btn btn-sm btn-outline-secondary">¿De qué se trata todo esto?</a></p>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
