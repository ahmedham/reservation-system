@if (session('error'))
<script>
Swal.fire({
    toast: true,
    position: "top-end",
    showConfirmButton: false,
    timer: 3000,
    icon: "error",
    title: "{{ session('error') }}",
});
</script>
@endif


@if (session('success'))
<script>

Swal.fire({
    toast: true,
    position: "top-end",
    showConfirmButton: false,
    timer: 3000,
    icon: "success",
    title: "{{ session('success') }}",
});
</script>
@endif
