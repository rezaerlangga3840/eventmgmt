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

class ProdukController extends Controller
{
    public function daftar(){
        $produk = produk::join('kategori','kategori.id_kategori','produk.kategori_id')->join('status','status.id_status','produk.status_id')->select('produk.*','nama_kategori','nama_status')->orderBy('created_at','desc')->get();
        $kategori = kategori::orderBy('nama_kategori','asc')->get();
        $status = status::orderBy('nama_status','asc')->get();
        return view('admin.pages.produk.daftar',['produk' => $produk,'kategori' => $kategori,'status' => $status]);
    }
    public function save(Request $request){
        $validated=$request->validate([
            'nama_produk'=>'required',
            'harga'=>'required',
            'kategori_id'=>'required',
            'status_id'=>'required',
        ]);
        $nama_produk=$request->input('nama_produk');
        $harga=$request->input('harga');
        $kategori_id=$request->input('kategori_id');
        $status_id=$request->input('status_id');
        produk::create([
            'nama_produk'=>$nama_produk,
            'harga'=>$harga,
            'kategori_id'=>$kategori_id,
            'status_id'=>$status_id,
        ]);
        return redirect()->route('admin.produk.daftar')->with('added','Produk telah ditambahkan');
    }
    public function update($id_produk, Request $request){
        $produk = produk::findOrFail($id_produk);
        $produk->nama_produk = $request->input('nama_produk');
        $produk->harga = $request->input('harga');
        $produk->kategori_id = $request->input('kategori_id');
        $produk->status_id = $request->input('status_id');
        $produk->save();
        return redirect()->back()->with('updated','Produk telah diupdate');
    }
    public function delete($id_produk){
        $produk = produk::find($id_produk);
        $produk->delete();
        return redirect()->back()->with('deleted','Produk telah dihapus');
    }
}
