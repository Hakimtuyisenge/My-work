<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="about.css">
</head>
<body>
    <div class="section">
    <div class="conatiner">
        <div class="contentsection">
            <div class="title">
                <a href="index.php"><img  class="back" src="images/back.svg" alt="back icon"></a>
                <h1>About Us</h1>
            </div>
            <div class="content">
                <h3>Relocation Management System</h3>
                <p>We are the civil servatnt institution , we provide the Address Update service to the citzens of
                    NGOMA SECTOR , This service is easy and efficient to everyone because it doesnt requre many
                    thind compared to going to the leader both from the place you move from and those of the place
                    that you move to<span id="dots"> ......</span>
                    <span id="more">, Our system made it very easy, simply thought the following explanation
                        <span>Whe the citzen move to the new place, all he/she have to do are bellow:</span>
                        <br>
                        
                        <span>1. Fill the required Form That you get through services Tab</span>
                        <br>
                        <span>2. Attach the Required Documents including your ID copy and Land ownership form or Legal Renters agreement</span>
                        <br>
                        <span>3. Submit the form</span>
                        <br>
                        <br>
                        <span>We will review your Request in not more dan one day</span>
                        <span></span>
                    </span>
                </p>
                <button onclick="myFunction()" id="myBtn">Read more</button>
            </div>

            <div class="social">
                <a href="https://www.facebook.com/">
                    <img src="images/facebook.svg" alt="facebook logo">
                </a>
                <a href="https://twitter.com/">
                   <img src="images/twitter.svg" alt="twitter logo">
                </a>
                <a href="https://www.instagram.com/">
                   <img src="images/instagram.svg" alt="intagram logo">
                </a>
            </div>
        </div>
        <div class="imagesection">
        <img src="images/new.webp" alt="change automatically image">
            <img src="images/12.png" alt="">
           
            <!-- <img src="images/" alt=""> -->
        </div>
    </div>
    </div>
    </div>

    <script>
        function myFunction() {
            var dots = document.getElementById("dots");
            var moreText = document.getElementById("more");
            var btnText = document.getElementById("myBtn");

            if (dots.style.display === "none") {
                dots.style.display = "inline";
                btnText.innerHTML = "Read more";
                moreText.style.display = "none";
            } else {
                dots.style.display = "none";
                btnText.innerHTML = "Read less";
                moreText.style.display = "inline";
            }
        }
    </script>
</body>

</html>