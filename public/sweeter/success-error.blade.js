@if (session()->has('error'))
    <script>
        function sweetAlert() {
            Swal.fire({
                title: 'Error!',
                text: '{{ session()->get('error') }}',
                icon: 'error',
                confirmButtonText: 'Ok'
            })
        }

        setTimeout(function() {
            Swal.close();
        }, 2000);
        sweetAlert();
    </script>
@endif

@if (session()->has('success'))
    <script>
        function sweetAlert() {
            Swal.fire({
                title: 'Success',
                text: '{{ session()->get('success') }}',
                icon: 'success',
                confirmButtonText: 'Ok'
            })
        }

        setTimeout(function() {
            Swal.close();
        }, 2000);
        sweetAlert();
    </script>
@endif
