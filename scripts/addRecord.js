function init()
{
    var d = new Date();
    //add 0 at the first postion if the day < 9
    var day = ("0" + d.getDate()).slice(-2);
    ////add 0 at the first postion if the month < 9
    var month = ("0" + (d.getMonth() + 1)).slice(-2);
    var today = d.getFullYear() + "-" + (month) + "-" + (day);    
    document.getElementById('currentdate').value = today;    
}