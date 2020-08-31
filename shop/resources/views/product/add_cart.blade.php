$(document).ready(function () {
    console.log("hi");
    $("#btn_add_cart").click(function(){
        console.log($(this).data('id')+"="+$("input[name=amount]").val());
    })
});