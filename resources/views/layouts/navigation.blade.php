<button data-drawer-target="sidebar-multi-level-sidebar" data-drawer-toggle="sidebar-multi-level-sidebar" aria-controls="sidebar-multi-level-sidebar" type="button" class="inline-flex items-center p-2 mt-2 ms-3 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 ">
   <span class="sr-only">Open sidebar</span>
   <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
   <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
   </svg>
</button>

<aside id="sidebar-multi-level-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0" aria-label="Sidebar">
   <div class="h-full px-3 py-4 overflow-y-auto bg-white">
    <div class="flex flex-col items-center mt-3 mb-8">
        <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
        <p class="font-bold">Rumahku Kost Puragabaya</p>
    </div>
      <ul class="space-y-2 font-medium">
         <li>
            <a href="{{ route('dashboard') }}" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100">
               <img class="w-2/12" src="{{ asset('assets/dashboard.png') }}" alt="Dashboard">
               <span class="ms-3">Dashboard</span>
            </a>
         </li>
         <li>
            <button type="button" class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100" aria-controls="dropdown-example" data-collapse-toggle="dropdown-example">
                  <img class="w-2/12" src="{{ asset('assets/keuangan.png') }}" alt="Keuangan">
                  <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Keuangan</span>
                  <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                     <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                  </svg>
            </button>
            <ul id="dropdown-example" class="hidden py-2 space-y-2">
                  <li>
                     <a href="{{ route('pemasukan') }}" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100">Pemasukan</a>
                  </li>
                  <li>
                     <a href="{{ route('pengeluaran') }}" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100">Pengeluaran</a>
                  </li>
                  <li>
                     <a href="{{ route('laporan') }}" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100">Laporan</a>
                  </li>
            </ul>
         </li>
         <li>
            <a href="{{ route('penyewa') }}" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100">
               <img class="w-2/12" src="{{ asset('assets/penyewa.png') }}" alt="Penyewa">
               <span class="flex-1 ms-3 whitespace-nowrap">Penyewa</span>
            </a>
         </li>
         
      </ul>
      <div class="flex gap-3 items-center justify-center fixed bottom-3 w-full pr-3">
         <img src="{{ asset('assets/profile.png') }}" alt="">
         <div>{{ Auth::user()->name }}</div>
         <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        <img src="{{ asset('assets/logout.png') }}" alt="">
                    </x-responsive-nav-link>
                </form>
               </div>
            </div>
</aside>