<!-- BEGIN VENDOR JS-->
<script src="{{ asset('back/vendors/js/vendors.min.js')}}" type="text/javascript"></script>
<!-- BEGIN VENDOR JS-->
<!-- BEGIN PAGE VENDOR JS-->


<script src="{{ asset('back/plugins/nestable/nestable.js') }}"></script>


<script src="{{ asset('back/vendors/js/extensions/sweetalert.min.js') }}"></script>
<!-- END PAGE VENDOR JS-->
<script src="{{ asset('back/vendors/js/extensions/toastr.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('back/js/scripts/extensions/toastr.min.js') }}"></script>
<!-- BEGIN STACK JS-->
<script src="{{ asset('back/js/core/app-menu.js') }}" type="text/javascript"></script>
<script src="{{ asset('back/js/core/app.js') }}" type="text/javascript"></script>
<script src="{{ asset('back/js/scripts/customizer.js') }}" type="text/javascript"></script>
<!-- END STACK JS-->


<script type="text/javascript" src="{{ asset('back/js/custom.js') }}"></script>
<script src="{{ asset('back/plugins/nestable/nesteble_custom.js') }}"></script>

@method('custom_js')

@stack('db_js')

@if(Session::has('success'))
<script>
    swal("Good job!", "{{ Session::get('success') }}", "success");
</script>
@endif


@if(Session::has('error'))
<script>
    swal("Sorry!", "{{ Session::get('error') }}", "warning");
</script>
@endif

@stack('menu_js')