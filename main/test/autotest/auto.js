function play() { // 경고음
    var audio = document.getElementById('audio_play');
    if (audio.paused) {
        audio.play();
    } else {
        audio.pause();
        audio.currentTime = 0
    }
}

function changeClass() {
    document.getElementById("img").className = "blinking2";
}

function changeClass2() {
    document.getElementById("img").className = "blinking3";
}

function changeClass3() {
    document.getElementById("img").className = "blinking";
}


function clickCheckbox() {
    var nomal = document.getElementsByName("nomal");
    for (var i = 0; nomal.length; i++) {
        //체크되어 있다면 park[i].checked == true
        //true -> false로 변환 ==> 체크해제
        if (nomal[i].checked) {
            nomal[i].checked = false;
        }
    }
}

function next() {
    if (confirm("경보가 해제되었나요?")) {
        var audio = document.getElementById('audio_play');
        if (audio.paused) {
            audio.play();
        } else {
            audio.pause();
            audio.currentTime = 0
        }
        document.getElementById("img").className = "blinking";
        var nomal = document.getElementsByName("nomal");
    for (var i = 0; nomal.length; i++) {
        //체크되어 있다면 park[i].checked == true
        //true -> false로 변환 ==> 체크해제
        if (nomal[i].checked) {
            nomal[i].checked = false;
        }
    }
    }
    else {
        document.getElementById("img").className = "blinking3";
    }
}

