@extends('admin.dashlayout')

@section('work')
<div x-data="{ isOpen: false, formData: {}, uploadModal:false }" setActiveLink(2) x-on:keyup.esc="isOpen = false, uploadModal = false" x-on:clickaway="isOpen = false, uploadModal = false">  

    <button @click="uploadModal = true; formData = { id: 'home'}" class="text-white border bg-slate-900 border-gray-200 px-4 py-2 rounded-md hover:bg-amber-200 hover:text-black transition inline mt-10">
        Upload Multiple
    </button>
    
    @include('modals/uploadsickness')
    

</div>
<form action="{{ Route('create-disease') }}" method="POST" class="mt-12">
    @csrf
    <div class="inline mr-10">
        <label for="name" class="text-gray-300 mr-3">Name</label>
        <input type="text" name="name" class="w-1/3 rounded-lg border-slate-700 bg-gray-500 text-gray-100">
    </div>
    <div class="inline mr-10">
        <label for="name" class="text-gray-300 mr-3 ml-3">Type</label>
        <input type="text" name="type" id="" class="w-1/3 rounded-lg border-slate-700 bg-gray-500 text-gray-100">
    </div>
    
    <div>
        <button class="block float-right mr-32 mt-4 text-white border bg-slate-900 border-gray-200 px-6 py-2 rounded-md hover:bg-amber-200 hover:text-black transition">Add</button>
    </div>
</form>
@endsection