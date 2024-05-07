<?php

namespace App\Http\Controllers;

use App\Models\Film;
use App\Http\Requests\FilmRequest;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Foundation\Application;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class FilmController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allFilms = Film::all();
        $films = [];

        foreach ($allFilms as $film) {
            if ($film['image'] === 'img/3df77a6fe04a8f4253879b3478b0776a.jpeg' || $film['image'] === 'img/511eb6fb02565ba0374ddb3ad501d299.jpeg') {
                $film['image'] = config('imgUrl.imgUrl') . '/' . $film['image'];
                $films[] = $film;
            } else {
                $film['image'] = (!empty($film['image'])) ? config('imgUrl.imgUrl') . '/storage/' . $film['image'] : '';
                $films[] = $film;
            }
        }

        return $films;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FilmRequest $request)
    {
        $image64 = $request->image;
        $extension = explode('/', explode(':', substr($image64, 0, strpos($image64, ';')))[1])[1];
        $replace = substr($image64, 0, strpos($image64, ',') + 1);
        $image = str_replace($replace, '', $image64);
        $image = str_replace(' ', '+', $image);
        $destinationPath = 'images/';
        $name = md5($image64 . strtotime("now")) . '.' . $extension;

        Storage::disk('public')->put($destinationPath . $name, base64_decode($image));
        $imageUrl = 'images/' . $name;
        $data = $request->validated();
        $data['image'] = $imageUrl;

        Film::create($data);

        return ['status' => 'ok', 'messages' => 'Data created'];
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return Film::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FilmRequest $request, Film $film): bool
    {
        $film->fill($request->validated());
        return $film->save();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Film $film): Application|Response|\Illuminate\Contracts\Foundation\Application|ResponseFactory|null
    {
        $imgs = $film->only('image');

        if ($film->delete()) {
            foreach ($imgs as $img) {
                if (!str_contains($img, 'img')) {
                    Storage::disk('public')->delete($img);
                }
            }
            return response("film deleted", 200);
        }

        return null;
    }
}
