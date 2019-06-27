<?php
class Admin_buku extends CI_Controller {
 
    /**
    * Responsable for auto load the model
    * @return void
    */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('buku_model');

        if(!$this->session->userdata('is_logged_in')){
            redirect('admin/login');
        }
    }
 
    /**
    * Load the main view with all the current model model's data.
    * @return void
    */
    public function index()
    {
        //all the posts sent by the view
        $buku_id = $this->input->post('buku_id');        
        $search_string = $this->input->post('search_string');        
        $order = $this->input->post('order'); 
        $order_type = $this->input->post('order_type'); 

        //pagination settings
        $config['per_page'] = 5;
        $config['base_url'] = base_url().'admin/buku';
        $config['use_page_numbers'] = TRUE;
        $config['num_links'] = 20;
        $config['full_tag_open'] = '<ul>';
        $config['full_tag_close'] = '</ul>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a>';
        $config['cur_tag_close'] = '</a></li>';

        //limit end
        $page = $this->uri->segment(3);

        //math to get the initial record to be select in the database
        $limit_end = ($page * $config['per_page']) - $config['per_page'];
        if ($limit_end < 0){
            $limit_end = 0;
        } 

        //if order type was changed
        if($order_type){
            $filter_session_data['order_type'] = $order_type;
        }
        else{
            //we have something stored in the session? 
            if($this->session->userdata('order_type')){
                $order_type = $this->session->userdata('order_type');    
            }else{
                //if we have nothing inside session, so it's the default "Asc"
                $order_type = 'Asc';    
            }
        }
        //make the data type var avaible to our view
        $data['order_type_selected'] = $order_type;        


        //we must avoid a page reload with the previous session data
        //if any filter post was sent, then it's the first time we load the content
        //in this case we clean the session filter data
        //if any filter post was sent but we are in some page, we must load the session data

        //filtered && || paginated
        if($buku_id !== false && $search_string !== false && $order !== false || $this->uri->segment(3) == true){ 
           
            /*
            The comments here are the same for line 79 until 99

            if post is not null, we store it in session data array
            if is null, we use the session data already stored
            we save order into the the var to load the view with the param already selected       
            */

            if($buku_id !== 0){
                $filter_session_data['buku_selected'] = $buku_id;
            }else{
                $buku_id = $this->session->userdata('buku_selected');
            }
            $data['buku_selected'] = $buku_id;

            if($search_string){
                $filter_session_data['search_string_selected'] = $search_string;
            }else{
                $search_string = $this->session->userdata('search_string_selected');
            }
            $data['search_string_selected'] = $search_string;

            if($order){
                $filter_session_data['order'] = $order;
            }
            else{
                $order = $this->session->userdata('order');
            }
            $data['order'] = $order;

            //save session data into the session
            $this->session->set_userdata($filter_session_data);
            $data['count_buku']= $this->buku_model->count_buku('', $search_string, $order);
            $config['total_rows'] = $data['count_buku'];

            //fetch sql data into arrays
            if($search_string){
                if($order){
                    $data['buku'] = $this->buku_model->get_buku('', $search_string, $order, $order_type, $config['per_page'],$limit_end);        
                }else{
                    $data['buku'] = $this->buku_model->get_buku('', $search_string, '', $order_type, $config['per_page'],$limit_end);           
                }
            }else{
                if($order){
                    $data['buku'] = $this->buku_model->get_buku('', '', $order, $order_type, $config['per_page'],$limit_end);        
                }else{
                    $data['buku'] = $this->buku_model->get_buku('', '', '', $order_type, $config['per_page'],$limit_end);        
                }
            }

        }else{
            $data['count_buku']= $this->buku_model->count_buku();
            $data['buku'] = $this->buku_model->get_buku('', '', '', $order_type, $config['per_page'],$limit_end);        
            $config['total_rows'] = $data['count_buku'];

        }

        //initializate the panination helper 
        $this->pagination->initialize($config);   

        //load the view
        $data['main_content'] = 'admin/buku/list';
        $this->load->view('includes/template', $data);  

    }//index

    public function add()
    {
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
            //form validation
            $this->form_validation->set_rules('judul', 'judul', 'required');
            $this->form_validation->set_rules('penulis', 'penulis', 'required');
            $this->form_validation->set_rules('penerbit', 'penerbit', 'required');
            $this->form_validation->set_rules('tahun', 'tahun', 'required|numeric');
            $this->form_validation->set_rules('jenis_buku', 'jenis_buku', 'required');
            $this->form_validation->set_rules('lokasi_rak', 'lokasi_rak', 'required');
            $this->form_validation->set_rules('isbn', 'isbn', 'required');
            $this->form_validation->set_rules('jumlah', 'jumlah', 'required|numeric');
            $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');

            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
                $data_to_store = array(
                    'judul' => $this->input->post('judul'),
                    'penulis' => $this->input->post('penulis'),
                    'penerbit' => $this->input->post('penerbit'),
                    'tahun' => $this->input->post('tahun'),          
                    'jenis_buku' => $this->input->post('jenis_buku'),
                    'lokasi_rak' => $this->input->post('lokasi_rak'),
                    'isbn' => $this->input->post('isbn'),
                    'jumlah' => $this->input->post('jumlah'),
                    'create_date' => date('Y-m-d'),
                    'update_date' => date('Y-m-d'),
                    'id_petugas' => $this->session->userdata('id_petugas')
                );
                //if the insert has returned true then we show the flash message
                if($this->buku_model->store_buku($data_to_store)){
                    $data['flash_message'] = TRUE; 
                }else{
                    $data['flash_message'] = FALSE; 
                }

            }

        }
        $data['main_content'] = 'admin/buku/add';
        $this->load->view('includes/form_template', $data);  
    }       

    /**
    * Update item by his id
    * @return void
    */
    public function update()
    {
        //product id 
        $id = $this->uri->segment(4);
  
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
            //form validation
            $this->form_validation->set_rules('judul', 'judul', 'required');
            $this->form_validation->set_rules('penulis', 'penulis', 'required');
            $this->form_validation->set_rules('penerbit', 'penerbit', 'required');
            $this->form_validation->set_rules('tahun', 'tahun', 'required|numeric');
            $this->form_validation->set_rules('jenis_buku', 'jenis_buku', 'required');
            $this->form_validation->set_rules('lokasi_rak', 'lokasi_rak', 'required');
            $this->form_validation->set_rules('isbn', 'isbn', 'required');
            $this->form_validation->set_rules('jumlah', 'jumlah', 'required|numeric');
            $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
    
                $data_to_store = array(
                    'judul'         => $this->input->post('judul'),
                    'penulis'       => $this->input->post('penulis'),
                    'penerbit'      => $this->input->post('penerbit'),
                    'tahun'         => $this->input->post('tahun'),          
                    'jenis_buku'    => $this->input->post('jenis_buku'),
                    'lokasi_rak'    => $this->input->post('lokasi_rak'),
                    'isbn'          => $this->input->post('isbn'),
                    'jumlah'        => $this->input->post('jumlah'),
                    'update_date'   => date('Y-m-d'),
                    'id_petugas'    => $this->session->userdata('id_petugas')
                );
                //if the insert has returned true then we show the flash message
                if($this->buku_model->update_buku($id, $data_to_store) == TRUE){
                    $this->session->set_flashdata('flash_message', 'updated');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
                redirect('admin/buku/update/'.$id.'');

            }//validation run

        }

        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data

        //buku data 
        $data['buku'] = $this->buku_model->get_buku_by_id($id);

        $data['main_content'] = 'admin/buku/edit';
        $this->load->view('includes/template', $data);            

    }//update

    /**
    * Delete product by his id
    * @return void
    */
    public function delete()
    {
        //product id 
        $id = $this->uri->segment(4);
        $this->buku_model->delete_buku($id);
        redirect('admin/buku');
    }//edit

}