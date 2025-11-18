<!DOCTYPE html>
<html>
<head>
    <title>Editar Doação - Banco de Doações</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header bg-success text-white">
                        <h4 class="mb-0">✏️ Editar Doação</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('donations.update', $donation->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            
                            <div class="mb-3">
                                <label for="title" class="form-label">Nome do Item:</label>
                                <input type="text" class="form-control" id="title" name="title" 
                                       value="{{ old('title', $donation->title) }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">Descrição:</label>
                                <textarea class="form-control" id="description" name="description" rows="3">{{ old('description', $donation->description) }}</textarea>
                            </div>

                            <div class="mb-3">
                                <label for="category" class="form-label">Categoria:</label>
                                <select class="form-select" id="category" name="category" required>
                                    <option value="">Selecione...</option>
                                    <option value="Alimento" {{ $donation->category == 'Alimento' ? 'selected' : '' }}>Alimento</option>
                                    <option value="Roupa" {{ $donation->category == 'Roupa' ? 'selected' : '' }}>Roupa</option>
                                    <option value="Higiene" {{ $donation->category == 'Higiene' ? 'selected' : '' }}>Produto de Higiene</option>
                                    <option value="Outros" {{ $donation->category == 'Outros' ? 'selected' : '' }}>Outros</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="quantity" class="form-label">Quantidade:</label>
                                <input type="number" class="form-control" id="quantity" name="quantity" 
                                       value="{{ old('quantity', $donation->quantity) }}" min="1" required>
                            </div>

                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-success">💾 Atualizar Doação</button>
                                <a href="{{ route('donations.index') }}" class="btn btn-secondary">↩️ Cancelar</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>