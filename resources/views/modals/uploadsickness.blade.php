<div x-show="uploadModal" class="fixed inset-0 flex items-center justify-center z-50">
    <div class="modal-overlay absolute w-full h-full bg-slate-900 opacity-50" x-on:click="uploadModal = false"></div>

    <div class="modal-container bg-slate-900 w-11/12 md:max-w-md mx-auto shadow-lg z-50 overflow-y-auto text-[#1A988A] rounded-lg">
        <!-- Modal content -->
        <div class="modal-content py-4 text-left px-6">
            <div class="flex justify-end">
                <button class="font-bold text-red-600" @click="uploadModal = false">Close</button>
            </div>
            <div class="text-2xl font-bold mb-4 text-center text-gray-300">Upload Excel Sheet</div>
                <form id="importSickness" method="POST" x-bind:action="formData.id"  enctype="multipart/form-data" >
                    @csrf
                    <div class="bg-slate-900 rounded-lg pt-7 px-10 pb-8 pr-8 mr-3">
                        <div class="">
                            <div class="flex items-center justify-center w-full">
                                <label for="file" class="border-gray-400 rounded-lg shadow-md shadow-slate-500 hover:shadow-slate-600 px-4 py-3">Click to add a file</label>                                       
                                <input id="file" type="file" hidden name="file" accept=".cvs, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet ,application/vnd.ms.excel" required />
                            </div> 
                        </div>
                    </div>
                    
                    <div class="mb-3 mt-3">
                        <img src="images/info.png" alt="" class="inline text-[#1A988A] "> 
                        <button type="submit" x-on:click="isOpen = false" class="border border-white text-white rounded-lg p-3 bg-slate-900 px-5 flex mb-5 mt-3 left-full right-0 float-right">Upload</button>
                    </div>
                </form>
            </div>            
        </div>
    </div>
</div>

<script>
    // 
</script>
