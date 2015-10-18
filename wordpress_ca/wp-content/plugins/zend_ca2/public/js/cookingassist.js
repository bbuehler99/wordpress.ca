 
 function show(noOfVisibleSteps) {
	 var i = 0;
	 var currentStep = document.getElementById('Step'+i);
	 while (currentStep != null){
		 if (i<noOfVisibleSteps){
			 currentStep.style.display = "block";
		 }
		 else{
			 currentStep.style.display = "none";
		 }
		 ++i;
		 currentStep = document.getElementById('Step'+i);
	 }

	 // Make sure the current number of steps is selected in drop down
	 var stepSelect = document.getElementById('NoOfStepSelect');
	 stepSelect.options[noOfVisibleSteps-1].selected = true;
}

 function switch_step(id){
 	var current = document.getElementById(id);
 	// get number of step
 	var index = id.slice(-1);
 	if(current.checked){
 	 	document.getElementById("singleStep"+index).style.display="none";
 	 	document.getElementById("multiStep"+index).style.display="block";
	 }
 	else{
 	 	document.getElementById("singleStep"+index).style.display="block";
 	 	document.getElementById("multiStep"+index).style.display="none";
//  	 	alert("unchecked");
	 }
 }