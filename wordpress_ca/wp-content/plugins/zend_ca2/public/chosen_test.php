<?php

?>
<head>
<script src="chosen.jquery.js"></script>
<style>
.chosen {background-color:lightgray}
</style>
</head> 
<body>


<select id="auto" class="chosen">
<option value="volvo">Volvo</option>
<option value="saab">Saab</option>
<option value="opel">Opel</option>
<option value="audi">Audi</option>
</select>


 <script>
 jQuery(document).ready(function(){
		 $(".chosen").chosen(); 
	});
</script>
 </body>