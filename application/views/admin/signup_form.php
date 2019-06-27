<!DOCTYPE html> 
<html lang="en-US">
  <head>
    <title>.:. PURWO HADI WEB .:. </title>
    <meta charset="utf-8">
    <link href="<?php echo base_url(); ?>assets/css/admin/global.css" rel="stylesheet" type="text/css">
  </head>
  <body>
<?php
//form validation
echo validation_errors();
?>  	
<div class="container login">
<?php
$attributes = array('class' => 'form-signin');   
echo form_open('admin/create_member', $attributes);
echo '<h2 class="form-signin-heading">Buat Akun Petugas</h2>';
echo form_input('ktp', set_value('ktp'), 'placeholder="KTP"');
echo form_input('nama', set_value('nama'), 'placeholder="Nama"');
echo form_textarea('alamat', set_value('alamat'), 'placeholder="Alamat"');
echo form_dropdown('jenis_kelamin',array('Pria' =>'Pria','Perempuan' =>'Perempuan'), 'Pria');
echo form_input('telp', set_value('telp'), 'placeholder="Telepo"');
echo form_input('hp', set_value('hp'), 'placeholder="HP"');
echo form_input('username', set_value('username'), 'placeholder="Username"');
echo form_password('password', '', 'placeholder="Password"');
echo form_password('password2', '', 'placeholder="Password confirm"');

echo form_submit('submit', 'submit', 'class="btn btn-large btn-primary"');
echo form_close();
?>
</div>
    <script src="<?php echo base_url(); ?>assets/js/jquery-1.7.1.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
  </body>
</html>    
    