<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
        <aside class="w-52 h-screen bg-white border-r border-gray-200 fixed top-0 left-0 ">
        <!-- Logo + Title -->
        <div class="flex items-center justify-center h-16 border-b px-2">
            <a href="{{ route('dashboard') }}" class="flex items-center space-x-2">
                <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                <span class="font-semibold text-blue-700 text-md">Hotel Pusaka Mulya</span>
            </a>
        </div>

        <!-- Dashboard -->
<nav class="mt-3 space-y-1">
    <x-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')" class="flex items-center gap-3 w-full h-11 rounded-md pl-4 font-semibold text-gray-400 hover:bg-gray-300 hover:text-gray-900 transition">
        <i data-feather="home" class="h-5 w-5"></i>
        {{ __('Dashboard') }}
    </x-nav-link>
</nav>

<!-- Manajemen Kamar -->
<nav class="mt-2 space-y-1">
    <x-nav-link href="{{ route('rooms.index') }}" :active="request()->routeIs('rooms.index')" class="flex items-center gap-3 w-full h-11 rounded-md pl-4 font-semibold text-gray-400 hover:bg-gray-300 hover:text-gray-900 transition">
        <i data-feather="grid" class="h-5 w-5"></i>
        {{ __('Manajemen Kamar') }}
    </x-nav-link>
</nav>


<!-- Manajemen Pegawai -->
<nav class="mt-2 space-y-1">
    <x-nav-link href="{{ route('employees.index') }}" :active="request()->routeIs('employees.index')" class="flex items-center gap-3 w-full h-11 rounded-md pl-4 font-semibold text-gray-400 hover:bg-gray-300 hover:text-gray-900 transition">
        <i data-feather="users" class="h-5 w-5"></i>
        {{ __('Manajemen Pegawai') }}
    </x-nav-link>
</nav>

<!-- Laporan Kerusakan -->
<nav class="mt-2 space-y-1">
    <x-nav-link href="{{ route('maintenances.index') }}" :active="request()->routeIs('maintenances.index')" class="flex items-center gap-3 w-full h-11 rounded-md pl-4 text-gray-400 hover:bg-gray-300 hover:text-gray-900 transition">
        <i data-feather="alert-circle" class="h-5 w-5"></i>
        {{ __('Laporan Keusakan') }}
    </x-nav-link>
</nav>

@role('admin')
<!-- Laporan Keuangan -->
<nav class="mt-2 space-y-1">
    <x-nav-link href="{{ route('finances.index') }}" :active="request()->routeIs('finances.index')" class="flex items-center gap-3 w-full h-11 rounded-md pl-4 font-semibold text-gray-400 hover:bg-gray-300 hover:text-gray-900 transition">
        <i data-feather="dollar-sign" class="h-5 w-5"></i>
        {{ __('Laporan Keuangan') }}
    </x-nav-link>
</nav>

<!-- Laporan Kamar -->
<nav class="mt-2 space-y-1">
    <x-nav-link href="{{ route('reservations.index') }}" :active="request()->routeIs('reservations.index')" class="flex items-center gap-3 w-full h-11 rounded-md pl-4 font-semibold text-gray-400 hover:bg-gray-300 hover:text-gray-900 transition">
        <i data-feather="file-text" class="h-5 w-5"></i>
        {{ __('Laporan Reservasi Kamar') }}
    </x-nav-link>
</nav>
@endrole

        
    </aside>

            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
