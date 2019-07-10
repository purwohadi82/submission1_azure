    <div class="container_form form">
        <div class="page-header">
            <h2>
                Tambah
            </h2>
        </div>
 
      <?php
      //flash messages
      if(isset($flash_message)){
        if($flash_message == TRUE)
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Well done!</strong> new book created with success.';
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
      //form validation
      echo validation_errors();
      
      echo form_open('admin/buku/add', $attributes);
      ?>
        <fieldset>
            <div class="control-group">
                <label for="inputError" class="control-label">Judul</label>
                <div class="controls">
                    <input type="text" id="judul" name="judul" value="<?php echo set_value('judul'); ?>" >
                    <!--<span class="help-inline">Woohoo!</span>-->
                </div>
            </div>
            <div class="control-group">
                <label for="inputError" class="control-label">Penulis</label>
                <div class="controls">
                    <input type="text" id="penulis" name="penulis" value="<?php echo set_value('penulis'); ?>">
                    <!--<span class="help-inline">Cost Price</span>-->
                </div>
            </div>          
            <div class="control-group">
                <label for="inputError" class="control-label">Penerbit</label>
                <div class="controls">
                    <input type="text" id="penerbit" name="penerbit" value="<?php echo set_value('penerbit'); ?>">
                    <!--<span class="help-inline">Cost Price</span>-->
                </div>
            </div>
            <div class="control-group">
                <label for="inputError" class="control-label">Tahun</label>
                <div class="controls">
                    <input type="text" id="tahun" name="tahun" value="<?php echo set_value('tahun'); ?>" onkeyup="this.value=this.value.replace(/[^\d]/,'')">
                    <!--<span class="help-inline">OOps</span>-->
                </div>
            </div>
            <div class="control-group">
                <label for="inputError" class="control-label">Jenis Buku</label>
                <div class="controls">
                    <input type="text" id="jenis_buku" name="jenis_buku" value="<?php echo set_value('jenis_buku'); ?>">
                    <!--<span class="help-inline">OOps</span>-->
                </div>
            </div>
            <div class="control-group">
                <label for="inputError" class="control-label">Lokasi Rak</label>
                <div class="controls">
                    <input type="text" id="lokasi_rak" name="lokasi_rak" value="<?php echo set_value('lokasi_rak'); ?>">
                    <!--<span class="help-inline">OOps</span>-->
                </div>
            </div>
            <div class="control-group">
                <label for="inputError" class="control-label">Isbn</label>
                <div class="controls">
                    <input type="text" id="isbn" name="isbn" value="<?php echo set_value('isbn'); ?>">
                    <!--<span class="help-inline">OOps</span>-->
                </div>
            </div>
            <div class="control-group">
                <label for="inputError" class="control-label">Jumlah</label>
                <div class="controls">
                    <input type="text" id="jumlah" name="jumlah" value="<?php echo set_value('jumlah'); ?>" onkeyup="this.value=this.value.replace(/[^\d]/,'')">
                    <!--<span class="help-inline">OOps</span>-->
                </div>
            </div>
            <div class="control-group">
                <label for="inputError" class="control-label">Upload Gambar</label>
                <div class="controls">
                    <input type="file" id="upload" name="upload">
                    <!--<span class="help-inline">OOps</span>-->
                </div>
            </div>
            <div class="form-actions">
                <button class="btn btn-primary" type="submit">Save changes</button>
                <button class="btn" type="reset">Cancel</button>
            </div>
        </fieldset>
        
    <?php echo form_close(); ?>

    </div>
    
     