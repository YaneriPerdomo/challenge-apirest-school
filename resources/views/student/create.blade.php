    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Challenge Api | Registrar Nuevo Alumno</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/layouts/base.css') }}">
    <link rel="stylesheet" href="{{ asset('css/utilities.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components/table.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components/search.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components/form.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components/button.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components/quick-access.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components/alert.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components/pagination.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="icon" type="image/x-icon" href="{{ asset('img/logo.ico') }}">



    </head>

    <body class="">
        <x-header></x-header>
        <main class="main flex flex-justify-content-center ">
            <article class="flex flex-column flex-align-content-center ">
                <form action="{{ route('student.store') }}" method="POST"
                    class="form flex flex-column    primary-border module-width">
                    @csrf
                    @method('POST')
                    @if (session('alert-danger'))
                        <div class="alert alert-danger">
                            {{ session('alert-danger') }}
                        </div>
                    @endif
                    <legend class="form__title">
                        <b>Registrar Nuevo Alumno</b>
                    </legend>

                    <div class="row mb-3">
                        <div class="col-lg-6 col-12">
                            <div class="form__item p-0">
                                <label for="name" class="form__label form__label--required">Nombres</label>
                                <div class="input-group">
                                    <span
                                        class="form__icon input-group-text @error('name') border-danger text-danger @enderror">
                                        <i class="bi bi-person"></i>
                                    </span>
                                    <input type="text" name="name" id="name"
                                        class="form-control @error('name') is-invalid @enderror" placeholder="Ej: Juan"
                                        autofocus value="{{ old('name') }}">
                                </div>
                                @error('name')
                                    <span
                                        class="form__error-message text-danger text-sm mt-1 d-block"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-6 col-12">
                            <div class="form__item p-0">
                                <label for="lastname" class="form__label form__label--required">Apellidos</label>
                                <div class="input-group">
                                    <span
                                        class="form__icon input-group-text @error('lastname') border-danger text-danger @enderror">
                                        <i class="bi bi-person-fill"></i>
                                    </span>
                                    <input type="text" name="lastname" id="lastname"
                                        class="form-control @error('lastname') is-invalid @enderror"
                                        placeholder="Ej: Pérez" value="{{ old('lastname') }}">
                                </div>
                                @error('lastname')
                                    <span
                                        class="form__error-message text-danger text-sm mt-1 d-block"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-lg-6 col-12">
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

                        <div class="col-lg-6 col-12">
                            <div class="form__item p-0">
                                <label for="birth" class="form__label form__label--required">Fecha de
                                    Nacimiento</label>
                                <div class="input-group">
                                    <span
                                        class="form__icon input-group-text @error('birth') border-danger text-danger @enderror">
                                        <i class="bi bi-calendar-event"></i>
                                    </span>
                                    <input type="date" name="birth" id="birth"
                                        class="form-control @error('birth') is-invalid @enderror"
                                        value="{{ old('birth') }}">
                                </div>
                                @error('birth')
                                    <span
                                        class="form__error-message text-danger text-sm mt-1 d-block"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-lg-6 col-12">
                            <div class="form__item p-0">
                                <label for="identity_document" class="form__label">Documento de Identidad del Alumno
                                    (Opcional)</label>
                                <div class="input-group">
                                    <span
                                        class="form__icon input-group-text @error('identity_document') border-danger text-danger @enderror">
                                        <i class="bi bi-person-vcard"></i>
                                    </span>
                                    <input type="text" name="identity_document" id="identity_document"
                                        class="form-control @error('identity_document') is-invalid @enderror"
                                        placeholder="Dejar vacío si no posee" value="{{ old('identity_document') }}">
                                </div>
                                @error('identity_document')
                                    <span
                                        class="form__error-message text-danger text-sm mt-1 d-block"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-6 col-12">
                            <div class="form__item p-0" id="wrapper-mother-document">
                                <label for="mother_s_identity_document" class="form__label"
                                    id="label-mother">Documento de Identidad
                                    de la Madre / Representante</label>
                                <div class="input-group">
                                    <span
                                        class="form__icon input-group-text @error('mother_s_identity_document') border-danger text-danger @enderror">
                                        <i class="bi bi-person-vcard"></i>
                                    </span>
                                    <input type="text" name="mother_s_identity_document"
                                        id="mother_s_identity_document"
                                        class="form-control @error('mother_s_identity_document') is-invalid @enderror"
                                        placeholder="Obligatorio si el niño no posee"
                                        value="{{ old('mother_s_identity_document') }}">
                                </div>
                                @error('mother_s_identity_document')
                                    <span
                                        class="form__error-message text-danger text-sm mt-1 d-block"><strong>{{ $message }}</strong></span>
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
                            <i class="bi bi-save"></i>
                            Guardar Alumno
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
