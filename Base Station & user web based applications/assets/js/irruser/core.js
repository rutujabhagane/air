$('documnet').ready(function(){
    
   /*Validation of fields
      fieldVal- value of field eg $('#usernmae').val();
      field   - the field itself NB: should be the field same field as fieldVal eg $('#username')
      type    - type can either be username,email or password,number,year
   */
   function validateField(fieldVal,field,form_div,type){
      var regExUsername = /^[a-zA-Z_0-9]*$/;
      var regExNumber = /^[0-9]*$/;
	  var regExPhone = /^[0-9+]*$/;
      var regExbasicField = /^[a-zA-Z_0-9& ]*$/;
      var regExyearField = /^[0-9]*$/;
      var regExbasicField2 = /^[()a-zA-Z_0-9&. ]*$/;
      var regExEmail = /^[-a-z0-9~!$%^&*_=+}{\'?]+(\.[-a-z0-9~!$%^&*_=+}{\'?]+)*@([a-z0-9_][-a-z0-9_]*(\.[-a-z0-9_]+)*\.(aero|arpa|biz|com|coop|edu|gov|info|int|mil|museum|name|net|org|pro|travel|mobi|[a-z][a-z])|([0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}))(:[0-9]{1,5})?$/i;
      var regExPassword = /^[a-zA-Z0-9-_ ]+$/;
      switch(type){
         case "username":
            regEx = regExUsername;
            errorMsg1 = "Please enter in a username";
            errorMsg2 = "The username you entered contain some invalid characters";
            if(fieldVal.length<3){
			   form_div.addClass("has-error");
               field.attr({
                  "data-tooltip": "Your username must be 3 or more characters",
                  "data-tooltip-direction":"right"
               });
               field.addClass("error");
               return false;
            }else if(fieldVal.length>15){
               form_div.addClass("has-error");
               field.attr({
                  "data-tooltip": "Your username is too long",
                  "data-tooltip-direction":"right"
               });
               field.addClass("error");
               return false;
            }
         break;
         case "email":
            regEx = regExEmail;
            errorMsg1 = "Please enter in an email address";
            errorMsg2 = "The email address seems not to be valid";
         break;
         case "number":
            regEx = regExNumber;
            errorMsg1 = "This field is empty";
            errorMsg2 = "Only numbers are allowed";
		 case "phone":
			regEx = regExPhone;
            errorMsg1 = "This field is empty";
            errorMsg2 = "Only valid phone numbers are allowed";
		 break
         break;
         case "password":
            regEx = regExPassword;
            errorMsg1 = "Please enter in a password of your choice";
            errorMsg2 = "The password you entered contain some invalid characters";
            if(fieldVal.length<4){
               form_div.addClass("has-error");
               field.attr({
                  "data-tooltip": "Password must be more than 4 characters",
                  "data-tooltip-direction":"right"
               });
               field.addClass("error");
               return false;
            }else if(fieldVal.length>20){
               form_div.addClass("has-error");
               field.attr({
                  "data-tooltip": "Your password is too long",
                  "data-tooltip-direction":"right"
               });
               field.addClass("error");
               return false;
            }
         break;
         case "basicField":
            regEx = regExbasicField;
            errorMsg1 = "This field is empty";
            errorMsg2 = "This field contain some invalid characters";
            if(fieldVal.length>80){
               form_div.addClass("has-error");
               field.attr({
                  "data-tooltip": "This field contain too many characterss",
                  "data-tooltip-direction":"right"
               });
               field.addClass("error");
               return false;
            }
         break;
         case "basicField2":
            regEx = regExbasicField2;
            errorMsg1 = "This field is empty";
            errorMsg2 = "This field contain some invalid characters";
            if(fieldVal.length>80){
               form_div.addClass("has-error");
               field.attr({
                  "data-tooltip": "This field contain too many characterss",
                  "data-tooltip-direction":"right"
               });
               field.addClass("error");
               return false;
            }
         break;
         case "year":
            regEx = regExyearField;
            errorMsg1 = "This field is empty";
            errorMsg2 = "Invalid year entered";
            if(fieldVal.length > 4 || fieldVal.length < 4){
               form_div.addClass("has-error");
               field.attr({
                  "data-tooltip": "Invalid year entered",
                  "data-tooltip-direction":"right"
               });
               field.addClass("error");
               return false;
            }
         break;
         default:
            return "Error:Type not specified in the function";
      }
      if(fieldVal.length==0){
         form_div.addClass("has-error");
         field.attr({
            "data-tooltip": errorMsg1,
            "data-tooltip-direction":"right"
         });
         field.addClass("error");
         return false;
      }else if(!regEx.test(fieldVal)){
         form_div.addClass("has-error");
         field.attr({
            "data-tooltip": errorMsg2,
            "data-tooltip-direction":"right"
         });
         field.addClass("error");
         return false;
      }else{
         form_div.removeClass("has-error");
		 form_div.addClass("has-success");
         field.attr({
            "data-tooltip":"",
            "data-tooltip-direction":""
         });
         field.removeClass("error");
         return true;
      }
   }
   
   /******** USER ********/
   
   /*login submit*/
   $('#login_phone').keyup(function(){
      validateField($('#login_phone').val(),$('#login_phone'),$('.login_username_div'),"phone");
   }).blur(function(){
      validateField($('#login_phone').val(),$('#login_phone'),$('.login_username_div'),"phone");
   });
  
	 //Fuction for loging users in
   $('.user_login').submit(function(){
	   console.log('wrikddf');
      if(!validateField($('#login_phone').val(),$('#login_phone'),$('.login_username_div'),"phone")){
        
      }else{
         $('#load').append('<img id="btnLoad" src="./assets/img/btn-ajax-loader.gif" />');
         $('#login_btn').css('display','none');
         var data = {phone:$('#login_phone').val(),pin:$('#login_pin').val()};
         $.ajax({
            url:"lib/irruser/login.php",
            type:"POST",
            data:{data:data},
            //dataType: "json",
            success:function(response){
               //$('#error_output').css('display','block').html(response);
               if(response.success){
                  $('#error_output').css('display','none');
                  setTimeout('window.location.href = "userdashboard";',3000);
               }else{
                  $('#error_output').css('display','block').html(response.error);
                  $('#login_btn').css('display','block');
                  $("#load img:last-child").remove();
                  $('#login_pin').val("");
               }
            },
            error:function($ex){
               console.log($ex);
               $('#error_output').css('display','block').html("An error occured, please try again");
            }
         });
      }
      return false;
   });
   
   
	/****** MESSAGE ******/
	
	//Deleting message
	$('.delete_message').click(function(){
		if(confirm("Are you sure you want to delete this message?")){
			var this_btn = $(this); //current btn clicked
			var formdata = new FormData(); 
			
			
			formdata.append('msg_id',$(this).attr('msg_id'));
		
			$.ajax({
				url: 'lib/irruser/msgdelete.php',
				type: 'POST',
				data: formdata,
				processData: false,
				contentType: false,
				success:function(response){
					if(response.success){
						if($("li#themsg").length){
							this_btn.closest("li#themsg").remove();
						}
						
						$.gritter.add({
							title: 'Message successfully deleted',
							text: "<span style='font-size:1.1em;'>This message has been successfully deleted</span>"
						});
						
						if ($("#msgdelete").length ) { //For the message view page
							setTimeout('window.location.href = "usermessages";',2000);
						}
						
					}else{
						$.gritter.add({
							title: 'An error occured',
							text: "<span style='font-size:1.1em;'>"+response.error+"</span>"
						});
					}
				},
				error: function (error,err,er){
					console.log(error);
				}
            });
		}
	});
	
	/****** END OF MESSAGE ******/
	
});