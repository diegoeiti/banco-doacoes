<!DOCTYPE html>
<html>
<head>
    <title>Nova Doação - Banco de Doações</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h1>Cadastrar Nova Doação</h1>
        
        <form action="{{ route('donations.store') }}" method="POST">
            @csrf
            
            <div class="mb-3">
                <label for="title" class="form-label">Nome do Item:</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Descrição:</label>
                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
            </div>

            <div class="mb-3">
                <label for="category" class="form-label">Categoria:</label>
                <select class="form-select" id="category" name="category" required>
                    <option value="">Selecione...</option>
                    <option value="Alimento">Alimento</option>
                    <option value="Roupa">Roupa</option>
                    <option value="Higiene">Produto de Higiene</option>
                    <option value="Outros">Outros</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="quantity" class="form-label">Quantidade:</label>
                <input type="number" class="form-control" id="quantity" name="quantity" min="1" required>
            </div>

            <button type="submit" class="btn btn-success">Cadastrar Doação</button>
            <a href="{{ route('donations.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</body>
</html>