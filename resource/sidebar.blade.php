<div @click.away="open = false"
    class="flex flex-col w-full lg:w-[300px] xl:w-[300px] h-max pb-0 xl:pb-5 no-scrollbar rounded-xl bg-slate-800 shadow flex-shrink-0"
    x-data="{ open: false }">
    <div class="flex-shrink-0 px-8 py-4 flex flex-row items-center justify-between">
        <div class="flex flex-row lg:flex-col gap-3 justify-center items-center w-full">
            <img src="{{ Auth::user()->photo() }}"
                class="w-[30px] lg:w-[140px] h-[30px] border-2 lg:border-8 border-slate-900 shadow-2xl lg:h-[140px] rounded-full object-cover">
            <a href="{{ route('/') }}" class="text-lg truncate font-semibold tracking-widest uppercase rounded-lg">Ramin
                Store</a>
            <p class="text-slate-500 hidden lg:block">Hi, {{ Auth::user()->name }}</p>
        </div>
        <button class="rounded-lg lg:hidden" @click="open = !open">
            <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 8 8" height="1em" width="1em"
                xmlns="http://www.w3.org/2000/svg">
                <path d="M0 0v1h8v-1h-8zm0 2.97v1h8v-1h-8zm0 3v1h8v-1h-8z" transform="translate(0 1)">
                </path>
            </svg>
        </button>
    </div>
    <nav :class="{'block': open, 'hidden': !open}"
        class="no-scrollbar flex-grow lg:block px-4 pb-4 lg:pb-0 lg:overflow-y-auto">
        @foreach ($sidebars as $sidebar)
        @if(in_array($sidebar['route'], Auth::user()->routes))
        <a href="{{ route($sidebar['route']) }}"
            class="p-2.5 bg-slate-900 w-full flex gap-3 items-center rounded-xl text-lg transition-all duration-500 hover:scale-105 mt-3">
            @if(Route::currentRouteName() == $sidebar['route'])
            <div class="bg-green-400 animate-pulse rounded-full w-[10px] h-[10px] relative"></div>
            @endif
            <div class="bg-slate-800 rounded-2xl w-[40px] h-[40px] relative">
                <x-icon name="{{ $sidebar['icon'] }}" class="w-[15px] centered" />
            </div>
            {{ $sidebar['name'] }}
        </a>
        @endif
        @endforeach
        <a href="{{ route('logout') }}"
            onclick="event.preventDefault(); document.getElementById('frm-logout').submit();"
            class="p-2.5 bg-red-400 w-full flex gap-3 items-center rounded-xl text-lg transition-all duration-500 hover:scale-105 mt-3">
            <div class="bg-red-800 rounded-2xl w-[40px] h-[40px] relative">
                <x-icon name="logout" class="w-[15px] centered" />
            </div>
            Logout
        </a>
        <form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
            {{ csrf_field() }}
        </form>
    </nav>
</div>