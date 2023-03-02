//--------------------------------------
// creating  a reponsive navbar componet
//--------------------------------------
const mobile_nav=document.querySelector('.mobile_navbar_btn');
const headerElement=document.querySelector('.header');
mobile_nav.addEventListener('click',()=>{
    headerElement.classList.toggle('active');
});
// edit
const navClick=document.querySelector('.navbar');
navClick.addEventListener('click',()=>{
    headerElement.classList.toggle('active');
});