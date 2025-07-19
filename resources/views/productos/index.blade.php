<!DOCTYPE html>
<html>
<head>
    <title>Tienda Simple</title>
</head>
<body>
    <h1>Lista de productos</h1>
    <ul>
        @foreach($productos as $producto)
            <li>
                <strong>{{ $producto->nombre }}</strong><br>
                {{ $producto->descripcion }}<br>
                Precio: ${{ $producto->precio }}<br>
                Stock: {{ $producto->stock }}<br>
                <form action="{{ route('comprar', $producto->id) }}" method="POST">
                    @csrf
                    <button type="submit">Comprar</button>
                </form>
                <hr>
            </li>
        @endforeach
    </ul>
</body>
</html>
