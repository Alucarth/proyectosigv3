<div class="mobile-menu md:hidden">
    <div class="mobile-menu-bar">
        <a href="" class="flex mr-auto">
            <img alt="Rubick Tailwind HTML Admin Template" class="w-6" src="dist/images/logo.svg">
        </a>
        <a href="javascript:;" id="mobile-menu-toggler"> <i data-feather="bar-chart-2"
                class="w-8 h-8 text-white transform -rotate-90"></i> </a>
    </div>
    <ul class="border-t border-theme-29 py-5 hidden">
        @role('admin')
        <li>
            <a href="{{ route('form.official') }}" class="menu">
                <div class="menu__icon"> <i data-feather="activity"></i> </div>
                <div class="menu__title"> Oficial </div>
            </a>
        </li>
        <li>
            <a href="javascript:;" class="menu">
                <div class="menu__icon"> <i data-feather="box"></i> </div>
                <div class="menu__title"> Reportes <i data-feather="chevron-down" class="side-menu__sub-icon "></i>
                </div>
            </a>
            <ul class="">
                    <li>
                        <a href=" {{ route('report.person') }}"
                    class="menu">
                    <div class="menu__icon"> <i data-feather="activity"></i> </div>
                    <div class="menu__title"> Persona </div>
                    </a>
            </li>
            <li>
                <a href="simple-menu-dark-dashboard-overview-1.html" class="menu">
                    <div class="menu__icon"> <i data-feather="activity"></i> </div>
                    <div class="menu__title"> Simple Menu </div>
                </a>
            </li>
            <li>
                <a href="top-menu-dark-dashboard-overview-1.html" class="menu">
                    <div class="menu__icon"> <i data-feather="activity"></i> </div>
                    <div class="menu__title"> Top Menu </div>
                </a>
            </li>
        </ul>
        </li>
    @endrole
    @role('oficial')
    <li>
        <a href="{{ route('agreement.institution') }}" class="menu">
            <div class="menu__icon"> <i data-feather="activity"></i> </div>
            <div class="menu__title"> Convenios </div>
        </a>
    </li>
    <li>
        <a href="{{ route('general.list') }}" class="menu">
            <div class="menu__icon"> <i data-feather="activity"></i> </div>
            <div class="menu__title"> Emparejamiento </div>
        </a>
    </li>
    <li>
        <a href="{{ route('contract.institution') }}" class="menu">
            <div class="menu__icon"> <i data-feather="activity"></i> </div>
            <div class="menu__title"> Contratos </div>
        </a>
    </li>
    <li>
        <a href="{{ route('replacement.institution') }}" class="menu">
            <div class="menu__icon"> <i data-feather="activity"></i> </div>
            <div class="menu__title"> Reposicion </div>
        </a>
    </li>
    @endrole
    @role('persona')
    <li>
        <a href="{{ route('data.person') }}" class="menu">
            <div class="menu__icon"> <i data-feather="inbox"></i> </div>
            <div class="menu__title"> Registro </div>
        </a>
    </li>
    <li>
        <a href="{{ route('abilities.person') }}" class="menu">
            <div class="menu__icon"> <i data-feather="inbox"></i> </div>
            <div class="menu__title"> Habilidades </div>
        </a>
    </li>
    @endrole
    @role('empresa')
    <li>
        <a href="{{ route('data.institution') }}" class="menu">
            <div class="menu__icon"> <i data-feather="edit"></i> </div>
            <div class="menu__title"> Registro </div>
        </a>
    </li>
    @if (auth()->user()->institution->estado == 'ACTIVO')
        <li>
            <a href="{{ route('vacancy.institution') }}" class="menu">
                <div class="menu__icon"> <i data-feather="package"></i> </div>
                <div class="menu__title"> Vacancias </div>
            </a>
        </li>
        {{-- <li>
            <a href="{{ route('petition.institution') }}" class="menu">
                <div class="menu__icon"> <i data-feather="book"></i> </div>
                <div class="menu__title"> Reposiciones </div>
            </a>
        </li> --}}
    @endif
    @endrole
    @role('responsable')
    <li>
        <a href="{{ route('assignment.official') }}" class="menu">
            <div class="menu__icon"> <i data-feather="book"></i> </div>
            <div class="menu__title"> Asignacion </div>
        </a>
    </li>
    @endrole
    </ul>
</div>
