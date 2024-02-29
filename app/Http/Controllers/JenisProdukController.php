<?php

namespace App\Http\Controllers;

use App\Models\JenisProduk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JenisProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //DIGUNAKAN UNTUK MENAMPILKAN DATA JENIS PRODUK
        $jns = JenisProduk::all();
        if (isset($jns)) {
            $success = [
                'success' => true,
                'message' => 'Data Jenis Produk',
                'data' => $jns
            ];
            return response()->json($success, 200);
        } else {
            $fails = [
                'success' => false,
                'message' => 'Data Jenis Produk Tidak Ditemukan',
                'data' => []
            ];
            return response()->json($fails, 404);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //DIGUNAKAN UNTUK MENAMBAHKAN DATA JENIS PRODUK
        $data = [
            'nama' => 'required',
        ];

        $validator = Validator::make($request->all(), $data);

        if ($validator->fails()) {
            $fails = [
                'succes' => false,
                'message' => 'Data Jenis Produk Tidak Valid',
                'data' => $validator->errors()
            ];
            return response()->json($fails, 404);
        } else {
            $jns = new JenisProduk;
            $jns->nama = $request->nama;
            $jns->save();
            $success = [
                'success' => true,
                'message' => 'Data Jenis Produk Berhasil Ditambahkan',
                'data' => $jns
            ];
            return response()->json($success, 200);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //DIGUNAKAN UNTUK MENGUBAH DATA JENIS PRODUK
        $data = [
            'nama' => 'required',
        ];

        $validator = Validator::make($request->all(), $data);

        if ($validator->fails()) {
            $fails = [
                'success' => false,
                'message' => 'Data Jenis Produk Tidak Valid',
                'data' => $validator->errors()
            ];
            return response()->json($fails, 404);
        } else {
            $jns = JenisProduk::find($id);
            $jns->nama = $request->nama;
            $jns->save();
            $success = [
                'success' => true,
                'message' => 'Data Jenis Produk Berhasil Diubah',
                'data' => $jns
            ];
            return response()->json($success, 200);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //DIGUNAKAN UNTUK MENGHAPUS DATA JENIS PRODUK
        $jns = JenisProduk::where('id', $id)->first();
        if (isset($prdk)) {
            $jns->delete();
            $success = [
                'succes' => true,
                'message' => 'Data Jenis Produk Berhasil Dihapus',
                'data' => $jns
            ];
            return response()->json($success, 200);
        } else {
            $fails = [
                'succes' => false,
                'message' => 'Data Jenis Produk Tidak Ditemukan',
                'data' => []
            ];
            return response()->json($fails, 404);
        }
    }
}
