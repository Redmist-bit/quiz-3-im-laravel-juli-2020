<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class ProyekController extends Controller
{
    public function create() {
        return view('proyek.create');
    }

    public function store(Request $request) {
        // dd($request->all());
        
        $query = DB::table('proyek')->insert([
            "nama_proyek" => $request["nama_proyek"],
            "tanggal_mulai" => $request["tanggal_mulai"],
            "tanggal_deadline" => $request["tanggal_deadline"],
            "status" => $request["status"],
            "karyawan_id" => $request["karyawan_id"]
        ]);
         
        return redirect('/proyek')->with('success','data anda telah tersimpan');
    }

    public function index(){
        $proyek = DB::table('proyek')->get();
        
        return view('proyek.index', compact('proyek'));
    }

    public function show($id){
        $proyek = DB::table('proyek')->where('id', $id)->first();
        // dd($ask);
        return view('proyek.show', compact('proyek'));
    }
    public function edit($id){
        $proyek = DB::table('proyek')->where('id', $id)->first();
        return view('proyek.edit', compact('proyek'));
    }
    public function update($id, Request $request){

        $query = DB::table('proyek')
                    ->where('id',$id)
                    ->update([
                        "nama_proyek" => $request["nama_proyek"],
                        "tanggal_mulai" => $request["tanggal_mulai"],
                        "tanggal_deadline" => $request["tanggal_deadline"],
                        "status" => $request["status"],
                        "karyawan_id" => $request["karyawan_id"]
                    ]);

        return redirect('/proyek')->with('success','Berhasil update data');
    }

    public function destroy($id){
        $query = DB::table('proyek')->where('id',$id)->delete();
        
        return redirect('/proyek')->with('success','Berhasil hapus data');
    }
}
