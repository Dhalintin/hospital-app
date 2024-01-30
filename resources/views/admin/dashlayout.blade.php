<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Hospital-App</title>
    {{-- Script for Tailwind --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    {{-- End of Script --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-100">
    <main class="w-full flex flex-col justify-start lg:flex-row h-full">
        <!-- Side navigation -->
        <aside x-data=" { open: false, activeLink: parseInt(localStorage.getItem('activeLink'))  }" x:init="activeLink = parseInt(localStorage.getItem('activeLink')) !! null" x-bind:class="!open? 'left-0 w-72 pt-10 bg-gray-950 flex flex-col h-screen p-4 dark:bg-gray-900 dark:border-gray-700' : 'left-0 w-20 bg-white flex flex-col h-screen p-4 dark:bg-gray-900 dark:border-gray-700 lg:w-20 lg:h-screen'">
            <div class="flex">
                <h3 class="text-sm" x-on:click="open = !open">
                    <div class="grid grid-cols-3">
                        <div class="grid col-start-2 col-span-1 w-12 h-12"><img src="../.././images/logo.png" alt="" x-show="!open"></div>                        
                    </div>
                </h3>
            </div>

            <div class="hidden flex-col justify-between flex-1 mt-1 lg:flex" side-nav>
                <nav>
                    <!-- Dashboard -->
                    <a :class="{ 'dashboard-active': activeLink === 0, 'dashboard-inactive': activeLink !== 0}" @click="setActiveLink(0)" href="{{ Route('dashboard') }}">
                        <span class="mx-4 font-medium" x-show="!open">Home</span>
                    </a>
                    <!-- Dashboard -->
                    <a :class="{ 'dashboard-active': activeLink === 1, 'dashboard-inactive': activeLink !== 1}" @click="setActiveLink(1)" href="{{ Route('add-patient') }}">
                        <span class="mx-4 font-medium" x-show="!open">Add Patient</span>
                    </a>

                    <!-- Records -->
                    <a :class="{ 'dashboard-active': activeLink === 2, 'dashboard-inactive': activeLink !== 2}" @click="setActiveLink(2)" href="{{ Route('patient') }}">
                        <span class="mx-4 font-normal" x-show="!open">View Patients</span>
                    </a>

                    <!-- Courses -->
                    <a :class="{ 'dashboard-active': activeLink === 3, 'dashboard-inactive': activeLink !== 3}" @click="setActiveLink(3)" href="">
                        <span class="mx-4 font-normal" x-show="!open">Start Treatment</span>
                    </a>

                    <!-- Student -->
                    <a :class="{ 'dashboard-active': activeLink === 4, 'dashboard-inactive': activeLink !== 4}" @click="setActiveLink(4)" href="{{ Route('medication') }}">
                        <span class="mx-4 font-normal" x-show="!open">Medication</span>
                    </a>

                    <!-- Student -->
                    <a :class="{ 'dashboard-active': activeLink === 5, 'dashboard-inactive': activeLink !== 5}" @click="setActiveLink(5)" href="{{ Route('add-disease') }}">
                        <span class="mx-4 font-normal" x-show="!open">Add Sickness</span>
                    </a>


                    <!-- Log Out-->
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="dashboard-inactive w-64" @click="setActiveLink(0)">
                            <span class="mx-4 font-normal" x-show="!open">Logout</span>
                        </button>
                    </form>
                </nav>
            </div>
        </aside>

         
         <section class="w-full p-8 bg-gray-800">
            <div class="font-bold text-center">
                @include('notification')
            </div>
            <div class="pt-2 pr-12 pb-5">
                @yield('work')
            </div>
         </section>
   
   
</body>

<script>


    function setActiveLink(index){
        this.activeLink = index;
        localStorage.setItem('activeLink', index)
    }
</script>
</html>