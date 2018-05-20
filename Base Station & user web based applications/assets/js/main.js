$('documnet').ready(function(){
	
	/* Profile Picture functionality*/
	$.fn.hasExtension = function(exts) {
        return (new RegExp('(' + exts.join('|').replace(/\./g, '\\.') + ')$')).test($(this).val());
    }

    function readDATA(input) {
         if ($('#upload_cover').hasExtension(['.jpg', '.png'])) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e){
                        $('#profile_pic').attr('src', e.target.result);
                        //alert($('#profile_pic').height());
	
                        

                    };
                    reader.readAsDataURL(input.files[0]);
                }
         }else{
			$('#saveprofilepic_btn').css('display','none');
			$('#profilepic_error').css('display','block').html("<b>Invalid image format</b> Only jpg and png image file allowed");
		 }
    }
	
	/*Load file when file is selected*/
   $('#upload_cover').change(function(){ 
		$('.count-jfilestyle').css('background','#303030');
        //$('.count-jfilestyle').css('display','');
        readDATA(this);
   });
	
	/*end of profile picture functionality*/
});