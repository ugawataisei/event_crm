@if (Route::has('login'))
    @auth
        <div class="col-md-2 offset-md-5">
            <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">
                {{ __('message.btn_labels.dashboard') }}
            </a>
        </div>
    @else
        <div class="col-md-2 offset-md-3">
            <button type="button" onclick="location.href='{{ route('login') }}'"
                    class="btn btn-dark">
                <i class="fa-solid fa-unlock-keyhole"></i>{{ __('message.btn_labels.login') }}
            </button>
        </div>
        <div class="col-md-2">
            @if (Route::has('register'))
                <button type="button" onclick="location.href='{{ route('register') }}'"
                        class="btn btn-secondary">
                    <i class="fa-solid fa-address-card"></i>{{ __('message.btn_labels.register') }}
                </button>
            @endif
        </div>
    @endauth
@endif
