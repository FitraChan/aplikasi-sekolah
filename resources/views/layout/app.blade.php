<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'PPDB 2026')</title>

    <!-- Google Fonts -->
     
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com">

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
          rel="stylesheet">

    <!-- Tailwind -->
     
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>

     <link href="https://unpkg.com/tabulator-tables@6.5.0/dist/css/tabulator.min.css" rel="stylesheet">
    <script src="{{ asset('public/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('public/ckfinder/ckfinder.js') }}"></script>
<script type="text/javascript" src="https://unpkg.com/tabulator-tables@6.5.0/dist/js/tabulator.min.js"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: {
                            50: '#ecfdf5',
                            100: '#d1fae5',
                            500: '#10b981',
                            600: '#00b686',
                            700: '#047857',
                        },
                        tealAccent: '#00B686',
                        slateInput: '#f8fafc',
                    },

                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <style>

    /* ========================================
       TABULATOR - TAILWIND STYLE
    ======================================== */

    /* ================================
   GLOBAL TABULATOR HEADER
================================ */

.tabulator .tabulator-header {
    background: #f8fafc;
    border-bottom: 1px solid #e2e8f0;
}

.tabulator .tabulator-header .tabulator-col {
    background: #f8fafc;
    color: #0f172a;
    font-size: 15px;
    font-weight: 700;
}

.tabulator .tabulator-header .tabulator-col .tabulator-col-content {
    padding: 14px 12px;
}

.tabulator .tabulator-header .tabulator-col .tabulator-col-title {
    font-size: 15px;
    font-weight: 700;
    color: #0f172a;
}

.tabulator .tabulator-row {
    font-size: 14px;
    color: #334155;
}

.tabulator .tabulator-cell {
    font-size: 14px;
    padding: 12px 12px;
}


/* Kalau ada teks kecil di dalam formatter */
.tabulator .tabulator-cell .text-xs {
    font-size: 13px !important;
}

.tabulator .tabulator-cell .text-sm {
    font-size: 15px !important;
}

    

    .tabulator {
        border: 1px solid #e2e8f0 !important;
        border-radius: 0.75rem;
        overflow: hidden;
        background: #ffffff;
        font-family: inherit;
        font-size: 0.875rem;
    }

    /* HEADER */
    .tabulator .tabulator-header {
        background: #f8fafc !important;
        border-bottom: 1px solid #e2e8f0 !important;
        color: #475569;
        font-weight: 600;
    }

    .tabulator .tabulator-header .tabulator-col {
        background: #f8fafc !important;
        border-right: 1px solid #e2e8f0 !important;
    }

    .tabulator .tabulator-header .tabulator-col-content {
        padding: 0.875rem 1rem;
    }

    .tabulator .tabulator-header .tabulator-col-title {
        font-size: 0.75rem;
        font-weight: 700;
        color: #475569;
    }

    /* ROW */
    .tabulator .tabulator-row {
        background: #ffffff;
        border-bottom: 1px solid #f1f5f9;
        min-height: 52px;
    }

    .tabulator .tabulator-row:hover {
        background: #f8fafc !important;
    }

    .tabulator .tabulator-row.tabulator-row-even {
        background: #ffffff;
    }

    .tabulator .tabulator-row.tabulator-row-even:hover {
        background: #f8fafc !important;
    }

    /* CELL */
    .tabulator .tabulator-cell {
        border-right: 1px solid #f8fafc;
        padding: 0.875rem 1rem;
        color: #334155;
    }

    /* SELECTED */
    .tabulator .tabulator-row.tabulator-selected {
        background: #f0fdfa !important;
    }

    /* SORT ICON */
    .tabulator .tabulator-header .tabulator-col .tabulator-arrow {
        border-bottom-color: #94a3b8;
    }

    /* FILTER */
    .tabulator .tabulator-header-filter input,
    .tabulator .tabulator-header-filter select {
        border: 1px solid #cbd5e1;
        border-radius: 0.5rem;
        padding: 0.5rem 0.75rem;
        font-size: 0.75rem;
        outline: none;
    }

    .tabulator .tabulator-header-filter input:focus,
    .tabulator .tabulator-header-filter select:focus {
        border-color: #14b8a6;
        box-shadow: 0 0 0 2px rgba(20, 184, 166, 0.15);
    }

    /* PAGINATION */
    .tabulator .tabulator-footer {
        background: #ffffff;
        border-top: 1px solid #e2e8f0;
        padding: 0.75rem 1rem;
    }

    .tabulator .tabulator-paginator {
        color: #64748b;
        font-size: 0.75rem;
    }

    .tabulator .tabulator-page {
        border: 1px solid #e2e8f0;
        background: #ffffff;
        color: #475569;
        border-radius: 0.5rem;
        margin: 0 2px;
        padding: 0.4rem 0.7rem;
        font-size: 0.75rem;
    }

    .tabulator .tabulator-page:hover {
        background: #f8fafc;
        border-color: #cbd5e1;
    }

    .tabulator .tabulator-page.active {
        background: #00bfa5;
        border-color: #00bfa5;
        color: #ffffff;
    }

    /* LOADING */
    .tabulator .tabulator-loader {
        background: rgba(255,255,255,0.85);
    }

    .tabulator .tabulator-loader-msg {
        border: 0;
        background: #ffffff;
        border-radius: 0.75rem;
        padding: 1rem 1.5rem;
        color: #64748b;
        box-shadow: 0 10px 30px rgba(15,23,42,0.08);
    }

</style>

    <style>
        html,
        body {
            margin: 0;
            padding: 0;
            width: 100%;
            min-height: 100%;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        input:read-only {
            background-color: #fcfdfe;
        }

        .no-scrollbar::-webkit-scrollbar {
            display: none;
            width: 0;
            height: 0;
        }

        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

       

      
    </style>

    @stack('styles')
</head>

<body class="bg-[#f8fafc] text-slate-700 font-sans antialiased overflow-hidden">
    <div class="h-screen flex w-full overflow-hidden">
        {{-- SIDEBAR --}}
        @include('layout.sidebar')

        {{-- AREA KANAN --}}
        <div class="flex-1 min-w-0 h-screen flex flex-col overflow-hidden">
            {{-- TOP HEADER --}}
            @include('layout.header')

            {{-- CONTENT --}}
            <main class="flex-1 min-w-0 w-full overflow-y-auto">              @include('layout.response')

                @yield('content')
            </main>

        </div>

    </div>

    @include('layout.footer')

    @stack('scripts')

    <script src="https://unpkg.com/lucide@latest"></script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }
    });
</script>

</body>
</html>