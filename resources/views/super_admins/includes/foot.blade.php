</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>

<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>
<script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
<script src="{{ asset('dist/js/chart.min.js') }}"></script>

<!-- AdminLTE for demo purposes -->
<!-- <script src="{{ asset('dist/js/demo.js') }}"></script> -->
<!-- <script src="//cdn.ckeditor.com/4.19.1/basic/ckeditor.js"></script> -->
{{-- <script src="//cdn.ckeditor.com/4.20.1/standard/ckeditor.js"></script> --}}
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.js"></script>
@yield('scripts')
<script>
    $(function() {
        @if (session('message'))
            console.log('{{ session('message') }}')
            @if (session('message_type') && session('message_type') == 'success')
                toastr.success('{{ session('message') }}')
            @elseif (session('message_type') && session('message_type') == 'info')
                toastr.info('{{ session('message') }}');
            @elseif (session('message_type') && session('message_type') == 'warning')
                toastr.warning('{{ session('message') }}');
            @elseif (session('message_type') && session('message_type') == 'error')
                toastr.error('{{ session('message') }}');
            @else
                toastr.info('{{ session('message') }}');
            @endif
        @endif
    });
</script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!--
<script>
    ClassicEditor
        .create(document.querySelector('#name_editor'))
        .catch(error => {
            console.error(error);
        });
    ClassicEditor
        .create(document.querySelector('#discription_editor'))
        .catch(error => {
            console.error(error);
        });
</script> -->
</body>

</html>
