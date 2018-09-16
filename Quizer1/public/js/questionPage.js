$(document).ready(function() {
//set confirm to the links
$('#homeLink,#toplistLink,#newGameLink, #contactLink').attr("onclick", "");
$('#homeLink').click(function(){
	quitAlertion('home');
});
$('#toplistLink').click(function(){
	quitAlertion('toplist');
});
$('#newGameLink').click(function(){
	quitAlertion('newGame');
});
$('#contactLink').click(function(){
	quitAlertion('contact');
});

function quitAlertion(links) {
	var result = confirm('Are you sure, do you want to quit?');	
	if(result) {
		location.href = links;
	} else {
		return 0;
	}
}


// inicialize and start the timer
var sec = 0;
var clock = setInterval(function(){addSec()},1000);

function addSec() {
	sec++;
	
	$("#timer").attr('value',sec);
	if(sec > 20) {
		$("#timer").css('background-color','pink');
		changeTime("pink",("Hurry, you have 10 seconds to answer!"));
		if(sec === 30) {
			$("#timer").css('background-color','red');
			free = false;
			clearInterval(clock);
			changeTime("red",("Sorry, your time is up!"));
			setTimeout(function(){$("#myForm").submit()},2000);
		}
	}
}

function changeTime(color, messageText) {
	$("#timer").css('background-color',color);
	$("#timer").text(messageText);	
}

//slideDown the answers continously
$("#answer1,#answer2,#answer3,#answer4").hide();	
$("#answer1").slideDown(2000);
$("#answer2").delay(2000).slideDown(2000);
$("#answer3").delay(4000).slideDown(2000);
$("#answer4").delay(6000).slideDown(2000);
	

//Change the backgound of the answer, stop timer, send a message, and after 2 seconds shows the result
$("#answer1").click(function() {
	signAnswer("answer1");
});
$("#answer2").click(function() {
	signAnswer("answer2");
});
$("#answer3").click(function() {
	signAnswer("answer3");
});
$("#answer4").click(function() {
	signAnswer("answer4");
});
var free = true;
function signAnswer(id) {
	if(free) {
	free = false;
	clearInterval(clock);
	changeAnswerMessage(id, '#0066ff', "alert alert-info", "You have selected answer " + id[6]);
	$("#"+id).css('color','white');
	setTimeout(function(){checkAnswer(id, $('#correctAnswer').text())},2000);
	}
}

function checkAnswer(id, correctAnswer) {
	if(correctAnswer === id[6]) {
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
});