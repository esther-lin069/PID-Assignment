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
            @auth
            if (error.response.status === 422) {
                var errors = JSON.stringify(error.response.data.errors);
                errors = JSON.parse(errors);
                var error = '';
                for(let x in errors){
                    error = errors[x];
                }
                console.log(error);

                swal(String(error), '', 'error');
            } 
            else if(error.response.status === 500) {
                swal('系統錯誤', '', 'error');
            }
            @endauth

            @guest
                swal('請先登入');
            @endguest

            
        })

        
    })
})


</script>
