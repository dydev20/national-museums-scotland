/* determine whether user answer is correct or not and display message*/
function checkAnswer(answer,userAnswerLowerCase){
    /* no user input */
    if(userAnswerLowerCase==""){
        switch (answer) {
            case "tyrannosaurus":
                document.getElementById("t-rex-result").innerHTML = "Please type your guess into text box";
                break;
            case "velociraptor":
                document.getElementById("velociraptor-result").innerHTML = "Please type your guess into text box";
                break;
            case "sarcophagus":
                document.getElementById("sarcophagus-result").innerHTML = "Please type your guess into text box";
                break;
            case "sphinx":
                document.getElementById("sphinx-result").innerHTML = "Please type your guess into text box";
                break;

        }
        
    }/* answer is correct */
    else if (userAnswerLowerCase == answer) {
        switch(answer){
            case "tyrannosaurus":
                document.getElementById("t-rex-result").innerHTML="Answer is correct";
                break;
            case "velociraptor":
                document.getElementById("velociraptor-result").innerHTML = "Answer is correct";
                break;
            case "sarcophagus":
                document.getElementById("sarcophagus-result").innerHTML = "Answer is correct";
                break;
            case "sphinx":
                document.getElementById("sphinx-result").innerHTML = "Answer is correct";
                break;

        }
        
        
    } else { /* answer is not correct */
        switch (answer) {
            case "tyrannosaurus":
                document.getElementById("t-rex-result").innerHTML = "Answer is incorrect. Try again";
                break;
            case "velociraptor":
                document.getElementById("velociraptor-result").innerHTML = "Answer is incorrect. Try again";
                break;
            case "sarcophagus":
                document.getElementById("sarcophagus-result").innerHTML = "Answer is incorrect. Try again";
                break;
            case "sphinx":
                document.getElementById("sphinx-result").innerHTML = "Answer is incorrect. Try again";
                break;

        }
    }

}

let guess = document.querySelectorAll(".guess-submit");

for(let i=0;i<4;i++){
    /* add click event listener to all guess submit buttons*/
    guess[i].addEventListener("click",function(){
        
        let answer;
        let userAnswer;

        /* switch depending on which guess submit button is clicked  */
        switch(i){
            case 0:
                answer = "tyrannosaurus";
                userAnswer = document.getElementById("t-rex-input").value;
                /* change user answer to lowercase */
                userAnswerLowerCase = userAnswer.toLowerCase();
                
                /* check answer */
                checkAnswer(answer,userAnswerLowerCase);
                break;

            case 1:
                answer = "velociraptor";
                userAnswer = document.getElementById("velociraptor-input").value;
                userAnswerLowerCase = userAnswer.toLowerCase();

                checkAnswer(answer, userAnswerLowerCase);
                break;

            case 2:
                answer = "sarcophagus";
                userAnswer = document.getElementById("sarcophagus-input").value;
                userAnswerLowerCase = userAnswer.toLowerCase();

                checkAnswer(answer, userAnswerLowerCase);
                break;

            case 3:
                answer = "sphinx";
                userAnswer = document.getElementById("sphinx-input").value;
                userAnswerLowerCase = userAnswer.toLowerCase();

                checkAnswer(answer, userAnswerLowerCase);
                break;

        }
    })
}

