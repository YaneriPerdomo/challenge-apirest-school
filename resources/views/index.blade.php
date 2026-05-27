<!doctype html>
<html lang="en" class="height-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Challenge Api | Inicio</title>
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

    <style>
        .welcome-box {
            width: clamp(300px, 50%, 1000px);
            height: clamp(200px, 50%, 400px);
        }


    </style>
</head>

<body class="">
    <x-header></x-header>
    <main class="main flex flex-justify-content-center">
        <section class="primary-border  welcome-box welcome-box--primary-border">
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="welcome-note">
                        <h1 class="welcome-note__title fs-4 welcome-note__title--primary primary-text">
                            <b>
                               <span class="note"> </span> Profesional!
                            </b>
                        </h1>
                        <p class="welcome-note__text">
                            <b class="welcome-note__highlight welcome-note__highlight--secondary secondary-text">
                                ¡Bienvenido/a! Este es el motor digital que te permitirá tener la visión y el control
                                total sobre la estructura académica y operativa de nuestra institución,
                            </b>
                            asegurando que cada calificación y registro se ejecute con precisión y eficiencia.
                        </p>

                        <p class="welcome-note__text">
                            Como usuario del sistema, tu principal función en esta plataforma será asegurar que todos
                            los recursos, asignaturas y evaluaciones estén correctamente registrados, asignados y
                            <i class="welcome-note__action welcome-note__action--primary primary-text">
                                listos para el periodo escolar.
                            </i>
                        </p>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="quick-access">
                        <div class="date text-end primary-text">
                            <i class="bi bi-calendar-event-fill "></i>
                            @php
                                function getCurrentDate()
                                {
                                    $day = Date('l');
                                    $nameDaySpanish = '';
                                    switch ($day) {
                                        case 'Monday':
                                            $nameDaySpanish = 'Lunes';
                                            break;
                                        case 'Tuesday':
                                            $nameDaySpanish = 'Martes';
                                            break;
                                        case 'Wednesday':
                                            $nameDaySpanish = 'Miércoles';
                                            break;
                                        case 'Thursday':
                                            $nameDaySpanish = 'Jueves';
                                            break;
                                        case 'Friday':
                                            $nameDaySpanish = 'Viernes';
                                            break;
                                        case 'Saturday':
                                            $nameDaySpanish = 'Sábado';
                                            break;
                                        case 'Sunday':
                                            $nameDaySpanish = 'Domingo';
                                            break;
                                        default:
                                            $nameDaySpanish = null;
                                            break;
                                    }
                                    return $nameDaySpanish . ', ' . Date('d/m/Y');
                                }
                                echo getCurrentDate();
                            @endphp
                        </div>

                        <div class="quick-access__bts">
                            <h2 class="quick-access__title mb-4 fs-4">Accesos Rápidos</h2>

                            <div class="d-flex flex-wrap gap-4 justify-content-start">

                                <a href="{{ route('student.index') }}" class="quick-access__item text-decoration-none">
                                    <div class="quick-access__icon-wrapper quick-access__icon-wrapper--blue">
                                        <i class="bi bi-people-fill"></i>
                                    </div>
                                    <span class="quick-access__label">Gestión de<br>Alumnos</span>
                                </a>

                                <a href="{{ route('teacher.index') }}" class="quick-access__item text-decoration-none">
                                    <div class="quick-access__icon-wrapper quick-access__icon-wrapper--blue">
                                        <i class="bi bi-person-badge-fill"></i>
                                    </div>
                                    <span class="quick-access__label">Gestión de<br>Profesores</span>
                                </a>

                                <a href="{{ route('subject.index') }}" class="quick-access__item text-decoration-none">
                                    <div class="quick-access__icon-wrapper quick-access__icon-wrapper--dark">
                                        <i class="bi bi-journal-bookmark-fill"></i>
                                    </div>
                                    <span class="quick-access__label">Gestión de<br>Asignaturas</span>
                                </a>



                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <x-footer></x-footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
    </script>
 <script src="{{ asset('js/components/header.js') }}" type="module"></script>
 <script src="{{ asset('js/components/addNoteHTML.js') }}" type="module"></script>

</body>

</html>

