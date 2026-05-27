<header class="header">
    <div class="header__content  ">
        <section class="header__logo  container-xl " >
            <strong class="header__logo-text fs-4">
                Challenge Api
            </strong>
        </section>
        <section class="header__navegation">
            <nav  class=" container-xl ">
                <ul class="flex   flex-row padding-0 margin-0   ">
                    <li class="list-none margin-right-1 clickable bar-link" title="Alumnos">
                        <a href="/inicio" class="link-none">
                            Inicio
                        </a>
                    </li>
                    <li class="list-none margin-right-1 clickable bar-link" title="Alumnos">
                        <a href="{{ route('student.index') }}" class="link-none">
                            Alumnos
                        </a>
                    </li>
                    <li class="list-none margin-right-1 clickable bar-link" title="Profesores">
                        <a href="{{ route('teacher.index') }}" class="link-none">
                            Profesores
                        </a>
                    </li>
                    <li class="list-none margin-right-1 clickable bar-link" title="Asignaturas">
                        <a href="{{ route('subject.index') }}" class="link-none">
                            Asignaturas
                        </a>
                    </li>
                </ul>
            </nav>
        </section>
    </div>
</header>
