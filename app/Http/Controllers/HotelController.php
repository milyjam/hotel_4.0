<?php

namespace App\Http\Controllers;

use App\Models\HotelModel;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class HotelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $hoteis = HotelModel::where('status', 'ativo')->orderBy('id')->paginate(30);

        return view('hoteis.hoteis', compact('hoteis'));
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
        $request->validate([
            'nome' => 'required',
            'descricao' => 'required',
            'cidade' => 'required',
            'estado' => 'required',
            'pais' => 'required',
            'status' => 'required',
        ]);
    
        try {
            $hotel = new HotelModel();
    
            $hotel->nome = $request->input('nome');
            $hotel->descricao = $request->input('descricao');
            $hotel->cidade = $request->input('cidade');
            $hotel->estado = $request->input('estado');
            $hotel->pais = $request->input('pais');
            $hotel->status = $request->input('status');
    
            if ($request->hasFile('imagem')) {
                $imagem = $request->file('imagem');
                $caminhoImagem = $imagem->store('public/hoteis');
                $hotel->imagem = $caminhoImagem;
            }
    
            $hotel->save();
    
            return redirect()->route('hoteis.index')->with('success', 'Hotel criado com sucesso.');
    
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Erro ao criar o hotel.');
        }
    }
    

    /**
     * Display a listing of the resource.
     */
    public function indexAdmin()
    {
        $hoteis = HotelModel::orderBy('id')->paginate(30);

        return view('admin.hoteis', compact('hoteis'));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $hotel = HotelModel::find($id);
        return response()->json($hotel);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, $id)
    {
        $request->validate([
            'nome' => 'required',
            'descricao' => 'required',
            'cidade' => 'required',
            'estado' => 'required',
            'pais' => 'required',
            'status' => 'required',
        ]);

        try {
            $hotel = HotelModel::findOrFail($id);

            $hotel->nome = $request->input('nome');
            $hotel->descricao = $request->input('descricao');
            $hotel->cidade = $request->input('cidade');
            $hotel->estado = $request->input('estado');
            $hotel->pais = $request->input('pais');
            $hotel->status = $request->input('status');

            if ($request->hasFile('imagem')) {
                $imagem = $request->file('imagem');
                $caminhoImagem = $imagem->store('public/hoteis');
                $hotel->imagem = $caminhoImagem;
            }

            $hotel->save();

            return redirect()->back()->with('success', 'Hotel atualizado com sucesso.');

        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Erro ao atualizar o hotel.');
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, HotelModel $hotelModel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $hotel = HotelModel::find($id);
        $hotel->delete();
        return true;
    }

    /**
     * Search hotel by filter
     *
     * @param Request $request
     * @return array
     **/
    public function busca(Request $request)
    {
        $searchTerm = $request->q;
    
        $hoteis = HotelModel::where('status', 'ativo')
            ->where(function ($query) use ($searchTerm) {
                $query->where('nome', 'like', '%' . $searchTerm . '%');
            })
            ->get();
        
        return response()->json($hoteis);
    }

    /**
     * Search hotel by filter
     *
     * @param Request $request
     * @return array
     **/
    public function getHoteisAtivos()
    {
        $hoteis = Hotel::where('status', 'ativo')->get();
        
        return response()->json($hoteis);
    }
}
