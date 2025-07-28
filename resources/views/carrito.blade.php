<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Carrito de Compras</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">

    <h1>Carrito de Compras</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <!-- Botones superiores -->
    <a href="{{ route('productos.index') }}" class="btn btn-secondary mb-3">⬅️ Regresar a productos</a>
    <a href="{{ route('historial.ver') }}" class="btn btn-info mb-3">📜 Ver Historial</a>

    @if(empty($carrito))
        <div class="alert alert-warning">Tu carrito está vacío.</div>
    @else
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Producto</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @php $total = 0; @endphp
                @foreach($carrito as $item)
                    @php $total += $item['precio'] * $item['cantidad']; @endphp
                    <tr>
                        <td>{{ $item['nombre'] }}</td>
                        <td>${{ number_format($item['precio'], 2) }}</td>
                        <td>{{ $item['cantidad'] }}</td>
                        <td>${{ number_format($item['precio'] * $item['cantidad'], 2) }}</td>
                    </tr>
                @endforeach
                <tr class="table-success">
                    <td colspan="3"><strong>Total a pagar</strong></td>
                    <td><strong>${{ number_format($total, 2) }}</strong></td>
                </tr>
            </tbody>
        </table>

        <!-- Botón Finalizar compra -->
        <form action="{{ route('carrito.finalizar') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-primary mt-3">✅ Finalizar Compra</button>
        </form>
    @endif

</body>
</html>
