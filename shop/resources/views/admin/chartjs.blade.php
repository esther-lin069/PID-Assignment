<div>    
    <div class="chart-container">
        <canvas id="myChart"></canvas>
    </div>
    <table id="p" style="display: none">
        @foreach ($order_details as $o)
        <tr>
            <td class="pid">
                {{$o->product->title}}
            </td>
            <td class="psum">
                {{$o->sum}}
            </td>
        </tr>
        @endforeach
        
    </table>
</div>



<script>
$(function () {

    var pid = $(".pid");
    var psum = $(".psum");
    var label_list = [];
    var data_list = [];

    $(pid).each(function(){
        label_list.push($(this).text().trim());
    })
    $(psum).each(function(){
        data_list.push(parseInt($(this).text().trim()));
    })

    var ctx = document.getElementById("myChart").getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: label_list,
            datasets: [
            {
                label: '銷量',
                data: data_list,
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255,99,132,1)',
                borderWidth: 1
            }
            ]
        },
        options: {
            maintainAspectRatio: false,
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero:true
                    }
                }]
            },
            title: {
            display: true,
            text: '商品銷量總表'
            }
        }
    });


    
});
</script>

<style>
    .chart-container{
    //position: relative;
    margin: auto;
    height: 80vh;
    width: 60vw;
    margin-bottom: 10vh;
}

</style>