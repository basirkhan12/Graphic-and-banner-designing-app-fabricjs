$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
jQuery(".fav-design-icon i").on("click", function(){
   var id= jQuery(this).attr('data-id');
   var el=jQuery(this);
   el.addClass("fa-spinner fa-spin");
   jQuery.ajax({
    url: "/favorite/"+id,
    method: 'get',
    data: {
    },
    success: function(result){
        console.log(result);
        if(result== "asuccess"){
            el.addClass("fa-heart");
            el.removeClass("fa-heart-o");
            el.removeClass("fa-spinner fa-spin");
        }
       else if(result== "rsuccess"){
            el.addClass("fa-heart-o");
            el.removeClass("fa-heart");
            el.removeClass("fa-spinner fa-spin");
        }else{

        }
    }});
})


// delete  Design
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
jQuery(".delete-design-icon i").on("click", function(){
    var id= jQuery(this).attr('data-id');
    var el=jQuery(this);
    el.addClass("fa-spinner fa-spin");
    jQuery.ajax({
     url: "/designs/"+id,
     headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
     method: 'delete',
     data: {
     },
     success: function(result){
         console.log(result);
         if(result== "deleted"){
            $("#dd-"+id).remove();
         }
        else{
           alert("Error in deleting "+ result)  
         }
     }});
 })