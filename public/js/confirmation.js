$(document).ready(function (){
    $("#btn_delete_real").hide();
    $('#btn_delete').click(function (){
        $.confirm({
        title: "Ar tikrai norite pašalinti planą?",
        buttons: {
            taip: function (){
                $("#btn_delete_real").show();
                $("#btn_delete").hide();
                },
            ne: function () {
                $.alert('Atšaukta!');
            }
            }
        });
    });
})

