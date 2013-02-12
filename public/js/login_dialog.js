$(document).ready(function() {
  $('#login_dialog').dialog({
    modal: true,
    title: "Login",
    //width: 280,
    //height: 280,
    resizable: false,
    close: function(event, ui) {
      window.location.href = 'http://www.berkeleysep.com/home';
    }
  });
  
  $('input[type="submit"]').button();
});



///showing bros

function showKathy(){

    
   $( "#kathy_dialog" ).dialog({ width: 1000, height: 700, show: {
        effect: "explode",
        duration: 1000
      }, hide: "explode" });
      
     $( "#kathy_dialog" ).html('<iframe style="width:100%;height:100%;" src="http://www.berkeleysep.com/public/images/Kathy.pdf"></iframe>'); 
}

function showSpencer(){

$( "#spencer_dialog" ).dialog({ width: 900, height: 700, show: {
        effect: "explode",
        duration: 1000
      }, hide: "explode" });
      
     $( "#spencer_dialog" ).html('<iframe style="width:100%;height:100%;" src="http://www.berkeleysep.com/public/images/Spencer.pdf"></iframe>'); 
}

function showJasmine(){

$( "#jasmine_dialog" ).dialog({ width: 900, height: 700, show: {
        effect: "explode",
        duration: 1000
      }, hide: "explode" });
      
     $( "#jasmine_dialog" ).html('<iframe style="width:100%;height:100%;" src="http://www.berkeleysep.com/public/images/Jasmine.pdf"></iframe>'); 
}
