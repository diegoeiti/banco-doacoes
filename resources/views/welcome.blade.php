<!DOCTYPE html>
<html>
<head>
    <title>Banco de Doações</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="row justify-content-center text-center">
            <div class="col-md-8">
                <h1 class="display-4 text-success mb-4">🏦 Banco de Doações</h1>
                <p class="lead mb-4">Conectando pessoas que querem doar com quem precisa receber</p>
                
                <div class="row mt-5">
                    <div class="col-md-6 mb-3">
                        <div class="card h-100 shadow">
                            <div class="card-body">
                                <h5 class="card-title">📦 Ver Itens Disponíveis</h5>
                                <p class="card-text">Veja todos os itens disponíveis para receber</p>
                                <a href="{{ route('donations.public') }}" class="btn btn-success btn-lg">
                                    Explorar Doações
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <div class="card h-100 shadow">
                            <div class="card-body">
                                <h5 class="card-title">❤️ Quero Doar</h5>
                                <p class="card-text">Cadastre itens que você quer doar</p>
                                @auth
                                    <a href="{{ route('donations.index') }}" class="btn btn-outline-success btn-lg">
                                        Minhas Doações
                                    </a>
                                @else
                                    <a href="{{ route('login') }}" class="btn btn-outline-success btn-lg">
                                        Fazer Login
                                    </a>
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>

                @auth
                    <div class="mt-4">
                        <p>👋 Olá, {{ auth()->user()->name }}! <a href="{{ route('donations.index') }}">Ir para minhas doações</a></p>
                    </div>
                @else
                    <div class="mt-4">
                        <p>Já tem conta? <a href="{{ route('login') }}">Login</a> | Primeira vez? <a href="{{ route('register') }}">Cadastre-se</a></p>
                    </div>
                @endauth
            </div>
        </div>
    </div>
</body>
</html>