<script type="text/javascript">
$(function() { 
  //for bootstrap 3 use 'shown.bs.tab' instead of 'shown' in the next line
  $('a[data-toggle="tab"]').on('click', function (e) {
    //save the latest tab; use cookies if you like 'em better:
    localStorage.setItem('lastTab', $(e.target).attr('href'));
  });

  //go to the latest tab, if it exists:
  var lastTab = localStorage.getItem('lastTab');

  if (lastTab) {
      $('a[href="'+lastTab+'"]').click();
  }
});

</script>

<!-- <script src="js/ui-load.js"></script>
<script src="js/ui-jp.config.js"></script>
<script src="js/ui-jp.js"></script>
<script src="js/ui-nav.js"></script>
<script src="js/ui-toggle.js"></script>
<script src="js/ui-client.js"></script> -->

