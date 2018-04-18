workCaReady=true;
function workCaStart(){
	$("#workCarousel").carousel('cycle');
}
function workCajump(aim){
	if(workCaReady)
		$("#workCarousel").carousel(aim);
}
$('#workCarousel').on('slide.bs.carousel', function () {
	workCaReady=false;
});
$('#workCarousel').on('slid.bs.carousel', function () {
	workCaReady=true;
});

/*图片滚动效果*/
speedpic = 25;//速度数值越大速度越慢
document.getElementById("list2").innerHTML = document.getElementById("list1").innerHTML;
function Marqueepic(){
    if (document.getElementById("list2").offsetWidth - document.getElementById("list").scrollLeft <= 0){
        document.getElementById("list").scrollLeft -= document.getElementById("list1").offsetWidth;
    }else{
		document.getElementById("list").scrollLeft++;
    }
}
MyMarpic = setInterval(Marqueepic, speedpic);
document.getElementById("list").onmouseover = function() {
	clearInterval(MyMarpic);
}
document.getElementById("list").onmouseout = function() {
	MyMarpic = setInterval(Marqueepic, speedpic);
}


