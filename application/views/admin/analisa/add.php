    <div class="container_form form">
        <div class="page-header">
            <h2>
                Upload Gambar Buku
            </h2>
        </div>
 
      <?php
      //flash messages
      if(isset($flash_message)){
        if($flash_message == TRUE)
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Well done!</strong> new book picture created with success.';
          echo '</div>';       
        }else{
          echo '<div class="alert alert-error">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Oh snap!</strong> change a few things up and try submitting again.';
          echo '</div>';          
        }
      }
      ?>
      
      <?php
      //form data
      $attributes = array('class' => 'form-horizontal', 'id' => '');
      
      echo form_open_multipart('admin/analisa/add', $attributes);
      ?>
        <fieldset>
            <div class="control-group">
                <label for="inputError" class="control-label">Upload Foto Buku</label>
                <div class="controls">
                    <input type="file" name="fileToUpload" accept=".jpeg,.jpg,.png" required="">
    
                    <!--<span class="help-inline">Woohoo!</span>-->
                </div>
            </div>
            <div class="form-actions">
                <button class="btn btn-primary" type="submit">Upload</button>
            </div>
        </fieldset>
        
    <?php echo form_close(); ?>

    </div>
    
     