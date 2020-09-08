<canvas id="myChart" width="200" height="200"></canvas>
<table id="p">
    @foreach ($order_details as $o)
    <tr>
        <td class="pid">
            {{$o->product_id}}
        </td>
        <td class="psum">
            {{$o->sum}}
        </td>
    </tr>
    @endforeach
    
</table>
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
                label: 'sum',
                data: data_list,
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255,99,132,1)',
                borderWidth: 1
            }
            ]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero:true
                    }
                }]
            }
        }
    });


    
});
</script>