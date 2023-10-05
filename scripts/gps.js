function gps()
{
    //a random number which sets of data used
    var number = parseInt(Math.random()*5,10) + 1;
    alert("GPS recording...." + number);

    var startLocation, finishlocation
    switch (number) {
        case 1:
            startLocation = "";
            finishlocation = "";
            break;
        case 2:
            startLocation = "";
            finishlocation = "";
            break;
        case 3:
            startLocation = "";
            finishlocation = "";
            break;
        case 4:
            startLocation = "";
            finishlocation = "";
            break;
        case 5:           
            startLocation = "";
            finishlocation = "";
            break;
        default:
            break;
    }
    //setup startloacation and finishlocation
    document.getElementById('locationstart').innerText = startLocation;
    document.getElementById('locationfinish').innerText = startLocation;

    //check folder, NO-create: the name of folder is student licence.

    //check the file, NO-create; Yes-open: the name of file is yyyyMMddHHmm00.txt

    //write the data into the file

    //close the file

}



//assume 5 data resources