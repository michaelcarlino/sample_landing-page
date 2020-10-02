$(function() {
       
  $('.form-err').hide();

  // $('input.contact-input-box').css({
  //   backgroundColor: "#f7f7f7"
  // });

  // $('input.contact-input-box').focus(function() {

  //   $(this).css({
  //     backgroundColor: ""
  //   });

  // });

  // $('input.contact-input-box').blur(function() {

  //   $(this).css({
  //     backgroundColor: "#f7f7f7"
  //   });

  // });



  $(".contact-form-submitformbtn").click(function() {
    // validate and process form
    // first hide any error messages
  $('.form-err').hide();
		   
  
  var contactfirstname = $("input#contactfirstname").val();
   if (contactfirstname == "") {
      $("label#contactfirstname_error").show();
      $("input#contactfirstname").focus();
      return false;
    }
    
  var contactlastname = $("input#contactlastname").val();
   if (contactlastname == "") {
      $("label#contactlastname_error").show();
      $("input#contactlastname").focus();
      return false;
    } 

  var contactphone = $("input#contactphone").val();
   if (contactphone == "") {
      $("label#contactphone_error").show();
      $("input#contactphone").focus();
      return false;
    } 
  
  var contactemail = $("input#contactemail").val();
   if (contactemail == "") {
      $("label#contactemail_error").show();
      $("input#contactemail").focus();
      return false;
    }

  var contactaddress = $("input#contactaddress").val();
   if (contactaddress == "") {
      $("label#contactaddress_error").show();
      $("input#contactaddress").focus();
      return false;
    }

  var contactiama = $("select#contactiama").val();
   // if (contactiama == "") {
   //    $("label#contactiama_error_valid").show();
   //    $("select#contactiama").focus();
   //    return false;
   //  }

  var contactcomments = $("textarea#contactcomments").val();

  
  

  var dataString = '&contactfirstname=' + contactfirstname + '&contactlastname=' + contactlastname + '&contactphone=' + contactphone + '&contactemail=' + contactemail  + '&contactaddress=' + contactaddress + '&contactiama=' + contactiama + '&contactcomments=' + contactcomments;  
	
 //  alert (dataString);return false;
	
    $.ajax({
      type: "POST",
      url: "./form-bin/contact-process.php",
      data: dataString,
      success: function() {
         window.location = "./thank-you.html";    
         return true;
      }
     });
    return false;
  });
});
runOnLoad(function() {
  $("select#contactfirstname").select().focus();
});
    


