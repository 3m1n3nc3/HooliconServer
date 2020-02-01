<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Datatables extends MY_Controller {
    public function index()
    {
        // $this->load->view('datatable');
    }

    public function list_admin_products()
    {
        $draw = intval($this->input->post("draw"));
        $start = intval($this->input->post("start"));
        $length = intval($this->input->post("length"));
        $order = $this->input->post("order");
        $search= $this->input->post("search");
        $search = $search['value'];
        $col = 0;
        $dir = "";
        if(!empty($order))
        {
            foreach($order as $o)
            {
                $col = $o['column'];
                $dir= $o['dir'];
            }
        }

        if($dir != "asc" && $dir != "desc")
        {
            $dir = "desc";
        }

        $valid_columns = array(
            0=>'site_name', 
            2=>'phone', 
            3=>'purchase_code',
            5=>'expiry'
        );

        if(!isset($valid_columns[$col]))
        {
            $order = null;
        }
        else
        {
            $order = $valid_columns[$col];
        }

        if($order !=null)
        {
            $this->db->order_by($order, $dir);
        }
        
        if(!empty($search))
        {
            $x=0;
            foreach($valid_columns as $sterm)
            {
                if($x==0)
                {
                    $this->db->like($sterm,$search);
                }
                else
                {
                    $this->db->or_like($sterm,$search);
                }
                $x++;
            }                 
        }

        $this->db->limit($length,$start);
        $products = $this->db->get("school");
        $data = array();
        foreach($products->result() as $rows)
        {

            $data[]= array(
                '<a href="'.site_url('admin/admin/product/'.$rows->id).'">'.$rows->site_name.'</a>',
                $rows->product ? $this->product_model->get($rows->product)['title'] : '',
                $rows->phone, 
                $rows->purchase_code,
                $rows->default_password ? $rows->default_password : 'Not available', 
                $rows->expiry,
                '<a href="'.site_url('admin/admin/product/'.$rows->id.'/update').'" class="btn btn-sm btn-warning mr-1">Edit</a>
                 <a href=""javascript:void(0)"" class="btn btn-sm btn-danger mr-1" onclick="deleteItem({type: \'product\', id: '.$rows->id.', init: \'dt\'})">Delete</a>
                '.($rows->installed ? '<a class="btn btn-sm btn-info disabled mr-1">Installed</a>' : '<a href="'.site_url('admin/operation/install/'.$rows->username).'" class="btn btn-sm btn-success mr-1">Install</a>'),
                20 => 'tr_'.$rows->id

            );     
        }
        $total_products = $this->totalProducts();
        $output = array(
            "draw" => $draw,
            "recordsTotal" => $total_products,
            "recordsFiltered" => $total_products,
            "data" => $data
        );
        echo json_encode($output);
        exit();
    }

    public function list_user_products($user_id = null)
    {
        $draw = intval($this->input->post("draw"));
        $start = intval($this->input->post("start"));
        $length = intval($this->input->post("length"));
        $order = $this->input->post("order");
        $search= $this->input->post("search");
        $search = $search['value'];
        $col = 0;
        $dir = "";
        if(!empty($order))
        {
            foreach($order as $o)
            {
                $col = $o['column'];
                $dir= $o['dir'];
            }
        }

        if($dir != "asc" && $dir != "desc")
        {
            $dir = "desc";
        }

        $valid_columns = array(
            0=>'site_name', 
            2=>'phone', 
            3=>'purchase_code',
            5=>'expiry'
        );

        if(!isset($valid_columns[$col]))
        {
            $order = null;
        }
        else
        {
            $order = $valid_columns[$col];
        }

        if($order !=null)
        {
            $this->db->order_by($order, $dir);
        }
        
        if(!empty($search))
        {
            $x=0;
            foreach($valid_columns as $sterm)
            {
                if($x==0)
                {
                    $this->db->like($sterm,$search);
                }
                else
                {
                    $this->db->or_like($sterm,$search);
                }
                $x++;
            }                 
        }

        $this->db->limit($length,$start);
        $this->db->where('user_id', $user_id); 
        $products = $this->db->get("school");
        $data = array();
        foreach($products->result() as $rows)
        {

            $data[]= array(
                '<a href="'.site_url('users/account/product/'.$rows->id).'">'.$rows->site_name.'</a>',
                $rows->product ? $this->product_model->get($rows->product)['title'] : '',
                $rows->phone, 
                $rows->purchase_code,
                $rows->default_password ? $rows->default_password : 'Not available', 
                $rows->expiry,
                20 => 'tr_'.$rows->id

            );     
        }
        $total_products = $this->totalProducts($user_id);
        $output = array(
            "draw" => $draw,
            "recordsTotal" => $total_products,
            "recordsFiltered" => $total_products,
            "data" => $data
        );
        echo json_encode($output);
        exit();
    }    


    public function totalProducts($user_id = null)
    {   
        if ($user_id) { 
            $this->db->where('user_id', $user_id); 
        }
        $query = $this->db->select("COUNT(*) as num")->get("school");
        $result = $query->row();
        if(isset($result)) return $result->num;
        return 0;
    }


    public function list_user_payments($user_id = null)
    {
        $draw = intval($this->input->post("draw"));
        $start = intval($this->input->post("start"));
        $length = intval($this->input->post("length"));
        $order = $this->input->post("order");
        $search= $this->input->post("search");
        $search = $search['value'];
        $col = 0;
        $dir = "";
        if(!empty($order))
        {
            foreach($order as $o)
            {
                $col = $o['column'];
                $dir= $o['dir'];
            }
        }

        if($dir != "asc" && $dir != "desc")
        {
            $dir = "desc";
        }

        $valid_columns = array(
            0=>'product_id', 
            1=>'plan_id', 
            2=>'reference',
            3=>'amount',
            5=>'date'
        );

        if(!isset($valid_columns[$col]))
        {
            $order = null;
        }
        else
        {
            $order = $valid_columns[$col];
        }

        if($order !=null)
        {
            $this->db->order_by($order, $dir);
        }
        
        if(!empty($search))
        {
            $x=0;
            foreach($valid_columns as $sterm)
            {
                if($x==0)
                {
                    $this->db->like($sterm,$search);
                }
                else
                {
                    $this->db->or_like($sterm,$search);
                }
                $x++;
            }                 
        }

        $this->db->limit($length,$start);
        if ($user_id) { 
            $this->db->where('user_id', $user_id); 
        }
        $products = $this->db->get("payments");
        $data = array();
        foreach($products->result() as $rows)
        {
            $setup = $this->school_model->get(['payment_id' => $rows->id]);

            $data[]= array( 
                '<a href="'.site_url('users/product/invoice/'.$rows->id).'">'.$this->product_model->get($rows->product_id)['title'].'</a>',
                $this->product_model->get_plan($rows->plan_id)['title'], 
                $rows->reference,
                $this->cr_symbol.$rows->amount, 
                $rows->description,
                date('Y/m/d - H:m A', strtotime($rows->date)),
                ($setup ? '<a class="btn btn-sm btn-info disabled mr-1">Complete</a>' : '<a href="'.site_url('users/product/setup/'.$rows->id).'" class="btn btn-sm btn-success mr-1">Setup</a>'),
                20 => 'tr_'.$rows->id
            );     
        }
        $total_payment = $this->totalPayments($user_id);
        $output = array(
            "draw" => $draw,
            "recordsTotal" => $total_payment,
            "recordsFiltered" => $total_payment,
            "data" => $data
        );
        echo json_encode($output);
        exit();
    }


    public function list_admin_payments($user_id = null)
    {
        $draw = intval($this->input->post("draw"));
        $start = intval($this->input->post("start"));
        $length = intval($this->input->post("length"));
        $order = $this->input->post("order");
        $search= $this->input->post("search");
        $search = $search['value'];
        $col = 0;
        $dir = "";
        if(!empty($order))
        {
            foreach($order as $o)
            {
                $col = $o['column'];
                $dir= $o['dir'];
            }
        }

        if($dir != "asc" && $dir != "desc")
        {
            $dir = "desc";
        }

        $valid_columns = array(
            0=>'id', 
            1=>'user_id', 
            2=>'amount',
            3=>'reference',
            5=>'date'
        );

        if(!isset($valid_columns[$col]))
        {
            $order = null;
        }
        else
        {
            $order = $valid_columns[$col];
        }

        if($order !=null)
        {
            $this->db->order_by($order, $dir);
        }
        
        if(!empty($search))
        {
            $x=0;
            foreach($valid_columns as $sterm)
            {
                if($x==0)
                {
                    $this->db->like($sterm,$search);
                }
                else
                {
                    $this->db->or_like($sterm,$search);
                }
                $x++;
            }                 
        }

        $this->db->limit($length,$start);
        if ($user_id) { 
            $this->db->where('user_id', $user_id); 
        }
        $payment = $this->db->get("payments");
        $data = array();
        foreach($payment->result() as $rows)
        { 

            $data[]= array( 
                $rows->id,
                '<a href="'.site_url('admin/admin/viewuser/'.$rows->user_id).'">'.$this->account_data->fetch($rows->user_id)['name'].'</a>',  
                $this->cr_symbol.$rows->amount, 
                $rows->reference,
                $rows->description,
                date('Y/m/d - H:m A', strtotime($rows->date)),
                20 => 'tr_'.$rows->id
            );     
        }
        $total_payment = $this->totalPayments($user_id);
        $output = array(
            "draw" => $draw,
            "recordsTotal" => $total_payment,
            "recordsFiltered" => $total_payment,
            "data" => $data
        );
        echo json_encode($output);
        exit();
    }

    public function totalPayments($user_id = null)
    {   
        if ($user_id) { 
            $this->db->where('user_id', $user_id); 
        }
        $query = $this->db->select("COUNT(*) as num")->get("payments");
        $result = $query->row();
        if(isset($result)) return $result->num;
        return 0;
    }


    public function list_users($user_id = null)
    {
        $draw = intval($this->input->post("draw"));
        $start = intval($this->input->post("start"));
        $length = intval($this->input->post("length"));
        $order = $this->input->post("order");
        $search= $this->input->post("search");
        $search = $search['value'];
        $col = 0;
        $dir = "";
        if(!empty($order))
        {
            foreach($order as $o)
            {
                $col = $o['column'];
                $dir= $o['dir'];
            }
        }

        if($dir != "asc" && $dir != "desc")
        {
            $dir = "desc";
        }

        $valid_columns = array(
            0=>'id', 
            1=>'username', 
            2=>'email',
            3=>'phone',
            4=>'role'
        );

        if(!isset($valid_columns[$col]))
        {
            $order = null;
        }
        else
        {
            $order = $valid_columns[$col];
        }

        if($order !=null)
        {
            $this->db->order_by($order, $dir);
        }
        
        if(!empty($search))
        {
            $x=0;
            foreach($valid_columns as $sterm)
            {
                if($x==0)
                {
                    $this->db->like($sterm,$search);
                }
                else
                {
                    $this->db->or_like($sterm,$search);
                }
                $x++;
            }                 
        }

        $this->db->limit($length,$start); 
        $products = $this->db->get("user");
        $data = array();
        foreach($products->result() as $rows)
        {
            $setup = $this->school_model->get(['payment_id' => $rows->id]);

            $data[]= array( 
                $rows->id,
                '<a href="'.site_url('admin/admin/viewuser/'.$rows->id).'">'.$this->account_data->fetch($rows->id)['name'].'</a>', 
                $rows->email,
                $rows->phone, 
                $rows->role, 
                '<a href="'.site_url('admin/admin/viewuser/'.$rows->id.'/update').'" class="btn btn-sm btn-warning mr-1">Edit</a>
                 <a href=""javascript:void(0)"" class="btn btn-sm btn-danger mr-1" onclick="deleteItem({type: \'user\', id: '.$rows->id.', init: \'dt\'})">Delete</a>',
                20 => 'tr_'.$rows->id
            );     
        }
        $total_users = $this->totalUsers($user_id);
        $output = array(
            "draw" => $draw,
            "recordsTotal" => $total_users,
            "recordsFiltered" => $total_users,
            "data" => $data
        );
        echo json_encode($output);
        exit();
    }

    public function totalUsers($user_id = null)
    {    
        $query = $this->db->select("COUNT(*) as num")->get("user");
        $result = $query->row();
        if(isset($result)) return $result->num;
        return 0;
    }


    public function list_visitors($visitor_id = null)
    {
        $draw = intval($this->input->post("draw"));
        $start = intval($this->input->post("start"));
        $length = intval($this->input->post("length"));
        $order = $this->input->post("order");
        $search= $this->input->post("search");
        $search = $search['value'];
        $col = 0;
        $dir = "";
        if(!empty($order))
        {
            foreach($order as $o)
            {
                $col = $o['column'];
                $dir= $o['dir'];
            }
        }

        if($dir != "asc" && $dir != "desc")
        {
            $dir = "desc";
        }

        $valid_columns = array(
            0=>'ip'
        );

        if(!isset($valid_columns[$col]))
        {
            $order = null;
        }
        else
        {
            $order = $valid_columns[$col];
        }

        if($order !=null)
        {
            $this->db->order_by($order, $dir);
        }
        
        if(!empty($search))
        {
            $x=0;
            foreach($valid_columns as $sterm)
            {
                if($x==0)
                {
                    $this->db->like($sterm,$search);
                }
                else
                {
                    $this->db->or_like($sterm,$search);
                }
                $x++;
            }                 
        }

        $this->db->limit($length,$start); 
        if ($visitor_id) { 
            $this->db->where('id', $visitor_id); 
            $this->db->or_where('ip', $visitor_id); 
        }
        $this->db->group_by('ip');
        $visitors = $this->db->select('ip')->get("visitors");
        $data = array();
        foreach($visitors->result() as $rows)
        { 
            $visitors = $this->dashboard_model->get_visitors($rows->ip);

            $data[]= array( 
                $visitors['id'], 
                $rows->ip,
                $visitors['country'], 
                $visitors['region'], 
                $visitors['city'], 
                $visitors['visits'], 
                date('Y/m/d - H:m A', strtotime($visitors['last_visit'])),
                date('Y/m/d - H:m A', strtotime($visitors['first_visit'])),
                20 => 'tr_'.$rows->ip
            );     
        }
        $total_visitors = $this->totalVisitors($visitor_id);
        $output = array(
            "draw" => $draw,
            "recordsTotal" => $total_visitors,
            "recordsFiltered" => $total_visitors,
            "data" => $data
        );
        echo json_encode($output);
        exit();
    }

    public function totalVisitors($visitor_id = null)
    {    
        if ($visitor_id) { 
            $this->db->where('id', $visitor_id); 
            $this->db->or_where('ip', $visitor_id); 
        }
        $this->db->group_by('ip');
        $query = $this->db->select("COUNT(ip) as num")->get("visitors");
        $result = $query->row();
        if(isset($result)) return $result->num;
        return 0;
    }


    public function public_content($id = null)
    {
        $draw = intval($this->input->post("draw"));
        $start = intval($this->input->post("start"));
        $length = intval($this->input->post("length"));
        $order = $this->input->post("order");
        $search= $this->input->post("search");
        $search = $search['value'];
        $col = 0;
        $dir = "";
        if(!empty($order))
        {
            foreach($order as $o)
            {
                $col = $o['column'];
                $dir= $o['dir'];
            }
        }

        if($dir != "asc" && $dir != "desc")
        {
            $dir = "desc";
        }

        $valid_columns = array(
            0=>'title',
            1=>'type',
            3=>'content'
        );

        if(!isset($valid_columns[$col]))
        {
            $order = null;
        }
        else
        {
            $order = $valid_columns[$col];
        }

        if($order !=null)
        {
            $this->db->order_by($order, $dir);
        }
        
        if(!empty($search))
        {
            $x=0;
            foreach($valid_columns as $sterm)
            {
                if($x==0)
                {
                    $this->db->like($sterm,$search);
                }
                else
                {
                    $this->db->or_like($sterm,$search);
                }
                $x++;
            }                 
        }

        $this->db->limit($length,$start);   
        $content = $this->db->select('*')->get("content");
        $data = array();
        foreach($content->result() as $rows)
        {  

            $data[]= array(  
                $rows->title, 
                $rows->type, 
                '<img src="'.$this->creative_lib->fetch_image($rows->image).'" class="user-image img-circle elevation-2" alt="Content Image" height="20px" width="auto">', 
                word_limiter($rows->content, 8), 
                '<a href="'.site_url('admin/frontsite/add_content/'.$rows->id).'" class="btn btn-sm btn-warning mr-1">Edit</a>
                 <a href=""javascript:void(0)"" class="btn btn-sm btn-danger mr-1" onclick="deleteItem({type: \'content\', id: '.$rows->id.', init: \'dt\'})">Delete</a>',
                20 => 'tr_'.$rows->id
            );     
        }
        $total_content = $this->totalPublic_content($id);
        $output = array(
            "draw" => $draw,
            "recordsTotal" => $total_content,
            "recordsFiltered" => $total_content,
            "data" => $data
        );
        echo json_encode($output);
        exit();
    }

    public function totalPublic_content($id = null)
    {      
        $query = $this->db->select("COUNT(id) as num")->get("content");
        $result = $query->row();
        if(isset($result)) return $result->num;
        return 0;
    }
}
