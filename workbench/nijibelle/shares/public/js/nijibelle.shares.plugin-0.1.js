$('[data-toggle="share-add"]').on('click',function(){
    
    var target_share = $(this).data('target_share');
    var id = $(this).data('id_share');
    var img = $(this).data('image');
  
    var url = "/share/add/"+target_share+"/"+id+"/"+img;
    
    $.get( url, function(data) {
        $('.share-content').html(data);
    }).fail(function(){
        alert('share server error');
    })
    
});

$('#shareModal').on('hidden.bs.modal', function() {
    $('.share-content').children().remove();  
});
