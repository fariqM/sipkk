<header class="main-heading">
    <!-- begin dashhead -->
    <div class="dashhead bg-white">
        {{-- <div class="dashhead-titles">
            <h6 class="dashhead-subtitle">
                {{ config('app.name', 'Laravel') }}
                / {{ \Request::route()->getName() }}
            </h6>
            <h3 class="dashhead-title">Konten Dasbor</h3>
        </div> --}}

        <div class="dashhead-toolbar">
            <div class="dashhead-toolbar-item">
                <a href="/">{{ config('app.name', 'Laravel') }}</a>
                / {{ $slot }}
            </div>
        </div>
    </div>
    <!-- END: dashhead -->
</header>