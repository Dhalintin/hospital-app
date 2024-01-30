@extends('admin.dashlayout')

@section('work')
<div x-data="{ isOpen: false, formData: {}, uploadModal:false }" setActiveLink(2) x-on:keyup.esc="isOpen = false, uploadModal = false" x-on:clickaway="isOpen = false, uploadModal = false">  

    <button @click="uploadModal = true; formData = { id: '{{ route('upload-medication') }}'}" class="text-white border bg-slate-900 border-gray-200 px-4 py-2 rounded-md hover:bg-amber-200 hover:text-black transition inline mb-3 float-left">
        Upload New Medication
    </button>
    
    @include('modals/uploadsickness')

</div>
<div class="w-full text-gray-300 text-lg">
    <div>
        <div class="grid grid-cols-3 w-full shadow-md shadow-gray-600 rounded-lg text-2xl p-3 mb-3 capitalize">
            <div class="grid col-span-1 text-lg text-gray-200 capitalize">Medication Name</div>
            <div class="grid col-span-1 text-lg text-gray-200 capitalize">Theureputic Class</div>
            <div class="grid col-span-2 text-lg text-gray-200 capitalize"></div>
        </div>
        <div class="grid grid-cols-4">
            @foreach ($medications as $medication)
                <span class="grid col-span-1 capitalize">{{ $medication['medication_name'] }}</span>
                <span class="grid col-span-2">{{ $medication['theurepetic_class'] }}</span>
                <span class="">
                    <form action="{{ route('delete-medication', $medication['id']) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="inline">Edit</div>
                        <button class="inline border-gray-300 border-2 rounded-lg px-2 py-1 mb-2 text-red-500 ml-3">Delete</button>
                    </form>
                </span>
            @endforeach
        </div>
        <div class="p-4 space-evenly float-end">{{ $medications->links() }}</div>
    </div>
</div>

@endsection