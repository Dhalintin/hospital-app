@extends('admin.dashlayout')

@section('work')
<div class="grid md:grid-cols-2">        
    <main class="px-16 py-6 pb-2 md:col-span-2">                 
        <div class="mt-8 grid md:grid-cols-2 gap-3 pr-5">
            <a href="{{ Route('add-patient') }}" @click="setActiveLink(1)">
                <div @click="setActiveLink(1)" class="card hover:shadow-2xl hover:shadow-gray-500  dark:bg-slate-800 rounded-2xl border-2 border-gray-700 mr-20">
                    <img @click="setActiveLink(1)" src="./images/patient.png" alt="" class="w-225 h-225 sm:h-48 object-cover pt-2 pl-12 pr-8">
                    <div class="m-4" @click="setActiveLink(1)">
                        <span class="info text-gray-200" @click="setActiveLink(1)">Admit Patient</span>
                    </div>
                </div>
            </a>
            <a href="#">
                <div class="card hover:shadow-2xl hover:shadow-gray-500  dark:bg-slate-800 rounded-2xl border-2 border-gray-700 mr-20">
                    <img src="./images/doctor.png" alt="" class="w-225 h-225 sm:h-48 object-cover pt-2 pl-12 pr-8">
                    <div class="m-4">
                        <span class="info text-gray-200">View Doctors</span>
                    </div>
                </div>
            </a>
            <a href="{{ Route('patient') }}">
                <div class="card hover:shadow-2xl hover:shadow-gray-500  dark:bg-slate-800 rounded-2xl border-2 border-gray-700 mr-20">
                    <img src="./images/record.jpeg" alt="" class="w-225 h-225 sm:h-48 object-cover pt-2 pl-12 pr-8">
                    <div class="m-4">
                        <span class="info text-gray-200">Check Patients Record</span>
                    </div>
                </div>
            </a>
            <a href="#">
                <div class="card hover:shadow-2xl hover:shadow-gray-500  dark:bg-slate-800 rounded-2xl border-2 border-gray-700 mr-20">
                    <img src="./images/bookings.png" alt="" class="w-225 h-225 sm:h-48 object-cover pt-2 pl-12 pr-8">
                    <div class="m-4">
                        <span class="info text-gray-200">Book an Appointment</span>
                    </div>
                </div>
            </a>
        </div>                        
    </main>
</div>
@endsection

<script>
    function setActiveLink(index){
        this.activeLink = index;
        localStorage.setItem('activeLink', index)
    }
</script>