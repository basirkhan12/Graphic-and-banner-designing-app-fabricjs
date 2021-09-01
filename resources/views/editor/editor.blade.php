<!DOCTYPE html>
<html lang="en">
<head>
  
  @include('editor.tool.head')

</head>
<body>

  
  @include('editor.layouts.unsplash-images')

  <!-- Profit Editor -->
  <div id="editor">
    
    <!-- Deselect Element Overlay -->
    <div id="editor-deselect-overlay"></div>

    <!-- Top Menu Bar -->
    @include('editor.layouts.editor-top')
    <!-- Element Toolbar -->
    @include('editor.layouts.editor-left')
    
    <!-- Canvas Image -->
    <div id="editor-content">
      <div id="editor-canvas">
        <canvas id="graphic-editor" width='500px' height='500px'></canvas>
      </div>
    </div>


    <!-- Sidebar -->
    <div id="editor-layers">

      <div id="sidebar-layers-nav" class="clearfix">
        <a id="settings-tab" href="#" style="width: 50%;">Graphic Settings</a>
        <a id="editing-tab" style="width: 50%;" href="#">Currently Editing</a>
      </div>



      <div id="editing-tab-content" style="display: none">
        <div class="sidebarbox" id="arrange-selected-object" style="display: none">
          <h3 class="sidebarbox-header"><i class="fa fa-layer-group"></i> Arrangement</h3>
          <div class="sidebarbox-content sidebarbox-content-inner">

            <div class="row">
              <div class="col-6" style="padding-right: 5px;">
                <a id="editor-delete" href="#" class="btn btn-sm btn-block btn-secondary"><i class="fa fa-trash"></i> Trash</a>
              </div>
              <div class="col-6" style="padding-left: 5px;">
                <a id="editor-clone" href="#" class="btn btn-sm btn-block btn-secondary"><i class="fa fa-copy"></i> Clone</a>
              </div>

              <br clear="all"><br>

              <div class="col-6"  style="padding-right: 5px;">
                <a id="sendBackwards" href="#" class="btn btn-sm btn-block btn-editor-icon btn-secondary">send to Back</a>
              </div>
              <div class="col-6" style="padding-left: 5px;padding-right: 5px;">
                <a id="bringForward" href="#" class="btn btn-sm btn-block btn-editor-icon btn-secondary">Bring Up</a>
              </div>
              
            </div>

          </div>
        </div>

        <div id="edit-text-options" style="display: none">

          <div class="sidebarbox">
            <h3 class="sidebarbox-header"><i class="fa fa-font"></i> Typography</h3>
            <div class="sidebarbox-content sidebarbox-content-inner">

              <div class="row" id="text-editing-buttons">
                <div class="col-4" style="padding-right: 5px;">
                  <a id="text-align-left" href="#" class="btn btn-sm btn-block btn-editor-icon btn-secondary"><i class="fa fa-align-left"></i></a>
                </div>
                <div class="col-4" style="padding-left: 5px;padding-right: 5px;">
                  <a id="text-align-center" href="#" class="btn btn-sm btn-block btn-editor-icon btn-secondary"><i class="fa fa-align-center"></i></a>
                </div>
                <div class="col-4" style="padding-left: 5px;">
                  <a id="text-align-right" href="#" class="btn btn-sm btn-block btn-editor-icon btn-secondary"><i class="fa fa-align-right"></i></a>
                </div>

                <br clear="all"><br>

                <div class="col-3"  style="padding-right: 5px;">
                  <a id="text-bold" href="#" class="btn btn-sm btn-block btn-editor-icon btn-secondary"><i class="fa fa-bold"></i></a>
                </div>
                <div class="col-3" style="padding-left: 5px;padding-right: 5px;">
                  <a id="text-underline" href="#" class="btn btn-sm btn-block btn-editor-icon btn-secondary"><i class="fa fa-underline"></i></a>
                </div>
                <div class="col-3" style="padding-left: 5px;padding-right: 5px;">
                  <a id="text-italic" href="#" class="btn btn-sm btn-block btn-editor-icon btn-secondary"><i class="fa fa-italic"></i></a>
                </div>
                <div class="col-3"  style="padding-left: 5px;">
                  <a id="text-strikethrough" href="#" class="btn btn-sm btn-block btn-editor-icon btn-secondary"><i class="fa fa-strikethrough"></i></a>
                </div>
              </div>

              <div class="row" style="padding-top: 15px">
                <div class="col-4" style="padding-right: 5px;">
                  <h3 class="sidebarbox-small-header">Font Size</h3>
                  <input type="number" class="form-control" id="text-font-size">
                </div>

                <div class="col-8" style="padding-left: 5px;">
                  <h3 class="sidebarbox-small-header">Font Family</h3>
                  <select class="select2 edit-element-attribute form-control" data-type="fontFamily">
                    <option value="Arial">Arial</option>
                    <option value="Arial Black">Arial Black</option>
                    <option value="Impact">Impact</option>
                    <option value="Tahoma">Tahoma</option>
                    <option value="Times New Roman">Times New Roman</option>
                  </select>
                </div>
              </div>

              <h3 class="sidebarbox-small-header">Line Height</h3>
              <div class="editor-input-slidercontainer">
                <input type="range" min="0.6" max="1.2" step="0.05" class="editor-input-slider edit-element-attribute-slider" data-type="lineHeight">
              </div>

              <h3 class="sidebarbox-small-header">Letter Spacing</h3>
              <div class="editor-input-slidercontainer">
                <input type="range" min="-100" max="100" step="5" class="editor-input-slider edit-element-attribute-slider" data-type="charSpacing">
              </div>

              <div style="display: none">
                <h3 class="sidebarbox-small-header">Text Align</h3>
                <select class="select2 edit-element-attribute form-control" data-type="textAlign">
                  <option value="left">Left</option>
                  <option value="center">Center</option>
                  <option value="right">Right</option>
                </select>

                <h3 class="sidebarbox-small-header">Font Weight</h3>
                <select class="select2 edit-element-attribute form-control" data-type="fontWeight">
                  <option value="400">Regular</option>
                  <option value="800">Bold</option>
                </select>

                <h3 class="sidebarbox-small-header">Italic</h3>
                <select class="select2 edit-element-attribute form-control" data-type="fontStyle">
                  <option value="normal">Normal</option>
                  <option value="italic">Italic</option>
                </select>

                <h3 class="sidebarbox-small-header">Underline</h3>
                <select class="select2 edit-element-attribute form-control" data-type="underline">
                  <option value="true">On</option>
                  <option value="false">Off</option>
                </select>

                <h3 class="sidebarbox-small-header">Line Through</h3>
                <select class="select2 edit-element-attribute form-control" data-type="linethrough">
                  <option value="true">On</option>
                  <option value="false">Off</option>
                </select>
              </div>

            </div>
          </div>

          <div class="sidebarbox">
            <h3 class="sidebarbox-header"><i class="fa fa-paint-brush"></i> Color</h3>
            <div class="sidebarbox-content sidebarbox-content-inner">

              <input type='text' class="colorpicker" id="text-colorpicker" />

            </div>
          </div>

          <div class="sidebarbox">
            <h3 class="sidebarbox-header"><i class="fa fa-square"></i> Stroke</h3>
            <div class="sidebarbox-content sidebarbox-content-inner">

              <input type='text' class="colorpicker" id="text-stroke-colorpicker" />

              <h3 class="sidebarbox-small-header">Width</h3>
              <div class="editor-input-slidercontainer">
                <input type="range" min="0" max="20" step="1" class="editor-input-slider" id="text-stroke">
              </div>

            </div>
          </div>

          <div class="sidebarbox">
            <h3 class="sidebarbox-header"><i class="fa fa-circle"></i> Text Shadow</h3>
            <div class="sidebarbox-content sidebarbox-content-inner">

              <input type='text' class="colorpicker" id="text-shadow-colorpicker" />

              <div class="row" style="padding-top: 10px;">
                <div class="col-4" style="padding-right: 5px;">
                  <h3 class="sidebarbox-small-header">Blur</h3>
                  <input type="number" class="form-control edit-text-shadow" id="text-shadow-blur">
                </div>

                <div class="col-4" style="padding-right: 5px;padding-left: 5px;">
                  <h3 class="sidebarbox-small-header">Offset X</h3>
                  <input type="number" class="form-control edit-text-shadow" id="text-shadow-offsetX">
                </div>

                <div class="col-4" style="padding-left: 5px;">
                  <h3 class="sidebarbox-small-header">Offset X</h3>
                  <input type="number" class="form-control edit-text-shadow" id="text-shadow-offsetY">
                </div>
              </div>

            </div>
          </div>

        </div>

        <div id="edit-shape-options" style="display: none">

          <div class="sidebarbox">
            <h3 class="sidebarbox-header"><i class="fa fa-square"></i> Size</h3>
            <div class="sidebarbox-content sidebarbox-content-inner">

              <div class="row">
                <div class="col-6" style="padding-right: 5px;">
                  <h3 class="sidebarbox-small-header">Width</h3>
                  <input type="number" class="form-control" id="shape-width">
                </div>

                <div class="col-6" style="padding-left: 5px;">
                  <h3 class="sidebarbox-small-header">Height</h3>
                  <input type="number" class="form-control" id="shape-height">
                </div>
              </div>

            </div>
          </div>

          <div class="sidebarbox">
            <h3 class="sidebarbox-header"><i class="fa fa-cogs"></i> Background</h3>
            <div class="sidebarbox-content sidebarbox-content-inner">
              <div id="gp"></div>
              <h3 class="sidebarbox-small-header">Opacity</h3>
              <div class="editor-input-slidercontainer">
                <input type="range" min="0.1" max="1" step="0.1" class="editor-input-slider" id="shape-opacity">
              </div>

              <h3 class="sidebarbox-small-header">Corner Radius</h3>
              <div class="editor-input-slidercontainer">
                <input type="range" min="0" max="100" step="5" class="editor-input-slider" id="shape-radius">
              </div>

            </div>
          </div>

          <div class="sidebarbox">
            <h3 class="sidebarbox-header"><i class="fa fa-square"></i> Stroke</h3>
            <div class="sidebarbox-content sidebarbox-content-inner">

              <input type='text' class="colorpicker" id="shape-border-colorpicker" />

              <h3 class="sidebarbox-small-header">Width</h3>
              <div class="editor-input-slidercontainer">
                <input type="range" min="0" max="20" step="1" class="editor-input-slider" id="shape-border">
              </div>

            </div>
          </div>

          <div class="sidebarbox">
          <h3 class="sidebarbox-header"><i class="fa fa-circle"></i> Drop Shadow</h3>
            <div class="sidebarbox-content sidebarbox-content-inner">

              <input type='text' class="colorpicker" id="shape-shadow-colorpicker" />

              <div class="row" style="padding-top: 10px;">
                <div class="col-4" style="padding-right: 5px;">
                  <h3 class="sidebarbox-small-header">Blur</h3>
                  <input type="number" class="form-control edit-shape-shadow" id="shape-shadow-blur">
                </div>

                <div class="col-4" style="padding-right: 5px;padding-left: 5px;">
                  <h3 class="sidebarbox-small-header">Offset X</h3>
                  <input type="number" class="form-control edit-shape-shadow" id="shape-shadow-offsetX">
                </div>

                <div class="col-4" style="padding-left: 5px;">
                  <h3 class="sidebarbox-small-header">Offset X</h3>
                  <input type="number" class="form-control edit-shape-shadow" id="shape-shadow-offsetY">
                </div>
              </div>

            </div>
          </div>


        </div>


        <div id="edit-image-options" style="display: none">

          <div class="sidebarbox">
            <h3 class="sidebarbox-header"><i class="fa fa-square"></i> Settings</h3>
            <div class="sidebarbox-content sidebarbox-content-inner">
              <h3 class="sidebarbox-small-header">Opacity</h3>
              <div class="editor-input-slidercontainer">
                <input type="range" min="0.01" max="1" step="0.01" class="editor-input-slider" id="image-opacity">
              </div>
            </div>
          </div>

          <!--<div class="sidebarbox">
            <h3 class="sidebarbox-header"><i class="fa fa-square"></i> Effects</h3>
            <div class="sidebarbox-content sidebarbox-content-inner">

              <h3 class="sidebarbox-small-header">Filters</h3>
              <select class="select2 form-control" id="image-filter">
                <option value="off">None</option>
                <option value="sepia">Sepia</option>
                <option value="greyscale">Greyscale</option>
                <option value="blackwhite">Black/White</option>
                <option value="brownie">Brownie</option>
                <option value="vintage">Vintage</option>
                <option value="kodachrome">Kodachrome</option>
                <option value="technicolor">Technicolor</option>
                <option value="polaroid">Polaroid</option>
                <option value="invert">Invert</option>
              </select>

              <h3 class="sidebarbox-small-header">Remove White</h3>
              <select class="select2 form-control" id="image-remove-white">
                <option value="off">Off</option>
                <option value="on">On</option>
              </select>

              <div id="image-filter-checkboxes" style="display:none">
                <input type="checkbox">
              </div>

              <h3 class="sidebarbox-small-header">Filters</h3>
              <div class="editor-input-slidercontainer">
                <input type="range" min="0" max="1" step="0.01" class="editor-input-slider" id="image-blur">
              </div>


            </div>
          </div> --->

          <div class="sidebarbox">
            <h3 class="sidebarbox-header"><i class="fa fa-square"></i> Color Overlay</h3>
            <div class="sidebarbox-content sidebarbox-content-inner">

              <h3 class="sidebarbox-small-header">Enable</h3>
              <select class="select2 form-control" id="image-color-overlay">
                <option value="off">Off</option>
                <option value="on">On</option>
              </select>

              <h3 class="sidebarbox-small-header">Color</h3>
              <input type='text' class="colorpicker" id="image-color-overlay-colorpicker" />
            </div>
          </div>

        </div>

      </div>


      <!-- Image Settings -->

      <div id="editing-settings-content" style="display: none">

        <div class="sidebarbox">
          <h3 class="sidebarbox-header"><i class="fa fa-edit"></i> Image Size</h3>
          <div class="sidebarbox-content">
            <div class="sidebarbox-content-inner">

              <h3 class="sidebarbox-small-header">Width</h3>
              <div class="input-group">
                <input id="graphic-width" value="500" type="number" class="form-control" autocomplete="off">
                <div class="input-group-append">
                  <span class="input-group-text" id="inputGroupPrepend">PX</span>
                </div>
              </div>

              <h3 class="sidebarbox-small-header">Height</h3>
              <div class="input-group">
                <input id="graphic-height" value="500" type="number" class="form-control"  autocomplete="off">
                <div class="input-group-append">
                  <span class="input-group-text" id="inputGroupPrepend">PX</span>
                </div>
              </div>

            </div>
          </div>
        </div>

        <div class="sidebarbox">
          <h3 class="sidebarbox-header"><i class="fa fa-paint-roller"></i> Background</h3>
          <div class="sidebarbox-content">
            <div class="sidebarbox-content-inner">

              <h3 class="sidebarbox-small-header">Color</h3>
              <input id="graphic-bgcolor" name="graphic[bgcolor]" type="text" class="form-control">

            </div>
          </div>
        </div>

      </div>


    </div>


  </div>

  @include('editor.tool.saveform')

  @include('editor.tool.scripts')
  </body>
</html>
