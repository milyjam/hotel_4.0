@extends('templates.pagina_principal')
@include('templates.header')
<hr>
@section('title', 'Hotéis')
@section('content')
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hoteis</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container">
    <h1>Hoteis</h1>

    <div class="row">
        <div class="col-md-12">
            <a href="/hoteis/create" onclick="event.preventDefault();" class="btn btn-primary" data-toggle="modal" data-target="#createHotelModal">Criar Hotel</a>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-12">
            <table class="table">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Cidade</th>
                    <th>Estado</th>
                    <th>País</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
                </thead>
                <tbody>
                @foreach($hoteis as $hotel)
                    <tr>
                        <td>{{ $hotel->id }}</td>
                        <td>{{ $hotel->nome }}</td>
                        <td>{{ $hotel->descricao }}</td>
                        <td>{{ $hotel->cidade }}</td>
                        <td>{{ $hotel->estado }}</td>
                        <td>{{ $hotel->pais }}</td>
                        <td>{{ $hotel->status }}</td>
                        <td>
                            <a href="/hoteis/show/{{$hotel->id}}" class="btn btn-primary" data-toggle="modal" data-target="#viewHotelModal" onclick="event.preventDefault(); showHotel({{ $hotel->id }})">Ver</a>
                            <a href="/hoteis/edit/{{$hotel->id}}" class="btn btn-alert" data-toggle="modal" data-target="#editHotelModal" onclick="event.preventDefault(); editHotel({{ $hotel->id }})">Editar</a>
                            <a href="/hoteis/destroy/{{$hotel->id}}" class="btn btn-danger" onclick="event.preventDefault(); deleteHotel({{ $hotel->id }})">Deletar</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
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

<!-- Modal de visualização -->
<div class="modal fade" id="viewHotelModal" tabindex="-1" role="dialog" aria-labelledby="viewHotelModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewHotelModalLabel">Detalhes do Hotel</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Dados do hotel serão exibidos aqui -->
                <p>Nome: <span id="hotelNome"></span></p>
                <p>Descrição: <span id="hotelDescricao"></span></p>
                <p>Cidade: <span id="hotelCidade"></span></p>
                <p>Estado: <span id="hotelEstado"></span></p>
                <p>País: <span id="hotelPais"></span></p>
                <p>Status: <span id="hotelStatus"></span></p>
                <p>Imagem: <img class="m-auto d-block mx-auto border border-dark img-fluid" id="hotelImagem" src="" alt="Imagem do Hotel"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal de edição -->
<div class="modal fade" id="editHotelModal" tabindex="-1" role="dialog" aria-labelledby="editHotelModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editHotelModalLabel">Editar Hotel</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Formulário de edição do hotel -->
                <form id="editHotelForm" action="" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="nome">Nome</label>
                        <input type="text" class="form-control" id="nome" name="nome" value="" required>
                    </div>
                    <div class="form-group">
                        <label for="descricao">Descrição</label>
                        <textarea class="form-control" id="descricao" name="descricao" rows="3" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="cidade">Cidade</label>
                        <input type="text" class="form-control" id="cidade" name="cidade" value="" required>
                    </div>
                    <div class="form-group">
                        <label for="estado">Estado</label>
                        <input type="text" class="form-control" id="estado" name="estado" value="" required>
                    </div>
                    <div class="form-group">
                        <label for="pais">País</label>
                        <input type="text" class="form-control" id="pais" name="pais" vvalue="" required>
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select class="form-control" id="status" name="status" required>
                            <option value="ativo" {{ $hotel->status == 'ativo' ? 'selected' : '' }}>Ativo</option>
                            <option value="inativo" {{ $hotel->status == 'inativo' ? 'selected' : '' }}>Inativo</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="imagem">Imagem</label>
                        <input type="file" class="form-control-file" id="imagem" name="imagem">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Salvar</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal de criar -->
<div class="modal fade" id="createHotelModal" tabindex="-1" role="dialog" aria-labelledby="createHotelModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createHotelModalLabel">Criar Hotel</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Formulário de edição do hotel -->
                <form id="createHotelForm" action="/hoteis/create" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="nome">Nome</label>
                        <input type="text" class="form-control" id="nome" name="nome" value="" required>
                    </div>
                    <div class="form-group">
                        <label for="descricao">Descrição</label>
                        <textarea class="form-control" id="descricao" name="descricao" rows="3" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="cidade">Cidade</label>
                        <input type="text" class="form-control" id="cidade" name="cidade" value="" required>
                    </div>
                    <div class="form-group">
                        <label for="estado">Estado</label>
                        <input type="text" class="form-control" id="estado" name="estado" value="" required>
                    </div>
                    <div class="form-group">
                        <label for="pais">País</label>
                        <input type="text" class="form-control" id="pais" name="pais" vvalue="" required>
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select class="form-control" id="status" name="status" required>
                            <option value="ativo" {{ $hotel->status == 'ativo' ? 'selected' : '' }}>Ativo</option>
                            <option value="inativo" {{ $hotel->status == 'inativo' ? 'selected' : '' }}>Inativo</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="imagem">Imagem</label>
                        <input type="file" class="form-control-file" id="imagem" name="imagem">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Salvar</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    function deleteHotel(hotelId) {
        if (confirm("Deseja realmente excluir o hotel?")) {
            axios.delete(`/hoteis/destroy/${hotelId}`)
                .then(response => {
                    alert("Hotel excluído com sucesso!");
                    window.location.reload();
                })
                .catch(error => {
                    console.error(error);
                    alert("Erro ao excluir o hotel.");
                });
        }
    }

    function editHotel(hotelId) {
        axios.get(`/hoteis/show/${hotelId}`)
            .then(response => {
                var hotel = response.data;
                $('#editHotelModal #nome').val(hotel.nome);
                $('#editHotelModal #descricao').val(hotel.descricao);
                $('#editHotelModal #cidade').val(hotel.cidade);
                $('#editHotelModal #estado').val(hotel.estado);
                $('#editHotelModal #pais').val(hotel.pais);
                $('#editHotelModal #status').val(hotel.status);
                $('#editHotelModal').modal('show');
                $('#editHotelModal #editHotelForm').attr('action', `/hoteis/edit/${hotel.id}`);
            })
            .catch(error => {
                console.error(error);
                alert("Erro ao carregar os dados do hotel.");
            });
    }


    
    function showHotel(hotelId) 
    {
        axios.get(`/hoteis/show/${hotelId}`)
            .then(response => {
                var hotel = response.data;
                $('#hotelNome').text(hotel.nome);
                $('#hotelDescricao').text(hotel.descricao);
                $('#hotelCidade').text(hotel.cidade);
                $('#hotelEstado').text(hotel.estado);
                $('#hotelPais').text(hotel.pais);
                $('#hotelStatus').text(hotel.status);
                $('#hotelImagem').attr('src', hotel.imagem);
            })
            .catch(error => {
                console.error(error);
                alert("Erro ao carregar os dados do hotel.");
            });
    }

    $('#viewHotelModal').on('hidden.bs.modal', function() {
    $('#hotelNome').text('');
    $('#hotelDescricao').text('');
    $('#hotelCidade').text('');
    $('#hotelEstado').text('');
    $('#hotelPais').text('');
    $('#hotelStatus').text('');
    $('#hotelImagem').attr('src', '');
});

</script>

</body>
</html>
