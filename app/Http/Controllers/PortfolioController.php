<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewsletterRequest;
use App\Mail\Email;
use App\Models\Newsletter;
use App\Models\Portfolio;
use Illuminate\Contracts\Support\ValidatedData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class PortfolioController extends Controller
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
     
        return redirect()-> back()->with('success', 'Enregistrement effectuer');
    }

    public function welcome()
    {
        $welcome = Portfolio::all();
        return view('welcome', ['welcome' => $welcome]);
    }


    /**
     * Display the specified resource.
     */
    public function liste(string $id)
    {
        $portfolio= Portfolio::findOrFail($id);
        return view('liste', compact('portfolio'));
    }

    public function tableau()
    {
        $tableau = Portfolio::all();
        return view('tableau', ['tableau' => $tableau]);
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
        
        return redirect()-> back()->with('success', 'Enregistrement modifier');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $portfolio= Portfolio::findOrFail($id);
        $portfolio->delete();
        return redirect()->back()->with('success', 'Suppression effectuer');
    }


    public function mail(Request $request)
    {
        $validatedData = $request->validate([
            'nom' => 'required',
            'email' => 'required',
            'sujet' => 'required',
            'message' => 'required',
        ]);
        $contact= Portfolio::create ($validatedData);
       Mail::to('berei@gmail.com',)->send(new Email($request->all()));
        return redirect()-> back()->with('success', 'Votre message à bien été envoyer'); 
    }

    public function post_(NewsletterRequest $request)
    {
        $validated = $request->validated();

        // Maybe you need more validation rules???
        Newsletter::create([
            'mail' => $validated['mail'],
        ]);


        return redirect()->back()->with('success', 'You have successfully subscribed. Please check your email spam folder.');
    }
}
