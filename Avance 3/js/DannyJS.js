
<script> 
    
$(document).ready(function(){
    $('.sidenav').sidenav();
  });
        
         $(document).ready(function(){
    $('.tooltipped').tooltip();
  });

  $(document).ready(function(){
    $('.parallax').parallax();
  });
        
    $('.carousel.carousel-slider').carousel({
    fullWidth: true,
    indicators: true
  });
      $(document).ready(function(){
    $('.carousel').carousel();
  });


function getRequestObject() {
  // Asynchronous objec created, handles browser DOM differences

  if(window.XMLHttpRequest) {
    // Mozilla, Opera, Safari, Chrome, IE 7+
    return (new XMLHttpRequest());
  }
  else if (window.ActiveXObject) {
    // IE 6-
    return (new ActiveXObject("Microsoft.XMLHTTP"));
  } else {
    // Non AJAX browsers
    return(null);
  }
}


<\script>