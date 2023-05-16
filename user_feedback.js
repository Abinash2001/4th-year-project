function togglePopup(index){
    var blur=document.getElementById('blur');
    blur.classList.add('active');
    var pop="popup"+index;
    var popup=document.getElementById(pop);
    popup.classList.add('active');
}
function closePopUp(index){
    var blur=document.getElementById('blur');
    blur.classList.remove('active');
    var pop="popup"+index;
    var popup=document.getElementById(pop);
    popup.classList.remove('active');
}