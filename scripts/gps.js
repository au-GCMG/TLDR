function gps()
{
    //a random number which sets of data used
    var number = parseInt(Math.random()*5,10) + 1;
    alert("GPS recording...." + number);
    document.getElementById("gpsnumber").value = number;
    var startLocation, finishlocation
    switch (number) {
        case 1:
            startLocation = "Blackwood";
            finishlocation = "Brighton";
            break;
        case 2:
            startLocation = "Tonsly";
            finishlocation = "Unley";
            break;
        case 3:
            startLocation = "Burnside";
            finishlocation = "Richmond";
            break;
        case 4:
            startLocation = "North Adelaide";
            finishlocation = "Prospect";
            break;
        case 5:           
            startLocation = "Glenelg";
            finishlocation = "West Lakes";
            break;
        default:
            break;
    }
    //setup startloacation and finishlocation
    document.getElementById('locationstart').value = startLocation;
    document.getElementById('locationfinish').value = finishlocation;
}

function clear()
{
    document.getElementById("gpsnumber").value = 0;
}