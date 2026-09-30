<!-- Toast Notification -->
<div id="tab-toast"
     class="fixed bottom-6 right-6 bg-slate-900 text-white
            px-5 py-3 rounded-xl shadow-lg flex items-center gap-3
            transform translate-y-20 opacity-0
            transition-all duration-300 z-50
            pointer-events-none">

    <svg class="w-5 h-5 text-[#00B686]"
         fill="none"
         stroke="currentColor"
         stroke-width="2"
         viewBox="0 0 24 24">

        <path d="M5 13l4 4L19 7"
              stroke-linecap="round"
              stroke-linejoin="round">
        </path>

    </svg>

    <span id="tab-toast-msg"
          class="text-sm font-medium">

        Berhasil disimpan

    </span>

</div>


<script>

    /* =========================================
       TAB NAVIGATION
    ========================================= */

    const tabButtons = document.querySelectorAll('.tab-btn');
    const tabPanels = document.querySelectorAll('[role="tabpanel"]');

    function activateTab(tabId) {

        const targetPanel = document.getElementById(tabId);

        if (!targetPanel) {
            return;
        }

        tabButtons.forEach(btn => {

            const target = btn.getAttribute('data-tab-target');

            if (target === tabId) {

                btn.setAttribute('aria-current', 'page');

                btn.className =
                    'tab-btn border-b-2 border-[#00B686] ' +
                    'pb-3 px-1 text-sm font-semibold ' +
                    'text-[#00B686] transition-colors ' +
                    'focus:outline-none cursor-pointer whitespace-nowrap';

            } else {

                btn.removeAttribute('aria-current');

                btn.className =
                    'tab-btn border-b-2 border-transparent ' +
                    'pb-3 px-1 text-sm font-medium ' +
                    'text-slate-500 hover:text-slate-700 ' +
                    'hover:border-slate-300 transition-colors ' +
                    'focus:outline-none cursor-pointer whitespace-nowrap';

            }

        });


        tabPanels.forEach(panel => {

            if (panel.id === tabId) {

                panel.classList.remove('hidden');

            } else {

                panel.classList.add('hidden');

            }

        });


        if (window.history.replaceState) {

            window.history.replaceState(
                null,
                null,
                '#' + tabId
            );

        }

    }


    tabButtons.forEach(btn => {

        btn.addEventListener('click', function (e) {

            e.preventDefault();

            const target =
                this.getAttribute('data-tab-target');

            activateTab(target);

        });

    });


    /* =========================================
       TOAST
    ========================================= */

    function showNotification(msg) {

        const toast =
            document.getElementById('tab-toast');

        const toastMsg =
            document.getElementById('tab-toast-msg');

        if (!toast || !toastMsg) {
            return;
        }

        toastMsg.textContent = msg;

        toast.classList.remove(
            'translate-y-20',
            'opacity-0',
            'pointer-events-none'
        );

        setTimeout(() => {

            toast.classList.add(
                'translate-y-20',
                'opacity-0',
                'pointer-events-none'
            );

        }, 3000);

    }


    /* =========================================
       MOBILE SIDEBAR
    ========================================= */

    const mainSidebar =
        document.getElementById('main-sidebar');

    const sidebarBackdrop =
        document.getElementById('sidebar-backdrop');

    const openSidebarBtn =
        document.getElementById('open-sidebar-btn');

    const closeSidebarBtn =
        document.getElementById('close-sidebar-btn');


    function openSidebar() {

        if (mainSidebar && sidebarBackdrop) {

            mainSidebar.classList.remove(
                '-translate-x-full'
            );

            sidebarBackdrop.classList.remove(
                'hidden'
            );

            document.body.style.overflow = 'hidden';

        }

    }


    function closeSidebar() {

        if (mainSidebar && sidebarBackdrop) {

            mainSidebar.classList.add(
                '-translate-x-full'
            );

            sidebarBackdrop.classList.add(
                'hidden'
            );

            document.body.style.overflow = '';

        }

    }


    if (openSidebarBtn) {

        openSidebarBtn.addEventListener(
            'click',
            openSidebar
        );

    }


    if (closeSidebarBtn) {

        closeSidebarBtn.addEventListener(
            'click',
            closeSidebar
        );

    }


    if (sidebarBackdrop) {

        sidebarBackdrop.addEventListener(
            'click',
            closeSidebar
        );

    }


    /* =========================================
       PROFILE DROPDOWN
    ========================================= */

    const profileMenuBtn =
        document.getElementById('profile-menu-btn');

    const profileDropdown =
        document.getElementById('profile-dropdown');


    if (profileMenuBtn && profileDropdown) {

        profileMenuBtn.addEventListener(
            'click',
            function (e) {

                e.stopPropagation();

                profileDropdown.classList.toggle(
                    'hidden'
                );

                const isExpanded =
                    !profileDropdown.classList.contains(
                        'hidden'
                    );

                profileMenuBtn.setAttribute(
                    'aria-expanded',
                    isExpanded
                );

            }
        );


        document.addEventListener(
            'click',
            function (e) {

                if (
                    !profileDropdown.contains(e.target) &&
                    !profileMenuBtn.contains(e.target)
                ) {

                    profileDropdown.classList.add(
                        'hidden'
                    );

                    profileMenuBtn.setAttribute(
                        'aria-expanded',
                        'false'
                    );

                }

            }
        );

    }


    /* =========================================
       ESCAPE KEY
    ========================================= */

    document.addEventListener(
        'keydown',
        function (e) {

            if (e.key === 'Escape') {

                if (
                    profileDropdown &&
                    !profileDropdown.classList.contains('hidden')
                ) {

                    profileDropdown.classList.add(
                        'hidden'
                    );

                    profileMenuBtn.setAttribute(
                        'aria-expanded',
                        'false'
                    );

                }


                if (
                    mainSidebar &&
                    !mainSidebar.classList.contains(
                        '-translate-x-full'
                    ) &&
                    window.innerWidth < 1024
                ) {

                    closeSidebar();

                }

            }

        }
    );

</script>