function setFrais(sel) 
{ 
	var nindex=sel.selectedIndex;
	var fsel = document.getElementById('fraisselect');
	var fval = document.getElementById('fraisid');
	var val = fsel.value;
	var res = val.split(";"); 
	fval.innerHTML  = res[nindex];
}

function active_save() 
{ 
	document.getElementById("savebuttonid").disabled='';
} 