<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Servientrega S.A.S. - Consulta de Pedidos</title>
    <!-- Estilos CSS puros para no depender de frameworks externos -->
    <style>
        :root {
            --rojo-servientrega: #E30613;
            --blanco: #FFFFFF;
            --gris-claro: #f4f4f4;
            --gris-oscuro: #333333;
            --gris-borde: #dddddd;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--gris-claro);
            color: var(--gris-oscuro);
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* Encabezado */
        header {
            background-color: var(--rojo-servientrega);
            color: var(--blanco);
            padding: 1.5rem 2rem;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .logo-container {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .logo-text h1 {
            font-size: 1.8rem;
            margin: 0;
        }

        .logo-text p {
            font-size: 0.9rem;
            opacity: 0.9;
            font-style: italic;
        }

        nav a {
            color: var(--blanco);
            text-decoration: none;
            font-weight: 600;
            padding: 0.5rem 1rem;
            border-radius: 4px;
            transition: background-color 0.3s;
        }

        nav a:hover {
            background-color: rgba(255, 255, 255, 0.2);
        }

        /* Contenido Principal */
        main {
            flex-grow: 1;
            padding: 2rem;
            max-width: 1200px;
            margin: 0 auto;
            width: 100%;
        }

        /* Utilidades Comunes */
        .card {
            background-color: var(--blanco);
            border-radius: 8px;
            padding: 2rem;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
            margin-bottom: 2rem;
        }

        .btn {
            display: inline-block;
            background-color: var(--rojo-servientrega);
            color: var(--blanco);
            padding: 0.6rem 1.2rem;
            text-decoration: none;
            border-radius: 4px;
            border: none;
            cursor: pointer;
            font-size: 1rem;
            transition: background-color 0.3s, transform 0.1s;
        }

        .btn:hover {
            background-color: #c00510;
        }

        .btn:active {
            transform: scale(0.98);
        }

        .btn-outline {
            background-color: transparent;
            color: var(--rojo-servientrega);
            border: 2px solid var(--rojo-servientrega);
        }

        .btn-outline:hover {
            background-color: var(--rojo-servientrega);
            color: var(--blanco);
        }

        /* Formularios */
        .search-form {
            display: flex;
            gap: 0.5rem;
            margin-bottom: 1.5rem;
            max-width: 500px;
        }

        .search-input {
            flex-grow: 1;
            padding: 0.8rem;
            border: 1px solid var(--gris-borde);
            border-radius: 4px;
            font-size: 1rem;
        }

        .search-input:focus {
            outline: none;
            border-color: var(--rojo-servientrega);
        }

        /* Alertas */
        .alert {
            padding: 1rem;
            border-radius: 4px;
            margin-bottom: 1.5rem;
        }

        .alert-error {
            background-color: #fee2e2;
            color: #991b1b;
            border: 1px solid #f87171;
        }

        /* Pie de página */
        footer {
            background-color: var(--gris-oscuro);
            color: var(--blanco);
            text-align: center;
            padding: 1.5rem;
            margin-top: auto;
        }

        footer p {
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
        }

        /* Responsividad */
        @media (max-width: 768px) {
            header {
                flex-direction: column;
                text-align: center;
                gap: 1rem;
            }
            .search-form {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>

    <!-- Encabezado de la página -->
    <header>
        <div class="logo-container">
            <div class="logo-text">
                <h1>Servientrega S.A.S.</h1>
                <p>Tu envío, nuestra prioridad</p>
            </div>
        </div>
        <nav>
            <a href="{{ route('pedidos.index') }}">Inicio</a>
            <a href="{{ route('pedidos.index') }}">Rastreo</a>
        </nav>
    </header>

    <!-- Contenedor principal donde las demás vistas inyectarán su contenido -->
    <main>
        @yield('content')
    </main>

    <!-- Pie de página con información de contacto ficticia -->
    <footer>
        <p>&copy; {{ date('Y') }} Servientrega S.A.S. - Todos los derechos reservados.</p>
        <p>Centro de Contacto: 01 8000 123 456 | Bogotá: (601) 777 7777</p>
        <p>Atención al cliente: servicioalcliente@servientrega-fake.com</p>
    </footer>

</body>
</html>
