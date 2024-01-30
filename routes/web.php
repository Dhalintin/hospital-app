<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect('login');
});

Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //Patient Routes
    Route::get('/home', [AdminController::class, 'home'])->name('home');
    Route::get('/add-patient', [AdminController::class, 'addpatient'])->name('add-patient');
    Route::post('addpatient', [AdminController::class, 'create'])->name('addpatient');
    Route::get('/patient', [AdminController::class, 'view'])->name('patient');
    Route::post('/patient{uid}', [AdminController::class, 'findPatient'])->name('patientid');
    Route::get('/view-patient/{id}', [AdminController::class, 'viewpatient'])->name('view-patient');

    // Disease and treatment Routes
    Route::get('/add-disease', [AdminController::class, 'adddisease'])->name('add-disease');
    Route::post('/create-disease', [AdminController::class, 'createdisease'])->name('create-disease');
    Route::post('/upload-sickness', [AdminController::class, 'uploadDisease'])->name('upload-sickness');

    //Medication Route
    Route::get('/medication', [AdminController::class, 'medication'])->name('medication');
    Route::post('/upload-medication', [AdminController::class, 'uploadMedication'])->name('upload-medication');
    Route::delete('/delete-medication{medication}', [AdminController::class, 'deleteMedication'])->name('delete-medication');

    Route::post('/start-treatment', [AdminController::class, 'startTreatment'])->name('start-treatment');
    Route::get('/edit-treatment', [AdminController::class, 'editTreatment'])->name('edit-treatment');
    Route::put('/update-treatment', [AdminController::class, 'updateTreatment'])->name('update-treatment');
});

require __DIR__.'/auth.php';
