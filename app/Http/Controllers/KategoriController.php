<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Models\Barang;

class KategoriController extends Controller
{
    public function index(Request $request)
    {
        $query = Kategori::select('id', 'deskripsi', 'kategori',
            \DB::raw('(CASE
                WHEN kategori = "M" THEN "Modal"
                WHEN kategori = "A" THEN "Alat"
                WHEN kategori = "BHP" THEN "Bahan Habis Pakai"
                ELSE "Bahan Tidak Habis Pakai"
                END) AS ketKategori'));

        // Jika ada parameter pencarian
        if ($request->has('search') && !empty($request->input('search'))) {
            $query->where('deskripsi', 'like', '%' . $request->input('search') . '%');
        }

        $rsetKategori = $query->paginate(10);

        return view('v_kategori.index', compact('rsetKategori'));
    }


    public function create()
    {
        $aKategori = array('blank'=>'Pilih Kategori',
                            'M'=>'Barang Modal',
                            'A'=>'Alat',
                            'BHP'=>'Bahan Habis Pakai',
                            'BTHP'=>'Bahan Tidak Habis Pakai'
                            );
        return view('v_kategori.create',compact('aKategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'deskripsi' => 'required|string|unique:kategori',
            'kategori' => 'required|in:M,A,BTP,BTHP',
        ], [
            'deskripsi.unique' => 'Deskripsi sudah ada dalam database.', // Pesan kesalahan kustom untuk deskripsi duplikat
        ]);
        Kategori::create([
            'deskripsi' => $request->deskripsi,
            'kategori' => $request->kategori,
        ]);
        
        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function show(string $id)
    {
        $rsetKategori = Kategori::find($id);

        return view('v_kategori.show', compact('rsetKategori'));
    }

    public function edit(string $id)
    {
        $rsetKategori = Kategori::find($id);
        return view('v_kategori.edit', compact('rsetKategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'deskripsi' => 'required|string',
            'kategori' => 'required|in:M,A,BTP,BTHP',
        ]);

        $rsetKategori = Kategori::findOrFail($id);
        $rsetKategori->deskripsi = $request->deskripsi;
        $rsetKategori->kategori = $request->kategori;
        $rsetKategori->save();

        return redirect()->route('kategori.index')->with(['success' => 'Data Berhasil Diupdate!']);
    }

    public function destroy(string $id)

    {
        if (DB::table('barang')->where('kategori_id', $id)->exists()){
            return redirect()->route('kategori.index')->with(['Gagal' => 'Data Gagal Dihapus!']);

        } else {

            $rsetKategori = Kategori::find($id);
            $rsetKategori->delete();

            return redirect()->route('kategori.index')->with(['success' => 'Data Berhasil Dihapus!']);

        }

    }

    function updateAPIKategori(Request $request, $kategori_id){
        $kategori = Kategori::find($kategori_id);

        if (null == $kategori){
            return response()->json(['status'=>"kategori tidak ditemukan"]);
        }

         $kategori->deskripsi= $request->deskripsi;
         $kategori->kategori = $request->kategori;
         $kategori->save();

        return response()->json(["status"=>"kategori berhasil diubah"]);
    }

    // function untuk membuat index api
    function showAPIKategori(Request $request){
        $kategori = Kategori::all();
        return response()->json($kategori);
    }

    // function untuk create api
    function buatAPIKategori(Request $request){
        $request->validate([
            'deskripsi' => 'required|string|max:100',
            'kategori' => 'required|in:M,A,BHP,BTHP',
        ]);

        // Simpan data kategori
        $kat = Kategori::create([
            'deskripsi' => $request->deskripsi,
            'kategori' => $request->kategori,
        ]);

        return response()->json(["status"=>"data berhasil dibuat"]);
    }

    // function untuk delete api
    function hapusAPIKategori($kategori_id){

        $del_kategori = Kategori::findOrFail($kategori_id);
        $del_kategori -> delete();

        return response()->json(["status"=>"data berhasil dihapus"]);
    }


}
