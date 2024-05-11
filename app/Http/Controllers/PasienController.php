<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use Illuminate\Http\Request;

class PasienController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pasien = Pasien::all();
        return response()->json([
            'data' => $pasien
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nomor_identitas' => 'required|string|max:30',
            'nama_pasien' => 'required|string|max:80',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat' => 'required',
            'no_telp' => 'required|string|max:12',
            'nik' => 'required|integer'
        ]);

        $pasien = Pasien::create($validatedData);
        $responseData = [
            'id_pasien' => $pasien->id_pasien,
            'nomor_identitas' => $pasien->nomor_identitas,
            'nama_pasien' => $pasien->nama_pasien,
            'jenis_kelamin' => $pasien->jenis_kelamin,
            'alamat' => $pasien->alamat,
            'no_telp' => $pasien->no_telp,
            'nik' => $pasien->nik
        ];

        return response()->json([
            'message' => 'Data pasien berhasil ditambahkan',
            'data' => $responseData
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pasien = Pasien::find($id);
        if (!$pasien) {
            return response()->json(['message' => 'Pasien tidak ditemukan'], 404);
        }

        return response()->json([
            'data' => $pasien
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $pasien = Pasien::find($id);
        if (!$pasien) {
            return response()->json(['message' => 'Pasien tidak ditemukan'], 404);
        }

        $pasien->update($request->all());
        return response()->json([
            'message' => 'Data pasien berhasil diubah',
            'data' => $pasien
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pasien = Pasien::find($id);
        if (!$pasien) {
            return response()->json(['message' => 'Pasien tidak ditemukan'], 404);
        }

        $pasien->delete();
        return response()->json(['message' => 'Data pasien berhasil dihapus'], 200);
    }
}
