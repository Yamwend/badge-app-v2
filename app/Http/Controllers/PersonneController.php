<?php

namespace App\Http\Controllers;

use App\Models\Personne;
use Illuminate\Http\Request;
use Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Str;

class PersonneController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:personne-list|personne-create|personne-edit|personne-delete', ['only' => ['index','show']]);
         $this->middleware('permission:personne-create', ['only' => ['create','store']]);
         $this->middleware('permission:personne-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:personne-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $personnes = Personne::latest()->paginate(5);
        return view('personnes.index',compact('personnes'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('personnes.create');
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'matricule' => 'required',
            'categorie' => 'required',
        ]);
       
        $img = $request->image;
        $folderPath = "public/";

        $image_parts = explode(";base64,", $img);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        
        $image_base64 = base64_decode($image_parts[1]);
        $fileName = $request->matricule . '.png';
        
        $file = $folderPath . $fileName;
        Storage::put($file, $image_base64);

        QrCode::size(250)->generate('Matricule :'.$request->matricule,public_path($request->matricule . '.svg'));

        $input = $request->all();
        $input['photo'] = $request->matricule . '.png';
        $input['qrcode'] = $request->matricule . '.svg';

        Personne::create($input);
    
        return redirect()->route('personnes.index')
                        ->with('success','Personne ajoutée avec succès.');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Personne  $personne
     * @return \Illuminate\Http\Response
     */
    public function show(Personne $personne)
    {
        return view('personnes.show',compact('personne'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Personne  $personne
     * @return \Illuminate\Http\Response
     */
    public function edit(Personne $personne)
    {
        return view('personnes.edit',compact('personne'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Personne  $personne
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Personne $personne)
    {
         request()->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'matricule' => 'required',
            'categorie' => 'required',
        ]);

       /* $img = $request->image;
        $folderPath = "public/";

        $image_parts = explode(";base64,", $img);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        
        $image_base64 = base64_decode($image_parts[1]);
        $fileName = $request->matricule . '.png';
        
        $file = $folderPath . $fileName;
        Storage::put($file, $image_base64);*/

        QrCode::size(250)->generate('Email : $request->nom',public_path($request->matricule . '.svg'));

        $input = $request->all();
        $input['photo'] = $request->matricule . '.png';
        $input['qrcode'] = $request->matricule . '.svg';

    
        $personne->update($input);
    
        return redirect()->route('personnes.index')
                        ->with('success','Personne modifiée avec succès.');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Personne  $personne
     * @return \Illuminate\Http\Response
     */
    public function destroy(Personne $personne)
    {
        $personne->delete();
    
        return redirect()->route('personnes.index')
                        ->with('success','Personne supprimer avec succès.');
    }
}
