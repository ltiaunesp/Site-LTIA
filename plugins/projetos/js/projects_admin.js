(function(){
	var user_click_event = function(e){
		e.setAttribute("selecionado", e.getAttribute("selecionado") == "true" ? "false" : "true" );
		var $ = jQuery.noConflict(),
			selected = $(".users_selectable[selecionado='true']"),
			users_field = $("#users_field"),
			str = "", i;
		for( i=0 ; i < selected.length; i++){
			str += selected[i].getAttribute("userid");
			if( i < selected.length - 1 )
				str += ";";
		}
		console.debug(users_field);
		users_field.val(str);
	}
	window.user_click_event = user_click_event;
})();