<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProduitRessource;
use App\Models\Produit;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProduitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return ProduitRessource
     */
    public function index()
    {
        $produit=Produit::paginate(5);
        return new ProduitRessource($produit);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $produit=Produit::create($request->all());
        return response()->json(['data' => $produit->id],201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Produit  $produit
     * @return ProduitRessource
     */
    public function show(Produit $produit)
    {
        return new ProduitRessource($produit);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Produit  $produit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Produit $produit)
    {
        $produit->update($request->all());
        return response()->json(['data' => $produit],Response::HTTP_NO_CONTENT);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Produit  $produit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Produit $produit)
    {
        $produit->delete();
        return response()->json(null,Response::HTTP_NO_CONTENT);
    }
}
