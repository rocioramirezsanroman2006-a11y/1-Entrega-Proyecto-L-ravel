<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use Illuminate\Http\Request;

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $empleados = Empleado::paginate(10);
        return view('empleados.index', compact('empleados'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('empleados.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'email' => 'required|email|unique:empleados,email',
            'puesto' => 'required|string|max:255',
            'salario' => 'required|numeric|min:0',
            'telefono' => 'nullable|string|max:20',
            'fecha_inicio' => 'required|date',
        ]);

        Empleado::create([
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'email' => $request->email,
            'puesto' => $request->puesto,
            'salario' => $request->salario,
            'telefono' => $request->telefono,
            'fecha_contratacion' => $request->fecha_inicio,
        ]);

        return redirect()->route('empleados.index')
                        ->with('success', 'Empleado creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Empleado $empleado)
    {
        return view('empleados.show', compact('empleado'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Empleado $empleado)
    {
        return view('empleados.edit', compact('empleado'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Empleado $empleado)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'email' => 'required|email|unique:empleados,email,' . $empleado->id,
            'puesto' => 'required|string|max:255',
            'salario' => 'required|numeric|min:0',
            'telefono' => 'nullable|string|max:20',
            'fecha_inicio' => 'required|date',
        ]);

        $empleado->update([
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'email' => $request->email,
            'puesto' => $request->puesto,
            'salario' => $request->salario,
            'telefono' => $request->telefono,
            'fecha_contratacion' => $request->fecha_inicio,
        ]);

        return redirect()->route('empleados.index')
                        ->with('success', 'Empleado actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Empleado $empleado)
    {
        // Check if user has permission
        if (!auth()->user()->isAdmin()) {
            return redirect()->route('empleados.index')->with('error', 'No tiene permisos para eliminar empleados.');
        }

        $empleado->delete();

        return redirect()->route('empleados.index')
                        ->with('success', 'Empleado eliminado exitosamente.');
    }
}
