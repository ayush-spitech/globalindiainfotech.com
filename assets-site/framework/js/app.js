
// When the user scrolls down 20px from the top of the document, show the button
$(document).ready(function(){
    $(window).scroll(function(){
        if($(this).scrollTop() > 100){
            $('#gototop').fadeIn();
        }else{
            $('#gototop').fadeOut();
        }
    });
    $('#gototop').click(function(){
        $("html, body").animate({ scrollTop: 0 }, 600);
        return false;
    });
});


$(document).ready(function(){
    $('#appMessageContainer').fadeOut(10000); // 10 seconds

});


function removeMessage(){
    document.getElementById('appMessageContainer').remove();
}

function reload(){    
  window.location = window.location.href.split("?")[0];
}

function refresh(){    
  window.location = window.location.href;
}

function goto(url){
    window.location=url;
}

function submitOnEnter(buttonId,e)
{
    e = e || window.event;
    if (e.keyCode == 13) // enter key
    {
        document.getElementById(buttonId).click();
        return false;
    }
    return true;
}

/*
Calling : nochange="previewImg('target_image_id')"
*/
function previewImg(input,target_image_id) {
   // var input=this;
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
          $('#'+target_image_id).attr('src', e.target.result);
      }
      reader.readAsDataURL(input.files[0]);
  }
}


function loadState(country_id,state_id){    
    var country=$('#'+country_id).val();
    $.ajax({
        url:BASE_URL+'common/load_state',
        type:'POST',
        data:{country_id:country},
        dataType:'json',
        success:function(response){
            var strHtml='';
            if(response.length>0){
                $.each(response,function(index,value){
                    strHtml+='<option value="'+value.state_id+'">'+value.state_name+'</option>';
                });
            }
            $('#'+state_id).html(strHtml);
        }
    });
}


function loadCity(state_id,city_id){
   var state=$('#'+state_id).val();
   $.ajax({
    url:BASE_URL+'common/load_city',
    type:'POST',
    data:{state_id:state},
    dataType:'json',
    success:function(response){
        var strHtml='';
        if(response.length>0){
            $.each(response,function(index,value){
                strHtml+='<option value="'+value.city_id+'">'+value.city_name+'</option>';
            });
        }
        $('#'+city_id).html(strHtml);
    }
});
}