<x-layouts.app>
    <x-slot name="title">
        Home
    </x-slot>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                {{--            <div class="card">--}}
                {{--                <div class="card-body">--}}
                {{--                    --}}
                {{--                </div>--}}
                {{--            </div>--}}
            </div>
        </div>
    </div>
</x-layouts.app>
