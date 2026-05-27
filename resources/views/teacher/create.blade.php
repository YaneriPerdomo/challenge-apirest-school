<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Challenge Api | Registrar Nuevo Profesor</title>
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
        <article class="flex flex-column  flex-align-content-center ">

            <form action="{{ route('teacher.store') }}" method="POST" class="form flex flex-column primary-border module-width">
                @csrf
                @method('POST')

                @if (session('alert-danger'))
                    <div class="alert alert-danger">
                        {{ session('alert-danger') }}
                    </div>
                @endif

                <legend class="form__title">
                    <b>Registrar Nuevo Profesor</b>
                </legend>

                <div class="row mb-3">
                    <div class="col-6">
                        <div class="form__item p-0">
                            <label for="names" class="form__label form__label--required">Nombres</label>
                            <div class="input-group">
                                <span class="form__icon input-group-text @error('names') border-danger text-danger @enderror">
                                    <i class="bi bi-person"></i>
                                </span>
                                <input type="text" name="names" id="names"
                                    class="form-control @error('names') is-invalid @enderror" placeholder="Ej: Nelson"
                                    autofocus value="{{ old('names') }}">
                            </div>
                            @error('names')
                                <span class="form__error-message text-danger text-sm mt-1 d-block"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form__item p-0">
                            <label for="lastnames" class="form__label form__label--required">Apellidos</label>
                            <div class="input-group">
                                <span class="form__icon input-group-text @error('lastnames') border-danger text-danger @enderror">
                                    <i class="bi bi-person-fill"></i>
                                </span>
                                <input type="text" name="lastnames" id="lastnames"
                                    class="form-control @error('lastnames') is-invalid @enderror"
                                    placeholder="Ej: Marín" value="{{ old('lastnames') }}">
                            </div>
                            @error('lastnames')
                                <span class="form__error-message text-danger text-sm mt-1 d-block"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-6">
                        <div class="form__item p-0">
                            <label for="identity_document" class="form__label form__label--required">Cédula de Identidad</label>
                            <div class="input-group">
                                <span class="form__icon input-group-text @error('identity_document') border-danger text-danger @enderror">
                                    <i class="bi bi-person-vcard"></i>
                                </span>
                                <input type="text" name="identity_document" id="identity_document"
                                    class="form-control @error('identity_document') is-invalid @enderror"
                                    placeholder="Ej: V-24123456" value="{{ old('identity_document') }}">
                            </div>
                            @error('identity_document')
                                <span class="form__error-message text-danger text-sm mt-1 d-block"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-6">
                          <div class="form__item p-0">
                                <label for="gender" class="form__label form__label--required">Género</label>
                                <div class="input-group">
                                    <span
                                        class="form__icon input-group-text @error('gender') border-danger text-danger @enderror">
                                        <i class="bi bi-gender-ambiguous"></i>
                                    </span>
                                    <select name="gender" id="gender"
                                        class="form-select @error('gender') is-invalid @enderror">
                                        <option value="" selected disabled>Seleccione...</option>
                                        <option value="M" {{ old('gender') == 'M' ? 'selected' : '' }}>Masculino
                                            (M)</option>
                                        <option value="F" {{ old('gender') == 'F' ? 'selected' : '' }}>Femenina
                                            (F)</option>
                                    </select>
                                </div>
                                @error('gender')
                                    <span
                                        class="form__error-message text-danger text-sm mt-1 d-block"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                    </div>
                </div>
                <div class="form__item p-0">
                    <label for="subject_id" class="form__label form__label--required">Asignatura a Dictar</label>
                    <div class="input-group">
                        <span class="form__icon input-group-text @error('subject_id') border-danger text-danger @enderror">
                            <i class="bi bi-book"></i>
                        </span>

                        <select name="subject_id" id="subject_id" class="form-select @error('subject_id') is-invalid @enderror">
                            <option value="" selected disabled>Seleccione una asignatura...</option>

                            @foreach ($asignaturas as $asignatura)
                            <option value="{{ $asignatura->subject_id }}" {{ old('subject_id')==$asignatura->subject_id ? 'selected' :
                                '' }}>
                                {{ $asignatura->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    @error('subject_id')
                    <span class="form__error-message text-danger text-sm mt-1 d-block"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
                <div class="form__button w-100 my-3 flex flex-justify-content-between gap-2">
                    <button class="button grey-button" type="button" onclick="window.history.back()">
                        <i class="bi bi-box-arrow-in-left"></i>
                        Regresar
                    </button>
                    <button class="button primary-button" type="submit">
                        <i class="bi bi-save"></i>
                        Guardar Profesor
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
