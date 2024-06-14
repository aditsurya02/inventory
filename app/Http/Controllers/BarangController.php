<?php

namespace App\Http\Controllers;
use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use DB;

class BarangController extends Controller
{
    
	public function index(Request $request)
    {
        $search = $request->input('search');
    
        $rsetBarang = Barang::with('kategori')
            ->when($search, function ($query, $search) {
                return $query->where('merk', 'like', '%' . $search . '%')
                    ->orWhere('seri', 'like', '%' . $search . '%')
                    ->orWhereHas('kategori', function ($query) use ($search) {
                        $query->where('deskripsi', 'like', '%' . $search . '%');
                    });
            })
            ->latest()
            ->paginate(10);
    
        $rsetBarang->appends(['search' => $search]);
    
        return view('v_barang.index', compact('rsetBarang'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategori = Kategori::all();
        return view('v_barang.create', compact('kategori'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'merk' => 'required',
            'seri' => 'required',
            'spesifikasi' => 'required',
            // 'stok' => 'required',
            'kategori_id' => 'required|exists:kategori,id',
            'foto'        => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $foto = $request->file('foto');
        $foto->storeAs('public/foto', $foto->hashName());

        //create post
        Barang::create([
            'merk'             => $request->merk,
            'seri'             => $request->seri,
            'spesifikasi'      => $request->spesifikasi,
            'kategori_id'      => $request->kategori_id,
            'foto'             => $foto->hashName()
        ]);

        //redirect to index
        return redirect()->route('barang.index')->with('success', 'Barang berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $rsetBarang = Barang::find($id);

        //return $rsetBarang;

        //return view
        return view('v_barang.show', compact('rsetBarang'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
    $akategori = Kategori::all();
    $rsetBarang = Barang::find($id);
    $selectedKategori = Kategori::find($rsetBarang->kategori_id);

    return view('v_barang.edit', compact('rsetBarang', 'akategori', 'selectedKategori'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Barang $barang)
    {
        $request->validate([
            'merk' => 'required',
            'seri' => 'required',
            'spesifikasi' => 'required',
            'kategori_id' => 'required|exists:kategori,id',
            'foto'        => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        // Set stok ke 0 jika tidak diisi
        $stok = $request->has('stok') ? $request->stok : 0;

        // Check if image is uploaded
        if ($request->hasFile('foto')) {

            // Upload new image
            $foto = $request->file('foto');
            $foto->storeAs('storage/app/public/foto', $foto->hashName());

            // Delete old image
            Storage::delete('storage/app/public/foto/'.$barang->foto);

            // Update post with new image
            $barang->update([
                'merk'          => $request->merk,
                'seri'          => $request->seri,
                'spesifikasi'   => $request->spesifikasi,
                'stok'          => $stok,
                'kategori_id'   => $request->kategori_id,
                'foto'          => $foto->hashName()
            ]);

        } else {

            // Update post without image
            $barang->update([
                'merk'          => $request->merk,
                'seri'          => $request->seri,
                'spesifikasi'   => $request->spesifikasi,
                'stok'          => $stok,
                'kategori_id'   => $request->kategori_id,
            ]);
        }
        return redirect()->route('barang.index')->with(['success' => 'Data Berhasil Diubah!']);
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    { {
            if (DB::table('barangmasuk')->where('barang_id', $id)->exists()) {
                return redirect()->route('barang.index')->with('error', 'Data gagal dihapus!');
            }

            if (DB::table('barangkeluar')->where('barang_id', $id)->exists()) {
                return redirect()->route('barang.index')->with('error', 'Data gagal dihapus!');
            }

            $rsetBarang = Barang::find($id);
            $rsetBarang->delete();

            return redirect()->route('barang.index')->with('success', 'Data berhasil dihapus!');
        }

    }



}
