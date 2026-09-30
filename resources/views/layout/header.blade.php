<!-- Mobile Drawer Backdrop -->
<div id="sidebar-backdrop" class="fixed inset-0 bg-slate-900/50 backdrop-blur-xs z-40 hidden transition-opacity lg:hidden" aria-hidden="true"></div>







<!-- ========================= -->
<!-- TOP BAR -->
<!-- ========================= -->

 <header
      class="h-16 sm:h-[72px] bg-white border-b border-slate-200 px-4 sm:px-6 lg:px-8 flex items-center justify-between sticky top-0 z-20"
      data-purpose="top-header">
      <div class="flex items-center gap-2 sm:gap-3 min-w-0">
        <!-- Mobile Hamburger Menu Button -->
        <button id="open-sidebar-btn" type="button"
          class="lg:hidden p-2 -ml-1 rounded-lg text-slate-600 hover:text-slate-900 hover:bg-slate-100 transition flex-shrink-0"
          aria-label="Buka menu navigasi">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path d="M4 6h16M4 12h16M4 18h16" stroke-linecap="round" stroke-linejoin="round"></path>
          </svg>
        </button>
        <h1 class="text-base sm:text-lg lg:text-xl font-bold text-[#00B686] tracking-tight truncate">Registrasi Siswa
          Baru</h1>
      </div>
      <!-- Right Header Actions (Notifications, Settings, User Info) -->
      <div class="flex items-center gap-2 sm:gap-4 lg:gap-5 flex-shrink-0">
        <div class="flex items-center gap-1 sm:gap-2 text-slate-500">
          <!-- Notification Bell -->
          <button aria-label="Notifikasi"
            class="p-2 hover:bg-slate-100 rounded-full text-slate-500 hover:text-slate-700 transition-colors"
            type="button">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path
                d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"
                stroke-linecap="round" stroke-linejoin="round"></path>
            </svg>
          </button>
          <!-- Settings Icon -->
          <button aria-label="Pengaturan"
            class="p-2 hover:bg-slate-100 rounded-full text-slate-500 hover:text-slate-700 transition-colors"
            type="button">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path
                d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"
                stroke-linecap="round" stroke-linejoin="round"></path>
              <circle cx="12" cy="12" r="3"></circle>
            </svg>
          </button>
        </div>
        <!-- Vertical Divider -->
        <div class="h-6 w-px bg-slate-200"></div>
        <!-- User Profile Trigger & Dropdown Menu -->
        <div class="relative pl-1" data-purpose="user-profile">
          <button id="profile-menu-btn" type="button"
            class="flex items-center gap-2.5 sm:gap-3 p-1 -m-1 rounded-xl hover:bg-slate-50 transition focus:outline-none text-left"
            aria-expanded="false" aria-haspopup="true" aria-label="Menu Calon Siswa">
            <div class="text-right hidden sm:block">
              <div class="font-bold text-sm text-slate-800 leading-tight">    {{ auth()->user()->name }}</div>
              <div class="text-[11px] text-slate-400 font-medium mt-0.5">Calon Siswa</div>
            </div>
            <div class="relative">
              <img alt="Budi Santoso Avatar"
                class="w-9 h-9 sm:w-10 sm:h-10 rounded-full object-cover border-2 border-[#00B686] p-0.5 shadow-xs transition transform hover:scale-105"
                src="https://lh3.googleusercontent.com/aida-public/AB6AXuARnySKQaFvPy16yuO1WlTHInH9_ORVCY0TBLi53UCdmqxAuG5u3F5zgaxciRtb3ggTkP38p-PKUKEb7AzI7R6iaDlhchBT4DQ-kYIpDpPSk6ZsiU2KapEBcWQBTdVP6_dbjir4proGW6LpaG3MhGH21qS6VptYFlnAzUuC705ovOvm4JnP8zXPXIkKu5eHN7OTUR5oK10E5Wg7b2WSeIorpmjzxbcYyX2uU578r10iXTsX4eWl_Esu3s-g-uxh8qEEhy7C2bImdGWd" />
              <span
                class="absolute bottom-0 right-0 w-2.5 h-2.5 bg-[#00B686] border-2 border-white rounded-full"></span>
            </div>
          </button>

          <!-- Dropdown Popup Menu -->
          <div id="profile-dropdown"
            class="hidden absolute right-0 top-full mt-2.5 w-64 bg-white rounded-2xl shadow-xl border border-slate-100 py-2 z-50 transition-all transform origin-top-right divide-y divide-slate-100"
            role="menu" aria-orientation="vertical">
            <!-- Dropdown User Info Header -->
            <div class="px-4 py-3 bg-slate-50/50">
              <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Akun Masuk</p>
              <p class="text-sm font-bold text-slate-800 mt-0.5">    {{ auth()->user()->name }}</p>
              <span
                class="inline-block mt-1 px-2.5 py-0.5 text-[11px] font-semibold bg-teal-50 text-[#00B686] rounded-md">Calon
                Siswa</span>
            </div>

            <!-- Dropdown Menu Links -->
            <div class="py-1">
              <!-- Ubah Password -->
              <a href="DashboardUbahPassword.html"
                class="flex items-center gap-3 px-4 py-2.5 text-sm text-slate-700 hover:bg-teal-50/60 hover:text-[#00B686] transition-colors group"
                role="menuitem">
                <div
                  class="w-8 h-8 rounded-lg bg-slate-100 text-slate-500 flex items-center justify-center group-hover:bg-teal-100 group-hover:text-[#00B686] transition-colors">
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                      d="M15.75 5.25a3 3 0 013 3m3 0a6 6 0 01-7.029 5.912c-.563-.097-1.159.026-1.563.43L10.5 17.25H8.25v2.25H6v2.25H2.25v-2.818c0-.597.237-1.17.659-1.591l6.499-6.499c.404-.404.527-1 .43-1.563A6 6 0 1121.75 8.25z" />
                  </svg>
                </div>
                <div>
                  <span class="block font-semibold text-xs text-slate-800 group-hover:text-[#00B686]">Ubah
                    Password</span>
                  <span class="block text-[10px] text-slate-400">Ganti kata sandi akun</span>
                </div>
              </a>
            </div>

            <!-- Dropdown Logout -->
            <div class="py-1">
              <a href="{{ route('logout') }}"
                class="flex items-center gap-3 px-4 py-2.5 text-sm text-rose-600 hover:bg-rose-50 transition-colors group"
                role="menuitem">
                <div
                  class="w-8 h-8 rounded-lg bg-rose-50 text-rose-600 flex items-center justify-center group-hover:bg-rose-100 transition-colors">
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                      d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" />
                  </svg>
                </div>
                <div>
                  <span class="block font-semibold text-xs text-rose-600">Logout</span>
                  <span class="block text-[10px] text-rose-400">Keluar dari akun</span>
                </div>
              </a>
            </div>
          </div>
        </div>
      </div>
    </header>