<script type="text/javascript" src="{{ URL::asset('jquery/jquery/dist/jquery.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('jquery/bootstrap/dist/js/bootstrap.js') }}"></script>
<script type="text/javascript">
	$(".alert").delay(8000).slideUp(2000, function() {
    	$(this).alert('close');
	});
</script>
<script type="text/javascript">
	//Redirect to home when session expires
	$(function() {
    	// Set idle time
    	$( document ).idleTimer(7200000);
	});

	$(function() {
    	$( document ).on( "idle.idleTimer", function(event, elem, obj){
        	window.location.href = "/"
    	});  
	});
</script>



