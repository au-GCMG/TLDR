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
