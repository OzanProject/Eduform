<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Models\Setting;

#[Layout('components.layouts.admin')]
class GlobalSettings extends Component
{
    use WithFileUploads;

    public $name;
    public $email;
    public $current_password;
    public $new_password;
    public $new_password_confirmation;
    public $brandLogo;
    public $currentBrandLogo;
    public $brandName;
    public $brandSubtitle;

    public function mount()
    {
        $user = auth()->user();
        $this->name = $user->name;
        $this->email = $user->email;
        $this->currentBrandLogo = Setting::where('key', 'brand_logo')->value('value');
        $this->brandName = Setting::where('key', 'brand_name')->value('value') ?? 'EduForm';
        $this->brandSubtitle = Setting::where('key', 'brand_subtitle')->value('value') ?? 'Assessment';
    }

    public function updateProfile()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . auth()->id(),
            'brandLogo' => 'nullable|image', // Tanpa batasan ukuran dari sisi aplikasi
            'brandName' => 'required|string|max:50',
            'brandSubtitle' => 'nullable|string|max:50',
        ]);

        $user = auth()->user();
        $user->update([
            'name' => $this->name,
            'email' => $this->email,
        ]);

        Setting::updateOrCreate(['key' => 'brand_name'], ['value' => $this->brandName]);
        Setting::updateOrCreate(['key' => 'brand_subtitle'], ['value' => $this->brandSubtitle]);

        if ($this->brandLogo) {
            $path = $this->brandLogo->store('logos', 'public');
            Setting::updateOrCreate(
                ['key' => 'brand_logo'],
                ['value' => $path]
            );
            $this->currentBrandLogo = $path;
            $this->brandLogo = null;
        }

        $this->dispatch('swal:toast', [
            'icon' => 'success',
            'title' => 'Profil dan pengaturan berhasil diperbarui.'
        ]);
    }

    public function updatePassword()
    {
        $this->validate([
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        if (!Hash::check($this->current_password, auth()->user()->password)) {
            throw ValidationException::withMessages([
                'current_password' => ['Password saat ini salah.'],
            ]);
        }

        auth()->user()->update([
            'password' => Hash::make($this->new_password),
        ]);

        $this->reset(['current_password', 'new_password', 'new_password_confirmation']);
        $this->dispatch('swal:toast', [
            'icon' => 'success',
            'title' => 'Password berhasil diubah.'
        ]);
    }

    public function render()
    {
        return view('livewire.admin.global-settings')->title('Pengaturan Akun');
    }
}
