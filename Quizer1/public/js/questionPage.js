$(document).ready(function() {
var sec = 0;
var free = true;
var clock = setInterval(function(){addSec()},1000);

	$('#homeLink,#newGameLink,#toplistLink,#contactLink').click(function(){
		var links = $('#homeLink,#toplistLink').onclick;
		quitAlertion(links);
	});


function addSec() {
	sec++;
	
	$("#timer").attr('value',sec);
	if(sec > 20) {
		$("#timer").css('background-color','pink');
		userMessage("alert alert-danger",("Hurry, you have 10 seconds to answer!"));
		if(sec === 30) {
			$("#timer").css('background-color','red');
			free = false;
			clearInterval(clock);
			userMessage("alert alert-danger",("Sorry, your time is up!"));
			setTimeout(function(){$("#myForm").submit()},2000);
		}
	}
}

$("#1").click(function() {
	signAnswer(1);
});
$("#2").click(function() {
	signAnswer(2);
});
$("#3").click(function() {
	signAnswer(3);
});
$("#4").click(function() {
	signkAnswer(4);
});

function signAnswer(id) {
	if(free) {
	free = false;
	clearInterval(clock);
	changeAnswerMessage(id, '#0066ff', "alert alert-info", "You have selected Answer" + id);
	$("#"+id).css('color','white');
	setTimeout(function(){checkAnswer(id, $('#correctAnswer').text())},2000);
	}
}

function checkAnswer(id, correctAnswer) {
	if(correctAnswer === id.toString()) {
		$("#answer").attr('value','1');
		changeAnswerMessage(id, '#00cc00', "alert alert-success", "Your answer was correct");
	} else {
		changeAnswerMessage(id, '#ff1a1a', "alert alert-danger", "You give bad answer");
	}
	setTimeout(function(){$("#myForm").submit()},2000);
}

function changeAnswerMessage(answerId, answerColor, messageType, messageText) {
	$("#message").addClass(messageType);
	$("#message").text(messageText);
	$("#" + answerId).css('background-color',answerColor);
}

function quitAlertion(links) {
	var result = confirm('Are you sure, do you want to quit?');
	
	if(result) {
		links;
	}
}
});