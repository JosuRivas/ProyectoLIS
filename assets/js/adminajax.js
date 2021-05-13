var frm = $("#frm-menu");
    frm.submit(function(e) {

    e.preventDefault(); 

    var form = $(this);
    var url = form.attr('action');
    
    $.ajax({
           type: "POST",
           url: url,
           data: form.serialize(),
           success: function(data)
           {
               form.trigger("reset");
               alert("Sentencia realizada satisfactoriamente");
           }
         });    
});
var bt = $("#bt-buscar");
    bt.click(function(e) {

    e.preventDefault(); 

    var form = $(this);
    var url = form.attr('action');
    
    $.ajax({
           type: "POST",
           url: url,
           data:{
            estado:'posted'
           },
           success: function(data)
           {
               form.trigger("reset");
                $("body").html(data);
           }
         });    
});
document.getElementById("cboxh").addEventListener("click",function(){
    if (document.getElementById("cboxh").checked == true) {
        document.getElementById("Nhora").readOnly = false
    } else {
        document.getElementById("Nhora").readOnly = true;
    }
});
document.getElementById("cbox-fecha").addEventListener("click",function(){
    if (document.getElementById("cbox-fecha").checked == true) {
        document.getElementById("Nfecha").readOnly = false; 
    }
    else{
        document.getElementById("Nfecha").readOnly = true;
    }
});


