function renamePopUp(num) {
    var inputName = prompt("Nouveau nom:", "");
    if (inputName.length !== 0 && typeof num !== 'undefined')
    {
        window.location.href = "./?project="+num+"&option=renameProj&newName="+inputName;
    }
}