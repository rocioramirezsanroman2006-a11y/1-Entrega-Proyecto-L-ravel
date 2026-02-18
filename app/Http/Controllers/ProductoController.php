<?php

namespace App\Http\Controllers;

use App\Models\Productos;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductoController extends Controller
{
    public function index()
    {
        $productos = Productos::with('categoria')->paginate(10);
        return view('productos.index', compact('productos'));
    }

    public function create()
    {
        $categorias = Categoria::all();
        return view('productos.create', compact('categorias'));
    }

    public function show(Productos $producto)
    {
        return view('productos.show', compact('producto'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'categoria_id' => 'required|exists:categorias,id',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'archivo_pdf' => 'nullable|mimes:pdf|max:5120',
        ]);

        // Handle image upload
        if ($request->hasFile('imagen')) {
            $file = $request->file('imagen');
            $path = $file->store('productos/imagenes', 'public');
            $validated['imagen'] = $path;
        }

        // Handle PDF upload
        if ($request->hasFile('archivo_pdf')) {
            $file = $request->file('archivo_pdf');
            $path = $file->store('productos/pdfs', 'public');
            $validated['archivo_pdf'] = $path;
        }

        Productos::create($validated);
        return redirect()->route('productos.index')->with('success', 'Producto creado correctamente.');
    }

    public function edit(Productos $producto)
    {
        $categorias = Categoria::all();
        return view('productos.edit', compact('producto', 'categorias'));
    }

    public function update(Request $request, Productos $producto)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'categoria_id' => 'required|exists:categorias,id',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'archivo_pdf' => 'nullable|mimes:pdf|max:5120',
        ]);

        // Handle image upload
        if ($request->hasFile('imagen')) {
            if ($producto->imagen) {
                Storage::disk('public')->delete($producto->imagen);
            }
            $file = $request->file('imagen');
            $path = $file->store('productos/imagenes', 'public');
            $validated['imagen'] = $path;
        }

        // Handle PDF upload
        if ($request->hasFile('archivo_pdf')) {
            if ($producto->archivo_pdf) {
                Storage::disk('public')->delete($producto->archivo_pdf);
            }
            $file = $request->file('archivo_pdf');
            $path = $file->store('productos/pdfs', 'public');
            $validated['archivo_pdf'] = $path;
        }

        $producto->update($validated);
        return redirect()->route('productos.index')->with('success', 'Producto actualizado correctamente.');
    }

    public function destroy(Productos $producto)
    {
        // Check if user has permission
        if (!auth()->user()->isAdmin()) {
            return redirect()->route('productos.index')->with('error', 'No tiene permisos para eliminar productos.');
        }

        // Delete files if exist
        if ($producto->imagen) {
            Storage::disk('public')->delete($producto->imagen);
        }
        if ($producto->archivo_pdf) {
            Storage::disk('public')->delete($producto->archivo_pdf);
        }

        $producto->delete();
        return redirect()->route('productos.index')->with('success', 'Producto eliminado correctamente.');
    }
}
