<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Encore\Admin\Layout\Content;
use App\OrderDetail;
use Illuminate\Http\Request;
use Encore\Admin\Widgets\Box;

class ChartController extends Controller
{
    
    public function index(Content $content)
    {

        $order_details = OrderDetail::groupBy('product_id')->selectRaw('product_id,sum(amount) as sum')->get();
        //dd($order_details);
        return $content
            ->header('Chartjs')
            ->body(new Box('Bar chart', view('admin.chartjs',compact('order_details'))));
    }
    


}
