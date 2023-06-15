@extends('templates.pagina_principal')
@include('templates.header')
@section('title', 'Dashboard')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var ctx = document.getElementById('hoteisChart').getContext('2d');
    var hoteisChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Hoteis', 'Quartos', 'Usuários', 'Clientes', 'Reservas'],
            datasets: [{
                label: 'Quantidades',
                data: [
                    {{ $quantidadeHoteis }},
                    {{ $quantidadeQuartos }},
                    {{ $quantidadeUsuarios }},
                    {{ $quantidadeClientes }},
                    {{ $quantidadeReservas }}
                ],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.5)',
                    'rgba(54, 162, 235, 0.5)',
                    'rgba(255, 206, 86, 0.5)',
                    'rgba(75, 192, 192, 0.5)',
                    'rgba(153, 102, 255, 0.5)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true
        }
    });
</script>

@section('content')
<br>
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Quantidade de Hoteis
                </div>
                <div class="card-body">
                    <canvas id="hoteisChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Quantidade de Quartos
                </div>
                <div class="card-body">
                    <canvas id="quartosChart"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Quantidade de Usuários Cadastrados
                </div>
                <div class="card-body">
                    <canvas id="usuariosChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Quantidade de Clientes Cadastrados no Último Mês
                </div>
                <div class="card-body">
                    <canvas id="clientesChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Configuração do gráfico de hoteis
        var hoteisChart = new Chart(document.getElementById('hoteisChart'), {
            type: 'bar',
            data: {
                labels: ['Hoteis'],
                datasets: [{
                    label: 'Quantidade',
                    data: [{{ $quantidadeHoteis }}],
                    backgroundColor: 'rgba(75, 192, 192, 0.5)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Configuração do gráfico de quartos
        var quartosChart = new Chart(document.getElementById('quartosChart'), {
            type: 'bar',
            data: {
                labels: ['Quartos'],
                datasets: [{
                    label: 'Quantidade',
                    data: [{{ $quantidadeQuartos }}],
                    backgroundColor: 'rgba(255, 205, 86, 0.5)',
                    borderColor: 'rgba(255, 205, 86, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Configuração do gráfico de usuários
        var usuariosChart = new Chart(document.getElementById('usuariosChart'), {
            type: 'bar',
            data: {
                labels: ['Usuários'],
                datasets: [{
                    label: 'Quantidade',
                    data: [{{ $quantidadeUsuarios }}],
                    backgroundColor: 'rgba(54, 162, 235, 0.5)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Configuração do gráfico de clientes
        var clientesChart = new Chart(document.getElementById('clientesChart'), {
            type: 'bar',
            data: {
                labels: ['Clientes'],
                datasets: [{
                    label: 'Quantidade',
                    data: [{{ $quantidadeClientes }}],
                    backgroundColor: 'rgba(255, 99, 132, 0.5)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    });
</script>
@endsection
