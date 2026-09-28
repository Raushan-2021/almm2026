<div id="msgModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">{{ Session::get('msg')['status'] }}</h4>
        </div>
        <div class="modal-body">
            <p>{{ Session::get('msg')['msg'] }}</p>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
        </div>
        </div>
    </div>
</div>
