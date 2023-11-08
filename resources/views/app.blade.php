<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('img/apple-icon.png') }}"/>
    <link rel="icon" type="image/png" href="{{ asset('img/favicon.png') }}"/>
    <title inertia>{{ config('app.name', 'GEL') }}</title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Urbanist:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,900&display=swap" rel="stylesheet">

    <!-- Nucleo Icons -->
    <link href="{{ asset('css/nucleo-icons.css') }}" rel="stylesheet"/>
    <link href="{{ asset('css/nucleo-svg.css') }}" rel="stylesheet"/>

    <script>
        loadStylesheet("{{ env('ASSET_URL') ? env('ASSET_URL').'/css/full-calendar.css':env('APP_URL').'/css/full-calendar.css'}}");
        loadStylesheet("{{ env('ASSET_URL') ? env('ASSET_URL')."/css/full-calendar.css":env('APP_URL')."/css/full-calendar.css"}}");
        loadStylesheet("{{ env('ASSET_URL') ? env('ASSET_URL')."/css/tooltips.css":env('APP_URL')."/css/tooltips.css"}}");
        loadStylesheet("{{ env('ASSET_URL') ? env('ASSET_URL')."/css/noui-slider.css":env('APP_URL')."/css/noui-slider.css"}}");
        loadStylesheet("{{ env('ASSET_URL') ? env('ASSET_URL')."/css/choices.css":env('APP_URL')."/css/choices.css"}}");
        loadStylesheet("{{ env('ASSET_URL') ? env('ASSET_URL')."/css/leaflet.css":env('APP_URL')."/css/leaflet.css"}}");
        loadStylesheet("{{ env('ASSET_URL') ? env('ASSET_URL')."/css/editor-quill.css":env('APP_URL')."/css/editor-quill.css"}}");
        loadStylesheet("{{ env('ASSET_URL') ? env('ASSET_URL')."/css/flatpickr.css":env('APP_URL')."/css/flatpickr.css"}}");
        loadStylesheet("{{ env('ASSET_URL') ? env('ASSET_URL')."/css/dropzone.css":env('APP_URL')."/css/dropzone.css"}}");
        loadStylesheet("{{ env('ASSET_URL') ? env('ASSET_URL')."/css/kanban.css":env('APP_URL')."/css/kanban.css"}}");
        loadStylesheet("{{ env('ASSET_URL') ? env('ASSET_URL')."/css/datatable.css":env('APP_URL')."/css/datatable.css"}}");
        loadStylesheet("{{ env('ASSET_URL') ? env('ASSET_URL')."/css/sweet-alerts.css":env('APP_URL')."/css/sweet-alerts.css"}}");
        loadStylesheet("{{ env('ASSET_URL') ? env('ASSET_URL')."/css/photo-swipe.css":env('APP_URL')."/css/photo-swipe.css"}}");

        function loadStylesheet(FILE_URL) {
            let dynamicStylesheet = document.createElement("link");

            dynamicStylesheet.setAttribute("href", FILE_URL);
            dynamicStylesheet.setAttribute("type", "text/css");
            dynamicStylesheet.setAttribute("rel", "stylesheet");

            document.head.appendChild(dynamicStylesheet);
        }
    </script>
    <script defer data-site="globaledulink.co.uk" src="https://api.nepcha.com/js/nepcha-analytics.js"></script>
    @routes
    @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
    @inertiaHead
</head>

<body
    class="m-0 font-sans text-base antialiased font-normal text-left leading-default dark:bg-slate-950 bg-gray-50 text-slate-500 dark:text-white">
@inertia
</body>
</html>
