var canvas;
$(document).ready(function() {
 
  var zoomMax = 23;
  var SCALE_FACTOR = 1.3;
  // Define Canvas
   canvas = new fabric.Canvas('graphic-editor', {
    selectionColor: 'blue',
    selectionLineWidth: 2,
    
  });
  canvas.preserveObjectStacking = true;


  // Guidelines
  initCenteringGuidelines(canvas)
  initAligningGuidelines(canvas)
 
  

  // Basic Settings
  fabric.Object.prototype.set({
    padding: 0
  })

  // Image Filters
  canvas.on({
    'object:selected': function() {
      var filters = ['grayscale', 'invert', 'remove-color', 'sepia', 'brownie',
                      'brightness', 'contrast', 'saturation', 'noise', 'vintage',
                      'pixelate', 'blur', 'sharpen', 'emboss', 'technicolor',
                      'polaroid', 'blend-color', 'gamma', 'kodachrome',
                      'blackwhite', 'blend-image', 'hue', 'resize'];
    }
  })
/*============ Undo Redo Code Start ============*/
  // Undo System
  var _config = {
    canvasState             : [],// array for storing Canvas States
    currentStateIndex       : -1, // it is the initail stage of canvas state array
    undoStatus              : false,// it is true when there is undostates
    redoStatus              : false,// it is true when there is redostates
    undoFinishedStatus      : 1,
    redoFinishedStatus      : 1,
    undoButton              : document.getElementById('undo'),// uses for one time initializ because we need to many time
    redoButton              : document.getElementById('redo'),
  }

  canvas.on('object:modified', function(){
    updateCanvasState() // event tigger when change occure
  })

  canvas.on('object:added', function(){
    updateCanvasState() // event tigger when change occure and update the undo redo state.
  })

  $('#undo').on('click',function() {// function call when some one click on undo button
    if(_config.undoFinishedStatus){
      if(_config.currentStateIndex == -1){
        _config.undoStatus = false;
      }
      else{
        if (_config.canvasState.length >= 1) {
          _config.undoFinishedStatus = 0;
          if(_config.currentStateIndex != 0){
            _config.undoStatus = true;
            canvas.loadFromJSON(_config.canvasState[_config.currentStateIndex-1],function(){
                var jsonData = JSON.parse(_config.canvasState[_config.currentStateIndex-1]);
                canvas.renderAll();
                _config.undoStatus = false;
                _config.currentStateIndex -= 1;
                _config.undoButton.removeAttribute("disabled");
                if(_config.currentStateIndex !== _config.canvasState.length-1){
                  _config.redoButton.removeAttribute('disabled');
                }
              _config.undoFinishedStatus = 1;
            });
          }
          else if(_config.currentStateIndex == 0){
            canvas.clear();
            _config.undoFinishedStatus = 1;
            _config.undoButton.disabled= "disabled";
            _config.redoButton.removeAttribute('disabled');
            _config.currentStateIndex -= 1;
          }
        }
      }
    }
  })

  $('#redo').click(function() {// function call when some one click on redo button
    if(_config.redoFinishedStatus) {
      if((_config.currentStateIndex == _config.canvasState.length-1) && _config.currentStateIndex != -1){
        _config.redoButton.disabled= "disabled";
      }else{
        if (_config.canvasState.length > _config.currentStateIndex && _config.canvasState.length != 0){
          _config.redoFinishedStatus = 0;
          _config.redoStatus = true;
          canvas.loadFromJSON(_config.canvasState[_config.currentStateIndex+1],function(){
              var jsonData = JSON.parse(_config.canvasState[_config.currentStateIndex+1]);
              canvas.renderAll();
              _config.redoStatus = false;
              _config.currentStateIndex += 1;
              if(_config.currentStateIndex != -1){
                _config.undoButton.removeAttribute('disabled');
              }
            _config.redoFinishedStatus = 1;
            if((_config.currentStateIndex == _config.canvasState.length-1) && _config.currentStateIndex != -1){
              _config.redoButton.disabled = "disabled";
            }
          });
        }
      }
    }
  })

  var updateCanvasState = function() {
    if((_config.undoStatus == false && _config.redoStatus == false)){
      var jsonData        = canvas.toJSON();
      var canvasAsJson        = JSON.stringify(jsonData);
      if (_config.currentStateIndex < _config.canvasState.length-1){
        var indexToBeInserted                  = _config.currentStateIndex+1;
        _config.canvasState[indexToBeInserted] = canvasAsJson;
        var numberOfElementsToRetain           = indexToBeInserted+1;
        _config.canvasState                    = _config.canvasState.splice(0,numberOfElementsToRetain);
      } else{
        _config.canvasState.push(canvasAsJson);
      }
      _config.currentStateIndex = _config.canvasState.length-1;
      if ((_config.currentStateIndex == _config.canvasState.length-1) && _config.currentStateIndex != -1){
        _config.redoButton.disabled= "disabled";
      }
    }
  }

/*============Undo Redo Code End============*/

  // Add Text
  $('#add-text').click(function() {
    let font = 'Arial'
    if (font === '') {
      font = 'Arial'
    }
    let textcolor = '#000'
    let text = new fabric.IText('Click to Edit', {
      fontFamily: font,
      lineHeight: '1',
      charSpacing: '0',
      textAlign: 'center',
      fontWeight: '600',
      fontSize: '32',
      underline: false,
      overline: false,
      linethrough: false,
      fill: textcolor,
      left: 100,
      top: 100,
      objecttype: 'text'
    })
    canvas.add(text)
  })

  // Add Rectangle
  $('#add-rectangle').click(function() {
    let rectangle = new fabric.Rect({
      left: 100,
      top: 50,
      width: 200,
      height: 100,
      fill: 'green',
      padding: 10,
      rx: 10,
      ry: 10
    })
    canvas.add(rectangle)
  })

  // Add Circle
  $('#add-circle').click(function() {
    let circle = new fabric.Circle({
      left: 30,
      top: 30,
      radius: 50,
      strokeWidth: 3,
      stroke: 'black',
      fill: 'grey',
      selectable: true
    });
    canvas.add(circle)
  })

  $('#add-ellipse').click(function() {
    let ecl = new fabric.Triangle({
      left: 30,
      top: 30,
      fill: 'grey',
      selectable: true
    });
    canvas.add(ecl)
  })


  // Layer Management
  $('#sendBackwards').click(function() {
    let obj = canvas.getActiveObject()
    canvas.sendBackwards(obj)
  })

  $('#sendToBack').click(function() {
    let obj = canvas.getActiveObject()
    canvas.sendToBack(obj)
  })

  $('#bringForward').click(function() {
    let obj = canvas.getActiveObject()
    canvas.bringForward(obj)
  })

  $('#bringToFront').click(function() {
    let obj = canvas.getActiveObject()
    canvas.bringToFront(obj)
  })

  // Delete and Clone
  $('#editor-delete').click(function() {
    let activeGroup = canvas.getActiveObjects()
    if (confirm('Delete selected layer?')) {
      canvas.discardActiveObject();
      activeGroup.forEach(function(object) {
        canvas.remove(object);
      });
    }
  })

  $('#editor-clone').click(function() {
    var object = canvas.getActiveObject();

object.clone(function(clone) {
    canvas.add(clone.set({
        left: object.left + 10, 
        top: object.top + 10
    }));
});
  
    canvas.requestRenderAll()
  })

//Text Shadow  setting 
  $('.edit-text-shadow').on('input',function() {
    var shadow = {
        color: $('#text-shadow-colorpicker').val(),
        blur: $('#text-shadow-blur').val(),
        offsetX: $('#text-shadow-offsetX').val(),
        offsetY: $('#text-shadow-offsetY').val()
    }
    var obj = canvas.getActiveObject()
    obj.setShadow(shadow)
    canvas.renderAll()
  })

//Shap Shadow setting
  $('.edit-shape-shadow').on('input',function() {
    var shadow = {
        color: $('#shape-shadow-colorpicker').val(),
        blur: $('#shape-shadow-blur').val(),
        offsetX: $('#shape-shadow-offsetX').val(),
        offsetY: $('#shape-shadow-offsetY').val()
    }
    var obj = canvas.getActiveObject()
    obj.setShadow(shadow)
    canvas.renderAll()
  })

//Shap Width management
  $('#shape-width').on("input",function() {
    var obj = canvas.getActiveObject()
    obj.set('width', parseInt($(this).val()))
    obj.setCoords()
    canvas.renderAll()
  })

  //Shap height management
  $('#shape-height').on("input",function() {
    var obj = canvas.getActiveObject()
    obj.set('height', parseInt($(this).val()))
    obj.setCoords()
    canvas.renderAll()
  })

//Text style
  function setTextParam(param, value) {
    var obj = canvas.getActiveObject()
    if (obj && value) {
      if (param === 'underline' || param === 'overline' || param === 'linethrough') {
        if (value === 'true') {
          obj.set(param, true)
        } else if (value === 'false') {
          obj.set(param, false)
        }
      } else {
        obj.set(param, value)
      }
      canvas.renderAll()
    }
  }
//Text Strock
  $('#text-stroke').on('input', function () {
    var obj = canvas.getActiveObject()
    if ($(this).val() === '0') {
      obj.set('stroke', false)
      obj.set('strokeWidth', 0)
      canvas.renderAll()
    } else {
      obj.set('stroke', $('#text-stroke-colorpicker').val())
      setTextParam('strokeWidth', parseInt($(this).val()))
      canvas.renderAll()
    }
  })
//Shape Setting
  $('#shape-border').on('input', function () {
    var obj = canvas.getActiveObject()
    if ($(this).val() === '0') {
      obj.set('stroke', false)
      obj.set('strokeWidth', 0)
      canvas.renderAll()
    } else {
      obj.set('stroke', $('#shape-border-colorpicker').val())
      setTextParam('strokeWidth', parseInt($(this).val()))
      canvas.renderAll()
    }
  })

  $('#shape-radius').on('input', function () {
    var obj = canvas.getActiveObject()
    let val = $(this).val()
    obj.set({
      'rx': val,
      'ry': val
    })
    canvas.renderAll()
  })

  $('#shape-opacity, #text-opacity, #image-opacity').on('input', function () {
    setTextParam('opacity', $(this).val())
  })

  $('.edit-element-attribute').change(function() {
    setTextParam($(this).data('type'), $(this).find('option:selected').val())
  })

  $('#text-font-size').keyup(function() {
    setTextParam('fontSize', $(this).val())
  })

  $('.edit-element-attribute-slider').on('input', function () {
    setTextParam($(this).data('type'), $(this).val())
  })

  $('#text-align-left').click(function() {
    $(this).addClass('active')
    $('#text-align-center, #text-align-right').removeClass('active')
    $('select[data-type="textAlign"]').val('left').trigger('change')
  })

  $('#text-align-center').click(function() {
    $(this).addClass('active')
    $('#text-align-left, #text-align-right').removeClass('active')
    $('select[data-type="textAlign"]').val('center').trigger('change')
  })

  $('#text-align-right').click(function() {
    $(this).addClass('active')
    $('#text-align-center, #text-align-left').removeClass('active')
    $('select[data-type="textAlign"]').val('right').trigger('change')
  })


  $('#text-bold').click(function() {
    if ($(this).hasClass('active')) {
      $(this).removeClass('active')
      $('select[data-type="fontWeight"]').val('400').trigger('change')
    } else {
      $(this).addClass('active')
      $('select[data-type="fontWeight"]').val('800').trigger('change')
    }
  })

  $('#text-underline').click(function() {
    if ($(this).hasClass('active')) {
      $(this).removeClass('active')
      $('select[data-type="underline"]').val('false').trigger('change')
    } else {
      $(this).addClass('active')
      $('select[data-type="underline"]').val('true').trigger('change')
    }
  })

  $('#text-strikethrough').click(function() {
    if ($(this).hasClass('active')) {
      $(this).removeClass('active')
      $('select[data-type="linethrough"]').val('false').trigger('change')
    } else {
      $(this).addClass('active')
      $('select[data-type="linethrough"]').val('true').trigger('change')
    }
  })

  $('#text-italic').click(function() {
    if ($(this).hasClass('active')) {
      $(this).removeClass('active')
      $('select[data-type="fontStyle"]').val('normal').trigger('change')
    } else {
      $(this).addClass('active')
      $('select[data-type="fontStyle"]').val('italic').trigger('change')
    }
  })

  $('#graphic-width').keyup(function() {
    var width = $(this).val()
    var half_width = parseInt(width) / 2 - 20
    $('.canvas-container').width(width)
    canvas.setWidth(width)
    $('.canvas-container').css('margin-left', `-${half_width}px`)
    $('input#graphic_width').val(width)
  })

  $('#graphic-width').on('mousewheel',function(e){
    var width = $(this).val()
    var half_width = parseInt(width) / 2 - 20
    $('.canvas-container').width(width)
    canvas.setWidth(width)
    $('.canvas-container').css('margin-left', `-${half_width}px`)
    $('input#graphic_width').val(width)
  })

  $('#graphic-height').keyup(function() {
    var height = $(this).val()
    var half_height = parseInt(height) / 2 - 20
    $('.canvas-container').height(height)
    canvas.setHeight(height)
    $('.canvas-container').css('margin-top', `-${half_height}px`)
    $('input#graphic_height').val(height)
  })

  $('#graphic-height').on('mousewheel',function(e){
    var height = $(this).val()
    var half_height = parseInt(height) / 2 - 20
    $('.canvas-container').height(height)
    canvas.setHeight(height)
    $('.canvas-container').css('margin-top', `-${half_height}px`)
    $('input#graphic_height').val(height)
  })

  $("#graphic-bgimage").change(function() {
      canvas.setBackgroundColor({source: $(this).val()}, canvas.renderAll.bind(canvas));
      $('input#graphic_bgimage').val($(this).val())
  });

  $("#graphic-font").on("change", function (e) {   $('input#graphic_font').val($(this).val()) });
  $("#graphic-font").val($('input#graphic_font').val()).trigger('change');


  canvas.on('selection:updated', function () {
    selectedObjectSidebar()
  });

  canvas.on('selection:created', function () {
    selectedObjectSidebar()
  });

  canvas.on('selection:cleared', function () {
     $('#layers-tab').trigger('click')
     $('#edit-text-options, #edit-shape-options, #edit-image-options, #arrange-selected-object').hide()
  });

  function selectedObjectSidebar() {
    var selectedObject = canvas.getActiveObjects()
    $('#editing-tab').trigger('click')

    // Check if Only 1 Selected
    if (selectedObject.length === 1) {
      $('#edit-text-options, #edit-shape-options, #edit-image-options').hide()
      $('#arrange-selected-object').show()

      // Check Type (text, shape, image)
      let objectType = selectedObject[0].type

      // Populate w/ Data
      if (objectType === 'i-text') {
        $('#edit-text-options').show()

        // Get Selected Element Info
        $('#text-colorpicker').spectrum("set", canvas.getActiveObject().fill)
        $('select[data-type="fontFamily"]').val(canvas.getActiveObject().fontFamily).trigger('change')
        $('#text-font-size').val(canvas.getActiveObject().fontSize).trigger('change')
        $('select[data-type="lineHeight"]').val(canvas.getActiveObject().lineHeight).trigger('change')
        $('select[data-type="charSpacing"]').val(canvas.getActiveObject().charSpacing).trigger('change')
        $('#text-opacity').val(canvas.getActiveObject().opacity).trigger('change')
        $('#text-stroke-colorpicker').spectrum("set", canvas.getActiveObject().stroke)
        $('#text-stroke').val(canvas.getActiveObject().strokeWidth).trigger('change')

        // Text Editing Buttons
        $('#text-editing-buttons .btn').removeClass('active')

        let textAlign = canvas.getActiveObject().textAlign
        $('select[data-type="textAlign"]').val(textAlign).trigger('change')

        if (textAlign === 'left') {
          $('#text-align-left').addClass('active')
        } else if (textAlign === 'center') {
          $('#text-align-center').addClass('active')
        } else if (textAlign === 'right') {
          $('#text-align-right').addClass('active')
        }


        let fontWeight = canvas.getActiveObject().fontWeight
        $('select[data-type="fontWeight"]').val(fontWeight).trigger('change')
        if (fontWeight === '800') {
          $('#text-bold').addClass('active')
        } else {
          $('#text-bold').removeClass('active')
        }

        let fontStyle = canvas.getActiveObject().fontStyle
        $('select[data-type="fontStyle"]').val(fontStyle).trigger('change')
        if (fontStyle === 'italic') {
          $('#text-italic').addClass('active')
        } else {
          $('#text-italic').removeClass('active')
        }

        let underline = canvas.getActiveObject().underline
        $('select[data-type="underline"]').val(underline).trigger('change')
        if (underline === true) {
          $('#text-underline').addClass('active')
        } else {
          $('#text-underline').removeClass('active')
        }

        let linethrough = canvas.getActiveObject().linethrough
        $('select[data-type="linethrough"]').val(linethrough).trigger('change')
        if (linethrough === true) {
          $('#text-strikethrough').addClass('active')
        } else {
          $('#text-strikethrough').removeClass('active')
        }


        if (canvas.getActiveObject().shadow) {
          $('#text-shadow-colorpicker').spectrum("set", canvas.getActiveObject().shadow.color)
          $('#text-shadow-blur').val(canvas.getActiveObject().shadow.blur).trigger('change')
          $('#text-shadow-offsetX').val(canvas.getActiveObject().shadow.offsetX).trigger('change')
          $('#text-shadow-offsetY').val(canvas.getActiveObject().shadow.offsetY).trigger('change')
        } else {
          $('#text-shadow-colorpicker').spectrum("set", '#000')
          $('#text-shadow-blur').val('0').trigger('change')
          $('#text-shadow-offsetX').val('0').trigger('change')
          $('#text-shadow-offsetY').val('0').trigger('change')
        }

      } else if (objectType === 'circle' || objectType === 'rect' || objectType==='triangle')  {
        $('#edit-shape-options').show()
        $('#shape-bg-colorpicker').spectrum("set", canvas.getActiveObject().fill)
        $('#shape-border-colorpicker').spectrum("set", canvas.getActiveObject().stroke)
        $('#shape-opacity').val(canvas.getActiveObject().opacity).trigger('change')
        $('#shape-border').val(canvas.getActiveObject().strokeWidth).trigger('change')
        $('#shape-width').val(canvas.getActiveObject().width).trigger('change')
        $('#shape-height').val(canvas.getActiveObject().height).trigger('change')

        // Gradient Color Picker
        const gp = new Grapick({
          el: '#gp',
          colorEl: '<input id="colorpicker"/>'
        });

        gp.setColorPicker(handler => {
          const el = handler.getEl().querySelector('#colorpicker');

          $(el).spectrum({
              color: handler.getColor(),
              preferredFormat: "hex",
              showAlpha: false,
              showButtons: false,
              showInput: true,
              change(color) {
                handler.setColor(color.toHexString());
              },
              
          });
        });


        let obj = canvas.getActiveObject()
        $.each(obj.fill.colorStops, function(index, value) {
          let position = value.offset.toString().replace('0.', '')
          if (position === '999') {
            position = '100'
          }
          let rgbColor = value.color.replace('rgb(', '').replace(')', '').split(',')
          gp.addHandler(parseInt(position), '#'+fullColorHex(rgbColor[0], rgbColor[1], rgbColor[2]));
        });


        function rgbToHex(rgb) {
          var hex = Number(rgb).toString(16);
          if (hex.length < 2) {
               hex = "0" + hex;
          }
          return hex;
        };

        function fullColorHex(r,g,b) {
          var red = rgbToHex(r);
          var green = rgbToHex(g);
          var blue = rgbToHex(b);
          return red+green+blue;
        };


        gp.on('change', complete => {
          let obj = canvas.getActiveObject()
          let allColors = gp.getColorValue().split(',')
          let hexColors = []
          let positions = []

          allColors.forEach(function(element) {
            let singleColor = element.trim().split(' ')
            hexColors.push(singleColor[0])
            if (singleColor[1] === '100%') {
              positions.push(999)
            } else {
              positions.push(singleColor[1])
            }
          });

          const objHexColors = hexColors.reduce((acc, color, i) => ({
            ...acc,
            [`0.${positions[i]}`]: color,
          }), {})

          obj.setGradient('fill', {
            x1: 0,
            y1: 0,
            x2: 0,
            y2: obj.height,
            colorStops: objHexColors
          });

          canvas.renderAll()
        })

        if (canvas.getActiveObject().shadow) {
          $('#shape-shadow-colorpicker').spectrum("set", canvas.getActiveObject().shadow.color)
          $('#shape-shadow-blur').val(canvas.getActiveObject().shadow.blur).trigger('change')
          $('#shape-shadow-offsetX').val(canvas.getActiveObject().shadow.offsetX).trigger('change')
          $('#shape-shadow-offsetY').val(canvas.getActiveObject().shadow.offsetY).trigger('change')
        } else {
          $('#shape-shadow-colorpicker').spectrum("set", '#000')
          $('#shape-shadow-blur').val('0').trigger('change')
          $('#shape-shadow-offsetX').val('0').trigger('change')
          $('#shape-shadow-offsetY').val('0').trigger('change')
        }

      } else if (objectType === 'image') {
        $('#edit-image-options').show()
        $('#image-opacity').val(canvas.getActiveObject().opacity).trigger('change')
      }

    }
  }

  $('#layers-tab').click(function() {
    $('#sidebar-layers-nav a').removeClass('active')
    $(this).addClass('active')
    $('#layers-tab-content').show();
    $('#editing-tab-content').hide();
    $('#settings-tab, #layers-tab').show();
    //$('#editing-tab').hide();
    $('#editing-settings-content').hide();
  })

  $('#settings-tab').on('click',function() {
    $('#sidebar-layers-nav a').removeClass('active')
    $(this).addClass('active')
    $('#layers-tab-content').hide();
    $('#editing-settings-content').show();
  })

  $('#editing-tab').on('click',function() {
    var selectedObject = canvas.getActiveObjects()
    $('#layers-tab').hide();

    if (selectedObject.length === 1) {
      $('#sidebar-layers-nav a').removeClass('active')
      $(this).addClass('active')
      $('#editing-tab-content').show()
      $('#layers-tab-content').hide()
      $('#editing-settings-content').hide();
    } else {
      $('#arrange-selected-object').show()
      $('#editing-tab-content').show()
      $('#layers-tab-content').hide()
      $('#editing-settings-content').hide();
    }
  })


  // Nudge
  var processKeys = function (evt) {
    evt = evt || window.event;

    var movementDelta = 2;

    var activeObject = canvas.getActiveObject();
    var getActiveObjects = canvas.getActiveObjects();

    if (evt.keyCode === 37) {
        evt.preventDefault();
        if (activeObject) {
            var a = activeObject.get('left') - movementDelta;
            activeObject.set('left', a);
        }
        else if (getActiveObjects) {
            var a = getActiveObjects.get('left') - movementDelta;
            getActiveObjects.set('left', a);
        }

    } else if (evt.keyCode === 39) {
        evt.preventDefault();
        if (activeObject) {
            var a = activeObject.get('left') + movementDelta;
            activeObject.set('left', a);
        }
        else if (getActiveObjects) {
            var a = getActiveObjects.get('left') + movementDelta;
            getActiveObjects.set('left', a);
        }

    } else if (evt.keyCode === 38) {
        evt.preventDefault();
        if (activeObject) {
            var a = activeObject.get('top') - movementDelta;
            activeObject.set('top', a);
        }
        else if (getActiveObjects) {
            var a = getActiveObjects.get('top') - movementDelta;
            getActiveObjects.set('top', a);
        }

    } else if (evt.keyCode === 40) {
        evt.preventDefault();
        if (activeObject) {
            var a = activeObject.get('top') + movementDelta;
            activeObject.set('top', a);
        }
        else if (getActiveObjects) {
            var a = getActiveObjects.get('top') + movementDelta;
            getActiveObjects.set('top', a);
        }
    }

    if (activeObject) {
        activeObject.setCoords();
        canvas.renderAll();
    } else if (getActiveObjects) {
        getActiveObjects.setCoords();
        canvas.renderAll();
    }
  }

  var canvasWrapper = document.getElementById('editor-canvas');
  canvasWrapper.tabIndex = 1000;
  canvasWrapper.addEventListener("keydown", processKeys, false);

  $('#graphic-editor').keydown(processKeys)


  // Color Pickers
  $("#text-colorpicker").spectrum({
      preferredFormat: "rgb",
      showButtons: false,
      showInput: true,
      showAlpha: true,
      move: function(color) {
        var obj = canvas.getActiveObject();
        obj.setColor(color.toRgbString());
        canvas.renderAll();
      }
  });

  $("#text-stroke-colorpicker").spectrum({
      preferredFormat: "rgb",
      showButtons: false,
      showInput: true,
      showAlpha: true,
      move: function(color) {
        var obj = canvas.getActiveObject()
        obj.set('stroke', color.toRgbString())
        canvas.renderAll()
      }
  });

  $("#text-shadow-colorpicker").spectrum({
      preferredFormat: "rgb",
      showButtons: false,
      showInput: true,
      showAlpha: true,
      move: function(color) {
        var shadow = {
            color: color.toRgbString()
        }
        var shadow = {
            color: color.toRgbString(),
            blur: $('#text-shadow-blur').val(),
            offsetX: $('#text-shadow-offsetX').val(),
            offsetY: $('#text-shadow-offsetY').val()
        }
        var obj = canvas.getActiveObject()
        obj.setShadow(shadow)
        canvas.renderAll()
      }
  });

  $("#shape-bg-colorpicker").spectrum({
      preferredFormat: "rgb",
      showButtons: false,
      showInput: true,
      showAlpha: true,
      move: function(color) {
        var obj = canvas.getActiveObject();
        obj.set("fill", color.toRgbString());
        canvas.renderAll();
      }
  });

  $("#shape-border-colorpicker").spectrum({
      preferredFormat: "rgb",
      showButtons: false,
      showInput: true,
      showAlpha: true,
      move: function(color) {
        var obj = canvas.getActiveObject();
        obj.set("stroke", color.toRgbString());
        canvas.renderAll();
      }
  });

  $("#shape-shadow-colorpicker").spectrum({
      preferredFormat: "rgb",
      showButtons: false,
      showInput: true,
      showAlpha: true,
      move: function(color) {
        var shadow = {
            color: color.toRgbString()
        }
        var shadow = {
            color: color.toRgbString(),
            blur: $('#shape-shadow-blur').val(),
            offsetX: $('#shape-shadow-offsetX').val(),
            offsetY: $('#shape-shadow-offsetY').val()
        }
        var obj = canvas.getActiveObject()
        obj.setShadow(shadow)
        canvas.renderAll()
      }
  });

  $("#graphic-bgcolor").spectrum({
      preferredFormat: "rgb",
      showButtons: false,
      showInput: true,
      showAlpha: true,
      move: function(color) {
        canvas.setBackgroundColor(color.toRgbString(), canvas.renderAll.bind(canvas));
        $('input#graphic_bgcolor').val(color.toRgbString())
      },
      change: function(color) {
        canvas.setBackgroundColor(color.toRgbString(), canvas.renderAll.bind(canvas));
        $('input#graphic_bgcolor').val(color.toRgbString())
      }
  });

  $("#graphic-textcolor").spectrum({
      preferredFormat: "rgb",
      showButtons: false,
      showInput: true,
      showAlpha: true,
      move: function(color) {
        $('input#graphic_textcolor').val(color.toRgbString())
      },
      change: function(color) {
        $('input#graphic_textcolor').val(color.toRgbString())
      }
  });


  $("#image-color-overlay-colorpicker").spectrum({
      preferredFormat: "rgb",
      showButtons: false,
      showInput: true,
      showAlpha: true,
      move: function(color) {
        if ($('#image-color-overlay').val() === 'on') {
          let obj = canvas.getActiveObject()
          let f = fabric.Image.filters
          let id = 2
          obj.filters[id] = new f.BlendColor({
            color: color.toRgbString(),
            mode: 'add',
            alpha: 1
          })
          obj.applyFilters()
          canvas.renderAll()
        }
      },
      change: function(color) {
        if ($('#image-color-overlay').val() === 'on') {
          let obj = canvas.getActiveObject()
          let f = fabric.Image.filters
          let id = 2
          obj.filters[id] = new f.BlendColor({
            color: color.toRgbString(),
            mode: 'add',
            alpha: 1
          })
          obj.applyFilters()
          canvas.renderAll()
        }
      }
  });

  $('.canvas-container').css({
    'position' : 'fixed',
    'left' : '41.5%',
    'top' : '50%',
    'margin-left' : -$('.canvas-container').outerWidth()/2,
    'margin-top' : -$('.canvas-container').outerHeight()/2
  })

  setTimeout(function() {
    let width = $('#graphic-width').val()
    let half_width = parseInt(width) / 2 - 20
    let height = $('#graphic-height').val()
    let half_height = parseInt(height) / 2 - 20
    $('.canvas-container').css('margin-left', `-${half_width}px`)
    $('.canvas-container').css('margin-top', `-${half_height}px`)
    $('#settings-tab').trigger('click')
  }, 100)

  $('#editor-deselect-overlay').click(function() {
    canvas.discardActiveObject()
    canvas.renderAll()
    $('#settings-tab').trigger('click')
  })

  $('#export-image').click(function() {
    var dataURL = canvas.toDataURL({
      format: "png",
      quality: 1,
      width: canvas.width ,
      height: canvas.height ,
    });
    var imagefilename=$('meta[name="design-name"]').attr('content');
    var link = document.createElement('a');
    link.setAttribute('href', dataURL);
    link.setAttribute('download',imagefilename+'.png');
    link.setAttribute('target', '_blank');
    link.style.display = 'none';
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
  })

  $('#save-image').click(function() {
    let json = canvas.toJSON()
    let layers = $('#containerLayers').html()
    let imageData = canvas.toDataURL({
      format: "png",
      quality: 1,
      enableRetinaScaling: true,
      width: canvas.width,
      height: canvas.height,
    });
    $('#graphic_body_json').val(JSON.stringify(json, undefined, 4))

      

    var fileContents = JSON.stringify(json, null, 2);
    var fileName = "data.json";

    var pp = document.createElement('a');
    pp.setAttribute('href', 'data:text/plain;charset=utf-8,' + encodeURIComponent(fileContents));
    pp.setAttribute('download', fileName);
    pp.click();
 

    $('#graphic_layers_list').val(layers)
    $('#graphic_preview_thumbnail').val(imageData)
    $('form').submit();
  })

  $('#upload-image-file').click(function() {
    
    var element = document.createElement('div')
    element.innerHTML = '<input type="file">'
    var fileInput = element.firstChild
    fileInput.addEventListener('change', function() {
        var file = fileInput.files[0]
        if (file.name.match(/\.(json)$/)) {
          var reader = new FileReader()
          reader.onload = function() {
              var json = reader.result
              canvas.loadFromJSON(json, importCallBack, function(o, object) {})
              function importCallBack() {}
          }
          reader.readAsText(file)
        } else {
            alert("File not supported, .json files only")
        }
    })
    //fileInput.click()
  })

  // Upload Image + Drag Image to Editor
  $('#uploadImage').click(function() {
    $('#imgLoader').trigger('click')
  })

  // Image Upload Input
  $('#imgLoader').change(function(e) {
      var reader = new FileReader();
      reader.onload = function (event) {
          var imgObj = new Image();
          imgObj.src = event.target.result;
          imgObj.onload = function () {
              var image = new fabric.Image(imgObj);
              image.set({
                  left: 10,
                  top: 10
              });
              canvas.add(image);
          }

      }
      reader.readAsDataURL(e.target.files[0]);
  })

  // Drag Image to Body
  $('body').filedrop({
      callback: function (fileEncryptedData) {
          var imgObj = new Image();
          imgObj.src =fileEncryptedData;
          imgObj.onload = function () {
              var image = new fabric.Image(imgObj);
              image.set({
                  left: 10,
                  top: 10
              });
              canvas.add(image);
          }
      }
  })
// zoom in zoom out


  createListenersKeyboard();

  function createListenersKeyboard() {
    document.onkeydown = onKeyDownHandler;
    //document.onkeyup = onKeyUpHandler;
  }

  function onKeyDownHandler(event) {
    //event.preventDefault();

    var key;
    if (window.event) {
      key = window.event.keyCode;
    }
    else {
      key = event.keyCode;
    }

    switch (key) {
      //////////////
      // Shortcuts
      //////////////
      // Zoom In (Ctrl+"+")
      case 187: // Ctrl+"+"
        if (ableToShortcut()) {
          if (event.ctrlKey) {
            event.preventDefault();
            zoomIn();
          }
        }
        break;
      // Zoom Out (Ctrl+"-")
      case 189: // Ctrl+"-"
        if (ableToShortcut()) {
          if (event.ctrlKey) {
            event.preventDefault();
            zoomOut();
          }
        }
        break;
      // Reset Zoom (Ctrl+"0")
      case 48: // Ctrl+"0"
        if (ableToShortcut()) {
          if (event.ctrlKey) {
            event.preventDefault();
            resetZoom();
          }
        }
        break;
      default:
        // TODO
        break;
    }
  }
  function ableToShortcut(){
    /*
     TODO check all cases for this

     if($("textarea").is(":focus")){
     return false;
     }
     if($(":text").is(":focus")){
     return false;
     }
     */
    return true;
  }
  // Zoom In
 function zoomIn() {
  if(canvas.getZoom().toFixed(5) > zoomMax){
      console.log("zoomIn: Error: cannot zoom-in anymore");
      return;
  }

  canvas.setZoom(canvas.getZoom()*SCALE_FACTOR);
  canvas.setHeight(canvas.getHeight() * SCALE_FACTOR);
  canvas.setWidth(canvas.getWidth() * SCALE_FACTOR);
  canvas.renderAll();
 }

  // Zoom Out
 function zoomOut() {
   if( canvas.getZoom().toFixed(5) <=1 ){
      console.log("zoomOut: Error: cannot zoom-out anymore");
      return;
   }

   canvas.setZoom(canvas.getZoom()/SCALE_FACTOR);
   canvas.setHeight(canvas.getHeight() / SCALE_FACTOR);
   canvas.setWidth(canvas.getWidth() / SCALE_FACTOR);
   canvas.renderAll();
  }

 // Reset Zoom
 function resetZoom() {

   canvas.setHeight(canvas.getHeight() /canvas.getZoom() );
   canvas.setWidth(canvas.getWidth() / canvas.getZoom() );
   canvas.setZoom(1);

   canvas.renderAll();

   getFabricCanvases().forEach(function(item){
      item.css('left', 0);
      item.css('top', 0);
   });

 }
})
