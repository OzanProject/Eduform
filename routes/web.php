<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\Dashboard;
use App\Livewire\Admin\FormBuilder;
use App\Livewire\Admin\FormResponses;
use App\Livewire\Auth\Login;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/login', Login::class)->name('login')->middleware('guest');

Route::post('/logout', function () {
    \Illuminate\Support\Facades\Auth::logout();
    session()->invalidate();
    session()->regenerateToken();
    return redirect('/login');
})->name('logout');

Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('admin.dashboard');
    Route::get('/forms', \App\Livewire\Admin\FormsList::class)->name('admin.forms.index');
    Route::get('/forms/create', FormBuilder::class)->name('admin.forms.create');
    Route::get('/forms/{form}/builder', FormBuilder::class)->name('admin.forms.builder');
    Route::get('/forms/{form}/responses', \App\Livewire\Admin\FormResponses::class)->name('admin.forms.responses');
    Route::get('/forms/{form}/export/excel', function (\App\Models\Form $form) {
        return \Maatwebsite\Excel\Facades\Excel::download(new \App\Exports\FormResponsesExport($form), $form->slug . '-responses.xlsx');
    })->name('admin.forms.export.excel');
    
    Route::get('/forms/{form}/export/pdf', function (\App\Models\Form $form) {
        return \Maatwebsite\Excel\Facades\Excel::download(new \App\Exports\FormResponsesExport($form), $form->slug . '-responses.pdf', \Maatwebsite\Excel\Excel::DOMPDF);
    })->name('admin.forms.export.pdf');

    Route::get('/responses', \App\Livewire\Admin\GlobalResponses::class)->name('admin.responses');
    Route::get('/settings', \App\Livewire\Admin\GlobalSettings::class)->name('admin.settings');
});

Route::get('/f/{slug}', \App\Livewire\Public\FormShow::class)->name('forms.show');
