function galleryMedia($){
	var _custom_media = true,
	_orig_send_attachment = wp.media.editor.send.attachment;
 
	$('.upload_image_button').click(function(e) {
		var send_attachment_bkp = wp.media.editor.send.attachment;
		var button = $(this);
		var id = button.attr('id').replace('_button', '');
		var textField = $("#"+id);
		var image = $("#"+id+"_image");
		_custom_media = true;
		wp.media.editor.send.attachment = function(props, attachment){
			if ( _custom_media ) {
				console.debug("#"+id);
				try{
				  textField.val(attachment.sizes.medium.url);
					console.debug(image);
					image[0].src = (attachment.sizes.medium.url);
				}catch(e){
					textField.val(attachment.url);
					image[0].src = (attachment.url);
				}
			} else {
				return _orig_send_attachment.apply( this, [props, attachment] );
			};
		}
 
		wp.media.editor.open(button);
		return false;
	});
 
	$('.add_media').on('click', function(){
		_custom_media = false;
	});
}
jQuery(document).ready(galleryMedia);
