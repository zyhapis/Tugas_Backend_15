<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //DIGUNAKAN UNTUK MENAMPILKAN DATA PRODUK
        $produk = Produk::all();
        if (isset($produk)) {
            $success = [
                'success' => true,
                'message' => 'Data Produk',
                'data' => $produk
            ];
            return response()->json($success, 200);
        } else {
            $fails = [
                'success' => false,
                'message' => 'Data Produk Tidak Ditemukan',
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
        //DIGUNAKAN UNTUK MENAMBAHKAN DATA PRODUK
        $data = [
            'nama' => 'required',
            'stok' => 'required|integer',
            'harga' => 'required|integer',
            'idjenis' => 'required|integer',
        ];


        $validator = Validator::make($request->all(), $data);

        if ($validator->fails()) {
            $fails = [
                'succes' => false,
                'message' => 'Data Produk Tidak Valid',
                'data' => $validator->errors()
            ];
            return response()->json($fails, 404);
        } else {
            $prdk = new Produk;
            $prdk->nama = $request->nama;
            $prdk->stok = $request->stok;
            $prdk->harga = $request->harga;
            $prdk->idjenis = $request->idjenis;
            $prdk->save();
            $success = [
                'success' => true,
                'message' => 'Data Produk Berhasil Ditambahkan',
                'data' => $prdk
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
        //DIGUNAKAN UNTUK MENGUBAH DATA PRODUK
        $data = [
            'nama' => 'required',
            'stok' => 'required|integer',
            'harga' => 'required|integer',
            'idjenis' => 'required|integer',
        ];

        $validator = Validator::make($request->all(), $data);

        if ($validator->fails()) {
            $fails = [
                'success' => false,
                'message' => 'Data Produk Tidak Valid',
                'data' => $validator->errors()
            ];
            return response()->json($fails, 404);
        } else {
            $prdk = Produk::find($id);
            $prdk->nama = $request->nama;
            $prdk->stok = $request->stok;
            $prdk->harga = $request->harga;
            $prdk->idjenis = $request->idjenis;
            $prdk->save();
            $success = [
                'success' => true,
                'message' => 'Data Produk Berhasil Diubah',
                'data' => $prdk
            ];
            return response()->json($success, 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //DIGUNAKAN UNTUK MENGHAPUS DATA PRODUK
        $prdk = Produk::where('id', $id)->first();
        if (isset($prdk)) {
            $prdk->delete();
            $success = [
                'succes' => true,
                'message' => 'Data Produk Berhasil Dihapus',
                'data' => $prdk
            ];
            return response()->json($success, 200);
        } else {
            $fails = [
                'succes' => false,
                'message' => 'Data Produk Tidak Ditemukan',
                'data' => []
            ];
            return response()->json($fails, 404);
        }
    }
}
