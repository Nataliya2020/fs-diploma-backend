<?php

namespace App\Http\Controllers;

use App\Http\Requests\SessionRequest;
use App\Models\Session;

class SessionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->filled('date')) {
            $param = request('date');

            return Session::where('session_date', $param)->get();
        }

        return Session::all();
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(SessionRequest $request)
    {
        $data = $request->validated();
        Session::create($data);

        return ['status' => 'ok', 'messages' => 'Data created'];
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return Session::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SessionRequest $request, $session_id): bool
    {
        $session = Session::findOrFail($session_id);
        $session->fill($request->validated());
        return $session->save();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): ?array
    {
        $session = Session::findOrFail($id);

        if ($session->delete()) {
            return ['status' => 'ok', 'messages' => 'Data deleted'];
        }

        return null;
    }
}
