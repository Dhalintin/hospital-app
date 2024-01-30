@extends('admin.dashlayout')

@section('work')
<div class="pt-5">
    <form action="{{ Route('patientid', 'id') }}" method="POST" class="mb-3">
        @csrf
        <label for="search" class="block text-gray-300 mb-3 text-lg">Search for Patient Record</label>
        <input type="text" placeholder="Enter Patient UniqueID" name="search" id="search" class="rounded-lg text-gray-100 bg-gray-500 border-2 w-72 border-gray-400 px-3 py-2 mr-3">
        <button class="rounded-lg bg-slate-900 text-gray-200 px-3 py-2 hover:font-lg broder-2 border-gray-400">Search</button>
    </form>
</div>
    <table class="w-full text-left mt-5 text-gray-400">
        <thead class="border-t-2 border-b-2 text-xl font-bold mb-32">
            <th>First Name</th>
            <th>Last Name</th>
            <th>Date of birth</th>
            <th>Phone Number</th>
            <td>Patient ID</td>
        </thead>
        <tbody class="mt-20 mb-20">
            @foreach ($patients as $patient)
                <tr class="mt-20 mb-20">
                    <td>{{ $patient->firstname }}</td>
                    <td>{{ $patient->lastname }}</td>
                    <td>{{ $patient->dob }}</td>
                    <td>{{ $patient->phone }}</td>
                    <td>{{ $patient->uniqueid }}</td>
                    <td>
                        <a href="{{ Route('view-patient', $patient->id) }}" class="">View</a>
                    </td>
                </tr>    
            @endforeach
            
        </tbody>
    </table>
@endsection