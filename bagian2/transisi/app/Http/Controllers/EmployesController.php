<?php

namespace App\Http\Controllers;

use App\Models\Employes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EmployesController extends Controller
{
    public function index()
    {
        $employes = Employes::latest()->paginate(5);
        return view('employe.index', compact('employes'));
    }

    public function create()
    {
        return view('employes.create');
    }

    public function store(Request $request)
{
    $this->validate($request, [
        'nama'     => 'required',
        'company'     => 'required'
        'email'   => 'required'
    ]);

    $employes = Employes::create([
        'nama'      => $request->nama,
        'company'     => $request->company,
        'email'   => $request->email
    ]);

    if($employes){
        //redirect dengan pesan sukses
        return redirect()->route('employes.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }else{
        //redirect dengan pesan error
        return redirect()->route('employes.index')->with(['error' => 'Data Gagal Disimpan!']);
    }
}

public function edit(Employes $employes)
{
    return view('employes.edit', compact('employes'));
}

public function update(Request $request, Employes $employes)
{
    $this->validate($request, [
        'nama'     => 'required',
        'company'     => 'required',
        'email'   => 'required'
    ]);


    $employes = Employes::findOrFail($employes->id);

    if($request->file('logo') == "") {

        $employes->update([
            'nama'     => $request->nama,
            'company'     => $request->company,
            'email'   => $request->email
        ]);

    } else {

        //hapus old image
        Storage::disk('local')->delete('public/companys/'.$employes->logo);

        //upload new image
        $logo = $request->file('logo');
        $logo->storeAs('public/companys', $logo->hashName());

        $employes->update([
            'nama'     => $request->nama,
            'company'     => $request->company,
            'email'   => $request->email
        ]);

    }

    if($employes){
        //redirect dengan pesan sukses
        return redirect()->route('employes.index')->with(['success' => 'Data Berhasil Diupdate!']);
    }else{
        //redirect dengan pesan error
        return redirect()->route('employes.index')->with(['error' => 'Data Gagal Diupdate!']);
    }
}

public function destroy($id)
{
  $employes = Employes::findOrFail($id);
  Storage::disk('local')->delete('public/companys/'.$employes->logo);
  $employes->delete();

  if($employes){
     //redirect dengan pesan sukses
     return redirect()->route('employes.index')->with(['success' => 'Data Berhasil Dihapus!']);
  }else{
    //redirect dengan pesan error
    return redirect()->route('employes.index')->with(['error' => 'Data Gagal Dihapus!']);
  }
}
}
