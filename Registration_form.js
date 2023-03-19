function address_function(){
    // let result=document.querySelector('.perma_house').value;
    
    if(chk.checked==true)
    {
        document.querySelector(".curr_house").value=document.querySelector(".perma_house").value;
        document.querySelector(".curr_area").value=document.querySelector(".perma_area").value;
        document.querySelector(".curr_city").value=document.querySelector(".perma_city").value;
        document.querySelector(".curr_district").value=document.querySelector(".perma_district").value;
        document.querySelector(".curr_po").value=document.querySelector(".perma_po").value;
        document.querySelector(".curr_ps").value=document.querySelector(".perma_ps").value;
        document.querySelector(".curr_pin").value=document.querySelector(".perma_pin").value;
        document.querySelector(".curr_country").value=document.querySelector(".perma_country").value;
    }
    else{
        document.querySelector(".curr_house").value='';
        document.querySelector(".curr_area").value='';
        document.querySelector(".curr_city").value='';
        document.querySelector(".curr_district").value=
        document.querySelector(".curr_po").value='';
        document.querySelector(".curr_ps").value='';
        document.querySelector(".curr_pin").value='';
        document.querySelector(".curr_country").value='';
    }
}