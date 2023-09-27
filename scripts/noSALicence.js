var checkbox = document.getElementById("check")
checkbox.addEventListener("change", function()
 {
    if(this.checked)
    {
        var sc = document.getElementById("userCountry");
        sc.value = ""
    }
    else
    {
        var sc = document.getElementById("userCountry");
        sc.value = "SA"
    }
});