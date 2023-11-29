<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\kategori;
use App\Models\status;
use App\Models\produk;
use Carbon\carbon;

use Hash;
use Auth;
use File;

class KategoriController extends Controller
{
    public function daftar(){
        $kategori = kategori::orderBy('created_at','desc')->get();
        return view('admin.pages.kategori.daftar',['kategori' => $kategori]);
    }
    public function save(Request $request){
        $validated=$request->validate([
            'nama_kategori'=>'required',
        ]);
        $nama_kategori=$request->input('nama_kategori');
        kategori::create([
            'nama_kategori'=>$nama_kategori,
        ]);
        return redirect()->route('admin.kategori.daftar')->with('added','Kategori telah ditambahkan');
    }
    public function update($id_kategori, Request $request){
        $kategori = kategori::findOrFail($id_kategori);
        $kategori->nama_kategori = $request->input('nama_kategori');
        $kategori->save();
        return redirect()->back()->with('updated','Kategori telah diupdate');
    }
    public function delete($id_kategori){
        $kategori = kategori::find($id_kategori);
        $kategori->delete();
        return redirect()->back()->with('deleted','Kategori telah dihapus');
    }
    public function lihatproduk($id_kategori){
        $kategori = kategori::findOrFail($id_kategori);
        $produk = produk::join('kategori','kategori.id_kategori','produk.kategori_id')->join('status','status.id_status','produk.status_id')->select('produk.*','nama_kategori','nama_status')->where('kategori_id',$id_kategori)->orderBy('created_at','asc')->get();
        return view('admin.pages.kategori.daftarproduk',['kategori'=>$kategori,'produk'=>$produk]);
    }
}
