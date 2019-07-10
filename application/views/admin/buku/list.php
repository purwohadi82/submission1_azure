    <div class="container top">

      <ul class="breadcrumb">
        <li>
          <a href="<?php echo site_url("admin"); ?>">
            <?php echo ucfirst($this->uri->segment(1));?>
          </a> 
          <span class="divider">/</span>
        </li>
        <li class="active">
          <?php echo ucfirst($this->uri->segment(2));?>
        </li>
      </ul>

      <div class="page-header users-header">
        <h2>
          <?php echo ucfirst($this->uri->segment(2));?> 
          <a rel="shadowbox" href="<?php echo site_url("admin").'/'.$this->uri->segment(2); ?>/add" class="btn btn-success">Add a new</a>
          </h2>
      </div>
      
      <div class="row">
        <div class="span12 columns">
          <div class="well">
           
            <?php
           /*
            $attributes = array('class' => 'form-inline reset-margin', 'id' => 'myform');
           
            $options_manufacture = array(0 => "all");
            foreach ($manufactures as $row)
            {
              $options_manufacture[$row['id']] = $row['name'];
            }
            //save the columns names in a array that we will use as filter         
            $options_products = array();    
            foreach ($products as $array) {
              foreach ($array as $key => $value) {
                $options_products[$key] = $key;
              }
              break;
            }

            echo form_open('admin/products', $attributes);
     
              echo form_label('Search:', 'search_string');
              echo form_input('search_string', $search_string_selected, 'style="width: 170px;
height: 26px;"');

              echo form_label('Filter by manufacturer:', 'manufacture_id');
              echo form_dropdown('manufacture_id', $options_manufacture, $manufacture_selected, 'class="span2"');

              echo form_label('Order by:', 'order');
              echo form_dropdown('order', $options_products, $order, 'class="span2"');

              $data_submit = array('name' => 'mysubmit', 'class' => 'btn btn-primary', 'value' => 'Go');

              $options_order_type = array('Asc' => 'Asc', 'Desc' => 'Desc');
              echo form_dropdown('order_type', $options_order_type, $order_type_selected, 'class="span1"');

              echo form_submit($data_submit);

            echo form_close();
            */
            ?>

          </div>

          <table class="table table-striped table-bordered table-condensed">
            <thead>
              <tr>
                <th class="header">#</th>
                <th class="yellow header headerSortDown">Judul</th>
                <th class="green header">Penulis</th>
                <th class="red header">Penerbit</th>
                <th class="red header">Tahun</th>
                <th class="red header">Jenis Buku</th>
                <th class="red header">Jumlah</th>
                <th class="red header">Gambar</th>
                <th class="red header">Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php
              foreach($buku as $row)
              {
                echo '<tr>';
                echo '<td>'.$row['id_buku'].'</td>';
                echo '<td>'.$row['judul'].'</td>';
                echo '<td>'.$row['penulis'].'</td>';
                echo '<td>'.$row['penerbit'].'</td>';
                echo '<td>'.$row['tahun'].'</td>';
                echo '<td>'.$row['jenis_buku'].'</td>';
                echo '<td>'.$row['jumlah'].'</td>';
                echo '<td></td>';
                echo '<td class="crud-actions">
                  <a href="'.site_url("admin").'/buku/update/'.$row['id_buku'].'" class="btn btn-info">Analyze Gambar</a>  
                </td>';
                /*
                echo '<td class="crud-actions">
                  <a href="'.site_url("admin").'/buku/update/'.$row['id_buku'].'" class="btn btn-info">view & edit</a>  
                  <a href="'.site_url("admin").'/buku/delete/'.$row['id_buku'].'" class="btn btn-danger">delete</a>
                </td>';
                */
                echo '</tr>';
              }
              ?>      
            </tbody>
          </table>

          <?php echo '<div class="pagination">'.$this->pagination->create_links().'</div>'; ?>

      </div>
    </div>