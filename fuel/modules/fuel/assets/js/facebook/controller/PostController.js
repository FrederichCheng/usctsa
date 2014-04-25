facebook.controller.PostController = jqx.createController(fuel.controller.BaseFuelController, {
	
	init: function(initObj){
		this._super(initObj);
	},

	items : function(){

		// call parent
		//fuel.controller.BaseFuelController.prototype.items.call(this);
		this._super();
		var _this = this;
                
                
                $('.category').ready(function(){
                    var select = $(_this);
                    $("body").remove(select);
                    $(_this).change(function(select){
                        return function(){
                            alert(select.html());
                            /*
                        $.get('facebook_posts/ajax/change_post_category', {
                            post_id: select.attr('id'), 
                            category: select.val()
                        }, function(html){ alert(html)});*/
                        };
                    }(select));
                });
	}
});