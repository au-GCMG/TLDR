function passwordValidate()
{
    var password = document.getElementById("passwordT").value;
    var repassword = document.getElementById("repasswordT").value;
    
    
    if(password !== repassword)
    {
        
        alert("The password not match!");
        document.getElementById("repasswordT").value = "";        
        document.getElementById("repasswordT").focus();
    }
}

function changeDaytime()
{
    self.location = "MyLogbookN.php";
}
function changeNighttime()
{    
    self.location = "MyLogbookD.php";
}

function setNightMenuActive()
{    
    const menu = document.querySelectorAll("#menu a");
    menu[1].classList.add("selected");    
}

setNightMenuActive();