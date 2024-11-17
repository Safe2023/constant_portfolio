<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EssaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('ajout');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|file|mimes:jpeg,png,jpg,gif|max:5020',
        ]);
        $image = $request->file('image');

        $image_name = time() . '.' . $image->extension();

        $image->move(public_path('/uploads/portfolio/'), $image_name);
        
        Portfolio::create ([
            'titre' => $request->titre,
            'description' => $request->description,
            'slug' => $request->slug,
            'image' =>'/uploads/portfolio/' . $image_name,
        ]);
        return response()->json([
            'status' => true,
            'message' => 'Enregistrement effectuer',
            'data'=>$data
        ],201);
    }

    public function welcome()
    {
        $welcome = Portfolio::all();
        return response()->json($welcome); 
    }

    public function liste(string $id)
    {
        $portfolio= Portfolio::findOrFail($id);
        return response()->json($portfolio); 
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $portfolio= Portfolio::findOrFail($id);
        return view('modifier', compact('portfolio'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $portfolio= Portfolio::findOrFail($id);
        $request->validate([
            'titre' => 'required',
            'description' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'slug' => 'required',
        ]);
        $portfolio->titre = $request->titre;
        $portfolio->description = $request->description;
        $portfolio->slug = $request->slug;


        if ($request->hasFile('image')) {
            if ($portfolio->image && Storage::disk('public')->exists($portfolio->image)) {
                Storage::disk('public')->delete($portfolio->image);
            }
            $image = $request->file('image');
            $imageName = time() . '.' . $image->extension();
            $image->move(public_path('uploads/news'), $imageName);

            $portfolio->image = '/uploads/news/' . $imageName;
        }
        $portfolio->save();
        return response()->json([
            'status' => true,
            'message' => 'Enregistrement modifier',
            
        ],201);  
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $portfolio= Portfolio::findOrFail($id);
        $portfolio->delete();
        return response()->json([
            'status' => true,
            'message' => 'Enregistrement suprimer !!!',
           
        ],201); 
    }

    
}
