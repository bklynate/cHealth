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

<script type="text/javascript">
	//Introducting a block history when clicking back button
	(function (global) { 

    if(typeof (global) === "undefined") {
        throw new Error("window is undefined");
    }

    var _hash = "!";
    var noBackPlease = function () {
        global.location.href += "#";

        // making sure we have the fruit available for juice (^__^)
        global.setTimeout(function () {
            global.location.href += "!";
        }, 50);
    };

    global.onhashchange = function () {
        if (global.location.hash !== _hash) {
            global.location.hash = _hash;
        }
    };

    global.onload = function () {            
        noBackPlease();
        $('.username').val("");
        $('.password').val("");

        // disables backspace on page except on input fields and textarea..
        document.body.onkeydown = function (e) {
            var elm = e.target.nodeName.toLowerCase();
            if (e.which === 8 && (elm !== 'input' && elm  !== 'textarea')) {
                e.preventDefault();
            }
            // stopping event bubbling up the DOM tree..
            e.stopPropagation();
        };          
    }

})(window);
</script>


