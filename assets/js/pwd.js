var check = function(){
    if (document.getElementById('passwordR').value == document.getElementById('passwordR2').value) {
        document.getElementById('msg').innerHTML = "*Contraseñas coinciden";
        document.getElementById('msg').style.display = "block";
        document.getElementById('msg').style.color = "green";
    }
    else{
        document.getElementById('msg').innerHTML = "*Contraseñas no coinciden";
        document.getElementById('msg').style.display = "block";
        document.getElementById('msg').style.color = "red";
    }

}