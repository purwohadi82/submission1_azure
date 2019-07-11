    <div class="container top">
      
      <ul class="breadcrumb">
        <li>
          <a href="<?php echo site_url("admin"); ?>">
            <?php echo ucfirst($this->uri->segment(1));?>
          </a> 
          <span class="divider">/</span>
        </li>
        <li>
          <a href="<?php echo site_url("admin").'/'.$this->uri->segment(2); ?>">
            <?php echo ucfirst($this->uri->segment(2));?>
          </a> 
          <span class="divider">/</span>
        </li>
        <li class="active">
          <a href="#">Update</a>
        </li>
      </ul>
      
      <div class="page-header">
        <h2>
          Updating <?php echo ucfirst($this->uri->segment(2));?>
        </h2>
      </div>

 
      <?php
      //flash messages
      if($this->session->flashdata('flash_message')){
        if($this->session->flashdata('flash_message') == 'updated')
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Well done!</strong> book updated with success.';
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
      //form validation
      echo validation_errors();

      echo form_open_multipart('admin/buku/update/'.$this->uri->segment(4));
      ?>
        <fieldset>
            <div class="control-group">
                <label for="inputError" class="control-label">Judul</label>
                <div class="controls">
                    <input type="text" id="judul" name="judul" value="<?php echo $buku->judul; ?>" >
                    <!--<span class="help-inline">Woohoo!</span>-->
                </div>
            </div>
            <div class="control-group">
                <label for="inputError" class="control-label">Penulis</label>
                <div class="controls">
                    <input type="text" id="penulis" name="penulis" value="<?php echo $buku->penulis; ?>">
                    <!--<span class="help-inline">Cost Price</span>-->
                </div>
            </div>          
            <div class="control-group">
                <label for="inputError" class="control-label">Penerbit</label>
                <div class="controls">
                    <input type="text" id="penerbit" name="penerbit" value="<?php echo $buku->penerbit; ?>">
                    <!--<span class="help-inline">Cost Price</span>-->
                </div>
            </div>
            <div class="control-group">
                <label for="inputError" class="control-label">Tahun</label>
                <div class="controls">
                    <input type="text" id="tahun" name="tahun" value="<?php echo $buku->tahun; ?>" onkeyup="this.value=this.value.replace(/[^\d]/,'')">
                    <!--<span class="help-inline">OOps</span>-->
                </div>
            </div>
            <div class="control-group">
                <label for="inputError" class="control-label">Jenis Buku</label>
                <div class="controls">
                    <input type="text" id="jenis_buku" name="jenis_buku" value="<?php echo $buku->jenis_buku; ?>">
                    <!--<span class="help-inline">OOps</span>-->
                </div>
            </div>
            <div class="control-group">
                <label for="inputError" class="control-label">Lokasi Rak</label>
                <div class="controls">
                    <input type="text" id="lokasi_rak" name="lokasi_rak" value="<?php echo $buku->lokasi_rak; ?>">
                    <!--<span class="help-inline">OOps</span>-->
                </div>
            </div>
            <div class="control-group">
                <label for="inputError" class="control-label">Isbn</label>
                <div class="controls">
                    <input type="text" id="isbn" name="isbn" value="<?php echo $buku->isbn; ?>">
                    <!--<span class="help-inline">OOps</span>-->
                </div>
            </div>
            <div class="control-group">
                <label for="inputError" class="control-label">Jumlah</label>
                <div class="controls">
                    <input type="text" id="jumlah" name="jumlah" value="<?php echo $buku->jumlah; ?>" onkeyup="this.value=this.value.replace(/[^\d]/,'')">
                    <!--<span class="help-inline">OOps</span>-->
                </div>
            </div>
            
            <div class="control-group">
                <label for="inputError" class="control-label">Upload Gambar</label>
                <div class="controls">
                    <input type="file" name="fileToUpload" accept=".jpeg,.jpg,.png">
                </div>
            </div>
            
            <div class="form-actions">
                <button class="btn btn-primary" type="submit">Save changes</button>
                <button class="btn" type="reset">Cancel</button>
            </div>
        </fieldset>
        
        

      <?php echo form_close(); ?>

    </div>
     