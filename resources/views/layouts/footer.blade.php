<footer class="footer">
    <div class=" container-fluid ">
      
      
    </div>
  </footer>
  
     <!--   Core JS Files   -->
     <script src={{ asset("assets/js/core/jquery.min.js")}}></script>
     <script src={{ asset("assets/js/core/popper.min.js")}}></script>
     <script src={{ asset("assets/js/core/bootstrap.min.js")}}></script>
     <script src={{ asset("assets/js/plugins/perfect-scrollbar.jquery.min.js")}}></script>
     <!--  Notifications Plugin    -->
     <script src={{ asset("assets/js/plugins/bootstrap-notify.js")}}></script>
     <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
     <script src={{ asset("assets/js/now-ui-dashboard.min.js?v=1.5.0")}} type="text/javascript"></script><!-- Now Ui -->
     <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
     <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
     <script src={{ asset("js\makefavorite.js")}}></script>
     <script type="text/javascript">
      jQuery('#summernote').summernote({
          height: 200,
          toolbar: [
            [ 'font', [ 'bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear'] ],
            [ 'fontsize', [ 'fontsize' ] ],
            [ 'color', [ 'color' ] ],
            [ 'para', [ 'ol', 'ul', 'paragraph', 'height' ] ],
            [ 'table', [ 'table' ] ],
            [ 'insert', [ 'link'] ],
            
        ]
      });
      jQuery('.dropdown-toggle').dropdown()

  </script>
     