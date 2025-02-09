<div class="top-bar">
    <!-- BEGIN: Breadcrumb -->
    <div class="-intro-x breadcrumb mr-auto hidden sm:flex">
       
        <a href="{{url('/')}}">Inicio</a> <i data-feather="chevron-right"     class="breadcrumb__icon"></i> <a href="" class="breadcrumb--active"></a>
     </div>
     
    <!-- END: Breadcrumb -->
    <!-- BEGIN: Notifications -->
    <div class="intro-x dropdown mr-auto sm:mr-6">
       <strong>{{ auth()->user()->email }}</strong> 
       
    </div>
    <!-- END: Notifications -->
    <!-- BEGIN: Account Menu -->
    <div class="intro-x dropdown w-8 h-8">
        <div class="dropdown-toggle w-8 h-8 rounded-full overflow-hidden shadow-lg image-fit zoom-in" role="button"
            aria-expanded="false">
            
            <img alt="Rubick Tailwind HTML Admin Template" src="{{ asset('img/user3.png') }}">
         
        </div>
        <div class="dropdown-menu w-56">
            <div class="dropdown-menu__content box bg-theme-26 dark:bg-dark-6 text-white">
                <div class="p-4 border-b border-theme-27 dark:border-dark-3">
                    <div class="font-medium">{{ auth()->user()->email }}</div>
                    
                    {{-- <div class="text-xs text-theme-28 mt-0.5 dark:text-gray-600">Frontend Engineer</div> --}}
                    
                </div>
                <!--
                <div class="p-2">
                    <a href=""
                        class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 dark:hover:bg-dark-3 rounded-md">
                        <i data-feather="user" class="w-4 h-4 mr-2"></i> Profile </a>
                    <a href=""
                        class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 dark:hover:bg-dark-3 rounded-md">
                        <i data-feather="edit" class="w-4 h-4 mr-2"></i> Add Account </a>
                    <a href=""
                        class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 dark:hover:bg-dark-3 rounded-md">
                        <i data-feather="lock" class="w-4 h-4 mr-2"></i> Reset Password </a>
                    <a href=""
                        class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 dark:hover:bg-dark-3 rounded-md">
                        <i data-feather="help-circle" class="w-4 h-4 mr-2"></i> Help </a>
                </div>
                -->
                <div class="p-2">
                    <a href="{{ route('auth.updatePassword') }}"
                        class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 dark:hover:bg-dark-3 rounded-md">
                        <i data-feather="lock" class="w-4 h-4 mr-2"></i> Cambiar Contraseña </a>
                </div>
                <div class="p-2 border-t border-theme-27 dark:border-dark-3">
                    <a href=""
                        class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 dark:hover:bg-dark-3 rounded-md"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> <i
                            data-feather="toggle-right" class="w-4 h-4 mr-2"></i> Salir </a>
                    <form id="logout-form" action="{{ route('auth.logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Account Menu -->
</div>
