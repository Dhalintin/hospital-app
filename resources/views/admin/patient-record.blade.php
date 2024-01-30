@extends('admin.dashlayout')

@section('work')
<div class="w-full text-gray-300 text-lg mt-4">
    <div>
        <div class="grid grid-cols-3">
            <span class="grid col-span-1 capitalize">{{ $patient[0]['firstname'] }}, {{ $patient[0]['lastname'] }}</span>
            <span class="grid col-span-1"></span>
            <span class="grid col-span-1">{{ $patient[0]['uniqueid'] }}</span>
        </div>
    </div>
    <div class="w-full shadow-md shadow-gray-600 rounded-lg">
        <div class="m-4 text-center text-2xl p-3 mb-5 capitalize">Medical Records</div>
    </div>
    <table class="w-full">
        <tbody>
            <tr>
                <td colspan="2">Sickness</td>
                <td colspan="1">Medication</td>
                <td colspan="1">Start</td>
                <td colspan="1">End</td>
            </tr>
            @foreach ($patient[0]['treatments'] as $treatment)
                <tr>
                    <td colspan="2">{{ $treatment->sicknesses[0]['name']}}</td>
                    <td>Medication</td>
                    <td>
                        @if($treatment->start_date != null )
                            {{ $treatment->start_date }}
                        @else
                            No treatment
                        @endif
                    </td>
                    <td>
                        @if($treatment->end_date != null && $treatment->start_date != null)
                            {{ $treatment->end_date }}
                        @elseif ($treatment->end_date == null && $treatment->start_date != null)
                            Still in treatment
                        @else
                            No treatment
                        @endif
                    </td>
                    <td>
                        <div x-data="{ isOpen: false, formData: {}, uploadModal:false }" x-on:keyup.esc="isOpen = false, uploadModal = false" x-on:clickaway="isOpen = false, uploadModal = false">  
                            <button class="text-white border bg-slate-900 border-gray-200 px-4 py-2 rounded-md hover:bg-amber-200 hover:text-black transition inline float-right"
                                @click="uploadModal = true, 
                                formData = { 
                                    route: '{{ Route('update-treatment', $treatment->id ) }}',
                                    treatment_id: '{{ $treatment->id }}',
                                    sickness_id: '{{ $treatment->sicknesses[0]['id'] }}',
                                    sickness: '{{ $treatment->sicknesses[0]['name']}}',
                                    doctor_id: '{{ $doctor[0]['id'] }}',
                                    start: '{{ $treatment->start_date }}',
                                    end: '{{ $treatment->end_date }}',
                                }" 
                                >
                                Update record
                            </button>
                            @include('modals/edittreatment')
                        </div>
                    </td>
                </tr>
                
            @endforeach
            
        </tbody>
    </table>
</div>
<div x-data="{ isOpen: false, formData: {}, uploadModal:false }" setActiveLink(2) x-on:keyup.esc="isOpen = false, uploadModal = false" x-on:clickaway="isOpen = false, uploadModal = false">  

    <button @click="uploadModal = true; formData = { id: '{{ route('upload-medication') }}'}" class="text-white border bg-slate-900 border-gray-200 px-4 py-2 rounded-md hover:bg-amber-200 hover:text-black transition inline mt-10 float-right">
        Start treatment
    </button>
    
    @include('modals/addtreatment')

</div>
@endsection