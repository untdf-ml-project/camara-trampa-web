<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Picture;
use App\Classification;

class PictureController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['create', 'edit', 'classify']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $picture = Picture::where('validated', 0)->inRandomOrder()->first();
        if ($picture && env('CLASSIFICATION_IS_OPEN')) {
            return view('picture', [
                'picture' => $picture,
                'count' => Classification::count()
            ]);
        }
        else {
            return redirect()->route('about');
        }
    }

    /**
     * Edit a resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($filename)
    {
        $picture = Picture::where('filename', $filename)->with('clasifications')->first();

        if ($picture) {
            return view('picture', [
                'picture' => $picture,
                'count' => Classification::count(),
            ]);
        }
        else {
            return redirect()->route('about');
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function classify($validated=0)
    {
        $status = Picture::groupBy('validated')->selectRaw('count(filename) as count, validated')->orderBy('validated')->get()->keyBy('validated');
        $pictures = Picture::where('validated', $validated)->orderBy('hits')->get();
        return view('classify', [
            'status' => $status,
            'pictures' => $pictures,
            'responses' => Classification::count(),
            'photos' => Picture::count(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $files = Storage::files('public');
        foreach ($files as $item) {
            $extension = end(explode('.', $item));

            if (in_array($extension, ['jpg', 'JPG', 'jpeg', 'JPEG'])) {
                $picture = new Picture();
                $filename = explode('/', $item);
                $filename = end($filename);
                $picture->filename = $filename;
                $picture->validated = false;
                $picture->hits = 0;
                $picture->save();
            }
        }
        return redirect()->route('about');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $picture = Picture::where('filename', $request->filename)->first();

            if (!$picture->validated || auth()->user()) {
                $clasification = new Classification();
                $clasification->filename = $request->filename;
                $clasification->day = $request->day;
                $clasification->animal = $request->animal;
                $clasification->picture_id = $picture->id;
                $clasification->save();

                if (auth()->user()) {
                    $picture->validated = 1;
                    $picture->day = $request->day;
                    $picture->animal = $request->animal;
                }
                else {
                    $picture->validated = $this->isValid($clasification->filename);
                    $picture->day = $picture->classifyDay();
                    $picture->animal = $picture->classifyAnimal();
                }

                $picture->hits = Classification::where('filename', $request->filename)->count();
                $picture->save();
            }

        } catch (Exception $exception) {
            return back()->withInput()
                ->withErrors(['unexpected_error' => $exception->getMessage()]);
        }

        return redirect()->route('pictures.index');
    }


    private function isValid($filename)
    {
        // obtenemos la cantidad de calificaciones positivas que tuvo una imagen
        // si el número por variable coincide con rowcount o es igual a cero,
        // es porque todas las personas respondieron lo mismo
        // entonces no hubo dudas sobre las respuestas
        $classification = Classification::groupBy('filename')->selectRaw('sum(day) as day, sum(animal) as animal, count(filename) as rowcount')->where('filename', $filename)->first();

        if ($classification) {

            // si 3 personas respondieron exactamente lo mismo, la daremos como válida
            if ($classification->rowcount == 3) {
                return (
                    (($classification->day == $classification->rowcount) || ($classification->day == 0))
                    &&
                    (($classification->animal == $classification->rowcount) || ($classification->animal == 0))
                );
            }

            // si al menos 6 personas respondieron y hay un acuerdo del 80% en las respuestas, la daremos como válida
            // esto quiere decir que el valor válido es > 0.8 o < 0.2
            if ($classification->rowcount > 5) {
                $day = $classification->day / $classification->rowcount;
                $animal = $classification->animal / $classification->rowcount;

                if ( ($day > 0.8 || $day < 0.2) && ($animal > 0.8 || $animal < 0.2) ) {
                    return true;
                }
            }
        }

        // en cualquier otro caso no será válida
        return false;
    }

}
