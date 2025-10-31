<div class="modal fade" id="importModal" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Import</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ $importUrl }}" enctype="multipart/form-data" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="InputImage">Choose File</label>
                        <input type="file" name="file"
                            class="custom-file-input @if ($errors->has('file')) is-invalid @endif" id="InputImage"
                            placeholder="Select image" aria-describedby="FileError" aria-invalid="true">
                        <span id="FileError" class="error invalid-feedback">
                            @if ($errors->has('file'))
                                {{ $errors->first('file') }}
                            @endif
                        </span>
                    </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Import</button>
            </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
