<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Challenge Api | Retirar Materia del Alumno</title>
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
        <article class="flex flex-column flex-align-content-center">

            <form action="{{ route('student.subjects-destroy', ['slug_student' => $student->slug, 'slug_cali' => $subject_cali->slug]) }}"
                 method="POST" class=" primary-border module-width form flex flex-column">
                @csrf
                @method('DELETE')

                <legend class="form__title">
                    <b class="text-red">Retirar Materia: {{ $subject_cali->Subject->name }}</b>
                    <p class="text-muted text-sm margin-0">
                        Alumn{{ $student->gender == 'M' ? 'o':'a' }}: {{ $student->name }} {{ $student->lastname }}
                    </p>
                </legend>

                <div class="alert alert-danger text-red d-flex align-items-center gap-2 my-2" role="alert">
                    <i class="bi bi-exclamation-triangle-fill fs-5"></i>
                    <div>
                        <strong>¡Atención!</strong> Al retirar esta asignatura, se eliminará de forma permanente la calificación acumulada de
                        {{ $student->gender == 'M' ? 'este alumno' : 'esta alumna' }} en esta materia específica.
                    </div>
                </div>

                <div class="my-3 p-3 bg-light rounded border">
                    <h6 class="text-secondary mb-3"><i class="bi bi-journal-x me-2"></i>Detalles de la asignación:</h6>
                    <div class="row">

                        <div class="col-6 mb-2">
                            <span class="text-muted d-block text-sm">Documento de Identidad:</span>
                            <strong class="text-dark fs-5">
                                {{ $student->identity_document }}
                            </strong>
                        </div>

                        <div class="col-6 mb-2">
                            <span class="text-muted d-block text-sm">Calificación Actual en la Asignatura:</span>
                            <strong class="text-dark fs-5">
                                {{ $subject_cali->qualification ?? 'Sin calificar' }}
                            </strong>
                        </div>

                    </div>
                </div>

                <div class="form__button w-100 my-3 flex flex-justify-content-between gap-2">
                    <button class="button grey-button" type="button" onclick="window.history.back()">
                        <i class="bi bi-box-arrow-in-left"></i>
                        Cancelar
                    </button>
                    <button class="button red-button" type="submit">
                        <i class="bi bi-dash-circle"></i>
                        Confirmar Asignatura
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
