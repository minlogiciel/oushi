function setTopTitle(sel, nn) 
{
	var fsel = document.getElementById('title_'+nn);
	var tvar = document.getElementById('tvariable_'+nn);
	var tphoto = document.getElementById('tphoto_'+nn);
	var ftphoto = document.getElementById('ftphoto_'+nn);
	var nindex = sel.selectedIndex;
	if (nindex >= 0){
		fsel.value  	= ALLNEWSLISTS[nindex][0];
		tphoto.value  	= ALLNEWSLISTS[nindex][1];	
		ftphoto.value 	= ALLNEWSLISTS[nindex][2];
		tvar.value 		= ALLNEWSLISTS[nindex][3];
	}
	else {
		fsel.value  = "";	
		tvar.value = "";
		tphoto.value  = "";	
		ftphoto.value = "";
	}
} 
function setTopTitle3(sel, nn) 
{
	var fsel = document.getElementById('title_'+nn);
	var tvar = document.getElementById('tvariable_'+nn);
	var tphoto = document.getElementById('tphoto_'+nn);
	var ftphoto = document.getElementById('ftphoto_'+nn);
	var nindex = sel.selectedIndex;
	var vstr = sel.value;
	if (nindex >= 0){
		var res = vstr.split("|",4); 
		tvar.value 		= res[0];
		fsel.value  	= res[1];
		tphoto.value  	= res[2];	
		ftphoto.value 	= res[3];

	}
	else {
		fsel.value  = "";	
		tvar.value = "";
		tphoto.value  = "";	
		ftphoto.value = "";
	}
} 

function setTopPhoto(nn, ff) 
{ 
	if (ff == 0) {
		var tphoto = document.getElementById('tphoto_'+nn);
		var pathname = document.getElementById('fphoto_'+nn).value;
	}
	else {
		var tphoto = document.getElementById('ftphoto_'+nn);
		var pathname = document.getElementById('ffphoto_'+nn).value;
	}
	var startIndex = (pathname.indexOf('\\') >= 0 ? pathname.lastIndexOf('\\') : pathname.lastIndexOf('/'));
	var filename = pathname.substring(startIndex);
	if (filename.indexOf('\\') === 0 || filename.indexOf('/') === 0) {
		filename = filename.substring(1);
	}
	tphoto.value  = filename;
} 

function setJLPhoto(nn) 
{ 
	if (nn == 0) {
		var tphoto = document.getElementById('imgfile');
		var pathname = document.getElementById('cphoto').value;
	}
	else {
		var tphoto = document.getElementById('fimgfile');
		var pathname = document.getElementById('fphoto').value;
	}
	var startIndex = (pathname.indexOf('\\') >= 0 ? pathname.lastIndexOf('\\') : pathname.lastIndexOf('/'));
	var filename = pathname.substring(startIndex);
	if (filename.indexOf('\\') === 0 || filename.indexOf('/') === 0) {
		filename = filename.substring(1);
	}
	tphoto.value  = "jiaoliunews/" + filename;
} 
