var sec = 0;
var free = true;
var clock = setInterval(function(){addSec()},1000);
document.getElementById("homeLink").onclick = function () {quitAlertion()};
document.getElementById("newGameLink").onclick = function () {quitAlertion()};
document.getElementById("toplistLink").onclick = function () {quitAlertion()};
document.getElementById("contactLink").onclick = function () {quitAlertion()};

function addSec() {
	sec++;
	
	document.getElementById("timer").value=sec;
	if(sec > 20) {
		document.getElementById("timer").style.backgroundColor="pink";
		userMessage("alert alert-danger",("Hurry, you have 10 seconds to answer!"));
		if(sec === 30) {
			document.getElementById("timer").style.backgroundColor="red";
			free = false;
			clearInterval(clock);
			userMessage("alert alert-danger",("Sorry, your time is up!"));
			setTimeout(function(){document.getElementById("myForm").submit()},2000);
		}
	}
}

function checkAnswer(id) {
	if(free) {
	free = false;
	clearInterval(clock);
	document.getElementById(id).style.backgroundColor="#0066ff";
	document.getElementById(id).style.color="white";
	var correctAnswer = document.getElementById("correctAnswer").innerHTML;
	setTimeout(function(){ch(id, correctAnswer)},2000);
	userMessage("alert alert-info",("You've selected answer " + id));
	document.getElementById("message").style.display="inline";
	}
}

function ch(id, correctAnswer) {
	if(correctAnswer === id) {
		document.getElementById("answer").value=1;
		document.getElementById(id).style.backgroundColor="#00cc00";
		setTimeout(function(){document.getElementById("myForm").submit()},2000);
		userMessage("alert alert-success",("Your answer was correct"));
	} else {
		document.getElementById(id).style.backgroundColor="#ff1a1a";
		setTimeout(function(){document.getElementById("myForm").submit()},2000);
		userMessage("alert alert-danger",("You give bad answer"));
	}
}

function userMessage(style, text) {
	document.getElementById("message").className=style;
	document.getElementById("message").innerHTML=text;
}

function quitAlertion() {
	var result = confirm('Are you sure, do you want to quit?');
	
	if(result) {
		location.href = "home";
	}
}
