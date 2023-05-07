function togglePopup(){
    var blur=document.getElementById('blur');
    blur.classList.add('active');
    var popup=document.getElementById('popup');
    popup.classList.add('active');
}
function closePopUp(){
    var blur=document.getElementById('blur');
    blur.classList.remove('active');
    var popup=document.getElementById('popup');
    popup.classList.remove('active');
}