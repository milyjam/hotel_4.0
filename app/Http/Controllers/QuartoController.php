<?php

namespace App\Http\Controllers;

use App\Models\QuartoModel;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class QuartoController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(QuartoModel $quartoModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(QuartoModel $quartoModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, QuartoModel $quartoModel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(QuartoModel $quartoModel)
    {
        //
    }

    /**
     * Search quarto by filter
     *
     * @param Request $request
     * @return array
     **/
    public function getQuartos(Request $request, $hotelId)
    {
        $quartos = QuartoModel::where('fk_hotel', $hotelId)->get();

        return response()->json($quartos);
    }
}
