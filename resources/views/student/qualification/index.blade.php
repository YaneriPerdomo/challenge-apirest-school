<!doctype html>
<html lang="en" class="height-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Challenge Api | Listado de Calificaciones</title>
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
        <article class="flex flex-column  flex-align-content-center">
            <div class=" primary-border module-width">
                <div class="flex flex-justify-content-between">
                    <div>

                        <legend>
                            <b>Listado de Calificaciones
                            </b><br>
                            <small>
                                {{ $student->name }} {{ $student->lastname }}
                            </small>
                        </legend>

                        <div class="search flex flex-row ">
                            <div class="input-group  search__seeker">
                                <span class="search__icon-wrapper input-group-text" id="product-name-addon">
                                    <i class="bi bi-search search__icon"></i>
                                </span>
                                <input type="text" name="name" id="name" disabled
                                    title="Esta función de búsqueda se encuentra actualmente en desarrollo."
                                    class="search__input  search__input--text form-control" data-url="/alumnos"
                                    placeholder="Buscador temporalmente fuera de servicio..."
                                    aria-label="Buscador temporalmente fuera de servicio..." autofocus
                                    data-name="{{ isset($searchValue) ? str_replace('-', ' ', $searchValue) : '' }}"
                                    value="{{ isset($searchValue) ? str_replace('-', ' ', $searchValue) : '' }}">
                            </div>
                            <div class="search__action">
                                <button class="button search__button primary-button color-white" type="button" disabled
                                    title="Esta función de búsqueda se encuentra actualmente en desarrollo.">
                                    <i class="bi bi-search"></i>
                                    Buscar
                                </button>
                            </div>
                        </div>
                    </div>

                    <div>
                        <a href="{{ route($student->gender == 'M' ? 'student.subjects-male.create' : 'student.subjects-female.create', ['slug' => $student->slug]) }}"
                            class="text-decoration-none text-white">
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
                    @if (session('alert-danger'))
                        <div class="alert alert-danger">
                            {{ session('alert-danger') }}
                        </div>
                    @endif
                    <section class='table'>
                        <table class='dataTable'>
                            <thead>
                                <tr>
                                    <th><i class="bi bi-caret-down-fill" style="  color: rgb(32, 97, 149);"></i></th>
                                    <th>Asignatura</th>
                                    <th>Calificación</th>
                                    <th>Fecha y Hora de Registro</th>
                                    <th>Fecha y Hora de Actualización</th>
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
                                                    <li class="list-none">Utiliza palabras más genéricas o menos
                                                        palabras.
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
                                            <td>{{ $value->subject->name ?? 'Nombre no disponible' }}</td>
                                            <td>
                                                <form action="{{ route('student.subjects-update', $student->slug) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PUT')

                                                    <input type="hidden" name="qualification_id"
                                                        value="{{ $value->qualification_id }}">

                                                    <input type="number" name="qualification" class="form-control"
                                                        value="{{ $value->qualification ?? '' }}" min="0"
                                                        max="20" placeholder="0-20" onchange="this.form.submit()">
                                                </form>
                                            </td>

                                            <td>
                                                {{ formatting_date_h($value->created_at) }}

                                            </td>
                                            <td>
                                                {{ formatting_date_h($value->updated_at) }}

                                            </td>
                                            <td class='table__operations'>
                                                @php
                                                    $urlDelete = $student->gender == 'M' ? 'male' : 'female';
                                                @endphp


                                                <a
                                                    href="{{ route("student.subjects-{$urlDelete}.delete", [
                                                        'slug' => $student->slug,
                                                        'slug_m' => $value->subject->slug,
                                                        'slug_cali' => $value->slug,
                                                    ]) }}">
                                                    <button type="button" class="button red-button ">
                                                        <i class='bi bi-trash'></i>
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
                </div>
            </div>
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
