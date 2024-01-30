<div x-show="uploadModal" class="fixed inset-0 flex items-center justify-center z-50">
    <div class="modal-overlay absolute w-full h-full bg-slate-900 opacity-50" x-on:click="uploadModal = false"></div>

    <div class="modal-container bg-slate-900 w-11/12 md:max-w-md mx-auto shadow-lg z-50 overflow-y-auto text-[#1A988A] rounded-lg">
        <!-- Modal content -->
        <div class="modal-content py-4 text-left px-6">
            <div class="flex justify-end">
                <button class="font-bold text-red-600" @click="uploadModal = false">Close</button>
            </div>
            <form method="POST" x-bind:action="formData.route" id="myForm">
                @csrf
                @method('PUT')               
                    <div class="">
                        <label for="sickness_id" class="text-lg font-bold block text-gray-300">Sickness</label>
                        <select type="text" name="sickness_id" x-model="formData.sickness_id" placeholder="select Sickness" class="w-full rounded-lg bg-slate-500 text-gray-200" :value= required >
                            <option value="">Select Sickness</option>
                            @foreach ($sicknesses as $sickness)
                                <option value="{{ $sickness->id }}">{{ $sickness->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="">
                        <label for="doctor_id" class="text-lg font-bold block text-gray-300">doctor</label>
                        <select type="text" name="doctor_id" x-model="formData.doctor_id" placeholder="select doctor" class="w-full rounded-lg bg-slate-500 text-gray-200" required >
                            <option value="">Select Doctor on Call</option>
                            @foreach ($doctors as $doctor)
                                <option class="text-white" value="{{ $doctor->id }}">{{ "Dr. ".$doctor->firstname." ".$doctor->firstname }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="hidden">
                        <input type="number" name="patient_id" value="{{ $patient[0]['id'] }}" readonly/>
                    </div>
                    <div class="">
                        <label for="start_date" class="text-lg font-bold block text-gray-300">doctor</label>
                        <input type="date" name="start_date" x-model="formData.start" class="w-full rounded-lg bg-slate-500 text-gray-200"/>
                    </div>

                    <div class="flex ">
                        <div class="justify-start mr-12">
                            <input type="checkbox" name="end_date" value="{{ date('Y-m-d') }}">
                                <span class="text-gray-200 font-semibold mt-10">End treatment</span>
                        </div>
    
                        <div class="justify-end">
                            <button  type="submit" class="text-white border border-amber-200 px-4 py-2 rounded-md hover:bg-amber-900 hover:text-black transition mt-6">Submit</button>
                            <span @click="uploadModal = false" class="text-white border border-amber-200 px-4 py-2 ml-3 rounded-md hover:bg-amber-900 hover:text-black transition mt-6">
                                Close
                            </span>
                          </div> 
                    </div>
                </form>
        </div>
    </div>
    