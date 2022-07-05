

</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->
<script src="{{url('des/admin/rtl')}}/plugins/jQuery/jQuery-2.2.0.min.js"></script>
<!-- Tags Input -->
<script src="https://cdn.jsdelivr.net/bootstrap.tagsinput/0.4.2/bootstrap-tagsinput.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="{{url('des/admin/rtl')}}/bootstrap/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="{{url('https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js')}}"></script>
<script src="{{url('https://cdn.rawgit.com/ashl1/datatables-rowsgroup/fbd569b8768155c7a9a62568e66a64115887d7d0/dataTables.rowsGroup.js')}}"></script>
<script src="{{url('https://cdn.datatables.net/buttons/1.4.0/js/dataTables.buttons.min.js')}}"></script>
<script src="{{url('https://cdn.datatables.net/buttons/1.4.0/js/buttons.flash.min.js')}}"></script>
<script src="{{url('https://cdn.datatables.net/buttons/1.4.0/js/buttons.html5.min.js')}}"></script>
<script src="{{url('https://cdn.datatables.net/buttons/1.4.0/js/buttons.print.min.js')}}"></script>
<script src="{{url('https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js')}}"></script>
<script src="{{url('https://cdn.rawgit.com/bpampuch/pdfmake/0.1.27/build/pdfmake.min.js')}}"></script>
<script src="{{url('https://cdn.rawgit.com/bpampuch/pdfmake/0.1.27/build/vfs_fonts.js')}}"></script>
<script src="{{url('https://cdn.datatables.net/select/1.2.6/js/dataTables.select.js')}}"></script>
<!-- SlimScroll -->
<script src="{{url('des/admin/rtl')}}/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="{{url('des/admin/rtl')}}/plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="{{url('des/admin/rtl')}}/dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{url('des/admin/rtl')}}/dist/js/demo.js"></script>
<!-- CK Editor -->
<script src="https://cdn.ckeditor.com/4.5.7/standard/ckeditor.js"></script>
<!-- Croppie -->
<script src="{{url('')}}/des/croppie/croppie.js"></script>
<!-- script to add class "active" to the currently clicked treeview -->
<script type="text/javascript">
$(document).ready(function(){
  $('li').each(function(){
    if($(this).find('a').attr('href')==`{{url()->current()}}`){
      if($(this).parent().parent().hasClass('treeview')){
          $(this).parent().parent().addClass('active')
      };
    }
  });
});
</script>
@stack('scripts')
<!-- Optionally, you can add Slimscroll and FastClick plugins.
   Both of these plugins are recommended to enhance the
   user experience. Slimscroll is required when using the
   fixed layout. -->
</body>
</html>
