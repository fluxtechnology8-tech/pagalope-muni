<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContribuyenteRequest;
use App\Http\Requests\UpdateContribuyenteRequest;
use App\Models\Contribuyente;
use Illuminate\Http\Request;

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

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Agregar la vista
        return view('');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreContribuyenteRequest $request)
    {
        Contribuyente::create($request->validated());

        return redirect()
                ->route('') // Agregar la vista
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // VERIFICAR SI SE DEBE DE PODER ELIMINAR UN CONTRIBUYENTE A NIVEL DE BD
        // CONTRIBUYENTE TIENE FK DE USER
        $contribuyente = Contribuyente::findOrFail($id);
        
        $contribuyente->delete();
    }
}
