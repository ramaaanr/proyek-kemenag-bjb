<?php

namespace App\Http\Controllers;

use App\Models\Kelurahan;
use Illuminate\Http\Request;

class KelurahanController extends Controller
{
    public function index()
    {
        $kelurahans = Kelurahan::all();
        return response()->json($kelurahans);
    }

    public function store(Request $request)
    {
        $kelurahan = Kelurahan::create($request->all());
        return response()->json($kelurahan, 201);
    }

    public function show($id)
    {
        $kelurahan = Kelurahan::findOrFail($id);
        return response()->json($kelurahan);
    }

    public function update(Request $request, $id)
    {
        $kelurahan = Kelurahan::findOrFail($id);
        $kelurahan->update($request->all());
        return response()->json($kelurahan);
    }

    public function destroy($id)
    {
        $kelurahan = Kelurahan::findOrFail($id);
        $kelurahan->delete();
        return response()->json(null, 204);
    }
}