<!doctype html>
<html lang="en" class="height-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Challenge Api | Listado de Asignaturas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/layouts/base.css') }}">
    <link rel="stylesheet" href="{{ asset('css/utilities.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components/table.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components/search.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components/button.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components/quick-access.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components/pagination.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="icon" type="image/x-icon" href="{{ asset('img/logo.ico') }}">

</head>

<body class="">
    <x-header></x-header>
    <main class="main flex flex-justify-content-center">
        <article class="flex flex-column flex-align-content-center ">
            <div class="primary-border module-width"><div class="flex flex-justify-content-between">
                <div>
                    <legend><b>Listado de Asignaturas</b></legend>
                    <div class="search flex flex-row ">
                        <div class="input-group  search__seeker">
                            <span class="search__icon-wrapper input-group-text" id="product-name-addon">
                                <i class="bi bi-search search__icon"></i>
                            </span>
                            <input type="text" name="name" id="name" class="search__input  search__input--text form-control"
                                data-url="/asignaturas" placeholder="Ingresa el nombre de asignatura para buscar"
                                aria-label="Ingresa el nombre de asignatura para buscar" autofocus
                                data-name="{{ isset($searchValue) ? str_replace('-', ' ', $searchValue) : '' }}"
                                value="{{ isset($searchValue) ? str_replace('-', ' ', $searchValue) : '' }}">
                        </div>
                        <div class="search__action">
                            <button class="button search__button primary-button color-white" type="button">
                                <i class="bi bi-search"></i>
                                Buscar
                            </button>
                        </div>
                    </div>
                </div>
                <div>
                    <a href="{{ route('subject.create') }}" class="text-decoration-none text-white">
                        <button class="button black-button">
                            <i class="bi bi-plus-circle"></i>
                            Registrar Nueva Asignatura
                        </button>
                    </a>
                </div>
            </div>
            <div class="">
                @if (session('alert-success'))
                    <div class="alert alert-success">
                        {{ session('alert-success') }}
                    </div>
                @endif

                <section class='table'>
                    <table class='dataTable'>
                        <thead>
                            <tr>
                                <th><i class="bi bi-caret-down-fill" style="  color: rgb(32, 97, 149);"></i></th>
                                <th>Nombre de la Asignatura</th>

                                <th>Descripción de la Asignatura</th>
                                <th>Fecha de Regristro</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($subjects->items() == [])
                                <tr>
                                    <td colspan="7" style="text-align: center;">
                                        @if (isset($searchValue))
                                            <br>
                                            <p>Por el momento no hay registros que coincidan con tu búsqueda.</p>
                                            <ul>
                                                <li class="list-none">Revisa la ortografía de la palabra.</li>
                                                <li class="list-none">Utiliza palabras más genéricas o menos palabras.
                                                </li>
                                            </ul>
                                        @else
                                            <br>
                                            <p>Por el momento no hay información guardada en esta sección.</p>
                                        @endif
                                    </td>
                                </tr>
                            @else
                                @foreach ($subjects->items() as $value)
                                    <tr class='show'>
                                        <td><i class="bi bi-caret-down-fill"></i></td>
                                        <td>{{ $value->name }}</td>
                                        <td>{{ $value->description }}</td>
                                        <td>
                                                {{ \Carbon\Carbon::parse($value->created_at)->format('d/m/Y') }}

                                        </td>
                                        <td class='table__operations'>

                                            <a href="{{ route('subject.edit', $value->slug) }} ">
                                                <button class="button green-button">
                                                    <i class="bi bi-pencil-square"></i>
                                                </button>
                                            </a>
                                            <a href="{{ route('subject.delete', $value->slug) }}">
                                                <button type="button" class="button red-button ">
                                                    <i class='bi bi-trash''></i>
                                                                    </button>
                                                                </a>
                                                            </td>
                                                        </tr>
                                @endforeach
                            @endif
                                    </tbody>
                                </table>
                            </section>
                            <div>
                            </div>
                            <div class="flex-justify-content-between">
                                <div>
                                    <small>
                                        Mostrando {{ $subjects->count() == 1 ? 'registro' : 'registros' }} 1 -
                                        {{ $subjects->count() }}
                                        de un total de {{ $subjects->total() }}
                                    </small>
                                </div>
                                <div>
                                    {{ $subjects->links() }}
                                </div>
                            </div>
                        </div></div>

        </article>
    </main>
    <x-footer></x-footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
    </script>
</body>
<script src="{{ asset('js/variables.js') }}" type="module"></script>
<script src="{{ asset('js/components/buttonSearch.js') }}" type="module"></script>
 <script src="{{ asset('js/components/header.js') }}" type="module"></script>
</html>
