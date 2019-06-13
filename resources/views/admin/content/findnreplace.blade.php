<!-- Modal -->
<div class="modal fade" id="findnreplace_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="">
                <h5 class="modal-title" id="exampleModalLabel">Find and replace a string</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form method="post" action="/admin/contents/find-n-replace">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Find string</label>
                        <input type="text" name="find" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="" required>

                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Replacement string</label>
                        <input type="text" class="form-control" name="replacement" id="exampleInputPassword1" placeholder="" required>
                    </div>
                    <input type="hidden" name="action" id="action" value="">
                    <button type="submit" class="btn btn-primary" id="replace" style="display: none">Submit</button>
                </form>

            </div>
            <div class="modal-footer" style="">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="find">Find</button>
                <button type="button" class="btn btn-primary" id="find_and_replace">Find and Replace</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $("#find").on('click',function(){
            $("#action").val('find');
            $("#exampleInputPassword1").removeAttr('required');
            $("#replace").click();
        });

        $("#find_and_replace").on('click',function(){
            $("#action").val('replace');
            $("#exampleInputPassword1").attr('required','required');
            $("#replace").click();
        });
    });
</script>
