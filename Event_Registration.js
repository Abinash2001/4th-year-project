
// function dynamicdropdown(listindex)
// {
// switch (listindex)
// {
// case "pm" :
//     document.getElementById("location").options[0]=new Option("Select location","");
//     document.getElementById("location").options[1]=new Option("INDIA","INDIA");
//     document.getElementById("location").remove(30);
//     document.getElementById("location").remove(29);
//     document.getElementById("location").remove(28);
//     document.getElementById("location").remove(27);
//     document.getElementById("location").remove(26);
//     document.getElementById("location").remove(25);
//     document.getElementById("location").remove(24);
//     document.getElementById("location").remove(23);
//     document.getElementById("location").remove(22);
//     document.getElementById("location").remove(21);
//     document.getElementById("location").remove(20);
//     document.getElementById("location").remove(19);
//     document.getElementById("location").remove(18);
//     document.getElementById("location").remove(17);
//     document.getElementById("location").remove(16);
//     document.getElementById("location").remove(15);
//     document.getElementById("location").remove(14);
//     document.getElementById("location").remove(13);
//     document.getElementById("location").remove(12);
//     document.getElementById("location").remove(11);
//     document.getElementById("location").remove(10);
//     document.getElementById("location").remove(9);
//     document.getElementById("location").remove(8);
//     document.getElementById("location").remove(7);
//     document.getElementById("location").remove(6);
//     document.getElementById("location").remove(5);
//     document.getElementById("location").remove(4);
//     document.getElementById("location").remove(3);
//     document.getElementById("location").remove(2);
//    // document.getElementById("location").options[2]=new Option("DELIVERED","delivered");
//     break;
// case "cm" :
//     document.getElementById("location").options[0]=new Option("Select location","");
//     document.getElementById("location").options[1]=new Option("Andhra Pradesh","AP");
//     document.getElementById("location").options[2]=new Option("Arunachal Pradesh","AR");
//     document.getElementById("location").options[3]=new Option("Bihar","BR");
//     document.getElementById("location").options[4]=new Option("Chhattisgarh","CG");
//     document.getElementById("location").options[5]=new Option("Goa","GA");
//     document.getElementById("location").options[6]=new Option("Gujarat","GJ");
//     document.getElementById("location").options[7]=new Option("Haryana","HR");
//     document.getElementById("location").options[8]=new Option("Himachal Pradesh","HP");
//     document.getElementById("location").options[9]=new Option("Jammu and Kashmir","JK");
//     document.getElementById("location").options[10]=new Option("Jharkhand","JH");
//     document.getElementById("location").options[11]=new Option("Karnataka","KA");
//     document.getElementById("location").options[12]=new Option("Kerala","KL");
//     document.getElementById("location").options[13]=new Option("Madhya Pradesh","MP");
//     document.getElementById("location").options[14]=new Option("Maharashtra","MH");
//     document.getElementById("location").options[15]=new Option("Manipur","MN");
//     document.getElementById("location").options[16]=new Option("Meghalaya","ML");
//     document.getElementById("location").options[17]=new Option("Mizoram","MZ");
//     document.getElementById("location").options[18]=new Option("Nagaland","NL");
//     document.getElementById("location").options[19]=new Option("Punjab","PB");
//     document.getElementById("location").options[20]=new Option("Rajasthan","RJ");
//     document.getElementById("location").options[21]=new Option("Sikkim","SK");
//     document.getElementById("location").options[22]=new Option("Tamil Nadu","TN");
//     document.getElementById("location").options[23]=new Option("Tripura","TR");
//     document.getElementById("location").options[24]=new Option("Andaman and Nicobar Islands","AN");
//     document.getElementById("location").options[25]=new Option("Chandigarh","CH");
//     document.getElementById("location").options[26]=new Option("Dadra and Nagar Haveli","DH");
//     document.getElementById("location").options[27]=new Option("Daman and Diu","DD");
//     document.getElementById("location").options[28]=new Option("Delhi","DL");
//     document.getElementById("location").options[29]=new Option("Lakshadweep","LD");
//     document.getElementById("location").options[30]=new Option("Pondicherry","PY");

//     break;
// }
// return true;
// }




var i=1;
function addCode(Eligibility_criteria) {
    document.getElementById("Eligibility_criteria").innerHTML+='<div class="criteriaa" id="criteria'+(++i)+'"><h4>Criteria '+(i)+'</h4><input class="criteria" type="text"></div>';

}
function removeCode() {
    if(i==1){
        alert("You have to add atleast 1 Criteria !!");
    }
    else{
        var parent=document.getElementById("Eligibility_criteria");
        var cre= 'criteria'+i;
        i--;
        var child=document.getElementById(cre);
        console.log(child);
        parent.removeChild(child);
        console.log(cre);
    }
}

var j=2;
function add() {
    document.getElementById("option_details").innerHTML+='<div id="option'+(++j)+'"><div class="option"><h4>Option '+j+'</h4><input class="textbox" name="option_name[]" type="text"></div></div>';

}
function remove() {
    if(j==1){
        alert("You have to add atleast 2 Option !!");
    }
    else{
        var parent=document.getElementById("option_details");
        var opt= 'option'+j;
        j--;
        var child=document.getElementById(opt);
        console.log(child);
        parent.removeChild(child);
        console.log(opt);
    }
}