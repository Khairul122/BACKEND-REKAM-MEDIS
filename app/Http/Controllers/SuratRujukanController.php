<?php

namespace App\Http\Controllers;

use App\Models\SuratRujukan;
use Illuminate\Http\Request;

class SuratRujukanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suratRujukan = SuratRujukan::all()->map(function ($item) {
            return [
                'id_surat_rujukan' => $item->id_surat_rujukan,
                'nomor_surat' => $item->nomor_surat,
                'tgl_surat' => $item->tgl_surat,
                'id_pasien' => $item->id_pasien,
                'nama_pasien' => $item->nama_pasien,
                'usia_pasien' => $item->usia_pasien,
                'jenis_kelamin' => $item->jenis_kelamin,
                'alamat' => $item->alamat,
                'diagnosis' => $item->diagnosis,
                'dokter_pengirim' => $item->dokter_pengirim,
                'catatan' => $item->catatan
            ];
        });

        return response()->json(['message' => 'Semua data surat rujukan berhasil diambil.', 'data' => $suratRujukan]);
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
            'nomor_surat' => 'required|string|max:20',
            'tgl_surat' => 'required|date',
            'id_pasien' => 'required|exists:pasien,id_pasien',
            'nama_pasien' => 'required|string|max:100',
            'usia_pasien' => 'required|integer',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat' => 'required|string',
            'diagnosis' => 'required|string',
            'dokter_pengirim' => 'required|string|max:100',
            'catatan' => 'required|string'
        ]);

        $suratRujukan = SuratRujukan::create($validatedData);

        return response()->json(['message' => 'Surat rujukan berhasil ditambahkan.', 'data' => $suratRujukan], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SuratRujukan  $suratRujukan
     * @return \Illuminate\Http\Response
     */
    public function show(SuratRujukan $suratRujukan)
    {
        return response()->json(['message' => 'Data surat rujukan berhasil ditemukan.', 'data' => $suratRujukan]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SuratRujukan  $suratRujukan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $suratRujukan = SuratRujukan::findOrFail($id);

        $validatedData = $request->validate([
            'nomor_surat' => 'string|max:20',
            'tgl_surat' => 'date',
            'nama_pasien' => 'string|max:100',
            'usia_pasien' => 'integer',
            'jenis_kelamin' => 'in:L,P',
            'alamat' => 'string',
            'diagnosis' => 'string',
            'dokter_pengirim' => 'string|max:100',
            'catatan' => 'string'
        ]);

        $suratRujukan->update($validatedData);
        $suratRujukan = $suratRujukan->fresh(); // Memuat ulang data dari database

        return response()->json([
            'message' => 'Data surat rujukan berhasil diperbarui.',
            'data' => $suratRujukan
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SuratRujukan  $suratRujukan
     * @return \Illuminate\Http\Response
     */
    public function destroy(SuratRujukan $suratRujukan)
    {
        $suratRujukan->delete();
        return response()->json(['message' => 'Data surat rujukan berhasil dihapus']);
    }
}
