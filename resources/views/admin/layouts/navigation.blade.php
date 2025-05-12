
<div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
        {{ __('Dashboard') }}
    </x-nav-link>

    {{-- THIS BLOCK FOR ADMIN LINK --}}
    @if(Auth::check() && Auth::user()->is_admin)
        <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard') || request()->routeIs('admin.products.*')">
            {{ __('Admin') }}
        </x-nav-link>
    @endif
    {{-- END OF ADMIN LINK BLOCK --}}
</div>

{{-- ... other navigation elements ... --}}

{{-- Inside the responsive navigation menu (for smaller screens) --}}
<div class="pt-2 pb-3 space-y-1">
    <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
        {{ __('Dashboard') }}
    </x-responsive-nav-link>

    {{--  THIS BLOCK FOR ADMIN LINK (RESPONSIVE) --}}
    @if(Auth::check() && Auth::user()->is_admin)
        <x-responsive-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard') || request()->routeIs('admin.products.*')">
            {{ __('Admin') }}
        </x-responsive-nav-link>
    @endif
    {{-- END OF ADMIN LINK BLOCK (RESPONSIVE) --}}
</div>