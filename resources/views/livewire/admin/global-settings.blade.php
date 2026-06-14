<x-slot:subtitle>Kelola informasi profil dan keamanan akun Anda.</x-slot:subtitle>

<div class="max-w-3xl space-y-6">
  
  <!-- Profil -->
  <div class="bg-white border border-slate-200 rounded-lg shadow-sm">
    <div class="px-6 py-4 border-b border-slate-200">
      <h2 class="text-lg font-semibold text-slate-900">Informasi Profil</h2>
      <p class="text-sm text-slate-500 mt-0.5">Perbarui nama dan alamat email akun Anda.</p>
    </div>
    <div class="p-6">


      <form wire:submit="updateProfile" class="space-y-4">
        <div>
          <label class="block text-sm font-medium text-slate-700 mb-1">Nama Lengkap</label>
          <input type="text" wire:model="name" class="w-full border border-slate-300 rounded-md px-3 py-2.5 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none @error('name') border-red-500 @enderror">
          @error('name') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
        </div>
        <div>
          <label class="block text-sm font-medium text-slate-700 mb-1">Alamat Email</label>
          <input type="email" wire:model="email" class="w-full border border-slate-300 rounded-md px-3 py-2.5 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none @error('email') border-red-500 @enderror">
          @error('email') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
        </div>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2 border-t border-slate-100 mt-4">
          <div>
            <label class="block text-sm font-medium text-slate-700 mb-1">Nama Brand Utama</label>
            <input type="text" wire:model="brandName" placeholder="Contoh: EduForm" class="w-full border border-slate-300 rounded-md px-3 py-2.5 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none @error('brandName') border-red-500 @enderror">
            @error('brandName') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
          </div>
          <div>
            <label class="block text-sm font-medium text-slate-700 mb-1">Sub-title Brand</label>
            <input type="text" wire:model="brandSubtitle" placeholder="Contoh: Assessment" class="w-full border border-slate-300 rounded-md px-3 py-2.5 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none @error('brandSubtitle') border-red-500 @enderror">
            @error('brandSubtitle') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
          </div>
        </div>
        <div>
          <label class="block text-sm font-medium text-slate-700 mb-1">Logo Brand (Sidebar & Favicon)</label>
          <div class="mt-1 flex items-center gap-4">
            <div class="w-16 h-16 rounded-md bg-slate-100 border border-slate-200 flex items-center justify-center overflow-hidden shrink-0">
              @if ($brandLogo)
                <img src="{{ $brandLogo->temporaryUrl() }}" class="w-full h-full object-contain">
              @elseif ($currentBrandLogo)
                <img src="{{ asset('storage/' . $currentBrandLogo) }}" class="w-full h-full object-contain">
              @else
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-slate-400"><rect width="18" height="18" x="3" y="3" rx="2" ry="2"/><circle cx="9" cy="9" r="2"/><path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"/></svg>
              @endif
            </div>
            <div class="flex-1">
              <input type="file" id="brandLogo" wire:model="brandLogo" class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 transition-colors" accept="image/png, image/jpeg">
              <p class="text-xs text-slate-500 mt-1">Format: JPG/PNG. Maks 2MB. Persegi disarankan.</p>
              @error('brandLogo') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
            </div>
          </div>
        </div>
        <div class="pt-2">
          <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-md px-4 py-2 text-sm transition-colors inline-flex items-center gap-2">
            <span wire:loading.remove wire:target="updateProfile">Simpan Profil</span>
            <span wire:loading wire:target="updateProfile">Menyimpan...</span>
          </button>
        </div>
      </form>
    </div>
  </div>

  <!-- Password -->
  <div class="bg-white border border-slate-200 rounded-lg shadow-sm">
    <div class="px-6 py-4 border-b border-slate-200">
      <h2 class="text-lg font-semibold text-slate-900">Ubah Password</h2>
      <p class="text-sm text-slate-500 mt-0.5">Pastikan akun Anda menggunakan password yang panjang dan acak untuk tetap aman.</p>
    </div>
    <div class="p-6">


      <form wire:submit="updatePassword" class="space-y-4">
        <div>
          <label class="block text-sm font-medium text-slate-700 mb-1">Password Saat Ini</label>
          <input type="password" wire:model="current_password" class="w-full border border-slate-300 rounded-md px-3 py-2.5 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none @error('current_password') border-red-500 @enderror">
          @error('current_password') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
        </div>
        <div>
          <label class="block text-sm font-medium text-slate-700 mb-1">Password Baru</label>
          <input type="password" wire:model="new_password" class="w-full border border-slate-300 rounded-md px-3 py-2.5 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none @error('new_password') border-red-500 @enderror">
          @error('new_password') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
        </div>
        <div>
          <label class="block text-sm font-medium text-slate-700 mb-1">Konfirmasi Password Baru</label>
          <input type="password" wire:model="new_password_confirmation" class="w-full border border-slate-300 rounded-md px-3 py-2.5 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none">
        </div>
        <div class="pt-2">
          <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-md px-4 py-2 text-sm transition-colors inline-flex items-center gap-2">
            <span wire:loading.remove wire:target="updatePassword">Ubah Password</span>
            <span wire:loading wire:target="updatePassword">Menyimpan...</span>
          </button>
        </div>
      </form>
    </div>
  </div>

</div>
