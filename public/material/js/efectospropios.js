var change = 0;
function FormEspe(){
    var container= document.querySelector('#tableEspe');
    var newform= document.querySelector('#newform');

    container.classList.toggle('hide');
    newform.classList.toggle('show');
    if (change==0) {
        document.getElementById("addEspe").innerHTML = "Mostrar Especialidades";
        change=1;
    }else{
        document.getElementById("addEspe").innerHTML = "Añadir Especialidad";
        change=0;
    }
    // var contpass= document.querySelector('.forgot');
    // contpass.classList.toggle('active');
}