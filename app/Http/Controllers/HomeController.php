<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Muestra el portal público con el buscador de contribuyentes.
     */
    public function index()
    {
        // TODO: Pasar estadísticas públicas (contribuyentes, recaudado, deudas)
        return view('portal.index');
    }

    /**
     * Vista de pago en línea.
     */
    public function pago()
    {
        // TODO: Integrar con pasarela de pago
        return view('portal.pago');
    }

    /**
     * Vista de fraccionamiento de deudas.
     */
    public function fraccionamiento()
    {
        // TODO: Formulario de solicitud de fraccionamiento
        return view('portal.fraccionamiento');
    }

    /**
     * Centro de ayuda.
     */
    public function ayuda()
    {
        // TODO: Contenido de preguntas frecuentes
        return view('portal.ayuda');
    }
}
