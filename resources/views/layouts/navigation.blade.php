<nav x-data="{ open: false }" class="bg-white border-b border-gray-50">
    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="py-3">
            <x-responsive-nav-link :href="route('profile.edit')" class="block px-4 py-2 text-sm text-gray-600 hover:bg-gray-100" style="font-family: Arial, sans-serif;">
                {{ __('Profile') }}
            </x-responsive-nav-link>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <x-dropdown-link :href="route('logout')"
                    onclick="event.preventDefault();
                    this.closest('form').submit();" class="block px-4 py-2 text-sm text-gray-600 hover:bg-gray-100" style="font-family: Arial, sans-serif;">
                    {{ __('Log Out') }}
                </x-dropdown-link>
            </form>
        </div>
    </div>
</nav>
