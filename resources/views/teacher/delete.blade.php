<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Challenge Api | Eliminar Profesor {{ $teacher->gender == 'M' ? ' ': 'a' }} - {{ $teacher->names }}</title>
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
    <link rel="stylesheet" href="{{ asset('css/components/alert.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components/pagination.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="icon" type="image/x-icon" href="{{ asset('img/logo.ico') }}">

</head>

<body>
    <x-header></x-header>

    <main class="main flex flex-justify-content-center">
        <article class="flex flex-column  flex-align-content-center  ">

            <form action="{{ route('teacher.destroy', $teacher->slug) }}" method="POST" class="form flex flex-column primary-border module-width">
                @csrf
                @method('DELETE')

                <legend class="form__title">
                    <b class="text-red">Eliminar {{ $teacher->gender == 'M' ? 'profesor' : 'profesora' }}: {{ $teacher->names }} {{ $teacher->lastnames }}</b>
                    <p class="text-muted   margin-0">
                        Esta acción no se puede deshacer. Por favor, asegúrate de que realmente deseas borrar a este docente del sistema escolar.
                    </p>
                </legend>

                <div class="alert alert-danger text-red d-flex align-items-center gap-2 my-2" role="alert">
                    <i class="bi bi-exclamation-triangle-fill fs-5"></i>
                    <div>
                        <strong>¡Atención!</strong> Al eliminar a est{{ $teacher->gender == 'M' ? 'e profesor' : 'a profesora' }}, la asignatura vinculada quedará libre en el sistema para ser asignada a otro docente.
                    </div>
                </div>

                <div class="my-3 p-3 bg-light rounded border">
                    <h6 class="text-secondary mb-3"><i class="bi bi-person-badge me-2"></i>Datos del registro:</h6>
                    <div class="row">

                        <div class="col-6 mb-2">
                            <span class="text-muted d-block text-sm">Documento de Identidad:</span>
                            <strong class="text-dark fs-5">
                                {{ $teacher->identity_document }}
                            </strong>
                        </div>

                        <div class="col-6 mb-2">
                            <span class="text-muted d-block text-sm">Asignatura que Dicta:</span>
                            <strong class="text-dark fs-5">
                                <i class="bi bi-book me-1 text-secondary"></i>
                                {{ $teacher->subject->name ?? 'Ninguna asignada' }}
                            </strong>
                        </div>

                    </div>
                </div>

                <div class="form__button w-100 my-3 flex flex-justify-content-between gap-2">
                    <button class="button grey-button" type="button" onclick="window.history.back()">
                        <i class="bi bi-box-arrow-in-left"></i>
                        Regresar
                    </button>
                    <button class="button red-button" type="submit">
                        <i class="bi bi-trash"></i>
                        Confirmar Eliminación
                    </button>
                </div>
            </form>

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
