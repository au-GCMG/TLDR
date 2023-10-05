function init()
{
    var d = new Date();
    //add 0 at the first postion if the day < 9
    var day = ("0" + d.getDate()).slice(-2);
    ////add 0 at the first postion if the month < 9
    //getMonth return the index, then must be +1
    var month = ("0" + (d.getMonth() + 1)).slice(-2);
    //Assemble, format yyyy-MM-dd
    var today = d.getFullYear() + "-" + (month) + "-" + (day);    
    document.getElementById('currentdate').value = today;    
}

function getStartTime()
{
    var d = new Date();
    var ss = ("0" + d.getSeconds()).slice(-2);
    var mm = ("0" + d.getMinutes()).slice(-2);
    var hh = ("0" + d.getHours()).slice(-2);
    //Assemble, format hh:mm:ss
    var time = hh + ":" + mm + ":00";
    document.getElementById('starttime').value = time;
}

function getEndTime()
{
    var d = new Date();
    var ss = ("0" + d.getSeconds()).slice(-2);
    var mm = ("0" + d.getMinutes()).slice(-2);
    var hh = ("0" + d.getHours()).slice(-2);
    //Assemble, format hh:mm:ss
    var time = hh + ":" + mm + ":00";
    document.getElementById('finishtime').value = time;
}