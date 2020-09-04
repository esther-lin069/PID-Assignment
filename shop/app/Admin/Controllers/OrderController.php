<?php

namespace App\Admin\Controllers;

use App\Order;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Layout\Content; //要自訂content的話要加這行啦！！

class OrderController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '訂單';

    

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Order());

        $grid->column('id', __('Id'));
        $grid->column('user_id', __('User id'));
        $grid->column('address', __('Address'));
        $grid->column('total', __('Total'));
        $grid->column('closed', __('Closed'))->display(function($value, $column){
            if($value == 1){
                return '已完成';
            }

            return '待處理';
        });
        $grid->column('created_at', __('Created at'))->sortable();
        $grid->column('updated_at', __('Updated at'))->sortable();

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Order::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('user_id', __('User id'));
        $show->field('address', __('Address'));
        $show->field('total', __('Total'));
        $show->field('closed', __('Closed'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Order());

        $form->text('user_id', __('User id'));
        $form->textarea('address', __('Address'));
        $form->number('total', __('Total'));
        $form->radio('closed', __('Closed'))->options([
            0 => '處理中',
            1 => '已完成',
        ]);

        return $form;
    }

    public function index(Content $content){
        return $content
            ->header('訂單管理')
            ->description('管理商店訂單')
            ->body($this->grid());
    }

    
}
