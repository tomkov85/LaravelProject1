var sec = 0;

setInterval(function(){addSec()},1000);

function addSec() {
	sec++;
	
	document.getElementById("timer").value=sec;
}