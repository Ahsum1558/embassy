setInterval(function showDate(){
    var d = new Date();
    var hrs = d.getHours();
    var mnts = d.getMinutes();
    var sec = d.getSeconds();
    sec = sec > 9 ? sec : '0' + sec;
    mnts = mnts > 9 ? mnts : '0' + mnts;
    // hrs = hrs > 9 ? hrs : '0' + hrs;
    if (hrs > 12) {
        hrs -= 12;
        document.querySelector("#ourTime").innerHTML = hrs + ":" + mnts + ":" + sec + " PM";
    }else if (hrs == 12) {
        document.querySelector("#ourTime").innerHTML = hrs + ":" + mnts + ":" + sec + " PM";
    }else if (hrs == 0) {
        hrs = 12;
        document.querySelector("#ourTime").innerHTML = hrs + ":" + mnts + ":" + sec + " AM";
    }else{
        document.querySelector("#ourTime").innerHTML = hrs + ":" + mnts + ":" + sec + " AM";
    }
}, 1000);sec



// function startTime(){
//     const now = new Date();
//     let h = now.getHours();
//     let m = now.getMinutes();
//     let s = now.getSeconds();

//     s = s > 9 ? s : '0' + s;
//     m = m > 9 ? m : '0' + m;

//     const time = h + ':' + m + ':' + s;
//     document.querySelector("#ourTime").innerHTML = time;
//     setTimeout(startTime, 500);
// }
// startTime();

// function startTime(){
//     const now = new Date();
//     let h = now.getHours();
//     let m = now.getMinutes();
//     let s = now.getSeconds();

//     s = s > 9 ? s : '0' + s;
//     m = m > 9 ? m : '0' + m;

//     const time = h + ':' + m + ':' + s;
//     if (h > 12) {
//         h -= 12;
//         document.querySelector("#ourTime").innerHTML = time + " PM";
//     }else if (h == 12) {
//         document.querySelector("#ourTime").innerHTML = time + " PM";
//     }else if (h == 0) {
//         h = 12;
//         document.querySelector("#ourTime").innerHTML = time + " AM";
//     }else{
//         document.querySelector("#ourTime").innerHTML = time + " AM";
//     }
//     setTimeout(startTime, 500);
// }
// startTime();