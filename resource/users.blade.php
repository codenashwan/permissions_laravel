<div>
    <x-breadcrumb title="Users Page" desc="This is the user page. You can see all user here." />

    <x-uibutton title="Add New User" icon="plus" modal="simpleModal" />


    <x-modal wire:model.defer="simpleModal">
        <x-card color="bg-slate-800" rounded="rounded-xl">
            <form wire:submit.prevent='save'>
                <p class="text-white mb-2">
                    {{ $title }}
                </p>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                    <x-input required wire:model.defer="name" full placeholder="User Name" icon="pencil"
                        class="p-4 mb-2" />
                    <x-input required wire:model.defer="email" type="email" full placeholder="User Email" icon="mail"
                        class="p-4 mb-2" />
                    <x-input wire:model.defer="password" type="password" full placeholder="User Password" icon="key"
                        class="p-4 mb-2" />
                    <div class="col-span-1 md:col-span-2 grid grid-cols-2 md:grid-cols-3 gap-2 mb-3">
                        @foreach ($all_routes as $key => $value)
                        <label for="route.{{ $value }}"
                            class="flex items-center justify-between w-full gap-2 bg-slate-900 p-3 text-white rounded-xl shadow">
                            <p class="capitalize">{{ $value }}</p>
                            <x-toggle id="route.{{ $value }}" lg wire:model="routes.{{ $value }}" />
                        </label>
                        @endforeach
                    </div>
                </div>
                <x-button green full rounded class="mb-2" type="submit" label="{{ $title }}" lg />
                <x-errors />

            </form>
        </x-card>
    </x-modal>

    <x-input wire:model="search" full placeholder="Search User" icon="search"
        class="p-4 md:w-[400px] !bg-slate-800 my-3" />

    <x-breadcrumb title="Users: " />

    <div class="grid grid-cols-1 mt-2 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-4 gap-3">
        @foreach ($users as $user)
        <div class="rounded-2xl p-4 bg-slate-800 shadow relative h-max">
            <div class="flex absolute top-0 right-0 divide-x divide-slate-700">
                <div class="bg-slate-900 p-3 rounded-bl-2xl cursor-pointer" wire:click="edit({{ $user->id }})">
                    <x-icon name="pencil" class="w-4 h-4 text-white" />
                </div>
                <div class="bg-slate-900 p-3 cursor-pointer" wire:click="lock({{ $user->id }})">
                    @if($user->lock)
                    <x-icon name="lock-closed" class="w-4 h-4 text-red-400" />
                    @else
                    <x-icon name="lock-open" class="w-4 h-4 text-slate-400" />
                    @endif
                </div>
                <a href="mailto:{{ $user->email }}" class="bg-slate-900 p-3 rounded-tr-2xl">
                    <x-icon name="mail" class="w-4 h-4 text-blue-400" />
                </a>
            </div>
            <img src="{{ $user->photo() }}" class="w-[80px] h-[80px] rounded-full object-cover mb-4">
            <p class="text-sm text-slate-400">Name :</p>
            <p class="font-black drop-shadow-xl text-xl mb-3">{{ $user->name }}</p>

            <p class="text-sm text-slate-400">Email :</p>
            <p class="font-black drop-shadow-xl text-xl mb-3 truncate">{{ $user->email }}</p>

            @if($user->routes && count($user->routes) > 0)
            <p class="text-sm text-slate-400">Permissions :</p>
            <div class="flex flex-wrap gap-2 mt-2">
                @foreach ($user->routes as $route)
                <div class="px-3 py-1.5 rounded-md bg-slate-900">
                    {{ $route }}
                </div>
                @endforeach
            </div>
            @endif
        </div>
        @endforeach
    </div>
</div>