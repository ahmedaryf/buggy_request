
const allcheckboxs = document.getElementById('selectAllBoxes');
const checkboxes = document.querySelector('.checkboxes');

function check(){
    allcheckboxs.click(function(event) {
        
            checkboxes.checked = true;
    })
}


// $(document).ready(function() {
//     $('#selectAllBoxes').click(function(event){
//         if (this.checked) {
//             $('.checkboxes').each(function(){
//                 this.checked = true;
//             });
//         }else{
//             $('.checkboxes').each(function(){
//                 this.checked = false;
//             });
//         }
//     });

// });