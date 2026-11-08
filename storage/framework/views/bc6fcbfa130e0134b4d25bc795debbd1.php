<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php if(session('success')): ?>
    <script>
        Swal.fire({
            toast: true,
            position: 'bottom',
            icon: 'success',
            title: '<?php echo e(session('success')); ?>',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });
    </script>
<?php endif; ?><?php /**PATH C:\laragon\www\adminium\packages\adminium\src\Dashboard\Views/flash_messages.blade.php ENDPATH**/ ?>