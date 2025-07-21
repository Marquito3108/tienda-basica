<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Productos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #f8f9fa, #e3f2fd);
            font-family: 'Segoe UI', sans-serif;
        }
        .card-custom {
            background-color: #ffffff;
            border: 1px solid #dee2e6;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0px 4px 8px rgba(0,0,0,0.1);
        }
        .footer {
            margin-top: 50px;
            padding: 15px;
            text-align: center;
            font-weight: bold;
            background-color: #212529;
            color: #fff;
            border-radius: 10px;
        }
    </style>
</head>
<body class="container mt-5">

    <div class="card-custom">
        <h1 class="text-center mb-4 text-primary">🛒 Productos Disponibles</h1>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <table class="table table-hover table-striped">
            <thead class="table-primary text-center">
                <tr>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Stock</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($productos as $producto)
                    <tr class="align-middle text-center">
                        <td>{{ $producto->nombre }}</td>
                        <td>${{ number_format($producto->precio, 2) }}</td>
                        <td>{{ $producto->stock }}</td>
                        <td>
                            <form action="{{ route('productos.comprar', $producto->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-success" @if($producto->stock <= 0) disabled @endif>
                                    Comprar
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="footer">
        Producto final - Marco Antonio Márquez Lozano
    </div>

</body>
</html>
