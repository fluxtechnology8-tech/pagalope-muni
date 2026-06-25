<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContribuyenteRequest;
use App\Http\Requests\UpdateContribuyenteRequest;
use App\Models\Contribuyente;
use Illuminate\Support\Facades\Auth;

class ContribuyenteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contribuyentes = Contribuyente::paginate(10);

        // Agregar la vista
        return view('', compact('contribuyentes'));
    }

    public function me()
    {
        $me = Auth::user()->contribuyente;

        if ($me == null) {
            return redirect()
                    ->route('contribuyentes.create');
        } 

        // Agregar la vista
        return view('contribuyentes.me', compact('me'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Agregar la vista
        return view('contribuyentes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreContribuyenteRequest $request)
    {
        $data = $request->validated();
        $contribuyenteInfo = [
            'user_id' => Auth::user()->id,
            'nombres_razon_social' => $data['nombres_razon_social'],
            'dni_ruc' => $data['dni_ruc'],
            'direccion_fiscal' => $data['direccion_fiscal']
        ];
    
        Contribuyente::create($contribuyenteInfo);

        return redirect()
                ->route('contribuyentes.me') // Agregar la vista
                ->with('success', 'Contribuyente creado exitosamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $contribuyente = Contribuyente::findOrFail($id);

        // Agregar la vista
        return view('', compact('contribuyente'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $contribuyente = Contribuyente::findOrFail($id);    

        // Agregar la vista
        return view('', compact('contribuyente'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateContribuyenteRequest $request, string $id)
    {
        $contribuyente = Contribuyente::findOrFail($id);

        $contribuyente->update($request->validated());

        return redirect()
                ->route('') // Agregar la vista
                ->with('success', 'Contribuyente actualizado exitosamente');
    }

    // NO HAY MÉTODO PARA ELIMINAR UN CONTRIBUYENTE, PUES TIENE UNA FK DE USUARIO
    // ENTONCES SE BORRARÁ EL CONTRIBUYENTE CUANDO SE ELIMINE EL USUARIO
}
