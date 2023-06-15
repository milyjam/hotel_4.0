@extends('templates.pagina_principal')
@include('templates.header')
<hr>
@section('title', 'Hotéis')
@section('content')
@include('templates.hotel')

<div class="row">
    @foreach($hoteis as $hotel)
        <div class="col-md-4">
            <div class="card mb-4">
                <a href="/hotel/quartos/{{ $hotel->id }}">
                    <img src="{{ $hotel->imagem }}" class="card-img-top" alt="{{ $hotel->nome }}">
                </a>         
                <div class="card-body">
                    <h5 class="card-title">{{ $hotel->nome }}</h5>
                    <p class="card-text">{{ $hotel->descricao }}</p>
                    <hr>
                    <p class="card-text">
                        <strong>Cidade:</strong> {{ $hotel->cidade }}<br>
                        <strong>Estado:</strong> {{ $hotel->estado }}<br>
                        <strong>País:</strong> {{ $hotel->pais }}
                    </p>
                </div>
            </div>
        </div>
    @endforeach
</div>
@if ($hoteis->lastPage() > 1)
    <div class="row">
        <div class="col-md-12">
            <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center">
                    @if ($hoteis->currentPage() > 1)
                        <li class="page-item">
                            <a class="page-link" href="{{ $hoteis->previousPageUrl() }}" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                                <span class="sr-only">Anterior</span>
                            </a>
                        </li>
                    @endif

                    @for ($i = 1; $i <= $hoteis->lastPage(); $i++)
                        <li class="page-item {{ $i == $hoteis->currentPage() ? 'active' : '' }}">
                            <a class="page-link" href="{{ $hoteis->url($i) }}">{{ $i }}</a>
                        </li>
                    @endfor

                    @if ($hoteis->currentPage() < $hoteis->lastPage())
                        <li class="page-item">
                            <a class="page-link" href="{{ $hoteis->nextPageUrl() }}" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                                <span class="sr-only">Próximo</span>
                            </a>
                        </li>
                    @endif
                </ul>
            </nav>
        </div>
    </div>
@endif
@endsection
