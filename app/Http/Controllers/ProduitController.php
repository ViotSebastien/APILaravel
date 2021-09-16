<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProduitRessource;
use App\Models\Produit;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Vinkla\Hashids\Facades\Hashids;


class ProduitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return ProduitRessource::collection(Produit::paginate(5));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return ProduitRessource
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'string|required',
            'price' => 'int|required'
        ]);
        $produit=Produit::create($request->all());
        return new ProduitRessource($produit);
    }

    /**
     * Display the specified resource.
     *
     * @param Produit $produit
     * @return ProduitRessource
     */
    public function show(Produit $produit)
    {
        $produit = Produit::findOrFail((new \Hashids\Hashids)->decode($produit->getAttribute("id")));
        return new ProduitRessource($produit);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Produit $produit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Produit $produit)
    {
        $request->validate([
            'name' => 'string|required',
            'price' => 'int|required'
        ]);
        $produit->update($request->all());
        return response()->json(
            [
                'data' => [
                    'id' => $produit->id
                ]
            ],Response::HTTP_NO_CONTENT);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Produit $produit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Produit $produit)
    {
        $produit = Produit::findOrFail($produit->getAttribute("id"));
        $produit->delete();
        return response()->json(null,Response::HTTP_NO_CONTENT);
    }
}
