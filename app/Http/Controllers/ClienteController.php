<?php

namespace App\Http\Controllers;

use App\Models\Clientes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ClienteController extends Controller
{
    public function index()
    {
        $clientes = Clientes::paginate(15);
        return view('clientes.index', compact('clientes'));
    }

    public function create()
    {
        return view('clientes.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|unique:clientes',
            'telefono' => 'required|string|max:20',
            'ciudad' => 'required|string|max:100',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle file upload
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $path = $file->store('clientes', 'public');
            $validated['foto'] = $path;
        }

        Clientes::create($validated);
        return redirect()->route('clientes.index')->with('success', 'Cliente creado correctamente.');
    }

    public function edit(Clientes $cliente)
    {
        return view('clientes.edit', compact('cliente'));
    }

    public function update(Request $request, Clientes $cliente)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|unique:clientes,email,' . $cliente->id,
            'telefono' => 'required|string|max:20',
            'ciudad' => 'required|string|max:100',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle file upload
        if ($request->hasFile('foto')) {
            // Delete old file if exists
            if ($cliente->foto) {
                Storage::disk('public')->delete($cliente->foto);
            }
            $file = $request->file('foto');
            $path = $file->store('clientes', 'public');
            $validated['foto'] = $path;
        }

        $cliente->update($validated);
        return redirect()->route('clientes.index')->with('success', 'Cliente actualizado correctamente.');
    }

    public function destroy(Clientes $cliente)
    {
        // Check if user has permission
        if (!auth()->user()->isAdmin()) {
            return redirect()->route('clientes.index')->with('error', 'No tiene permisos para eliminar clientes.');
        }

        // Delete file if exists
        if ($cliente->foto) {
            Storage::disk('public')->delete($cliente->foto);
        }

        $cliente->delete();
        return redirect()->route('clientes.index')->with('success', 'Cliente eliminado correctamente.');
    }
}
