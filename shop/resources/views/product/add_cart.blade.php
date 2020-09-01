<script>
$(function(){

    $(".btn_add_cart").click(function(){
        console.log($(this).data("id")+"="+$("input[name=amount]").val());
        $id = $(this).data("id");
        $amount = $("input[name=amount]").val();
        
        axios.post('/cart/store',{
            product_id: $id,
            amount: $amount,
        }).then(function(){
            swal('加入購物車成功', '','success');
        }).catch(function(error){
            @guest
                swal('請先登入');
            @endguest

            @auth
                swal('系統錯誤', '', 'error');
            @endauth
        })

        
    })
})


</script>
