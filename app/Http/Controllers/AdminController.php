<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Models\Patient;
use App\Models\Sickness;
use App\Models\Treatment;
use App\Models\Doctor;
use App\Models\PatientMedication;
use App\Models\Medication;
use Illuminate\Support\Facades\Validator;

use App\Imports\DiseaseImport;
use App\Imports\MedicationImport;
use Maatwebsite\Excel\Facades\Excel;

use Illuminate\Pagination\Paginate;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    public function home()
    {
        if(Auth::user()->role == '1'){
            return view('admin.dashboard');
        }else{
            return view('user.dashboard');
        }
    }

    public function addpatient()
    {
        return view('admin.addpatient');
    }

    public function create(Request $request)
    {
        try{
            $uniqueID = uniqid('kli');
            
            $request->validate([
                'firstname' => 'required',
                'lastname' => 'required',
                'gender' => 'required',
                'dob' => 'required',
                'email' => 'required',
                'phone'=>'required'
            ]);

            $patient = new Patient;

            $patient->firstname = $request->firstname;
            $patient->lastname = $request->lastname;
            $patient->gender = $request->gender;
            $patient->dob = $request->dob;
            $patient->email = $request->email;
            $patient->phone = $request->phone;
            $patient->uniqueid = $uniqueID;

            $patient->save();

            return back()->with('success', 'Patient added successfully');
        }catch(\Exception $e){
            return back()->with('failed', $e->getMessage());
        }
    }

    public function view()
    {
        $patients = Patient::all();
        return view('admin.patient', compact('patients'));
    }
    
    public function findPatient(Request $request)
    {
        $patients = Patient::where('uniqueid', $request->search)->get();
        return view('admin.patient', compact('patients'));
    }
    public function viewpatient($id)
    {
        $patient = Patient::where('id', $id)->with('treatments.sicknesses')->get();
        $sicknesses = Sickness::all();
        $doctor = Doctor::where('id', $patient[0]['treatments'][0]['doctor_id'])->get();
        $doctors = Doctor::all();
        return view('admin.patient-record', compact('patient'), compact('sicknesses', 'doctor', 'doctors'));
    }

    public function adddisease()
    {
        return view('admin.add-disease');//, compact('patient'));
    }

    public function createdisease(Request $request)
    {
        try
        {
            $request->validate([
                'name' => 'required|unique:disease,name',
                'type' => 'required',
            ]);
    
            $sickness = new Sickness;
    
            $sickness->name = $request->name;
            $sickness->type = $request->type;
    
            $sickness->save();
            return back()->with('success', 'Added Successfully');
        }catch(\Exception $e)
        {
            return back()->with('failed', 'Something went wrong');
        }
        
    }

    public function uploadDisease(Request $request)
    {       
        // try{
            $validator = Validator::make($request->all(), [
                'file' => [
                    'required',
                    'mimetypes:application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                    'mimes:xls,xlsx,xlsm,xlsb,xltm,xltx,xlam,ods',
                    function ($attribute, $value, $fail) {
                        $path = $value->getRealPath();
                        $sheets = Excel::toArray([], $path);
                        if (count($sheets) !== 1) {
                            $fail('The :attribute must have exactly one sheet.');
                        }
                    },
                ],
            ]);
        
            if ($validator->fails()) {
                session()->flash('error', 'Excel file must have only one sheet');
                return redirect()->back();
            }
        
            $file = $request->file('file');
            $path = $file->getRealPath();
    
    
            $file = $request->file('file');
            $path = $file->getRealPath();
            
            Excel::import(new DiseaseImport, $file);

            return redirect()->back()->with('success', 'Uploaded successfully');
    }

    public function startTreatment(Request $request)
    {
        try
        {
            $request->validate([
                'sickness_id' => 'required',
                'patient_id' => 'required',
                'doctor_id' => 'required',
                'start_date' => 'required',
            ]);
    
            $treatment = new Treatment;
    
            $treatment->sickness_id = $request->sickness_id;
            $treatment->doctor_id = $request->doctor_id;
            $treatment->patient_id = $request->patient_id;
            $treatment->start_date = $request->start_date;
    
            $treatment->save();
            return back()->with('success', 'Treatemnt started');
        }
        catch(\Exception $e)
        {
            return back()->with('failed', $e->getMessage());
        }
       
    }

    public function updateTreatment(Treatment $treatment, Request $request)
    {
        try
        {
            $request->validate([
                'sickness_id' => 'required',
                'patient_id' => 'required',
                'doctor_id' => 'required',
                'end_date' => 'date'
            ]);

            $treatment->update([
                'sickness_id' => $request->sickness_id,
                'patient_id' => $request->patient_id,
                'doctor_id' => $request->doctor_id,
                'end_date' => $request->end_date,
            ]);

            // $treatment->update($request->all());
    
            return back()->with('success', 'Completed');
        }
        catch(\Exception $e)
        {
            return back()->with('failed', $e->getMessage());
        }
    }

    public function medication()
    {
        $medications = Medication::orderBy('theurepetic_class')->paginate(9);
        return view('admin.medication', compact('medications'));
    }
    public function uploadMedication(Request $request)
    {       
        // try{
            $validator = Validator::make($request->all(), [
                'file' => [
                    'required',
                    'mimetypes:application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                    'mimes:xls,xlsx,xlsm,xlsb,xltm,xltx,xlam,ods',
                    function ($attribute, $value, $fail) {
                        $path = $value->getRealPath();
                        $sheets = Excel::toArray([], $path);
                        if (count($sheets) !== 1) {
                            $fail('The :attribute must have exactly one sheet.');
                        }
                    },
                ],
            ]);
        
            if ($validator->fails()) {
                session()->flash('error', 'Excel file must have only one sheet');
                return redirect()->back();
            }
        
            $file = $request->file('file');
            $path = $file->getRealPath();
    
    
            $file = $request->file('file');
            $path = $file->getRealPath();
            
            Excel::import(new MedicationImport, $file);

            return redirect()->back()->with('success', 'Uploaded successfully');
    }

    public function deleteMedication(Medication $medication)
    {
        $medication->delete();
        return back()->with('success', 'Deleted Successfully');
    }


}
