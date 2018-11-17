/*
$("a").hover(function(e) {
    $($(this).data("tooltip")).css({
        left: e.pageX + 1,
        top: e.pageY + 1
    }).stop().show(100);
}, function() {
    $($(this).data("tooltip")).hide();
});
*/

function showbox(x){
	document.getElementById(x).style.display = 'block';
}
function hidebox(x)
{
	document.getElementById(x).style.display = 'none';
}