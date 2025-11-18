<!DOCTYPE html>
<html>
<head>
    <title>Itens Disponíveis - Banco de Doações</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card-custom {
            border-left: 4px solid #28a745;
        }
    </style>
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-success mb-4">
        <div class="container">
            <a class="navbar-brand" href="{{ route('donations.public') }}">🏦 Banco de Doações</a>
            
            <div class="navbar-nav ms-auto">
                @auth
                    <span class="navbar-text me-3">👋 Olá, {{ auth()->user()->name }}!</span>
                    <a href="{{ route('donations.index') }}" class="btn btn-outline-light btn-sm me-2">Minhas Doações</a>
                    <form method="POST" action="{{ route('logout') }}" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-outline-light btn-sm">🚪 Sair</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="btn btn-outline-light btn-sm">🔑 Login</a>
                @endauth
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="text-center mb-4">📦 Itens Disponíveis para Receber</h1>

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show">
                        ✅ {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <div class="row">
                    @foreach($donations as $donation)
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card card-custom h-100 shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title text-success">{{ $donation->title }}</h5>
                                <p class="card-text text-muted">{{ $donation->description }}</p>
                                
                                <div class="mb-2">
                                    <span class="badge bg-info">{{ $donation->category }}</span>
                                    <span class="badge bg-success">Disponível</span>
                                </div>

                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="fw-bold text-primary">
                                        📦 {{ $donation->quantity }} unidades
                                    </span>
                                    
                                    @auth
                                        @if(auth()->id() == $donation->user_id)
                                            <span class="badge bg-info">📝 Minha Doação</span>
                                        @else
                                            <form action="{{ route('donations.receber', $donation->id) }}" method="POST" class="d-flex align-items-center">
                                                @csrf
                                                <input type="number" name="quantidade" 
                                                      class="form-control form-control-sm me-2" 
                                                      style="width: 70px;" 
                                                      min="1" max="{{ $donation->quantity }}" 
                                                      value="1" required>
                                                <button type="submit" class="btn btn-success btn-sm">
                                                    Receber
                                                </button>
                                            </form>
                                        @endif
                                    @else
                                        <div class="text-center">
                                            <a href="{{ route('login') }}" class="btn btn-outline-success btn-sm mb-1">
                                                🔑 Fazer Login
                                            </a>
                                            <br>
                                            <small class="text-muted">ou</small>
                                            <br>
                                            <a href="{{ route('register') }}" class="btn btn-success btn-sm mt-1">
                                                📝 Criar Conta
                                            </a>
                                        </div>
                                    @endauth
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                @if($donations->isEmpty())
                    <div class="text-center py-5">
                        <h4 class="text-muted">📭 Nenhum item disponível no momento</h4>
                        <p class="text-muted">Seja o primeiro a fazer uma doação!</p>
                        @auth
                            <a href="{{ route('donations.create') }}" class="btn btn-success">
                                Fazer Primeira Doação
                            </a>
                        @else
                            <div class="text-center">
                                <a href="{{ route('register') }}" class="btn btn-success me-2">
                                    📝 Criar Conta
                                </a>
                                <a href="{{ route('login') }}" class="btn btn-outline-success">
                                    🔑 Fazer Login
                                </a>
                            </div>
                        @endauth
                    </div>
                @endif
            </div>
        </div>
    </div>
</body>
</html>