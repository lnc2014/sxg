<?php
/**
 * Description：发票控制器
 * Author: LNC
 * Date: 2016/5/4
 * Time: 23:53
 */
include_once 'BaseController.php';

class Invoice extends BaseController{

    /**
     * 通过个人的UserID找到个人的发票
     */
    public function user_invoice(){

        $user_id = $this->uri->segment(4);//使用ci自带方法拿到user_id

        if(empty($user_id)){
            $this->load->view('errors/error',array('code'=>500,'msg'=>'用户ID不能为空'));
        }else{
            $this->load->model('admin/sxg_invoice');

            $invoices = $this->sxg_invoice->findInvoicesByUserId($user_id);

            $this->load->view('admin/user_invoice',array(
                'invoices' => $invoices
            ));
        }


    }

}