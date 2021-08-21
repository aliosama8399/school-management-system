{{--<div>--}}
{{--    --}}{{-- If your happiness depends on money, you will never be happy with yourself. --}}
{{--    <div style="text-align: center">--}}
{{--        <button wire:click="increment">+</button>--}}
{{--        <h1>{{ $count }}</h1>--}}
{{--        <button wire:click="minus">-</button>--}}

{{--    </div>--}}
{{--</div>--}}

<div>
    <input wire:model="search" type="text" placeholder="Search users..."/>

    <ul>
        @foreach($users as $user)
            <li>{{ $user->name }}</li>
        @endforeach
    </ul>
</div>
