//var client_id = 'ac2440143679fe6cabdec3a7c05d19336e6985f38a5808992db62cac654e7a7b';
var client_id='jzph19NDUZh57e3sjKtgBO6N0Xmg3jUKHKc-FI_O9Ak';
var limit = 10;
$("body").on("click", "#posts img", function(){
  //alert($(this).attr('src'));
   fabric.Image.fromURL( $(this).attr('src'), function(myImg) {
     //i create an extra var for to change some image properties
     var img1 = myImg.set({ left: 0, top: 0 });
     canvas.add(img1); 
    });
    canvas.randerAll();
 });
$(document).ready(function() {
  
  var $container = $('#posts');
  $container.imagesLoaded( function() {
    $container.masonry({
      itemSelector: '.post',
      isAnimated: true,
      columnWidth: 237,
      gutter:4,
     
    }); 
  });
  
});

function unsplash(more){
  $.ajax({
    url:'https://api.unsplash.com/photos',
    type:'GET',
    dataType:'json',
    data:{
      client_id:client_id,
      page:more,
      per_page:limit
    },
    success: function(data){
      $.each(data, function(i, item) {
        var image = $("<img>").attr("src",item.urls.small);
        var item = $("<div class='post'>").append(image).hide();
        var $container = $('#posts');
        $container.append(item).imagesLoaded(function(){ 
         item.show();
          $container.masonry( 'appended', item).masonry();
        }); 

      });
      $(".more").attr("href",more).html("More");
    }
  });
}


//Click function to get the next page
$(".more").click(function(){
  var page = $(".more").attr('href');
  page++;
  unsplash(page);
  return false;
});
//Initial parameter
//When the value of the more buttons, the function is called again with new page number
$(".more").change(unsplash(1));


