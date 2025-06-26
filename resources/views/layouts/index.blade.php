<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>KEMENAG BANJARBARU</title>
  <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
    crossorigin="anonymous"></script>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
  <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css" />
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
  <!-- Load Material Symbols Outlined -->
  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />


</head>




<body class="">


  <!-- Sidebar Start -->
  <div class=" flex flex-col flex-auto  antialiased bg-gray-50 text-gray-800">


    <div class="fixed flex flex-col top-0 left-0 w-64 bg-white h-full border-r">
      <div class="flex items-center justify-center h-14 border-b">
        <div>KEMENAG Banjarbaru</div>
      </div>
      <div class="overflow-y-auto overflow-x-hidden flex-grow">


        <ul class="flex  flex-col py-4 space-y-1">
          <li class="px-5">
            <div class="flex flex-row items-center h-8">
              <div class="text-sm font-light tracking-wide text-gray-500">Menu</div>
            </div>
          </li>


          <li class="hidden">
            <a href="#"
              class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-gray-50 text-gray-600 hover:text-gray-800 border-l-4 border-transparent hover:border-indigo-500 pr-6">
              <span class="inline-flex justify-center items-center ml-4">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                  xmlns="http://www.w3.org/2000/svg">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                  </path>
                </svg>
              </span>
              <span class="ml-2 text-sm tracking-wide truncate">Dashboard</span>
            </a>
          </li>


          <li class="hidden">
            <a href="#"
              class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-gray-50 text-gray-600 hover:text-gray-800 border-l-4 border-transparent hover:border-indigo-500 pr-6">
              <span class="inline-flex justify-center items-center ml-4">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                  xmlns="http://www.w3.org/2000/svg">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9">
                  </path>
                </svg>
              </span>
              <span class="ml-2 text-sm tracking-wide truncate">Data Perkawinan</span>
              <span
                class="px-2 py-0.5 ml-auto text-xs font-medium tracking-wide text-red-500 bg-red-50 rounded-full"></span>
            </a>
          </li>


          <li class="hidden px-5">
            <div class="flex flex-row items-center h-8">
              <div class="text-sm font-light tracking-wide text-gray-500">Isi Data Mempelai</div>
            </div>
          </li>


          <li class="">
            <a href="/pria"
              class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-gray-50 text-gray-600 hover:text-gray-800 border-l-4 border-transparent hover:border-indigo-500 pr-6">
              <span class="inline-flex justify-center items-center ml-4">
                <span class="material-symbols-outlined">
                  man
                </span>
              </span>
              <span class="ml-2 text-sm tracking-wide truncate">Data Laki-laki</span>
            </a>
          </li>

          <li class="">
            <a href="/perempuan"
              class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-gray-50 text-gray-600 hover:text-gray-800 border-l-4 border-transparent hover:border-indigo-500 pr-6">
              <span class="inline-flex justify-center items-center ml-4">
                <span class="material-symbols-outlined">
                  woman
                </span>
              </span>
              <span class="ml-2 text-sm tracking-wide truncate">Data Perempuan</span>
            </a>
          </li>

          <li class="">
            <a href="/pernikahan"
              class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-gray-50 text-gray-600 hover:text-gray-800 border-l-4 border-transparent hover:border-indigo-500 pr-6">
              <span class="inline-flex justify-center items-center ml-4">
                <span class="material-symbols-outlined">
                  wc
                </span>
              </span>
              <span class="ml-2 text-sm tracking-wide truncate">Data Pernikahan</span>
            </a>
          </li>
          <li>
            <a href="/users"
              class="relative flex flex-row items-center h-11 hover:bg-gray-50 text-gray-600 hover:text-gray-800 border-l-4 border-transparent hover:border-indigo-500 pr-6">
              <span
                class="inline-flex justify-center items-center ml-4 material-symbols-outlined">manage_accounts</span>
              <span class="ml-2 text-sm tracking-wide truncate">Pengelolaan User</span>
            </a>
          </li>
          ``

          <li class="px-5">
            <div class="flex flex-row items-center h-8">
              <div class="text-sm font-light tracking-wide text-gray-500">Laporan</div>
            </div>
          </li>

          <li>
            <a href="/laporan/bulanan"
              class="relative flex flex-row items-center h-11 hover:bg-gray-50 text-gray-600 hover:text-gray-800 border-l-4 border-transparent hover:border-indigo-500 pr-6">
              <span class="inline-flex justify-center items-center ml-4 material-symbols-outlined">bar_chart</span>
              <span class="ml-2 text-sm tracking-wide truncate">Laporan Bulanan</span>
            </a>
          </li>

          <li>
            <a href="/laporan/tahunan"
              class="relative flex flex-row items-center h-11 hover:bg-gray-50 text-gray-600 hover:text-gray-800 border-l-4 border-transparent hover:border-indigo-500 pr-6">
              <span class="inline-flex justify-center items-center ml-4 material-symbols-outlined">calendar_month</span>
              <span class="ml-2 text-sm tracking-wide truncate">Laporan Tahunan</span>
            </a>
          </li>

          <li>
            <a href="/laporan/kecamatan"
              class="relative flex flex-row items-center h-11 hover:bg-gray-50 text-gray-600 hover:text-gray-800 border-l-4 border-transparent hover:border-indigo-500 pr-6">
              <span class="inline-flex justify-center items-center ml-4 material-symbols-outlined">location_city</span>
              <span class="ml-2 text-sm tracking-wide truncate">Laporan Kecamatan</span>
            </a>
          </li>

          <li>
            <a href="/laporan/usia"
              class="relative flex flex-row items-center h-11 hover:bg-gray-50 text-gray-600 hover:text-gray-800 border-l-4 border-transparent hover:border-indigo-500 pr-6">
              <span class="inline-flex justify-center items-center ml-4 material-symbols-outlined">group</span>
              <span class="ml-2 text-sm tracking-wide truncate">Laporan Usia</span>
            </a>
          </li>

          <li>
            <a href="/laporan/tren"
              class="relative flex flex-row items-center h-11 hover:bg-gray-50 text-gray-600 hover:text-gray-800 border-l-4 border-transparent hover:border-indigo-500 pr-6">
              <span class="inline-flex justify-center items-center ml-4 material-symbols-outlined">insights</span>
              <span class="ml-2 text-sm tracking-wide truncate">Tren Pernikahan</span>
            </a>
          </li>

          <li>
            <a href="/laporan/peta"
              class="relative flex flex-row items-center h-11 hover:bg-gray-50 text-gray-600 hover:text-gray-800 border-l-4 border-transparent hover:border-indigo-500 pr-6">
              <span class="inline-flex justify-center items-center ml-4 material-symbols-outlined">map</span>
              <span class="ml-2 text-sm tracking-wide truncate">Pemetaan Leaflet</span>
            </a>
          </li>

          <li>
            <a href="/laporan/user"
              class="relative flex flex-row items-center h-11 hover:bg-gray-50 text-gray-600 hover:text-gray-800 border-l-4 border-transparent hover:border-indigo-500 pr-6">
              <span class="inline-flex justify-center items-center ml-4 material-symbols-outlined">person</span>
              <span class="ml-2 text-sm tracking-wide truncate">Laporan per User</span>
            </a>
          </li>

          <li>
            <a href="/laporan/pendidikan"
              class="relative flex flex-row items-center h-11 hover:bg-gray-50 text-gray-600 hover:text-gray-800 border-l-4 border-transparent hover:border-indigo-500 pr-6">
              <span class="inline-flex justify-center items-center ml-4 material-symbols-outlined">school</span>
              <span class="ml-2 text-sm tracking-wide truncate">Pendidikan Pasangan</span>
            </a>
          </li>




          <li>
            <form action="{{ route('user.logout') }}" method="POST" class="w-full">
              @csrf
              <button type="submit"
                class="w-full relative flex flex-row items-center h-11 text-white bg-red-500 hover:bg-red-600 border-l-4 border-red-600 pr-6 transition-colors duration-200">
                <span class="inline-flex justify-center items-center ml-4">
                  <span class="material-symbols-outlined">logout</span>
                </span>
                <span class="ml-2 text-sm tracking-wide truncate">Logout</span>
              </button>
            </form>
          </li>



        </ul>
      </div>
    </div>
  </div>

  <!-- Sidebar End -->

  <div
    class="pt-14 ml-64 px-16 bg-gradient-to-r from-green-600 via-teal-400 to-purple-500 dark:bg-gradient-to-r dark:from-green-600 dark:via-teal-600 dark:to-purple-700 flex flex-col min-h-screen pb-8wwww">
    <div class="bg-white rounded-lg border border-zinc-300 p-4">
      @yield('content')
    </div>
  </div>






</body>

</html>