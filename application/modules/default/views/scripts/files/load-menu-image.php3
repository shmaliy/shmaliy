<?php
?>
<div id="upload_container" style="display:none;">
	<div>
		<div class="fieldset flash" id="fsUploadProgress">
        	<span class="legend">Загрузить изображение</span>
        </div>
        <div id="divStatus"></div>
        <div class="clear"></div>
        <div class="select_photo">
        	<span id="spanButtonPlaceHolderCnt"><span id="spanButtonPlaceHolder"></span></span>
            <input id="btnCancel" type="button" value="Отмена" onclick="swfu.cancelQueue();" disabled="disabled" />
        </div>
		<div id="uploaded_images" class="uploaded_images">                
             <div class="clear"></div>
        </div>
	</div>
</div>
<div id = "photos" class="uploaded_photos"></div>
<div class="error" id="photos_error"></div>

<script>
$("#upload_container").show();
var swfu;
var post_params = {"PHPSESSID" : "<?php echo session_id(); ?>"};
function initSwfUpl() {
	$("#divStatus").html('');
	$("#spanButtonPlaceHolderCnt").append('<span id="spanButtonPlaceHolder"></span>');
	$("#fsUploadProgress").html('<span class="legend">Загрузить изображение</span>');
	var settings = {
		flash_url : "/js/swfupload/swfupload.swf",
		upload_url: "/default/files/upload",
		post_params: post_params,
		file_size_limit : "1 MB",
		file_types : "*.png;",
		file_types_description : "All Files",
		file_upload_limit : "1",
		file_queue_limit : "1",
		custom_settings : {
			progressTarget : "fsUploadProgress",
			cancelButtonId : "btnCancel"
		},
		debug: true,

		// Button settings
		button_image_url: "/theme/img/browse.png",
		button_width: "120",
		button_height: "30",
		button_placeholder_id: "spanButtonPlaceHolder",
		button_text: '<span class="theFont">Обзор</span>',
		button_text_style: ".theFont { font-size: 14; font-family: tahoma; font-weight:bold; text-align: center;}",
		button_text_left_padding: 8,
		button_text_top_padding: 5,
		
		// The event handler functions are defined in handlers.js
		file_queued_handler : fileQueued,
		file_queue_error_handler : fileQueueError,
		file_dialog_complete_handler : fileDialogComplete,
		upload_start_handler : uploadStart,
		upload_progress_handler : uploadProgress,
		upload_error_handler : uploadError,
		upload_success_handler : uploadSuccess,
		upload_complete_handler : uploadComplete,
		queue_complete_handler : queueComplete	// Queue plugin event
	};

	swfu = new SWFUpload(settings);
}

window.onload = initSwfUpl;

</script>