    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Challenge Api | Editar Asignatura: {{ $subject->name ?? '' }}</title>
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

    <body class="">
        <x-header></x-header>
        <main class="main flex flex-justify-content-center">
            <article class="flex flex-column  flex-align-content-center  ">
                <form action="{{ route('subject.update', $subject->slug) }}" method="POST"
                    class="form flex flex-column primary-border module-width">
                    @csrf
                    @method('PUT')

                    <legend class="form__title">
                        <b>Editar Asignatura</b>
                    </legend>

                    <div class="form__item mb-3">
                        <label for="name" class="form__label form__label--required">Nombre de la Asignatura</label>
                        <div class="input-group">
                            <span class="form__icon input-group-text @error('name') border-danger text-danger @enderror"
                                id="name-addon">
                                <i class="bi bi-type"></i>
                            </span>
                            <input type="text" name="name" id="name"
                                class="form-control @error('name') is-invalid @enderror" placeholder="Ej: Matemáticas"
                                aria-label="name de la Asignatura" autofocus value="{{ old('name', $subject->name) }}">
                        </div>
                        @error('name')
                            <span class="form__error-message text-danger text-sm mt-1 d-block">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form__item mb-3">
                        <label for="description" class="form__label form__label--required">Descripción de la
                            Asignatura(Opcional)</label>
                        <div class="input-group">
                            <span
                                class="form__icon input-group-text @error('description') border-danger text-danger @enderror"
                                id="description-addon">
                                <i class="bi bi-card-text"></i>
                            </span>
                            <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror"
                                placeholder="Una breve descripción de la asignatura..." aria-label="Descripción de la Asignatura" rows="4">{{ old('description', $subject->description) }}</textarea>
                        </div>
                        @error('description')
                            <span class="form__error-message text-danger text-sm mt-1 d-block">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form__button w-100 my-3 flex flex-justify-content-between gap-2">
                        <button class="button grey-button" type="button" onclick="window.history.back()">
                            <i class="bi bi-box-arrow-in-left"></i>
                            Regresar
                        </button>
                        <button class="button primary-button" type="submit">
                            <i class="bi bi-arrow-clockwise"></i>
                            Guardar Cambios
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
