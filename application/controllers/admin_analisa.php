<?php
//require_once(APPPATH.'libraries/azurestorage/vendor/autoload.php');

use MicrosoftAzure\Storage\Blob\BlobRestProxy;
use MicrosoftAzure\Storage\Common\Exceptions\ServiceException;
use MicrosoftAzure\Storage\Blob\Models\ListBlobsOptions;
use MicrosoftAzure\Storage\Blob\Models\CreateContainerOptions;
use MicrosoftAzure\Storage\Blob\Models\PublicAccessType;

class Admin_analisa extends CI_Controller {
 
    /**
    * Responsable for auto load the model
    * @return void
    */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('buku_model');
		$this->load->library('azurestorage');

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
        $data['main_content'] = 'admin/analisa/list';
        $this->load->view('includes/template', $data);  

    }//index

    public function add()
    {
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
            //form validation
            // Get connection string
            $Azurestorage = new Azurestorage;
            $connectionString = $Azurestorage->getConnectionString();
        
            $containerName = "blobpurwo";
            // Create table REST proxy.
            $connectionString = $Azurestorage->uploadBlob($connectionString,$_FILES);
         $data['flash_message'] = $connectionString;
            //if the upload has returned true then we show the flash message
            /*
            if($blobClient->createBlockBlob($containerName, $fileToUpload, $content)){
                $data['flash_message'] = TRUE; 
            }else{
                $data['flash_message'] = FALSE; 
            }
            */
        }
        $data['main_content'] = 'admin/analisa/add';
        $this->load->view('includes/form_template', $data);  
    }       

}