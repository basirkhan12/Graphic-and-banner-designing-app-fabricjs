<script src="/assets/js/core/jquery.min.js"></script>
  <script src="/assets/js/core/bootstrap.min.js"></script>
  <script src="/editor/js/fabricjs.js"></script>
  <script src="/editor/js/fabric-settings.js"></script>
  <script src="/editor/js/fabricjs-custom-controls.js"></script>
  <script src="/editor/js/fabricjs-guidelines.js"></script>
  <script src="/editor/js/select2.js"></script>
  <script src="/editor/js/spectrum.js"></script>
  <script src="/editor/js/gradientpicker.js"></script>
  <script src="/editor/js/filedrop.js"></script>
  <script src="/editor/js/editor.js"></script>
  <script src="https://rawgithub.com/desandro/masonry/v2.1.08/jquery.masonry.js"></script>
  <script src="https://imagesloaded.desandro.com/imagesloaded.pkgd.js"></script>
  <script src="/editor/js/unsplash.js"></script>
  
  <script>
    jQuery(document).ready(function(){
      
      var designID="";
      var checkreq=false;

     
      @if(request()->is('designs/*/edit'))
      designID='{{$id}}';

      var checkreq=false;

      var json = @php echo $canvasJson; @endphp
        
              canvas.loadFromJSON(json, importCallBack, function(o, object) {})
              function importCallBack() {}
      @endif

      jQuery('#ajaxSave').click(function(e){
        if(checkreq){
               return;
              }
              checkreq=true;
        if( ($('#input-keyword').val()=="" || $("#input-title").val()=="") && designID==""){
            if($('#input-keyword').val()=="")
                 $('#input-keyword').css({'background-color':'#a20000','color':'#fff'})
            if($('#input-title').val()=="")
               $('#input-title').css({'background-color':'#a20000','color':'#fff'})

            return;
        }
        

      let imageData = canvas.toDataURL({
      format: "png",
      quality: 1,
      enableRetinaScaling: true,
      width: canvas.width,
      height: canvas.height,
    });

          $.ajaxSetup({
             headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             }
         });
         if(designID==""){
          jQuery.ajax({
             url: "{{ route('designs.store') }}",
             method: 'post',
             data: {
                json: JSON.stringify(canvas.toJSON(),undefined, 4),
                thumbnail: imageData,
                visible: $('input[name="d-visible"]:checked').val(),
                title: $("#input-title").val(),
                keywords: $("#input-keyword").val()
             },
             success: function(result){
                 designID=result;
                 checkreq=false;
                 $('#saveDesign').modal('hide');
             }});
            }
            else{
              jQuery.ajax({
             url: "{{ route('designs.store') }}/"+designID,
             method: 'put',
             data: {
                json: JSON.stringify(canvas.toJSON(),undefined, 4),
                thumbnail: imageData,
                visible: $('input[name="d-visible"]:checked').val(),
                title: jQuery('#input-title').val(),
                keywords: jQuery('#input-keyword').val()
             },
             success: function(result){
                checkreq=false;
               $('#saveDesign').modal('hide');
               
             }}); 
            }
          });
       });
 </script>
