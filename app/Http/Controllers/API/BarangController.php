<?php

namespace App\Http\Controllers\API;

use Carbon\Carbon;
use App\Models\Barang;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $barang = Barang::all();
        return response()->json([
            'status' => 'success',
            'barang' => $barang,
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
        $request->validate([
            'kode_barang' => 'required|string|max:255|unique:tbl_barang,kode_barang',
            'nama_barang' => 'required|string|max:255',
            'harga' => 'required|integer',
        ]);
        $barang = Barang::create([
            'nama_barang'      => $request->nama_barang,
            'kode_barang'     => $request->kode_barang,
            'harga'  => $request->harga,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        return response()->json([
            'status' => true,
            'message' => "Barang Created!!",
            'barang' => $barang
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $barang = Barang::find($id);
        return response()->json([
            'status' => 'success',
            'barang' => $barang,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $barang = Barang::find($id);
        $barang->update($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Barang updated!',
            'barang' => $barang,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $barang = Barang::find($id);
        $barang->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Barang deleted',
            'barang' => $barang,
        ]);
    }
}
