<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SalesReport extends MY_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model('users_model', 'User');
        $this->load->model('roles_model', 'Role');
        
        $this->load->model('transactions_model', 'Transaction');
    }
    
    public function index(){
        $data = array();
        $data['role'] = $this->logged_out_check();
        $data['title']='Sales Report';
        $data['page_description']="View Sales Statistics";
        $data['treeActive'] = 'epayment';
        $data['childActive'] = 'sales_report' ;

        $data['breadcrumbs']=array
        (
                array('Sales report','SalesReport')
        );

        $this->load->view("template/header", $data);
        $this->load->view("epayment/sales_report", $data);
        $this->load->view("template/footer", $data);
    }
    
    public function showSales(){	
        $logs = $this->Transaction->show_Logs();
        $sales=array();
        $data="";
        $sales[0]['head']="<th style='background:#339440;color:white;text-align:center'>Buy Card</th>";
        $sales[0]['count']=0;
        $sales[0]['amount']=0;
        $sales[1]['head']="<th style='background:#339440;color:white;text-align:center'>Load Card</th>";
        $sales[1]['count']=0;
        $sales[1]['amount']=0;
        $sales[2]['head']="<th style='background:#339440;color:white;text-align:center'>Single Journey</th>";
        $sales[2]['count']=0;
        $sales[2]['amount']=0;
        $Total['head']="<th style='background:#339440;color:white;text-align:center'>Total</th>";
        $Total['count']=0;
        $Total['amount']=0;
        foreach ($logs as $rows) {
            if($rows['transType']=="BC"){
                $sales[0]['count']+=1;
                $sales[0]['amount']+=$rows['transAmount'];
                $Total['count']+=1;
                $Total['amount']+=$rows['transAmount'];
            }
            if($rows['transType']=="LC"){
                $sales[1]['count']+=1;
                $sales[1]['amount']+=$rows['transAmount'];
                $Total['count']+=1;
                $Total['amount']+=$rows['transAmount'];
            }
            if($rows['transType']=="SJ"){
                $sales[2]['count']+=1;
                $sales[2]['amount']+=$rows['transAmount'];
                $Total['count']+=1;
                $Total['amount']+=$rows['transAmount'];
            }
        }
        
        foreach ($sales as $rows){
            $data .="<tr>". 
                    $rows['head'].
                "<td>".$rows['count']."</td>".
                "<td>Php ".$rows['amount']."</td>".
                    "</tr>";
                
        }
        
         $data .="<tr>". 
                $Total['head'].
            "<td style='font-weight:bolder'>".$Total['count']."</td>".
            "<td style='font-weight:bolder'>Php ".$Total['amount']."</td>".
                "</tr>";
        
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }
       
}
