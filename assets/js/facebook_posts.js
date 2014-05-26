/* 
 *  Copyright 2014 Shao-yen(Frederich) Cheng .
 *  All rights reserved.
 *
 */



(function(){
    $(document).ready(function(){
        $('select.category').ready(function(){
            $('select.category').each(function(index, elem){

                    alert($(elem).attr('id'));
                //});
            });
        });
    });
})();

function changePostCategory(oldCat){
    return function(){
        var jEle = $(this);
        var post_id = jEle.attr("id");
        var cat = jEle.val();
        $('<img>').attr('src','/TSAWebsite/assets/images/spinner_sm.gif').appendTo(jEle.parent('td'));
        $.get("/TSAWebsite/fuel/facebook/facebook_posts/ajax/change_post_category", {
            post_id: post_id, 
            category: cat,
            old_category : oldCat
        }, function(html){
            if(!html || html["status"] !== "success"){
                jEle.val(oldCat);
                if(html['message']){
                    alert('Fail to change category of post '+post_id+':' + html['message']);
                }
                else{
                    alert('Fail to change category of post '+post_id+':'+html['status']);
                }
                
            }
            else{
                
            }
            jEle.siblings('img').remove();
        });
    };
}