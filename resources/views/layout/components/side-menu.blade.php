<nav class="side-nav">
    <a href="" class="intro-x flex items-center pl-5 pt-4">
        <img alt="Rubick Tailwind HTML Admin Template" class="w-6"
            src="{{ asset('dist/images/logo.svg') }}">
        <span class="hidden xl:block text-white text-lg ml-3"> SIG<span class="font-medium">v3</span> </span>
    </a>
    <div class="side-nav__devider my-6"></div>
    <ul>
        @role('admin')
        <li>
            <a href="{{ route('form.official') }}" class="side-menu">
                <div class="side-menu__icon"> <i class="fas fa-user-shield fa-2x"></i> </div>
                <div class="side-menu__title"> Oficiales </div>
            </a>
        </li>
        <li>
            <a href="javascript:;" class="side-menu">
                <div class="side-menu__icon"> <i class="fas fa-file-alt fa-2x"></i> </div>
                <div class="side-menu__title"> Reportes <i data-feather="chevron-down" class="side-menu__sub-icon "></i>
                </div>
            </a>
            <ul class="">
                <li>
                    <a href=" {{ route('report.person') }}"
                class="side-menu">
                <div class="side-menu__icon"> <i class="fas fa-user-friends "></i> </div>
                <div class="side-menu__title"> Personas </div>
                </a>
        </li>
        <li>
            <a href="simple-menu-dark-dashboard-overview-1.html" class="side-menu">
                <div class="side-menu__icon"> <i class="fas fa-laptop-house "></i> </div>
                <div class="side-menu__title"> Empresas </div>
            </a>
        </li>
    
    </ul>
    </li>
    @endrole
    @role('oficial')
    <li>
        <a href="{{ route('agreement.institution') }}" class="side-menu">
            <div class="side-menu__icon"><i class="fa fa-handshake fa-2x"></i> </div>
            <div class="side-menu__title"> Convenios </div>
        </a>
    </li>
    <li>
        <a href="{{ route('general.list') }}" class="side-menu">
            <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
            <div class="side-menu__title"> Emparejamiento </div>
        </a>
    </li>
    <li>
        <a href="{{ route('contract.institution') }}" class="side-menu">
            <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
            <div class="side-menu__title"> Contratos </div>
        </a>
    </li>
    <li>
        <a href="{{ route('replacement.institution') }}" class="side-menu">
            <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
            <div class="side-menu__title"> Reposicion </div>
        </a>
    </li>
    @endrole
    @role('persona')
    <li>
        <a href="{{ route('data.person') }}" class="side-menu">
            <div class="side-menu__icon"> <i data-feather="file-text"></i> </div>
            <div class="side-menu__title"> Registro </div>
        </a>
    </li>
    <li>
        <a href="{{ route('abilities.person') }}" class="side-menu">
            <div class="side-menu__icon"> <i data-feather="shield"></i> </div>
            <div class="side-menu__title"> Habilidades </div>
        </a>
    </li>
    @endrole
    @role('empresa')
    <li>
        <a href="{{ route('institution.dashboard') }}" class="side-menu">
            <div class="side-menu__icon"> <i data-feather="home"></i> </div>
            <div class="side-menu__title"> Inicio </div>
        </a>
    </li>
    <li>
        <a href="{{ route('data.institution') }}" class="side-menu">
            <div class="side-menu__icon"> <i data-feather="edit"></i> </div>
            <div class="side-menu__title"> Registro </div>
        </a>
    </li>
    @if (auth()->user()->institution->estado == 'ACTIVO')
        <li>
            <a href="{{ route('vacancy.institution') }}" class="side-menu">
                <div class="side-menu__icon"> <i data-feather="package"></i> </div>
                <div class="side-menu__title"> Vacancias </div>
            </a>
        </li>
        <li>
            <a href="{{ route('petition.institution') }}" class="side-menu">
                <div class="side-menu__icon"> <i data-feather="book"></i> </div>
                <div class="side-menu__title"> Reposiciones </div>
            </a>
        </li>
    @endif
    @endrole
    @role('responsable')
    <li>
        <a href="{{ route('assignment.official') }}" class="side-menu">
            <div class="side-menu__icon"> <i data-feather="book"></i> </div>
            <div class="side-menu__title"> Asignacion </div>
        </a>
    </li>
    @endrole
    </ul>
</nav>
