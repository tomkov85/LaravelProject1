var sec = 0;
var free = true;
var clock = setInterval(function(){addSec()},1000);

function addSec() {
	sec++;
	
	document.getElementById("timer").value=sec;
	if(sec > 20) {
		document.getElementById("timer").style.backgroundColor="pink";
		if(sec === 30) {
			document.getElementById("timer").style.backgroundColor="red";
			free = false;
			clearInterval(clock);
			setTimeout(function(){document.getElementById("myForm").submit()},2000);
		}
	}
}

function checkAnswer(id) {
	if(free) {
	free = false;
	clearInterval(clock);
	document.getElementById(id).style.backgroundColor="blue";
	var correctAnswer = document.getElementById("correctAnswer").innerHTML;
	setTimeout(function(){ch(id, correctAnswer)},2000);
	userMessage("alert alert-info",("You've selected answer " + id));
	document.getElementById("message").style.display="inline";
	}
}

function ch(id, correctAnswer) {
	if(correctAnswer === id) {
		document.getElementById("answer").value=1;
		document.getElementById(id).style.backgroundColor="green";
		setTimeout(function(){document.getElementById("myForm").submit()},2000);
		userMessage("alert alert-success",("Your answer was correct"));
	} else {
		document.getElementById(id).style.backgroundColor="red";
		setTimeout(function(){document.getElementById("myForm").submit()},2000);
		userMessage("alert alert-danger",("You give bad answer"));
	}
}

function userMessage(style, text) {
	document.getElementById("message").className=style;
	document.getElementById("message").innerHTML=text;
}