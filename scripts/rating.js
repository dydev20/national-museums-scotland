
    ////////////////////////////////////////////change star from regular to solid//////////////////
    //change star 1 from regular to solid
    function star1ChangeToSolid(){
        document.getElementById("rating1").style.display = "none";
        document.getElementById("rating1-solid").style.display = "block";
    }

    //change star2 from regular to solid
    function star2ChangeToSolid(){
        document.getElementById("rating2").style.display = "none";
        document.getElementById("rating2-solid").style.display = "block";
    }

    function star3ChangeToSolid(){
        document.getElementById("rating3").style.display = "none";
        document.getElementById("rating3-solid").style.display = "block";
    }

    function star4ChangeToSolid(){
        document.getElementById("rating4").style.display = "none";
        document.getElementById("rating4-solid").style.display = "block";
    }

    function star5ChangeToSolid(){
        document.getElementById("rating5").style.display = "none";
        document.getElementById("rating5-solid").style.display = "block";
    }


    //////////////////////////////////////////////change star from solid to regular//////////////////////////
    //change star 1 from solid to regular
    function star1ChangeToRegular(){
        document.getElementById("rating1").style.display = "block";
        document.getElementById("rating1-solid").style.display = "none";
    }

    //change star 2 from solid to regular
    function star2ChangeToRegular(){
        document.getElementById("rating2").style.display = "block";
        document.getElementById("rating2-solid").style.display = "none";
    }

    function star3ChangeToRegular(){
        document.getElementById("rating3").style.display = "block";
        document.getElementById("rating3-solid").style.display = "none";
    }

    function star4ChangeToRegular(){
        document.getElementById("rating4").style.display = "block";
        document.getElementById("rating4-solid").style.display = "none";
    }

    function star5ChangeToRegular(){
        document.getElementById("rating5").style.display = "block";
        document.getElementById("rating5-solid").style.display = "none";
    }

    
    let stars= document.querySelectorAll(".star");

    /* When user clicks on a star, the stars do not remain solid because when the user moves their mouse out of the stars, the mouse out event activates.  */
    /* The mouse out event only executes if the variable clicked is set to false */
    let clicked = false;
    

    for(let i=0;i<5;i++){
        /* add click event listener to all stars */
        stars[i].addEventListener("click", function () {

            clicked = true;            

            switch(i){
                
                case 0:
                    star1ChangeToSolid(); //hover over star 1 to change star 1 from regular to solid
                    break;
                case 1:
                    star1ChangeToSolid(); //hover over star 2 to change star 1 and star 2 from regular to solid
                    star2ChangeToSolid();
                    break;
                case 2:
                    star1ChangeToSolid(); //hover over star 3 to change star 1 and star 2 and 3 from regular to solid
                    star2ChangeToSolid();
                    star3ChangeToSolid();
                    break;
                case 3:
                    star1ChangeToSolid(); //hover over star 4 to change star 1 and star 2, 3 and 4 from regular to solid
                    star2ChangeToSolid();
                    star3ChangeToSolid();
                    star4ChangeToSolid();
                    break;
                case 4:
                    star1ChangeToSolid(); //hover over star 5 to change star 1 and star 2, 3, 4 and 5 from regular to solid
                    star2ChangeToSolid();
                    star3ChangeToSolid();
                    star4ChangeToSolid();
                    star5ChangeToSolid();
                    break;
            }
        })
        
        /* add hover event listener to all stars */
        stars[i].addEventListener("mouseover",function(){
            
            if(clicked==false){
                switch(i){
                    case 0:
                        star1ChangeToSolid(); //hover over star 1 to change star 1 from regular to solid
                        break;
                    case 1:
                        star1ChangeToSolid(); //hover over star 2 to change star 1 and star 2 from regular to solid
                        star2ChangeToSolid();
                        break;
                    case 2:
                        star1ChangeToSolid(); //hover over star 3 to change star 1 and star 2 and 3 from regular to solid
                        star2ChangeToSolid();
                        star3ChangeToSolid();
                        break;
                    case 3:
                        star1ChangeToSolid(); //hover over star 4 to change star 1 and star 2, 3 and 4 from regular to solid
                        star2ChangeToSolid();
                        star3ChangeToSolid();
                        star4ChangeToSolid();
                        break;
                    case 4:
                        star1ChangeToSolid(); //hover over star 5 to change star 1 and star 2, 3, 4 and 5 from regular to solid
                        star2ChangeToSolid();
                        star3ChangeToSolid();
                        star4ChangeToSolid();
                        star5ChangeToSolid();
                        break;
                }
            }
        })


        /* add mouseout event listener to all stars */
        stars[i].addEventListener("mouseout", function () {
            
            if(clicked==false){

                switch (i) {
                    case 0:
                        star1ChangeToRegular(); //hover out star 1 to change star 1 from solid to regular
                        break;
                    case 1:
                        star1ChangeToRegular(); //hover out star 2 to change star 1 and star 2 from solid to regular
                        star2ChangeToRegular();
                        break;
                    case 2:
                        star1ChangeToRegular(); //hover out star 3 to change star 1 and star 2 and 3 from solid to regular
                        star2ChangeToRegular();
                        star3ChangeToRegular();
                        break;
                    case 3:
                        star1ChangeToRegular(); //hover out star 4 to change star 1 and star 2, 3 and 4 from solid to regular
                        star2ChangeToRegular();
                        star3ChangeToRegular();
                        star4ChangeToRegular();
                        break;
                    case 4:
                        star1ChangeToRegular(); //hover out star 5 to change star 1 and star 2, 3, 4 and 5 from solid to regular
                        star2ChangeToRegular();
                        star3ChangeToRegular();
                        star4ChangeToRegular();
                        star5ChangeToRegular();
                        break;
                }
            }
        })
        
        
        
    }

