<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Historial de Compras</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">

    <h1>Historial de Compras</h1>

    <a href="{{ route('productos.index') }}" class="btn btn-secondary mb-3">⬅️ Regresar a productos</a>
    <a href="{{ route('carrito.ver') }}" class="btn btn-success mb-3">🛒 Ver Carrito</a>

    @if(count($historial) > 0)
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Producto</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Fecha de compra</th>
                </tr>
            </thead>
            <tbody>
                @foreach($historial as $compra)
                    <tr>
                        <td>{{ $compra->producto }}</td>
                        <td>${{ $compra->precio }}</td>
                        <td>{{ $compra->cantidad }}</td>
                        <td>{{ $compra->created_at->format('d/m/Y H:i') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="alert alert-info">No hay compras registradas aún.</div>
    @endif

</body>
</html>
