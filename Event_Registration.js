var i=1;
function addCode(Eligibility_criteria) {
    document.getElementById("Eligibility_criteria").innerHTML+='<div class="criteriaa" id="criteria'+(++i)+'"><h4>Criteria '+(i)+'</h4><input class="criteria" type="text"></div>';

}
function removeCode() {
    var parent=document.getElementById("Eligibility_criteria");
    var cre= 'criteria'+i;
    i--;
    var child=document.getElementById(cre);
    console.log(child);
    parent.removeChild(child);
    console.log(cre);
}

var j=1;
function add() {
    document.getElementById("option_details").innerHTML+='<div id="option'+(++j)+'"><h4 class="optionheading" class="option">Option '+j+'</h4><div class="option"><h4>Option Name</h4><input class="textbox" type="text"></div><div class="option"><h4>Option details</h4><input class="textbox" type="text"></div></div>';

}
function remove() {
    var parent=document.getElementById("option_details");
    var opt= 'option'+j;
    j--;
    var child=document.getElementById(opt);
    console.log(child);
    parent.removeChild(child);
    console.log(opt);
}