<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Challenge Api | Asignar Asignatura</title>
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
        <article class="flex flex-column flex-align-content-center ">

            <form action="{{ route('student.subjects-store', $student->slug) }}" method="POST" class="primary-border module-width form flex flex-column">
                @csrf
                @method('POST')

                @if (session('alert-danger'))
                    <div class="alert alert-danger">
                        {{ session('alert-danger') }}
                    </div>
                @endif

                <legend class="form__title">
                    <b>Inscribir Asignatura</b>
                    <p class="text-muted text-sm margin-0">
                        <small class="fs-5">
                            Alumn{{ $student->gender == 'M' ? 'o':'a' }}: <strong>{{ $student->name }} {{ $student->lastname }}
                        </small></strong>
                        ({{ $student->identity_document ?? 'Escolar: Sin Cédula' }})
                    </p>
                </legend>

                <div class="row mb-3 flex flex-justify-content-center">
                    <div class="col-12">
                        <div class="form__item p-0">
                            <label for="subject_id" class="form__label form__label--required">Seleccione la Asignatura</label>
                            <div class="input-group">
                                <span class="form__icon input-group-text @error('subject_id') border-danger text-danger @enderror">
                                    <i class="bi bi-journal-text"></i>
                                </span>

                                <select name="subject_id" id="subject_id" class="form-select @error('subject_id') is-invalid @enderror" autofocus>
                                    <option value="" selected disabled>Seleccione una materia...</option>
                                    @foreach ($materiasSinCalificar as $materia)
                                        <option value="{{ $materia->subject_id }}" {{ old('subject_id') == $materia->subject_id ? 'selected' : '' }}>
                                            {{ $materia->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            @error('subject_id')
                                <span class="form__error-message text-danger text-sm mt-1 d-block">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form__button w-100 my-3 flex flex-justify-content-between gap-2">
                    <button class="button grey-button" type="button" onclick="window.history.back()">
                        <i class="bi bi-box-arrow-in-left"></i>
                        Regresar
                    </button>
                    <button class="button primary-button" type="submit">
                        <i class="bi bi-plus-circle"></i>
                        Asignar Asignatura
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
