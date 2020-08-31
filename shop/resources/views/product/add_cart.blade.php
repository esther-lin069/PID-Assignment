<script>
$(function(){

    $(".btn_add_cart").click(function(){
        console.log($(this).data("id")+"="+$("input[name=amount]").val());

        if($.cookie('cart') === undefined){
            $.cookie('cart', [$(this).data("id"), $("input[name=amount]").val()]);
            
        }
        else{
            $.cookie('cart', [$(this).data("id"), $("input[name=amount]").val()]);
        }
    })
})


</script>
