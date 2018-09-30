var elErrMsg = document.getElementById('errMsg');
var check = {};
check['input-name'] = function(id) {
    var field = document.getElementById(id);
    if(field.value.length >= 5) {
        elErrMsg.style.display = 'none';
        field.style.border = '1px solid #13f80b';
        return true;
    } else {
        field.style.border = '1px solid #ff0000';
        elErrMsg.textContent = 'Un nom de famille ne peut pas faire moins de 5 caractères';
        elErrMsg.style.display = 'block';
        return false; 
    } 
};
check['input-email'] = function(id) {
    var field = document.getElementById(id);
    var regex = /^[a-zA-Z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$/;
    if(field.value.length >= 8 && regex.test(field.value)) {
        elErrMsg.style.display = 'none';
        field.style.border = '1px solid #13f80b';
        return true;
    } else {
        field.style.border = '1px solid #ff0000';
        elErrMsg.textContent = "Ce doit etre une adresse courriel valide";
        elErrMsg.style.display = 'block';
        return false; 
    } 
};
check['input-subject'] = function(id) {
    var field = document.getElementById(id);
    if(field.value.length >= 2) {
        elErrMsg.style.display = 'none';
        field.style.border = '1px solid #13f80b';
        return true;
    } else {
        field.style.border = '1px solid #ff0000';
        elErrMsg.textContent = "L'objet du message doit être composé d'au moins deux caractères";
        elErrMsg.style.display = 'block';
        return false; 
    } 
};
check['input-message'] = function(id) {
    var field = document.getElementById(id);
    if(field.value.length >= 10) {
        elErrMsg.style.display = 'none';
        field.style.border = '1px solid #13f80b';
        return true;
    } else {
        field.style.border = '1px solid #ff0000';
        elErrMsg.textContent = "Le message doit être composé d'au moins dix caractères";
        elErrMsg.style.display = 'block';
        return false; 
    } 
};
(function(){
    var myForm = document.getElementById('contact-form');
    var inputs = document.querySelectorAll('.contact input[type=text], .contact textarea, .contact input[type=email]');
   
    for(var i=0; i<inputs.length; i++) {
        inputs[i].addEventListener('keyup', function(e){
            check[e.target.id](e.target.id);
        });
    }
    myForm.addEventListener('submit', function(e){
        var result = true;
        for(var i in check) {
            result = check[i](i) && result;
        }
        if(result) {
            var elErrMsg = document.getElementById('errMsg');
            elErrMsg.textContent = 'Votre message a été envoyé';
            elErrMsg.style.color = '#5cadd3';
            elErrMsg.style.borderColor = '#00ff00';
            elErrMsg.style.backgroundColor = '#bfffbf';
            elErrMsg.style.display = 'block';
        }
        e.preventDefault();
    });
})();

desactivateErrMsg();

function desactivateErrMsg() {
    var elErrMsg = document.getElementById('errMsg');
    elErrMsg.style.display = 'none';
}