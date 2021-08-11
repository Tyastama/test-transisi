<?php

namespace App\Http\Controllers;
use App\Models\Companies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CompaniesController extends Controller
{
    public function index()
    {
        $companies = Companies::latest()->paginate(5);
        return view('companies.index', compact('companies'));
    }

    public function create()
    {
        return view('companies.create');
    }


/**
* store
*
* @param  mixed $request
* @return void
*/
public function store(Request $request)
{
    $this->validate($request, [
        'nama'     => 'required',
        'email'     => 'required',
        'logo'     => 'required|image|mimes:png,jpg,jpeg',
        'website'   => 'required'
    ]);

    //upload logo
    $logo = $request->file('logo');
    $logo->storeAs('public/companys', $logo->hashName());

    $companies = Companies::create([
        'nama'      => $request->nama,
        'email'     => $request->email,
        'logo'      => $logo->hashName(),
        'website'   => $request->website
    ]);

    if($companies){
        //redirect dengan pesan sukses
        return redirect()->route('companies.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }else{
        //redirect dengan pesan error
        return redirect()->route('companies.index')->with(['error' => 'Data Gagal Disimpan!']);
    }
}

public function edit(Companies $companies)
{
    return view('companies.edit', compact('companies'));
}


/**
* update
*

*/
public function update(Request $request, Companies $companies)
{
    $this->validate($request, [
        'nama'     => 'required',
        'email'     => 'required',
        'website'   => 'required'
    ]);

   
    $comapnies = Companies::findOrFail($companies->id);

    if($request->file('logo') == "") {

        $comapnies->update([
            'nama'     => $request->nama,
            'email'     => $request->email,
            'website'   => $request->website
        ]);

    } else {

        //hapus old image
        Storage::disk('local')->delete('public/companys/'.$companies->logo);

        //upload new image
        $logo = $request->file('logo');
        $logo->storeAs('public/companys', $logo->hashName());

        $companies->update([
            'nama'     => $request->nama,
            'email'     => $request->email,
            'logo'     => $logo->hashName(),
            'website'   => $request->website
        ]);

    }

    if($companies){
        //redirect dengan pesan sukses
        return redirect()->route('companies.index')->with(['success' => 'Data Berhasil Diupdate!']);
    }else{
        //redirect dengan pesan error
        return redirect()->route('companies.index')->with(['error' => 'Data Gagal Diupdate!']);
    }
}

public function destroy($id)
{
  $companies = Companies::findOrFail($id);
  Storage::disk('local')->delete('public/companys/'.$companies->logo);
  $companies->delete();

  if($companies){
     //redirect dengan pesan sukses
     return redirect()->route('companies.index')->with(['success' => 'Data Berhasil Dihapus!']);
  }else{
    //redirect dengan pesan error
    return redirect()->route('companies.index')->with(['error' => 'Data Gagal Dihapus!']);
  }
}
}
