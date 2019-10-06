<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Legancy
{

    /**
     * assign value
     */
    protected $assign_value=array();

    /**
     * @var array
     * assign particular value from controllers
     */


    /**
     * collecting data
     */
     protected $data=array();

     /**
      * @var array
      * collecting data     
      */

      protected $item_name;



      public function __construct()
      {
  
          // Get the CodeIgniter reference
  
          $this->_CI = &get_instance();
  
      }

    public function design($assign_value=null,$item_name)
    {

      

        if(!empty($assign_value))
        {
           
         
        $this->item_name=$item_name;

        $this->data['legancy']['add']=$this->add();

        $this->data['legancy']['active']=$this-> active();

        $this->data['legancy']['actions']=$this->Actions();

        $this->data['legancy']['block']=$this->Block();

        $this->data['legancy']['pending']=$this->pending();

        $this->data['legancy']['notactive']=$this->notactive();

        $this->data['legancy']['approved']=$this->Approved();

        $this->data['legancy']['picked']=$this-> Picked();

        $this->data['legancy']['confirmed']=$this-> Confirmed();

        $this->data['legancy']['dispatched']=$this->Dispatched();

        $this->data['legancy']['ordered']=$this-> Ordered();

        $this->data['legancy']['cancelled']=$this->Cancelled();

        $this->data['legancy']['packed']=$this-> Packed();

        $this->data['legancy']['delivered']=$this->Delivered();

        $this->data['legancy']['returned']=$this->Returned();

        $this->data['legancy']['replaced']=$this->Replaced();

        $this->data['legancy']['assigned']=$this->Assigned();
        
        $this->data['legancy']['orderlist']=$this->Orderlist();

        $this->data['legancy']['view']=$this->view();

        $this->data['legancy']['C Currency']=$this->C_Currency();

        $this->data['legancy']['A-comm']=$this->A_comm();

        $this->data['legancy']['P']=$this->P();
        $this->data['legancy']['S']=$this->S();
        $this->data['legancy']['T']=$this->T();
        $this->data['legancy']['F']=$this->F();
        $this->data['legancy']['R']=$this->R();
        $this->data['legancy']['accountrule']=$this->accountrule();



        


        $this->data['assign_value']=$assign_value;

    

        return $this->_CI->load->view('template/library',$this->data,true);

        }
        else
        {
           return false;
        }
       
    


    }
  

    public function add()
    {
    return "<li> <span class='label label-sm btn blue-hoki'>Add + </span>&nbsp&nbsp Indicate Add new $this->item_name </li><br>";
    }

    public function active ()
    {
      return "<li> <span class='label label-sm btn green-jungle'> Active </span>&nbsp&nbsp Indicate $this->item_name Item is Active </li><br>";
    }

    public function  Actions ()
    {
   return "<li> <span class='label label-sm label-danger'> Actions </span>&nbsp&nbsp Indicate Edit and Delete $this->item_name </li><br>";
    }

    public function  Block ()
    {
   return "<li><span class='label label-sm btn purple-soft'>Block </span>&nbsp&nbsp Indicate $this->item_name Item is Block </li><br>";
    }

    public function pending()
    {
    return "<li> <span class='label label-sm label-info'> Pending </span>&nbsp;&nbsp; Indicate for account is pending </li><br>";
    }

    public function notactive()
    {
    return " <li> <span class='label label-sm label-warning'> Not Active </span>&nbsp;&nbsp; Indicate for account is Not Active </li><br>";
    }

    public function Approved()
    {
    return " <li> <span class='label label-sm label-success'> Approved </span>&nbsp;&nbsp; Indicate for account is approved </li> <br>";
    }
    public function Picked()
    {
    return "<li> <span class='label label-sm label-info'> Picked </span>&nbsp&nbsp Indicate $this->item_name is Picked </li><br>";
    }

    public function Confirmed()
    {
    return " <li> <span class='label label-sm label-success'> Confirmed </span>&nbsp&nbsp Indicates $this->item_name is Confirmed </li> <br>";
    }

    public function Dispatched()
    {
    return "<li> <span class='label label-sm label-warning'> Dispatched </span>&nbsp&nbsp Indicates $this->item_name is Dispatched </li><br>";
    }
    public function  Ordered ()
    {
    return"<li> <span class='label label-sm label-default'>Ordered </span>&nbsp&nbsp Indicates $this->item_name  is Ordered </li><br>";
        
    }

    public function   Cancelled()
    {
   return "  <li> <span class='label label-sm label-danger'> Cancelled </span>&nbsp&nbsp Indicates $this->item_name is Cancelled  </li><br>";   
    }

    public function Packed()
    {
    return " <li> <span class='label label-sm label-primary'> Packed </span>&nbsp&nbsp Indicates $this->item_name product is Packed </li><br>";
    }

    public function Delivered()
    {
    return "<li> <span class='label label-sm btn purple'> Delivered </span>&nbsp&nbsp Indicates $this->item_name is Deliverd </li> <br>";
    }
    public function  Returned()
    {
        return"  <li> <span class='label label-sm btn dark'> Returned </span>&nbsp&nbsp Indicates $this->item_name is Returned </li><br>" ;
    }
     public function Replaced()
     {
         return " <li> <span class='label label-sm btn grey'>Replaced </span>&nbsp&nbsp Indicates $this->item_name  is Replaced </li><br>";
     }
     public function Assigned()
     {
         return"<li> <span class='label label-sm btn blue'> Assigned </span>&nbsp&nbsp Indicates $this->item_name is Assigned  <br> <br></li>";
     
    }
    public function Orderlist()
    {
        return"<li><span class='btn blue-madison dropdown-toggle'> Ordered List </span>&nbsp&nbsp Indicates list of $this->item_name <br> </li>";
    
   }
   public function view()
   {
       return"<li> <i class='icon-eye'></i>&nbsp&nbsp Indicates to View $this->item_name</li> <br>";
   
   }
   public function C_Currency()
   {
       return"<li><b> C Currency&nbsp:-</b> &nbsp&nbsp Indicates to Customer Currency</li><br> ";
   }

   public function A_comm()
   {
       return"<li><b> A-comm&nbsp&nbsp:-</b> &nbsp&nbsp Indicates to Admin Commission </li><br> ";
   }
   public function P()
   {
       return"<li><b> P&nbsp&nbsp:-</b> &nbsp&nbsp Indicates Facebook Share </li><br> ";
   }
   public function S()
   {
       return"<li><b> S&nbsp&nbsp:-</b> &nbsp&nbsp Indicates Point Sale </li><br> ";
   }
   public function T()
   {
       return"<li><b> T&nbsp&nbsp:-</b> &nbsp&nbsp Indicates Transfer To a customer </li><br> ";
   }
   public function F()
   {
       return"<li><b> F&nbsp&nbsp:-</b> &nbsp&nbsp Indicates Transfer From a customer </li><br> ";
   }
   public function R()
   {
       return"<li><b> R&nbsp&nbsp:-</b> &nbsp&nbsp Indicates Redeem </li><br> ";
   }
   public function accountrule()
   {
       return"<li><b> Personal Account Rule :-</b> &nbsp&nbsp Debit the Receiver, Credit the Giver </li><br> ";
   }

}
