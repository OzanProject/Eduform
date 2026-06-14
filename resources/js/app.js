import Swal from 'sweetalert2';

// Inisialisasi Toast default
window.Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.onmouseenter = Swal.stopTimer;
        toast.onmouseleave = Swal.resumeTimer;
    }
});

// Listener untuk Toast
document.addEventListener('livewire:init', () => {
    Livewire.on('swal:toast', (event) => {
        window.Toast.fire({
            icon: event[0].icon ?? 'success',
            title: event[0].title ?? 'Berhasil!'
        });
    });

    // Listener untuk Konfirmasi
    Livewire.on('swal:confirm', (event) => {
        Swal.fire({
            title: event[0].title ?? 'Apakah Anda yakin?',
            text: event[0].text ?? "Data ini tidak dapat dikembalikan!",
            icon: event[0].icon ?? 'warning',
            showCancelButton: true,
            confirmButtonColor: '#2563eb',
            cancelButtonColor: '#ef4444',
            confirmButtonText: event[0].confirmButtonText ?? 'Ya, Lanjutkan!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed && event[0].action) {
                // Panggil event action yang dilempar dari component
                Livewire.dispatch(event[0].action, event[0].params ?? {});
            }
        });
    });
});
