<!-- jQuery -->
<script src="{{ URL::asset('assets/admin/vendors/jquery/dist/jquery.min.js') }}"></script>
<!-- Bootstrap -->
<script src="{{ URL::asset('assets/admin/vendors/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- Custom Theme Scripts -->
<script src="{{ URL::asset('assets/admin/build/js/custom.min.js') }}"></script>
<!-- jquery.inputmask -->
<script src="{{ URL::asset('assets/admin/vendors/jquery.inputmask/dist/min/jquery.inputmask.bundle.min.js') }}"></script>

<!-- Validation Engine -->
<script src="{{ URL::asset('assets/admin/plugins/validation-engine/js/languages/jquery.validationEngine-en.js') }}"></script>
<script src="{{ URL::asset('assets/admin/plugins/validation-engine/js/jquery.validationEngine.js') }}"></script>
<script src="{{ URL::asset('assets/admin/plugins/notify/notify.min.js') }}"></script>

 <!-- Datatables -->
<script src="{{ URL::asset('assets/admin/vendors/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('assets/admin/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ URL::asset('assets/admin/vendors/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ URL::asset('assets/admin/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js') }}"></script>
<script src="{{ URL::asset('assets/admin/vendors/datatables.net-buttons/js/buttons.flash.min.js') }}"></script>
<script src="{{ URL::asset('assets/admin/vendors/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ URL::asset('assets/admin/vendors/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ URL::asset('assets/admin/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js') }}"></script>
<script src="{{ URL::asset('assets/admin/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js') }}"></script>
<script src="{{ URL::asset('assets/admin/vendors/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ URL::asset('assets/admin/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js') }}"></script>
<script src="{{ URL::asset('assets/admin/vendors/datatables.net-scroller/js/dataTables.scroller.min.js') }}"></script>
<script src="{{ URL::asset('assets/admin/vendors/jszip/dist/jszip.min.js') }}"></script>
<script src="{{ URL::asset('assets/admin/vendors/pdfmake/build/pdfmake.min.js') }}"></script>
<script src="{{ URL::asset('assets/admin/vendors/pdfmake/build/vfs_fonts.js') }}"></script>

<script>
 
</script>

@if(session('notify_mssg'))
<script>
$(document).ready(function(){
	$.notify(
        "<?php echo session('notify_mssg')?>",
        "<?php echo session('notify_stat')?>"
  );
});
</script>
@endif