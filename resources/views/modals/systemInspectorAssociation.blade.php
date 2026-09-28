<div class="modal fade" id="systemInspectorModal" tabindex="-1" role="dialog" aria-labelledby="systemInspectorModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="" method="POST" id="systemInspectorForm">
                @csrf
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title" id="systemInspectorModalLabel">Allot Inspector To System</h4>
                </div>
                <div class="modal-body">
                    @isset($inspectors)
                        <div class="form-group">
                            <label for="">Select Inspector</label>
                            <select class="form-control required" name="inspector_id">
                                <option value="" selected disabled>Select Inspector</option>
                                @foreach ($inspectors as $inspector)
                                    <option value="{{$inspector->id}}">{{$inspector->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    @endisset
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Associate</button>
                    <a href="javascript:;" class="btn btn-default" data-dismiss="modal">Close</a>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $('#systemInspectorForm').validate();
</script>