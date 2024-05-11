<?php

namespace App\Http\Controllers;

use App\Models\RekamMedis;
use Illuminate\Http\Request;

class RekamMedisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rekamMedis = RekamMedis::all()->map(function ($item) {
            return [
                'id_rm' => $item->id_rm,
                'id_pasien' => $item->id_pasien,
                'keluhan' => $item->keluhan,
                'nama_dokter' => $item->nama_dokter,
                'diagnosa' => $item->diagnosa,
                'tgl_periksa' => $item->tgl_periksa
            ];
        });

        return response()->json(['message' => 'Semua data rekam medis berhasil diambil.', 'data' => $rekamMedis]);
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
        $validatedData = $request->validate([
            'id_pasien' => 'required|exists:pasien,id_pasien',
            'keluhan' => 'required',
            'nama_dokter' => 'required',
            'diagnosa' => 'required',
            'tgl_periksa' => 'required|date'
        ]);

        $rekamMedis = RekamMedis::create($validatedData);
        $data = [
            'id_rm' => $rekamMedis->id_rm,
            'id_pasien' => $rekamMedis->id_pasien,
            'keluhan' => $rekamMedis->keluhan,
            'nama_dokter' => $rekamMedis->nama_dokter,
            'diagnosa' => $rekamMedis->diagnosa,
            'tgl_periksa' => $rekamMedis->tgl_periksa
        ];

        return response()->json(['message' => 'Data rekam medis berhasil ditambahkan.', 'data' => [$data]], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RekamMedis  $rekamMedis
     * @return \Illuminate\Http\Response
     */
    public function show(RekamMedis $rekamMedis)
    {
        $data = [
            'id_rm' => $rekamMedis->id_rm,
            'id_pasien' => $rekamMedis->id_pasien,
            'keluhan' => $rekamMedis->keluhan,
            'nama_dokter' => $rekamMedis->nama_dokter,
            'diagnosa' => $rekamMedis->diagnosa,
            'tgl_periksa' => $rekamMedis->tgl_periksa
        ];

        return response()->json(['message' => 'Data rekam medis berhasil ditemukan.', 'data' => [$data]]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RekamMedis  $rekamMedis
     * @return \Illuminate\Http\Response
     */
    public function edit(RekamMedis $rekamMedis)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RekamMedis  $rekamMedis
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rekamMedis = RekamMedis::findOrFail($id);
        $rekamMedis->update($request->all());

        $data = [
            'id_rm' => $rekamMedis->id_rm,
            'id_pasien' => $rekamMedis->id_pasien,
            'keluhan' => $rekamMedis->keluhan,
            'nama_dokter' => $rekamMedis->nama_dokter,
            'diagnosa' => $rekamMedis->diagnosa,
            'tgl_periksa' => $rekamMedis->tgl_periksa
        ];

        return response()->json(['message' => 'Data rekam medis berhasil diperbarui.', 'data' => [$data]]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RekamMedis  $rekamMedis
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $rekamMedis = RekamMedis::find($id);
        if (!$rekamMedis) {
            return response()->json(['message' => 'Rekam Medis tidak ditemukan'], 404);
        }

        $rekamMedis->delete();
        return response()->json(['message' => 'Data rekam medis berhasil dihapus'], 200);
    }
}
