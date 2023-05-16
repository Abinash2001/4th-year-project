
$(document).ready(function(){
    var i=2;
    $('#add').click(function(){
    i++;
    $('#option_details').append('<div id="option'+(++j)+'"><div class="option"><h4>Option '+j+'</h4><input class="textbox" name="option_name[]" type="text"></div></div>');
    });
        
    $(document).on('click', '#remove', function(){
        if(j==1){
            alert("You have to add atleast 2 Option !!");
        }
        else{
            var button_id = $(this).attr("id"); 
            $('#row'+button_id+'').remove();
        }
    });
    });



// var j=2;
// function add() {
//     document.getElementById("option_details").innerHTML+='<div id="option'+(++j)+'"><div class="option"><h4>Option '+j+'</h4><input class="textbox" name="option_name[]" type="text"></div></div>';

// }
// function remove() {
//     if(j==1){
//         alert("You have to add atleast 2 Option !!");
//     }
//     else{
//         var parent=document.getElementById("option_details");
//         var opt= 'option'+j;
//         j--;
//         var child=document.getElementById(opt);
//         console.log(child);
//         parent.removeChild(child);
//         console.log(opt);
//     }
// }