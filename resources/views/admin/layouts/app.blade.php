<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin') — FindState</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('css')
</head>
<body class="min-h-screen bg-canvas text-ink">
    {{-- Desktop sidebar: fixed 256px (w-64) from lg --}}
    <aside class="fixed inset-y-0 left-0 z-30 hidden w-64 border-r border-line bg-white lg:block">
        <div class="flex h-16 items-center gap-2 border-b border-line px-5">
            <span class="inline-flex h-9 w-9 items-center justify-center rounded-sm bg-brand text-white"><i class="fas fa-building" aria-hidden="true"></i></span>
            <span class="text-sm font-bold">FindState Admin</span>
        </div>
        @include('admin.layouts.sidebar-nav')
    </aside>

    <div class="flex min-h-screen min-w-0 flex-col lg:pl-64">
        <header class="sticky top-0 z-20 flex h-16 items-center justify-between gap-3 border-b border-line bg-white px-4 sm:px-6">
            <div class="flex min-w-0 flex-1 items-center gap-3">
                <button type="button" id="admin-nav-open" class="inline-flex h-11 w-11 shrink-0 items-center justify-center rounded-sm border border-line lg:hidden" aria-label="Open sidebar">
                    <i class="fas fa-bars" aria-hidden="true"></i>
                </button>
                <p class="truncate text-sm font-semibold text-ink">@yield('title', 'Dashboard')</p>
            </div>
            <div class="flex shrink-0 items-center gap-3">
                <span class="hidden max-w-[10rem] truncate text-sm font-medium text-ink-secondary sm:inline" title="{{ Auth::user()?->name }}">
                    {{ Auth::user()?->name }}
                </span>
                <a href="{{ route('home') }}" class="hidden text-sm font-medium text-ink-secondary transition-ui hover:text-ink sm:inline">View site</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-button type="submit" variant="ghost">Logout</x-button>
                </form>
            </div>
        </header>

        <main class="flex-1 p-4 sm:p-6 lg:p-8">
            <div class="mx-auto w-full max-w-[1600px]">
                @if(session('success'))
                    <div class="mb-6 flex items-start justify-between gap-3 rounded-sm border border-brand/20 bg-brand-light px-4 py-3 text-sm text-brand" role="status" data-flash>
                        <p>{{ session('success') }}</p>
                        <button type="button" class="inline-flex h-11 w-11 shrink-0 items-center justify-center rounded-sm text-brand" aria-label="Dismiss" data-flash-dismiss>
                            <i class="fas fa-times" aria-hidden="true"></i>
                        </button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="mb-6 flex items-start justify-between gap-3 rounded-sm border border-danger/20 bg-danger/10 px-4 py-3 text-sm text-danger" role="alert" data-flash>
                        <p>{{ session('error') }}</p>
                        <button type="button" class="inline-flex h-11 w-11 shrink-0 items-center justify-center rounded-sm text-danger" aria-label="Dismiss" data-flash-dismiss>
                            <i class="fas fa-times" aria-hidden="true"></i>
                        </button>
                    </div>
                @endif

                @if($errors->any())
                    <div class="mb-6 rounded-sm border border-danger/20 bg-danger/10 px-4 py-3 text-sm text-danger" role="alert" data-flash>
                        <div class="flex items-start justify-between gap-3">
                            <div>
                                <p class="font-semibold">Please fix the following errors:</p>
                                <ul class="mt-2 list-disc space-y-1 pl-5">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            <button type="button" class="inline-flex h-11 w-11 shrink-0 items-center justify-center rounded-sm text-danger" aria-label="Dismiss" data-flash-dismiss>
                                <i class="fas fa-times" aria-hidden="true"></i>
                            </button>
                        </div>
                    </div>
                @endif

                @yield('content')
            </div>
        </main>
    </div>

    {{-- Mobile sidebar drawer (kept in DOM; slide with translate + invisible) --}}
    <div id="admin-backdrop" class="fixed inset-0 z-40 bg-ink/40 opacity-0 pointer-events-none invisible transition-ui lg:invisible"></div>
    <aside id="admin-drawer" class="fixed inset-y-0 left-0 z-50 w-72 -translate-x-full border-r border-line bg-white shadow-lg transition-ui invisible pointer-events-none lg:invisible" aria-label="Admin menu">
        <div class="flex h-16 items-center justify-between border-b border-line px-4">
            <span class="text-sm font-bold">Menu</span>
            <button type="button" id="admin-nav-close" class="inline-flex h-11 w-11 items-center justify-center rounded-sm border border-line" aria-label="Close sidebar">
                <i class="fas fa-times" aria-hidden="true"></i>
            </button>
        </div>
        @include('admin.layouts.sidebar-nav')
    </aside>

    <script>
    (function () {
        var openBtn = document.getElementById('admin-nav-open');
        var closeBtn = document.getElementById('admin-nav-close');
        var drawer = document.getElementById('admin-drawer');
        var backdrop = document.getElementById('admin-backdrop');

        function setOpen(v) {
            if (!drawer || !backdrop) return;
            drawer.classList.toggle('invisible', !v);
            drawer.classList.toggle('pointer-events-none', !v);
            drawer.classList.toggle('-translate-x-full', !v);
            drawer.classList.toggle('translate-x-0', v);
            backdrop.classList.toggle('invisible', !v);
            backdrop.classList.toggle('pointer-events-none', !v);
            backdrop.classList.toggle('opacity-0', !v);
            backdrop.classList.toggle('opacity-100', v);
            document.body.classList.toggle('overflow-hidden', v);
            if (!v && openBtn) {
                openBtn.focus();
            }
        }

        if (openBtn) openBtn.addEventListener('click', function () { setOpen(true); });
        if (closeBtn) closeBtn.addEventListener('click', function () { setOpen(false); });
        if (backdrop) backdrop.addEventListener('click', function () { setOpen(false); });

        if (drawer) {
            drawer.querySelectorAll('a').forEach(function (link) {
                link.addEventListener('click', function () { setOpen(false); });
            });
        }

        document.addEventListener('keydown', function (e) {
            if (e.key !== 'Escape') return;
            if (drawer && !drawer.classList.contains('invisible')) {
                setOpen(false);
            }
        });

        // Flash dismiss
        document.querySelectorAll('[data-flash-dismiss]').forEach(function (btn) {
            btn.addEventListener('click', function () {
                var box = btn.closest('[data-flash]');
                if (box) box.remove();
            });
        });

        // Confirm delete modals
        var activeModal = null;
        var lastTrigger = null;

        function getFocusable(root) {
            return Array.prototype.slice.call(root.querySelectorAll('button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])'))
                .filter(function (el) { return !el.hasAttribute('disabled') && el.offsetParent !== null; });
        }

        function openModal(modal, trigger) {
            activeModal = modal;
            lastTrigger = trigger || null;
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            document.body.classList.add('overflow-hidden');
            var panel = modal.querySelector('[data-confirm-panel]');
            var focusables = getFocusable(panel || modal);
            if (focusables.length) focusables[0].focus();
        }

        function closeModal(modal) {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            document.body.classList.remove('overflow-hidden');
            if (activeModal === modal) activeModal = null;
            if (lastTrigger) {
                lastTrigger.focus();
                lastTrigger = null;
            }
        }

        document.querySelectorAll('[data-confirm-open]').forEach(function (btn) {
            btn.addEventListener('click', function () {
                var id = btn.getAttribute('data-confirm-open');
                var modal = document.getElementById(id);
                if (modal) openModal(modal, btn);
            });
        });

        document.querySelectorAll('[data-confirm-modal]').forEach(function (modal) {
            modal.querySelectorAll('[data-confirm-close], [data-confirm-backdrop]').forEach(function (el) {
                el.addEventListener('click', function () { closeModal(modal); });
            });
        });

        document.addEventListener('keydown', function (e) {
            if (!activeModal) return;
            if (e.key === 'Escape') {
                closeModal(activeModal);
                return;
            }
            if (e.key === 'Tab') {
                var panel = activeModal.querySelector('[data-confirm-panel]');
                var focusables = getFocusable(panel || activeModal);
                if (!focusables.length) return;
                var first = focusables[0];
                var last = focusables[focusables.length - 1];
                if (e.shiftKey && document.activeElement === first) {
                    e.preventDefault();
                    last.focus();
                } else if (!e.shiftKey && document.activeElement === last) {
                    e.preventDefault();
                    first.focus();
                }
            }
        });

        // Image file previews
        document.querySelectorAll('input[type="file"][accept*="image"]').forEach(function (input) {
            var wrap = input.closest('div') || input.parentElement;
            var preview = wrap.querySelector('[data-image-preview]');
            if (!preview) {
                preview = document.createElement('div');
                preview.setAttribute('data-image-preview', '');
                preview.className = 'mt-3 hidden';
                preview.innerHTML = '<p class="mb-1 text-xs font-semibold text-ink-muted">New preview</p><img alt="Selected image preview" class="max-h-40 rounded-sm object-cover">';
                input.insertAdjacentElement('afterend', preview);
            }
            var img = preview.querySelector('img');
            input.addEventListener('change', function () {
                var file = input.files && input.files[0];
                if (input._previewObjectUrl) {
                    URL.revokeObjectURL(input._previewObjectUrl);
                    input._previewObjectUrl = null;
                }
                if (!file) {
                    preview.classList.add('hidden');
                    img.removeAttribute('src');
                    return;
                }
                var url = URL.createObjectURL(file);
                input._previewObjectUrl = url;
                img.src = url;
                img.alt = 'Preview of ' + file.name;
                preview.classList.remove('hidden');
            });
        });
    })();
    </script>
    @stack('scripts')
</body>
</html>
