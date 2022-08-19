

<div id="deleteModal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true" style="display: none;">
    <div style="{{((app()->getLocale()=='en')?'position:relative;top:50px;':'')}}" class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="deleteModalLabel">{{__('admindash.deletemodal.delete')}}</h4> </div>
            <div class="modal-body">
                <h3>{{__('admindash.deletemodal.delete_warning1')}} <span id="deleteCount"></span> {{__('admindash.deletemodal.delete_warning2')}}</h3>
            </div>
            <div class="modal-footer">
              <form id="deleteModalForm" class="form" action="" method="post">
                  {{csrf_field()}}
                  <input id="deleteInput" type="hidden" name="ids" value="">
              </form>
                <button type="button" class="btn btn-danger" onclick="deleteSubmit()">{{__('admindash.deletemodal.delete_confirm')}}</button>
                <button type="button" class="btn btn-warning" data-dismiss="modal">{{__('admindash.actions.cancel')}}</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>



<!-- /.modal -->
