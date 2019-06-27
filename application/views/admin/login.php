  

    <!DOCTYPE html> 
<html lang="en-US">
  <head>
    <title>.:. PURWO HADI WEB .:. </title>
    <meta charset="utf-8">
    <link href="<?php echo base_url(); ?>assets/css/login.css" rel="stylesheet" type="text/css">
  </head>
  <?php $data = array('name' => 'button','id' => 'button','type' => 'submit','class' => 'login-button','content' => 'Reset'); ?>
  <body>
  
    <div class="container login">
      <?php 

      $attributes = array('class' => 'login');
     echo form_open('admin/login/validate_credentials', $attributes);
         ?>
      <p>
      <label for="login">Username:</label>
      <?php
      echo form_input('username', '', 'placeholder="Username"');

      ?>
      </p>
      <p>
      <label for="password">Password:</label>
      <?php
      echo form_password('password', '', 'placeholder="Password"');
      if(isset($message_error) && $message_error){
          echo '<div class="alert alert-error">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Error!</strong> Username / Password salah.';
          echo '</div>';             
      }
         echo anchor('admin/signup', 'Buat Akun Petugas');
      ?>
      </p>
      <p class="login-submit">
      <?php
            echo form_button($data);
            echo form_close();
      ?>      
    </p>    
    </div><!--container-->
    <script src="<?php echo base_url(); ?>assets/js/jquery-1.7.1.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
  </body>
</html>    
    