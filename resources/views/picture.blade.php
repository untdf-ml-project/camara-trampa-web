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

    <style>
        body { background: #efefef; }
        h1 { font-size: 1.8em; }
        .main { padding-top: 1em; }
        img { max-width: 100%; }
    </style>

    <title>Cámaras trampa</title>
</head>
<body>
    <div class="container main">

        <div class="row justify-content-center">
            <div class="col text-center">
                <h1>¡Gracias por ayudar!</h1>
                <p><strong>Indicá si esta foto incluye algún animal</strong> (aunque esté tapado, lejos o borroso)</p>
            </div>
        </div>

        <form action="{{route('pictures.store')}}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}

            <div class="row">
                <div class="col-lg-8 mb-3">
                    <img src="{{Storage::url($picture->filename)}}">
                    <input type="hidden" name="filename" value="{{$picture->filename}}">
                </div>

                <div class="col-lg-4">
                    <div class="row justify-content-center">

                        <div class="btn-group btn-group-toggle mb-3" data-toggle="buttons">
                            <label class="btn btn-outline-success">
                                <input type="radio" id="day1" name="day" value="1" required />
                                <img src="{{asset('images/sun.png')}}"> Es de día
                            </label>
                            <label class="btn btn-outline-success">
                                <input type="radio" id="day0" name="day" value="0" required />
                                <img src="{{asset('images/moon.png')}}"> Es de noche
                            </label>
                        </div>

                        <div class="btn-group btn-group-toggle mb-3" data-toggle="buttons">
                            <label class="btn btn-outline-success">
                                <input type="radio" id="animal1" name="animal" value="1" required />
                                <img src="{{asset('images/cow.png')}}"> Con animales
                            </label>
                            <label class="btn btn-outline-success">
                                <input type="radio" id="animal0" name="animal" value="0" required />
                                <img src="{{asset('images/tree.png')}}"> Sin animales
                            </label>
                        </div>

                        <div class="row mb-3">
                            <div class="col text-center">
                                <button class="btn btn-success" type="submit">Enviar respuesta</button>
                                <a href="{{route('pictures.index')}}" class="btn btn-warning">No estoy segur@</a>
                            </div>
                        </div>

                    </div>

                    @if (auth()->user())
                        <div class="row mt-5">
                            <div class="col text-center">
                                <p><strong>{{$picture->hits}} RESPUESTAS</strong></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-1"></div>
                            <div class="col-5">
                                <p>Día: {{$picture->resumen->dia}} <br> Noche: {{$picture->resumen->noche}}</p>
                            </div>
                            <div class="col-5">
                                <p>Con animales: {{$picture->resumen->animales}} <br> Sin animales: {{$picture->resumen->sinanimales}}</p>
                            </div>
                        </div>

                        @if ($picture->isValidated())
                        <div class="row mt-5">
                            <div class="col text-center">
                                <p><strong><i class="fas fa-check-circle"></i> CLASIFICACIÓN FINAL</strong></p>
                            </div>
                        </div>
                        <div class="row justify-content-center">

                            <div class="btn-group mb-3" data-toggle="buttons">
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


                       @endif

                    @endif

                </div>
            </div>

        </form>

        <p class="text-center">¡Genial! ya clasificamos {{$count}} fotos <img src="http://icons.iconarchive.com/icons/google/noto-emoji-people-bodyparts/32/12069-asset.pimages/ng" alt=""></p>

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
