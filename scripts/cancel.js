
function init()
{
    const cancelButton = document.getElementById("submitCancel");
    cancelButton.addEventListener("click", cancel);    
}

function cancel(Event)
{
    if(confirm("This page will be closed.\nAll information will be lost!"))
    {
        window.history.go(-1);
    }
}



init()
