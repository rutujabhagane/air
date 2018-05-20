$('documnet').ready(function(){
    
   /*Validation of fields
      fieldVal- value of field eg $('#usernmae').val();
      field   - the field itself NB: should be the field same field as fieldVal eg $('#username')
      type    - type can either be username,email or password,number,year
   */
   function validateField(fieldVal,field,form_div,type){
      var regExUsername = /^[a-zA-Z_0-9]*$/;
      var regExNumber = /^[0-9]*$/;
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
   
   /******** ADMIN ********/
   
   /*login submit*/
   $('#login_username').keyup(function(){
      validateField($('#login_username').val(),$('#login_username'),$('.login_username_div'),"username");
   }).blur(function(){
      validateField($('#login_username').val(),$('#login_username'),$('.login_username_div'),"username");
   });
  
	 //Fuction for loging users in
   $('.admin_login').submit(function(){
	   console.log('wrikddf');
      if(!validateField($('#login_username').val(),$('#login_username'),$('.login_username_div'),"username")){
        
      }else{
         $('#load').append('<img id="btnLoad" src="./assets/img/btn-ajax-loader.gif" />');
         $('#login_btn').css('display','none');
         var data = {username:$('#login_username').val(),password:$('#login_password').val()};
         $.ajax({
            url:"lib/login.php",
            type:"POST",
            data:{data:data},
            //dataType: "json",
            success:function(response){
               //$('#error_output').css('display','block').html(response);
               if(response.success){
                  $('#error_output').css('display','none');
                  setTimeout('window.location.href = "dashboard";',3000);
               }else{
                  $('#error_output').css('display','block').html(response.error);
                  $('#login_btn').css('display','block');
                  $("#load img:last-child").remove();
                  $('#login_password').val("");
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
   
   //Adding admin 
   $( '.add_admin' ).submit( function(e){
	var formdata = new FormData();
	var profile_pic = $('#upload_cover').prop('files')[0];  
	formdata.append('username',$('#username').val());
	formdata.append('first_name',$('#first_name').val());
	formdata.append('last_name',$('#last_name').val());
	formdata.append('other_names',$('#other_names').val());
	formdata.append('email',$('#email').val());
	formdata.append('password',$('#password').val());
	formdata.append('retype_password',$('#retype_password').val());
	formdata.append('title',$('#title').val());
	formdata.append('profile_pic',profile_pic);
    $.ajax( {
      url: 'lib/add_admin.php',
      type: 'POST',
      data: formdata,
      processData: false,
      contentType: false,
	  success:function(response){
		if(response.success){
            $('#error_output').css('display','none');
            $('#success_output').css('display','block').html("An account with username '<b>"+ $('#username').val() +"</b>' has been successfully created");
			
			 $.gritter.add({
				title: 'Account successfully created',
				text: "<span style='font-size:1.1em;'>An account with username '<b>"+ $('#username').val() +"</b>' has been successfully created</span>"
			});
			
            $('#username').val('');
            $('#first_name').val('');
			$('#last_name').val('');
			$('#other_names').val('');
			$('#email').val('');
			$('#password').val('');
			$('#retype_password').val('');
			$('#title').val('none');
            $('#profile_pic').attr('src', "assets/img/default_profile.png");
			$('.count-jfilestyle').html(" ");
			$('.count-jfilestyle').css('background','white');
        }else{
			$('#success_output').css('display','none');
            $('#error_output').css('display','block').html(response.error);
			$.gritter.add({
				title: 'An error occured',
				text: "<span style='font-size:1.1em;'>"+response.error+"</span>"
			});
        }
	  },
	  error:function(error){
		  console.log(error);
	  }
    } );
		e.preventDefault();
	} );
	
	
	//Editing admin info 
	$('.edit_admininfo').submit( function(e){
		var formdata = new FormData();
		var profile_pic = $('#upload_cover').prop('files')[0];  
		formdata.append('uid',$('#uid').val());
		formdata.append('username',$('#username').val());
		formdata.append('first_name',$('#first_name').val());
		formdata.append('last_name',$('#last_name').val());
		formdata.append('other_names',$('#other_names').val());
		formdata.append('email',$('#email').val());
		formdata.append('profile_pic',profile_pic);
		$.ajax( {
		  url: 'lib/edit_admininfo.php',
		  type: 'POST',
		  data: formdata,
		  processData: false,
		  contentType: false,
		  success:function(response){
			if(response.success){
				$('#error_output').css('display','none');
				$('#success_output').css('display','block').html("The details has been successfully updated");
				
				 $.gritter.add({
					title: 'Account successfully Updated',
					text: "<span style='font-size:1.1em;'>The details has been successfully updated</span>"
				});
				
				$('.count-jfilestyle').html(" ");
				$('.count-jfilestyle').css('background','white');
			}else{
				$('#success_output').css('display','none');
				$('#error_output').css('display','block').html(response.error);
				$.gritter.add({
					title: 'An error occured',
					text: "<span style='font-size:1.1em;'>"+response.error+"</span>"
				});
			}
		  },
		  error:function(error){
			  console.log(error);
		  }
		} );
			e.preventDefault();
	} );
	
	//Editing admin privilege 
	$('.edit_privelege').submit( function(e){
		var formdata = new FormData(); 
		formdata.append('uid',$('#uid').val());
		formdata.append('title',$('#title').val());
		$.ajax( {
		  url: 'lib/edit_adminprivilege.php',
		  type: 'POST',
		  data: formdata,
		  processData: false,
		  contentType: false,
		  success:function(response){
			if(response.success){
				$('#error_output_2').css('display','none');
				$('#success_output_2').css('display','block').html("Privelege has been changed");
				
				 $.gritter.add({
					title: 'Account successfully Updated',
					text: "<span style='font-size:1.1em;'>Privelege has been changed</span>"
				});
			}else{
				$('#success_output_2').css('display','none');
				$('#error_output_2').css('display','block').html(response.error);
				$.gritter.add({
					title: 'An error occured',
					text: "<span style='font-size:1.1em;'>"+response.error+"</span>"
				});
			}
		  },
		  error:function(error){
			  console.log(error);
		  }
		} );
			e.preventDefault();
	} );
	
	//Editing admin password 
	$('.edit_password').submit( function(e){
		var formdata = new FormData(); 
		formdata.append('uid',$('#uid').val());
		formdata.append('password',$('#password').val());
		formdata.append('retype_password',$('#retype_password').val());
		$.ajax( {
		  url: 'lib/edit_adminpassword.php',
		  type: 'POST',
		  data: formdata,
		  processData: false,
		  contentType: false,
		  success:function(response){
			if(response.success){
				$('#error_output_3').css('display','none');
				
				if($('#password').val().length == 0){
					
					$('#success_output_3').css('display','block').html("Password has been reset");
				
					 $.gritter.add({
						title: 'Account successfully Updated',
						text: "<span style='font-size:1.1em;'>Password has been reset</span>"
					});
					
				}else{
					
					$('#success_output_3').css('display','block').html("Password has been changed");
				
					 $.gritter.add({
						title: 'Account successfully Updated',
						text: "<span style='font-size:1.1em;'>Password has been changed</span>"
					});
					
				}
				$('#password').val('');
				$('#retype_password').val('');
			}else{
				$('#success_output_3').css('display','none');
				$('#error_output_3').css('display','block').html(response.error);
				$.gritter.add({
					title: 'An error occured',
					text: "<span style='font-size:1.1em;'>"+response.error+"</span>"
				});
			}
		  },
		  error:function(error){
			  console.log(error);
		  }
		} );
			e.preventDefault();
	} );
	
	//Deleting admin
	$('.delete_admin').click(function(){
		if(confirm("Are you sure you want to delete this user. All login information about this user will be deleted and can't login with this login detatils anymore. Click OK to delete")){
			var this_btn = $(this); //current btn clicked
			var formdata = new FormData(); 
			var uid;
			if ($("#uid").length ) {
				uid = $('#uid').val();  
			}else{
				uid = $(this).attr('uid'); //viewadmin page
			}
			
			formdata.append('uid',uid);
		
			$.ajax({
				url: 'lib/edit_admindelete.php',
				type: 'POST',
				data: formdata,
				processData: false,
				contentType: false,
				success:function(response){
					if(response.success){
						$('#error_output_4').css('display','none');
						
						if($("tr#admin-list").length){
							this_btn.closest("tr#admin-list").remove();
						}
						
						$.gritter.add({
							title: 'Account successfully deleted',
							text: "<span style='font-size:1.1em;'>This admin has been successfully deleted</span>"
						});
						
						if ($("#admindelete").length ) {
							setTimeout('window.location.href = "logout";',2000);
						}else{
							setTimeout('window.location.href = "viewadmins";',2000);
						}
			
						
						
					}else{
						$('#error_output_4').css('display','block').html(response.error);
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
	/******** END OF ADMIN ********/
	
	
	/******** USER ********/
	/*** Adding a user/farmer ***/
	//Selecting if a farm already exists or not
	$('#existing_farm_q').change(function(){
      var value = $(this).val();
      if(value=='no'){
        $('#existing_farm_names').css('display','none');
		$('#enter_farm_details').css('display','block');
      }else if(value=='yes'){
        $('#existing_farm_names').css('display','block');
		$('#enter_farm_details').css('display','none');
      }
	});
	
	//Creating user 
   $( '.add_user' ).submit( function(e){
	var formdata = new FormData();
	var profile_pic = $('#upload_cover').prop('files')[0];
	formdata.append('first_name',$('#first_name').val());
	formdata.append('last_name',$('#last_name').val());
	formdata.append('other_names',$('#other_names').val());
	formdata.append('phone',$('#phone').val());
	formdata.append('user_region',$('#user_region').val());
	formdata.append('user_town',$('#user_town').val());
	formdata.append('profile_pic',profile_pic);
	
	formdata.append('pin',$('#pin').val());
	formdata.append('retype_pin',$('#retype_pin').val());
	
	formdata.append('existing_farm_q',$('#existing_farm_q').val());
	formdata.append('existing_farms',$('#existing_farms').val());
	
	formdata.append('farm_name',$('#farm_name').val());
	formdata.append('crop',$('#crop').val());
	formdata.append('size',$('#size').val());
	formdata.append('soil_type',$('#soil_type').val());
	formdata.append('irrigation_type',$('#irrigation_type').val());
	formdata.append('farm_region',$('#farm_region').val());
	formdata.append('farm_town',$('#farm_town').val());
	formdata.append('block_id',$('#block_id').val());
	
    $.ajax( {
      url: 'lib/add_user.php',
      type: 'POST',
      data: formdata,
      processData: false,
      contentType: false,
	  success:function(response){
		if(response.success){
            $('#error_output').css('display','none');
            $('#success_output').css('display','block').html($('#first_name').val() +"'s account has been successfully created");
			
			 $.gritter.add({
				title: 'Farmer\'s account successfully created',
				text: "<span style='font-size:1.1em;'>"+ $('#first_name').val() +"'s account has been successfully created</span>"
			});
			
            $('#first_name').val('');
			$('#last_name').val('');
			$('#other_names').val('');
			$('#phone').val('');
			$('#user_region').val('none');
			$('#user_town').val('');
			
			$('#retype_pin').val('');
			$('#pin').val('');
			
			$('#existing_farm_q').val('yes');
			$('#existing_farms').val('none');
			
			$('#farm_name').val('');
			$('#crop').val('none');
			$('#size').val('');
			$('#soil_type').val('none');
			$('#irrigation_type').val('none');
			$('#farm_region').val('none');
			$('#farm_town').val('');
			$('#block_id').val('');
			
			
            $('#profile_pic').attr('src', "assets/img/default_profile.png");
			$('.count-jfilestyle').html(" ");
			$('.count-jfilestyle').css('background','white');
        }else{
			$('#success_output').css('display','none');
            $('#error_output').css('display','block').html(response.error);
			$.gritter.add({
				title: 'An error occured',
				text: "<span style='font-size:1.1em;'>"+response.error+"</span>"
			});
        }
	  },
	  error:function(error){
		  console.log(error);
	  }
    } );
		e.preventDefault();
	} );
	
	
	
	
	//Search functionality farmers
	$('.farmers_search_box').keyup(function(){
		
		var search_query = $(this).val();
		
		if(search_query.length != 0){
			$('.farmers').css('display','none');
			$('.search').css('display','block');
			$.ajax({
				url:"lib/farmers_search.php",
				type:"POST",
				data:{search_query:search_query},
				dataType: "json",
				success:function(response){
					if(response.results_found){
						
                     $('.search_results').html(response.results_found);
                
					}else if(response.results){
						$('.search_results').html('');
						$('.search_results').append("<div style='margin-left: -2em;margin-right:1em;margin-top:1em;' class='alert alert-warning'>"+ response.results +"</div>");
					}

				},
				error:function(ex,err,er){
					//error occured
				}
			});
		}else{
			$('.farmers').css('display','inline-table');
			$('.search').css('display','none');
		}
		
	});

	$('.view_all_farmers').click(function(){
		$('.farmers_search_box').val('');
		$('.farmers').css('display','inline-table');
		$('.search').css('display','none');
	});
	
	
	
	//Editing user info 
	$('.edit_userinfo').submit( function(e){
		var formdata = new FormData();
		var profile_pic = $('#upload_cover').prop('files')[0];  
		formdata.append('uid',$('#uid').val());
		formdata.append('first_name',$('#first_name').val());
		formdata.append('last_name',$('#last_name').val());
		formdata.append('other_names',$('#other_names').val());
		formdata.append('phone',$('#phone').val());
		formdata.append('region',$('#region').val());
		formdata.append('town',$('#town').val());
		formdata.append('profile_pic',profile_pic);
		$.ajax( {
		  url: 'lib/edit_userinfo.php',
		  type: 'POST',
		  data: formdata,
		  processData: false,
		  contentType: false,
		  success:function(response){
			if(response.success){
				$('#error_output').css('display','none');
				$('#success_output').css('display','block').html("The details has been successfully updated");
				
				 $.gritter.add({
					title: 'Account successfully Updated',
					text: "<span style='font-size:1.1em;'>The details has been successfully updated</span>"
				});
				
				$('.count-jfilestyle').html(" ");
				$('.count-jfilestyle').css('background','white');
			}else{
				$('#success_output').css('display','none');
				$('#error_output').css('display','block').html(response.error);
				$.gritter.add({
					title: 'An error occured',
					text: "<span style='font-size:1.1em;'>"+response.error+"</span>"
				});
			}
		  },
		  error:function(error){
			  console.log(error);
		  }
		} );
			e.preventDefault();
	} );
	
	//Editing user pin 
	$('.edit_pin').submit( function(e){
		var formdata = new FormData(); 
		formdata.append('uid',$('#uid').val());
		formdata.append('pin',$('#pin').val());
		formdata.append('retype_pin',$('#retype_pin').val());
		$.ajax( {
		  url: 'lib/edit_userpin.php',
		  type: 'POST',
		  data: formdata,
		  processData: false,
		  contentType: false,
		  success:function(response){
			if(response.success){
				$('#error_output_3').css('display','none');
				
				if($('#pin').val().length == 0){
					
					$('#success_output_3').css('display','block').html("PIN has been reset");
				
					 $.gritter.add({
						title: 'Account successfully Updated',
						text: "<span style='font-size:1.1em;'>PIN has been reset</span>"
					});
					
				}else{
					
					$('#success_output_3').css('display','block').html("PIN has been changed");
				
					 $.gritter.add({
						title: 'Account successfully Updated',
						text: "<span style='font-size:1.1em;'>PIN has been changed</span>"
					});
					
				}
				$('#pin').val('');
				$('#retype_pin').val('');
			}else{
				$('#success_output_3').css('display','none');
				$('#error_output_3').css('display','block').html(response.error);
				$.gritter.add({
					title: 'An error occured',
					text: "<span style='font-size:1.1em;'>"+response.error+"</span>"
				});
			}
		  },
		  error:function(error){
			  console.log(error);
		  }
		} );
			e.preventDefault();
	} );
	
	
	//Deleting user
	$('.delete_user').click(function(){
		if(confirm("Are you sure you want to delete this user. All login information about this user will be deleted and can't login with this login detatils anymore. Click OK to delete")){
			if($("tr#admin-list").length){
				(this).closest("tr#admin-list").remove();
			}
			var formdata = new FormData(); 
			var uid;
			if ($("#uid").length ) {
				uid = $('#uid').val();  
			}else{
				uid = $(this).attr('uid'); //viewadmin page
			}
			
			formdata.append('uid',uid);
		
			$.ajax({
				url: 'lib/edit_userdelete.php',
				type: 'POST',
				data: formdata,
				processData: false,
				contentType: false,
				success:function(response){
					if(response.success){
						$('#error_output_4').css('display','none');
					
						$.gritter.add({
							title: 'Account successfully deleted',
							text: "<span style='font-size:1.1em;'>This user has been successfully deleted</span>"
						});
						
						setTimeout('window.location.href = "viewusers";',2000);
												
					}else{
						$('#error_output_4').css('display','block').html(response.error);
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
	
	//Deleting users farm
	$('.delete_user_farm').click(function(){
		var this_btn = $(this);
		if(confirm("Are you sure you want to delete the association between this user and farm profile.")){
			var formdata = new FormData(); 
			
			/*
			var uid;
			if ($("#uid").length ) {
				uid = $('#uid').val();  
			}else{
				uid = $(this).attr('uid'); //viewadmin page
			}
			*/
			
			formdata.append('uid',$(this).attr('user_id'));
			formdata.append('farm_id',$(this).attr('farm_id'));
			formdata.append('check',$(this).attr('check')); //check = false(edit_farm funtionality) & check=true(edit_user)
			
			$.ajax({
				url: 'lib/edit_userdeletefarm.php',
				type: 'POST',
				data: formdata,
				processData: false,
				contentType: false,
				success:function(response){
					if(response.success){
						$('#error_output_4').css('display','none');
						
						if($("tr#farm-list").length){
							this_btn.closest("tr#farm-list").remove();
						}
						
						$.gritter.add({
							title: 'Association successfully deleted',
							text: "<span style='font-size:1.1em;'>Association between the user and this farm profile has been successfully deleted </span>"
						});
						
						if(this_btn.attr('check') == "false" ){
							setTimeout('window.location.reload();',2000);
							setTimeout('window.location.href = "editfarm&id='+$('#farm_id').val()+'#assofarmers";',2000);
						}
					}else{
						$('#error_output_4').css('display','block').html(response.error);
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
	/******** END OF USER ********/
	
	
	/******** FARM *********/
	
	//Adding a farm
   $( '.add_farm' ).submit( function(e){
	var formdata = new FormData();
	formdata.append('farm_name',$('#farm_name').val());
	formdata.append('crop',$('#crop').val());
	formdata.append('size',$('#size').val());
	formdata.append('soil_type',$('#soil_type').val());
	formdata.append('irrigation_type',$('#irrigation_type').val());
	formdata.append('farm_region',$('#farm_region').val());
	formdata.append('farm_town',$('#farm_town').val());
	formdata.append('block_id',$('#block_id').val());
	
    $.ajax( {
      url: 'lib/add_farm.php',
      type: 'POST',
      data: formdata,
      processData: false,
      contentType: false,
	  success:function(response){
		if(response.success){
            $('#error_output').css('display','none');
            $('#success_output').css('display','block').html("Farm profile has been successfully created");
			
			 $.gritter.add({
				title: 'Farmer\'s account successfully created',
				text: "<span style='font-size:1.1em;'>Farm profile has been successfully created</span>"
			});
			
			$('#farm_name').val('');
			$('#crop').val('none');
			$('#size').val('');
			$('#soil_type').val('none');
			$('#irrigation_type').val('none');
			$('#farm_region').val('none');
			$('#farm_town').val('');
			$('#block_id').val('');
			
        }else{
			$('#success_output').css('display','none');
            $('#error_output').css('display','block').html(response.error);
			$.gritter.add({
				title: 'An error occured',
				text: "<span style='font-size:1.1em;'>"+response.error+"</span>"
			});
        }
	  },
	  error:function(error){
		  console.log(error);
	  }
    } );
		e.preventDefault();
	} );
	
	//Adding a farm unit
	
	function generate_rand_id(){
		var rand_num = Math.floor(new Date().getTime() + (Math.random() * 10000));
		return String(rand_num).slice(7,12);
	}
	
	$( '#generate_id' ).click( function(e){
		e.preventDefault();
		$('#farm_unit_id').val(generate_rand_id());
	})
	
	$( '.add_farm_unit' ).submit( function(e){
	var formdata = new FormData();
	formdata.append('farm_unit_id',$('#farm_unit_id').val());
	formdata.append('farm_id',$('#farm_id').val());
	
    $.ajax( {
      url: 'lib/add_farm_unit.php',
      type: 'POST',
      data: formdata,
      processData: false,
      contentType: false,
	  success:function(response){
		if(response.success){
            $('#error_output_5').css('display','none');
            $('#success_output_5').css('display','block').html("Farm Unit has been successfully added");
			
			 $.gritter.add({
				title: 'Farm unit added',
				text: "<span style='font-size:1.1em;'>Farm Unit has been successfully added</span>"
			});
			
			$('#farm_unit_id').val('');
			setTimeout('window.location.reload();',2000);
			setTimeout('window.location.href = "editfarm&id='+$('#farm_id').val()+'#farmunits";',2000);
        }else{
			$('#success_output_5').css('display','none');
            $('#error_output_5').css('display','block').html(response.error);
			$.gritter.add({
				title: 'An error occured',
				text: "<span style='font-size:1.1em;'>"+response.error+"</span>"
			});
        }
	  },
	  error:function(error){
		  console.log(error);
	  }
    } );
		e.preventDefault();
	} );
	
	//edit farm unit
	$('.edit_farm_unit').submit( function(e){
		var formdata = new FormData();
		formdata.append('id',$('#id').val());
		formdata.append('farm_unit_id',$('#farm_unit_id').val());
		
		$.ajax( {
		  url: 'lib/edit_farm_unit.php',
		  type: 'POST',
		  data: formdata,
		  processData: false,
		  contentType: false,
		  success:function(response){
			if(response.success){
				$('#error_output').css('display','none');
				$('#success_output').css('display','block').html("Farm unit has been updated");
				
				 $.gritter.add({
					title: 'Unit updated',
					text: "<span style='font-size:1.1em;'>Farm unit has been successfully updated</span>"
				});
			}else{
				$('#success_output').css('display','none');
				$('#error_output').css('display','block').html(response.error);
				$.gritter.add({
					title: 'An error occured',
					text: "<span style='font-size:1.1em;'>"+response.error+"</span>"
				});
			}
		  },
		  error:function(error){
			  console.log(error);
		  }
		} );
			e.preventDefault();
	} );
	
	//deleting farm unit
	$('.delete_farm_unit').click(function(){
		var this_btn = $(this);
		if(confirm("Are you sure you want to delete this farm unit")){
			var formdata = new FormData(); 
			
			formdata.append('id',$(this).attr('row_id'));

			$.ajax({
				url: 'lib/edit_deletefarmunit.php',
				type: 'POST',
				data: formdata,
				processData: false,
				contentType: false,
				success:function(response){
					if(response.success){
						$('#error_output_4').css('display','none');
						
						if($("tr#unit-list").length){
							this_btn.closest("tr#unit-list").remove();
						}
						
						$.gritter.add({
							title: 'Unit deleted',
							text: "<span style='font-size:1.1em;'>The farm unit has been successfully deleted</span>"
						});
						
					
						setTimeout('window.location.reload();',2000);
						setTimeout('window.location.href = "editfarm&id='+$('#farm_id').val()+'#farmunits";',2000);
					}else{
						$('#error_output_4').css('display','block').html(response.error);
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
	
	
	//edit farm
	$('.edit_farm').submit( function(e){
		var formdata = new FormData();
		formdata.append('id',$('#farm_id').val());
		
		formdata.append('farm_name',$('#farm_name').val());
		formdata.append('crop',$('#crop').val());
		formdata.append('size',$('#size').val());
		formdata.append('soil_type',$('#soil_type').val());
		formdata.append('irrigation_type',$('#irrigation_type').val());
		formdata.append('farm_region',$('#farm_region').val());
		formdata.append('farm_town',$('#farm_town').val());
		formdata.append('block_id',$('#block_id').val());
		
		$.ajax( {
		  url: 'lib/edit_farminfo.php',
		  type: 'POST',
		  data: formdata,
		  processData: false,
		  contentType: false,
		  success:function(response){
			if(response.success){
				$('#error_output').css('display','none');
				$('#success_output').css('display','block').html("The details has been successfully updated");
				
				 $.gritter.add({
					title: 'Profile successfully Updated',
					text: "<span style='font-size:1.1em;'>The details has been successfully updated</span>"
				});
			}else{
				$('#success_output').css('display','none');
				$('#error_output').css('display','block').html(response.error);
				$.gritter.add({
					title: 'An error occured',
					text: "<span style='font-size:1.1em;'>"+response.error+"</span>"
				});
			}
		  },
		  error:function(error){
			  console.log(error);
		  }
		} );
			e.preventDefault();
	} );
	
	//Search functionality farmers
	$('.farms_search_box').keyup(function(){
		
		var search_query = $(this).val();
		
		if(search_query.length != 0){
			$('.farmers').css('display','none');
			$('.search').css('display','block');
			$.ajax({
				url:"lib/farms_search.php",
				type:"POST",
				data:{search_query:search_query},
				dataType: "json",
				success:function(response){
					if(response.results_found){
						
                     $('.search_results').html(response.results_found);
                
					}else if(response.results){
						$('.search_results').html('');
						$('.search_results').append("<div style='margin-left: -2em;margin-right:1em;margin-top:1em;' class='alert alert-warning'>"+ response.results +"</div>");
					}

				},
				error:function(ex,err,er){
					//error occured
				}
			});
		}else{
			$('.farmers').css('display','inline-table');
			$('.search').css('display','none');
		}
		
	});
	
	
	//Adding a user-farm
   $( '.add_user_farm' ).submit( function(e){
	var formdata = new FormData();
	formdata.append('farmer_uid',$('#farmer_selected').val());
	formdata.append('farm_id',$('#farm_id').val());
	
    $.ajax( {
      url: 'lib/add_user-farm.php',
      type: 'POST',
      data: formdata,
      processData: false,
      contentType: false,
	  success:function(response){
		if(response.success){
            $('#error_output_2').css('display','none');
            $('#success_output_2').css('display','block').html("Farm profile has been successfully created");
			
			 $.gritter.add({
				title: 'Association created successfully',
				text: "<span style='font-size:1.1em;'>User has been successfully associated with this farm profile </span>"
			});

			$('#farmer_selected').val('none');
			setTimeout('window.location.reload();',2000);
			setTimeout('window.location.href = "editfarm&id='+$('#farm_id').val()+'#assofarmers";',2000);
        }else{
			$('#success_output_2').css('display','none');
            $('#error_output_2').css('display','block').html(response.error);
			$.gritter.add({
				title: 'An error occured',
				text: "<span style='font-size:1.1em;'>"+response.error+"</span>"
			});
        }
	  },
	  error:function(error){
		  console.log(error);
	  }
    } );
		e.preventDefault();
	} );
	
	
	//Deleting farm profile
	$('.delete_farm').click(function(){
		if(confirm("Are you sure you want to delete this farm profile. By deleting this farm profile you will be deleting all association with users/farmers and if a farmer/user is only associated with this farm ,his account will be deleted")){
			var this_btn = $(this); //current btn clicked
			var formdata = new FormData(); 
			var farm_id;
			if ($("#farm_id").length ) {
				farm_id = $('#farm_id').val();  
			}else{
				farm_id = $(this).attr('farm_id'); //viewadmin page
			}
			
			formdata.append('farm_id',farm_id);
		
			$.ajax({
				url: 'lib/edit_farmdelete.php',
				type: 'POST',
				data: formdata,
				processData: false,
				contentType: false,
				success:function(response){
					if(response.success){
						$('#error_output_4').css('display','none');
						
						if($("tr#farm-list").length){
							this_btn.closest("tr#farm-list").remove();
						}
						
						$.gritter.add({
							title: 'Farm profile successfully deleted',
							text: "<span style='font-size:1.1em;'>This farm profile and all information related to it has been successfully deleted</span>"
						});
						
						setTimeout('window.location.href = "viewfarms";',4000);
					}else{
						$('#error_output_4').css('display','block').html(response.error);
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
	
	
	//Runnig algorithm
	$('.run_algorithm').submit( function(e){
		var formdata = new FormData();
		formdata.append('water_volume',$('#water_volume').val());
		formdata.append('times',$('#times').val());
		formdata.append('block_id',$('#block_id').val());
		
		$.ajax( {
		  url: 'lib/run_algorithm.php',
		  type: 'POST',
		  data: formdata,
		  processData: false,
		  contentType: false,
		  success:function(response){
			if(response.success){
				$('#error_output').css('display','none');
				$('#success_output').css('display','block').html("Rationing has been done on the block successfully");
				
				$.gritter.add({
					title: 'Rationing done successfully',
					text: "<span style='font-size:1.1em;'>Rationing has been done on the block successfully</span>"
				});
				$('#responseText').css('display','block').html(response.response_text);
				$('#block_id').val('none');
				$('#times').val('');
				$('#water_volume').val('');
			}else{
				$('#success_output').css('display','none');
				$('#error_output').css('display','block').html(response.error);
				$.gritter.add({
					title: 'An error occured',
					text: "<span style='font-size:1.1em;'>"+response.error+"</span>"
				});
			}
		  },
		  error:function(error){
			  console.log(error);
		  }
		} );
			e.preventDefault();
	} );
	
	
	/******** END OF FARM *******/
	
	
	/****** STATS *****/
	$('#show_graph_duration').change(function(){
		$("#today-moisture-sensor-readings").empty();
		$("#today-temperature-sensor-readings").empty();
		$("#today-moisturetemperature-sensor-readings").empty();
		$("#interval-moisture-sensor-readings").empty();
		$("#interval-temperature-sensor-readings").empty();
		$("#interval-moisturetemperature-sensor-readings").empty();
		
		var value = $(this).val();
		
		if(value == "today"){
			$('#today_stats').css('display','block');
			$('#interval_stats').css('display','none');
		}else if(value == "week" || value == 'monthly' || value == 'yearly'){
			$('#interval_stats').css('display','block');
			$('#today_stats').css('display','none');
		}else if(value == "none"){
			$('#interval_stats').css('display','none');
			$('#today_stats').css('display','none');
		}
		
		var formdata = new FormData();
		formdata.append('duration',value);
		formdata.append('farm_id',$('#thefarmid').val());
		$.ajax( {
		  url: "lib/stats.php",
		  type: 'POST',
		  data: formdata,
		  processData: false,
		  contentType: false,
		  success:function(response){
			  //console.log(response['moisture_senosr_single']);
			if(response.error){
				$('#success_output').css('display','none');
				$('#error_output').css('display','block').html(response.error);
				$.gritter.add({
					title: 'An error occured',
					text: "<span style='font-size:1.1em;'>"+response.error+"</span>"
				});
			}else{				
				var moisture_sensor_single_arr = [];
				var temperature_sensor_single_arr = [];
				var moisturetemperature_sensor_double_arr = [];
				
				if(response['moisture_sensor_single'] != 0 && value == "today"){
					for(item in response['moisture_sensor_single']){
						moisture_sensor_single_arr.push(response['moisture_sensor_single'][item]);
					}

					
					Morris.Line({
						element: 'today-moisture-sensor-readings',
						data: moisture_sensor_single_arr,
						xkey: 'y',
						ykeys: ['a'],
						labels: ['Moisture sensor readings(Percentage)'],
						lineColors:['#3498DB']
					});
				}else{
					$('#today-moisture-sensor-readings').html('No moisture sensor readings');
				}
				
				
				if(response['temperature_sensor_single'] != 0 && value == "today"){
					for(item in response['temperature_sensor_single']){
						temperature_sensor_single_arr.push(response['temperature_sensor_single'][item]);
					}
					

					Morris.Line({
						element: 'today-temperature-sensor-readings',
						data: temperature_sensor_single_arr,
						xkey: 'y',
						ykeys: ['a'],
						labels: ['Temperature sensor readings(Degrees celcius)',],
						lineColors:['#D35400']
					});
				}else{
					$('#today-temperature-sensor-readings').html('No temperature sensor readings')
				}
				
				
				if(response['moisturetemperature_sensor_double'] != 0 && value == "today"){
					for(item in response['moisturetemperature_sensor_double']){
						moisturetemperature_sensor_double_arr.push(response['moisturetemperature_sensor_double'][item]);
					}

					Morris.Line({
						element: 'today-moisturetemperature-sensor-readings',
						data: moisturetemperature_sensor_double_arr,
						xkey: 'y',
						ykeys: ['a','b'],
						labels: ['Moisture sensor readings(Percentage)', 'Temperature sensor readings(Degrees Celcius)'],
						lineColors:['#3498DB','#D35400']
					});
				}else{
					$('#today-moisturetemperature-sensor-readings').html('No moisture and temperature sensor readings')
				}
				
				
				if(response['moisture_sensor_single'] != 0 && value != "today"){
					for(item in response['moisture_sensor_single']){
						moisture_sensor_single_arr.push(response['moisture_sensor_single'][item]);
					}
					
					Morris.Bar({
						element: 'interval-moisture-sensor-readings',
						data: moisture_sensor_single_arr,
						xkey: 'y',
						ykeys: ['a'],
						labels: ['Moisture sensor readings(Percentage)'],
						barColors:['#3498DB']
					});
				}else{
					$('#interval-moisture-sensor-readings').html('No moisture sensor readings');
				}
				
				
				if(response['temperature_sensor_single'] != 0 && value != "today"){
					for(item in response['temperature_sensor_single']){
						temperature_sensor_single_arr.push(response['temperature_sensor_single'][item]);
					}
					
					Morris.Bar({
						element: 'interval-temperature-sensor-readings',
						data: temperature_sensor_single_arr,
						xkey: 'y',
						ykeys: ['a'],
						labels: ['Temperature sensor readings(Degrees Celcius)'],
						barColors:['#D35400']
					});
				}else{
					$('#interval-temperature-sensor-readings').html('No moisture sensor readings');
				}
				
				//
				
				if(response['moisturetemperature_sensor_double'] != 0 && value != "today"){
					for(item in response['moisturetemperature_sensor_double']){
						moisturetemperature_sensor_double_arr.push(response['moisturetemperature_sensor_double'][item]);
					}

					Morris.Bar({
						element: 'interval-moisturetemperature-sensor-readings',
						data: moisturetemperature_sensor_double_arr,
						xkey: 'y',
						ykeys: ['a','b'],
						labels: ['Moisture sensor readings(Percentage)', 'Temperature sensor readings(Degrees Celcius)'],
						barColors:['#3498DB','#D35400']
					});
				}else{
					$('#interval-moisturetemperature-sensor-readings').html('No moisture and temperature sensor readings')
				}
				
			}
		  },
		  error:function(error){
			  console.log(error);
		  }
		} );
	});
	/***** END OF STATS *****/
	
	
	/***** SENDING A MESSAGE *****/
		
		$('#snd_msg_q').change(function(){
		  var value = $(this).val();
		  if(value=='selectedusers'){
			$('#msg_users_selected').css('display','block');
			$('#msg_region_selected').css('display','none');
			$('#msg_crop_selected').css('display','none');
			$('#msg_irrigation_selected').css('display','none');
		  }else if(value=='allusers'){
			$('#msg_users_selected').css('display','none');
			$('#msg_region_selected').css('display','none');
			$('#msg_crop_selected').css('display','none');
			$('#msg_irrigation_selected').css('display','none');
		  }else if(value=='regions'){
			$('#msg_region_selected').css('display','block');
			$('#msg_users_selected').css('display','none');
			$('#msg_crop_selected').css('display','none');
			$('#msg_irrigation_selected').css('display','none');
		  }else if(value=='croptype'){
			$('#msg_crop_selected').css('display','block');
			$('#msg_region_selected').css('display','none');
			$('#msg_users_selected').css('display','none');
			$('#msg_irrigation_selected').css('display','none');
		  }else if(value=='irrigationtype'){
			$('#msg_irrigation_selected').css('display','block');
			$('#msg_crop_selected').css('display','none');
			$('#msg_region_selected').css('display','none');
			$('#msg_users_selected').css('display','none');
		  }
		});
		
		
	//Sending message 
   $( '.snd_message' ).submit( function(e){
	if(confirm("Click 'OK' to send message")){
		e.preventDefault();
		var formdata = new FormData();
		
		formdata.append('message',$('#message').val());
		formdata.append('subject',$('#subject').val());
		var submit_url; // to control which asyc php file is submitted to... 1 = for selected users ,2 = for all users 
		
		if($('#snd_msg_q').val() == "selectedusers"){
			submit_url = "lib/snd_msg_selectedusers.php";
			var users = [];
			$('.users_selected').each(function(){
				if($(this).is(":checked")){
					users.push($(this).val());
				}
			});
			formdata.append('users',users);
		}else if($('#snd_msg_q').val() == "allusers"){
			submit_url = "lib/snd_msg_allusers.php";
		}else if($('#snd_msg_q').val() == "regions"){
			formdata.append('region',$('#farm_region').val());
			submit_url = "lib/snd_msg_regions.php";
		}else if($('#snd_msg_q').val() == "croptype"){
			formdata.append('crop',$('#crop').val());
			submit_url = "lib/snd_msg_croptype.php";
		}else if($('#snd_msg_q').val() == "irrigation_type"){
			formdata.append('irrigation_type',$('#irrigation_type').val());
			submit_url = "lib/snd_msg_irrigationType.php";
		}
		
		
		$.ajax( {
		  url: submit_url,
		  type: 'POST',
		  data: formdata,
		  processData: false,
		  contentType: false,
		  success:function(response){
			if(response.success){
				$('#error_output').css('display','none');
				$('#success_output').css('display','block').html("Message has been successfully sent");
				
				 $.gritter.add({
					title: 'Message sent',
					text: "<span style='font-size:1.1em;'> Message has been successfully sent. </span>"
				});
				
				$('#message').val('');
				$('#snd_msg_q').val('allusers');
				$('#msg_users_selected').css('display','none');
				$('#msg_region_selected').css('display','none');
				$('#msg_crop_selected').css('display','none');
				$('#msg_irrigation_selected').css('display','none');
			}else{
				$('#success_output').css('display','none');
				$('#error_output').css('display','block').html(response.error);
				$.gritter.add({
					title: 'An error occured',
					text: "<span style='font-size:1.1em;'>"+response.error+"</span>"
				});
			}
		  },
		  error:function(error){
			  console.log(error);
		  }
		} );

	}
	} );
		
	/***** END OF SENDING A MESSAGE*****/
	
	
});