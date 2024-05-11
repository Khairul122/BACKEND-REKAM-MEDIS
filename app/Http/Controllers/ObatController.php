<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use Illuminate\Http\Request;

class ObatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $obat = Obat::all()->map(function ($item) {
            return [
                'id_obat' => $item->id_obat,
                'nama_obat' => $item->nama_obat,
                'ket_obat' => $item->ket_obat,
            ];
        });

        return response()->json([
            'data' => $obat
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $obat = Obat::create([
            'nama_obat' => $request->input('nama_obat'),
            'ket_obat' => $request->input('ket_obat')
        ]);
        return response()->json([
            'message' => 'Data obat berhasil ditambahkan',
            'data' => $obat
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Obat  $obat
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $obat = Obat::find($id);

        if (!$obat) {
            return response()->json(['message' => 'Data obat tidak ditemukan'], 404);
        }

        return response()->json([
            'data' => $obat
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Obat  $obat
     * @return \Illuminate\Http\Response
     */
    public function edit(Obat $obat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Obat  $obat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $obat = Obat::find($id);
        if (!$obat) {
            return response()->json(['message' => 'Obat tidak ditemukan'], 404);
        }

        $obat->nama_obat = $request->input('nama_obat');
        $obat->ket_obat = $request->input('ket_obat');
        $obat->save();

        return response()->json([
            'message' => 'Data obat berhasil diubah',
            'data' => $obat
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Obat  $obat
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $obat = Obat::find($id);
        if (!$obat) {
            return response()->json(['message' => 'Obat tidak ditemukan'], 404);
        }

        $obat->delete();
        return response()->json(['message' => 'Data obat berhasil dihapus'], 200);
    }
}
