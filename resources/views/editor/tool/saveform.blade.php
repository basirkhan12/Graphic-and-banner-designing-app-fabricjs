
<div class="modal fade" id="saveDesign" tabindex="-1" role="dialog" aria-labelledby="save-design" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="save-design">Save the File</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          
         
          @php
            if(!isset($id)){
              $id="";
            }
          @endphp
          
          
            
          
          <div class="form-group input-title-con row">
            <label for="input-title" class="col-sm-2 col-form-label">Title</label>
            <div class="col-sm-10">
              <input name="input-title" type="text" class="form-control" id="input-title" placeholder="Title" value="{{ $title }}">
              
            </div>
          </div>
          <div class="form-group input-keyword-con row">
            <label for="input-keyword" class="col-sm-2 col-form-label">Keywork</label>
            <div class="col-sm-10  control-group">
              <input type="text" class="form-control" id="input-keyword" placeholder="Keywords" value="{{ $keywords }}">
              
            </div>
          </div>
        
          <fieldset class="form-group">
            <div class="row">
              <legend class="col-form-label col-sm-2 pt-0">Visibility</legend>
              <div class="col-sm-10">
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="d-visible" id="input-public" value="public" checked>
                  <label class="form-check-label" for="input-public">
                   Public
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="d-visible" id="input-private" value="private">
                  <label class="form-check-label" for="input-private">
                    Only me
                  </label>
                </div>
              </div>
            </div>
          </fieldset>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button id="ajaxSave" type="button" class="btn btn-primary">Save Design</button>
        </div>
      </div>
    </div>
  </div>