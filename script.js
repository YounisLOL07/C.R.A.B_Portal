var button = document.getElementById("clickButton");
var clickCountText = document.getElementById("clickCount");
var startOver = document.getElementById("startOverButton");
var tenXButton = document.getElementById("ten")

var clickCount = 0;

function normalClick() {
    clickCount = clickCount + 1;
    updateScore();
}
function zeroPoint () {
    clickCount = 0; 
    updateScore();
}

function tenTimesButton() {
    clickCount = clickCount + 10;
    updateScore();
}


function updateScore() {
    clickCountText.textContent = clickCount;

    if (clickCount > 10) {
        tenXButton.style.display = "block";
    } else {
        tenXButton.style.display = "none";
    }
}

button.addEventListener("click", normalClick);
startOver.addEventListener("click", zeroPoint);
tenXButton.addEventListener("click", tenTimesButton);


var submitButton = document.getElementById("submitScoreButton");

submitButton.addEventListener("click", function () {
    var username = document.getElementById("username").value;

    if (username.trim() === "") {
        document.getElementById("submitStatus").textContent = "Please enter your name!";
        return;
    }

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "submit_score.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    xhr.onload = function () {
        document.getElementById("submitStatus").textContent = xhr.responseText;
    };

    xhr.send("username=" + encodeURIComponent(username) + "&score=" + clickCount);
});


