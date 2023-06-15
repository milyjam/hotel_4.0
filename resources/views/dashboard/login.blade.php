@extends('templates.pagina_principal')
@section('title', 'Login')

@section('content')
    <div class="row justify-content-center mt-5">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="text-center mb-4">
                        <img src="https://png.pngtree.com/template/20191212/ourlarge/pngtree-receptionist-bell-hotel-logo-design-image_339601.jpg" alt="Logo" width="200">
                    </div>
                    <h4 class="card-title text-center mb-4">Login</h4>

                    <!-- Formulário de login -->
                    <form method="POST" action="login">
                        @csrf

                        <!-- Campo de e-mail -->
                        <div class="form-group">
                            <label for="email">E-mail</label>
                            <input id="email" type="email" class="form-control" name="email" required autofocus>
                        </div>

                        <!-- Campo de senha -->
                        <div class="form-group">
                            <label for="password">Senha</label>
                            <input id="password" type="password" class="form-control" name="password" required>
                        </div>

                        @if($errors->has('login'))
                            <div class="alert alert-danger">
                                {{ $errors->first('login') }}
                            </div>
                        @endif

                        <!-- Botão de login -->
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block">Entrar</button>
                        </div>

                        <div class="text-center mb-3">
                            <span class="text-muted">Ou faça login com</span>
                        </div>

                        <!-- Botão de login via Google -->
                        <div class="form-group">
                            <a href="/login/google" class="btn btn-danger btn-block">
                                <i class="fab fa-google mr-2"></i> Login com Google
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
