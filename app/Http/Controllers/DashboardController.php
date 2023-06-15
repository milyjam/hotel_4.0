<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HotelModel;
use App\Models\QuartoModel;
use App\Models\UserModel;
use App\Models\ClienteModel;
use App\Models\ReservasModel;
class DashboardController extends Controller
{
    /**
     * Mostra a página inicial do painel de controle.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $quantidadeHoteis = HotelModel::count();
        $quantidadeQuartos = QuartoModel::count();
        $quantidadeUsuarios = UserModel::count();
        $quantidadeClientes = ClienteModel::count();
        $quantidadeReservas = ReservasModel::count();

        return view('dashboard.index', compact('quantidadeHoteis', 'quantidadeQuartos', 'quantidadeUsuarios', 'quantidadeClientes', 'quantidadeReservas'));
    }

    /**
     * Mostra a página de configurações do painel de controle.
     *
     * @return \Illuminate\View\View
     */
    public function settings()
    {
        return view('dashboard.settings');
    }

    /**
     * Mostra a página de perfil do usuário no painel de controle.
     *
     * @return \Illuminate\View\View
     */
    public function profile()
    {
        return view('dashboard.profile');
    }
}
