<div class="row mb-4">
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Informações do Hotel</h5>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Filtros de Pesquisa</h5>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="checkin">Check-in</label>
                            <input type="date" class="form-control" id="checkin" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="checkout">Check-out</label>
                            <input type="date" class="form-control" id="checkout" disabled>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="hotel">Hotel</label>
                            <select class="select2" id="hotel" data-placeholder="Pesquisar hotel" style="width: 100%; overflow: auto;">
                            </select>
                        </div>
                    </div>                    
                </div>
                <div class="form-group">
                    <label for="quarto">Quarto</label>
                    <select class="form-control" id="quarto" disabled>
                        <option value="">Selecione um hotel primeiro</option>
                    </select>
                </div>                
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('js/filtros.js') }}"></script>
