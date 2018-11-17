
function setHuiguItem(nindex){
	var path = "../photos/";
	var obj;
	var item = HG_PHOTOS[nindex];
	obj = document.getElementById("hgtitle4");
	if (obj) {
		obj.innerHTML = item[0];
	}
	
	obj = document.getElementById("hgtitle5");
	if (obj) {
		obj.innerHTML = "【发表时间】 " + item[3];
	}
	
	obj = document.getElementById("huiguphoto");
	if (obj) {
		obj.src = path + item[1];
	}
	obj = document.getElementById("hgcontent");
	if (obj) {
		obj.innerHTML = item[4];
	}
}
