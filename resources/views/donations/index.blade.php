<!DOCTYPE html>
<html>
<head>
    <title>Banco de Doações</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card-custom {
            border-left: 4px solid #28a745;
        }
        .btn-receber {
            background: #28a745;
            border: none;
        }
        .btn-receber:hover {
            background: #218838;
        }
    </style>
</head>
<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-success mb-4">
      <div class="container">
          <a class="navbar-brand" href="{{ route('donations.public') }}">🏦 Banco de Doações</a>
          
          <div class="navbar-nav ms-auto">

            <a href="{{ route('donations.create') }}" class="btn btn-light btn-sm me-3">
                ➕ Nova Doação
            </a>

              <span class="navbar-text me-3">
                  👋 Olá, {{ auth()->user()->name }}!
              </span>
              <form method="POST" action="{{ route('logout') }}">
                  @csrf
                  <button type="submit" class="btn btn-outline-light btn-sm">🚪 Sair</button>
              </form>
          </div>
      </div>
    </nav>

    <div class="container mt-4">
        <div class="row">
            <div class="col-12">

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show">
                        ✅ {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show">
                        ⚠️ {{ session('error') }}
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
                                    <span class="badge bg-{{ $donation->status == 'disponivel' ? 'success' : 'secondary' }}">
                                        {{ $donation->status }}
                                    </span>
                                </div>

                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="fw-bold text-primary">
                                        📦 {{ $donation->quantity }} unidades
                                    </span>
                                    
                                    @if($donation->status == 'disponivel')
                                        <div class="text-center">
                                            <span class="badge bg-success d-block mb-1">🟢 Disponível</span>
                                            <small class="text-muted">Outras pessoas podem receber</small>
                                        </div>
                                    @else
                                        <div class="text-center">
                                            <span class="badge bg-secondary d-block mb-1">⛔ Esgotado</span>
                                            <small class="text-muted">Todos os itens foram recebidos</small>
                                        </div>
                                    @endif

                                </div>

                                @if($donation->status == 'disponivel')
                                <div class="mt-2">
                                    <a href="{{ route('donations.edit', $donation->id) }}" class="btn btn-outline-primary btn-sm w-100">
                                        ✏️ Editar
                                    </a>
                                </div>
                                @endif

                                @if($donation->status == 'entregue')
                                <div class="mt-2">
                                    <form action="{{ route('donations.destroy', $donation->id) }}" method="POST" 
                                          onsubmit="return confirm('Tem certeza que deseja excluir esta doação?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm w-100">
                                            🗑️ Excluir Doação
                                        </button>
                                    </form>
                                </div>
                                @endif
                                
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                @if($donations->isEmpty())
                    <div class="text-center py-5">
                        <h4 class="text-muted">📭 Nenhuma doação cadastrada</h4>
                        <p class="text-muted">Seja o primeiro a fazer uma doação!</p>
                        <a href="{{ route('donations.create') }}" class="btn btn-success">
                            Fazer Primeira Doação
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>