<?php

namespace App\Http\Controllers;

use App\Models\murid;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class MuridController extends Controller
{

    //Buat ngambil data semua murid
   
    public function semua()
    {
        $murid = murid::all();
     
        return response()->json([
            "success" => true,
            "message" => "List Murid",
            "data" => $murid
        ]);
    }

   //Buat nambah data murid
    public function store(Request $request)
    {
        $input = $request->all();
    
        $validator = Validator::make($input, [
            'name' => 'required',
            'email' => 'required',
            'usia' => 'required',
            'jurusan' => 'required',
        ]);
    
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
    
        $murid = murid::create($input);
 
        return response()->json([
            "success" => true,
            "message" => "Berhasil Menambah Data.",
            "data" => $murid
        ]);
    }

    //Buat ngambil data salah 1 murid berdasarkan id murid
    public function show($id)
    {
        $murid = murid::find($id);
   
        if (is_null($murid)) {
            return $this->sendError('Data tidak ditemukan.');
        }
         
        return response()->json([
            "success" => true,
            "message" => "Berhasil Mengambil Data.",
            "data" => $murid
        ]);
    }



    public function update(Request $request, $id)
{
    $input = $request->all();

    $validator = Validator::make($input, [
        'name' => 'required',
        'email' => 'required',
        'usia' => 'required',
        'jurusan' => 'required',
    ]);

    if ($validator->fails()) {
        return $this->sendError('Validation Error.', $validator->errors());
    }

    // Menggunakan metode findOrFail untuk menemukan data berdasarkan ID
    $murid = murid::findOrFail($id);

    // Mengubah nilai kolom sesuai dengan data yang diberikan
    $murid->name = $input['name'];
    $murid->email = $input['email'];
    $murid->usia = $input['usia'];
    $murid->jurusan = $input['jurusan'];

    $murid->save();

    return response()->json([
        "success" => true,
        "message" => "Data Berhasil Diupdate.",
        "data" => $murid
    ]);
}


    //Buat hapus murid
    public function hapus($id)
    {
        $data = murid::find($id);
        if($data){
            $data = murid::where('id', $id)->delete();
        if ($data) {
            return response()->json(['status' => 'success', 'message' => 'Berhasil Hapus Data']);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Gagal Hapus Data']);
        }
        }
    }
}
