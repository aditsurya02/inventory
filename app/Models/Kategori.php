<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


// Barang model
// Author : mrantazy68
// Written: 2023 - PKK
// URL    : experimen.test
// ---------------------------------------------------------------------------

class Kategori extends Model
{
    use HasFactory;

    protected $table = 'kategori';

    protected $fillable = ['deskripsi','kategori'];

    public function barang()
    {
        return $this->hasMany(Barang::class);
    }

    public static function getKategoriAll(){
        return DB::table('kategori')
                    ->select('kategori.id','deskripsi',DB::raw('ketKategori(kategori) as ketkategori'));
    }

    public static function katShowAll(){
        return DB::table('kategori')
                ->join('barang','kategori.id','=','barang.kategori_id')
                ->select('kategori.id','deskripsi',DB::raw('ketKategori(kategori) as ketkategori'),
                         'barang.merk');
                // ->pagination(1);
                // ->get();

    }

    public static function showKategoriById($id){
        return DB::table('kategori')
                ->join('barang','kategori.id','=','barang.kategori_id')
                ->select('barang.id','kategori.deskripsi',DB::raw('ketKategori(kategori.kategori) as ketkategori'),
                         'barang.merk','barang.seri','barang.spesifikasi','barang.stok')
                ->get();

    }

    

}
