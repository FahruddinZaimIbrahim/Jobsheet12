<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileUploadController extends Controller
{
    public function fileUpload(){
        return view ('file-upload');
    }

    public function prosesFileUpload(Request $request){
        //dump($request->berkas);
        //dump($request->file('file'));
        //return "Pemrosesan file upload di sini";
        /*if($request->hasFile('berkas'))
        {
            echo "path(): ".$request->berkas->path();
            echo "<br>";
            echo "extension(): ".$request->berkas->extension();
            echo "<br>";
            echo "getClientOriginalExtension(): ".$request->berkas->getClientOriginalExtension();
            echo "<br>";
            echo "getMimeType(): ".$request->berkas->getMimeType();
            echo "<br>";
            echo "getClientOriginalName(): ".$request->berkas->getClientOriginalName();
            echo "<br>";
            echo "getSize(): ".$request->berkas->getSize();
        }
        else
        {
            echo "Tidak ada berkas yang diupload";
        }*/
        $request->validate(['filename' => 'required|string|max:255','berkas'=>'required|file|image|max:500']);
        $extfile = $request->berkas->getClientOriginalName();
        $filename = $request->filename.'.jpg';
        //$namaFile = $request->berkas->getClientOriginalName();
        //$namaFile = 'web-'.time().".".$extfile;
        $path = $request->berkas->move('gambar',$filename);
        $path = str_replace("\\","//", $path);
//        echo "Variabel path berisi:$path <br>";

        $pathBaru = asset('gambar/'.$filename);
        echo "Gambar berhasil di upload ke <a href='$pathBaru'>$filename</a>";
        echo "<br>";
//       echo "Tampilkan link:<a href='$pathBaru'>$pathBaru</a>";
        echo "<img src='$pathBaru' alt='uploaded image' />";
        //echo $request->berkas->getClientOriginalName()." lolos validasi";
    }
}
