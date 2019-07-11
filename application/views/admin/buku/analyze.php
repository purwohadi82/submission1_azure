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
          <a href="#">Analyze</a>
        </li>
      </ul>

        <div class="page-header users-header">
          <h2>
            Hasil Analisis Buku
            </h2>
        </div>
        
        <div class="page-header users-header"> <br>
            <h3>
                Berikut merupakan hasil analisis kendaraan yang <b>Anda</b> Upload <br> Karakteristik Foto buku ada pada kolom Response.
                <span class="border-top my-3"></span>
            </h3>
        </div>
      
      <div class="row">
        <div class="span12 columns">
            <div class="well">
                <script type="text/javascript">
                    $(document).ready(function () {
                    // **********************************************
                    // *** Update or verify the following values. ***
                    // **********************************************
                    // Replace <Subscription Key> with your valid subscription key.
                    var subscriptionKey = "29d54771a09646b0b5217b5a7514b9de";
                    // You must use the same Azure region in your REST API method as you used to
                    // get your subscription keys. For example, if you got your subscription keys
                    // from the West US region, replace "westcentralus" in the URL
                    // below with "westus".
                    //
                    // Free trial subscription keys are generated in the "westus" region.
                    // If you use a free trial subscription key, you shouldn't need to change
                    // this region.
                    var uriBase =
                    "https://southeastasia.api.cognitive.microsoft.com/vision/v2.0/analyze";
                    // Request parameters.
                    var params = {
                        "visualFeatures": "Categories,Description,Color",
                        "details": "",
                        "language": "en",
                    };
                    // Display the image.
                    var sourceImageUrl = "<?php echo $buku->foto ?>";
                    document.querySelector("#sourceImage").src = sourceImageUrl;
                    // Make the REST API call.
                    $.ajax({
                        url: uriBase + "?" + $.param(params),
                        // Request headers.
                        beforeSend: function(xhrObj){
                            xhrObj.setRequestHeader("Content-Type","application/json");
                            xhrObj.setRequestHeader("Ocp-Apim-Subscription-Key", subscriptionKey);
                        },
                        type: "POST",
                        // Request body.
                        data: '{"url": ' + '"' + sourceImageUrl + '"}',
                    })
                    .done(function(data) {
                        // Show formatted JSON on webpage.
                        $("#responseTextArea").val(JSON.stringify(data, null, 2));
                        // console.log(data);
                        // var json = $.parseJSON(data);
                        $("#description").text(data.description.captions[0].text);
                    })
                    .fail(function(jqXHR, textStatus, errorThrown) {
                        // Display error message.
                        var errorString = (errorThrown === "") ? "Error. " :
                        errorThrown + " (" + jqXHR.status + "): ";
                        errorString += (jqXHR.responseText === "") ? "" :
                        jQuery.parseJSON(jqXHR.responseText).message;
                        alert(errorString);
                    });
                });
            </script>
            <div id="wrapper" style="width:1020px; display:table;">
                <div id="jsonOutput" style="width:600px; display:table-cell;">
                    <b>Response:</b>
                    <br><br>
                    <textarea id="responseTextArea" class="UIInput"
                    style="width:580px; height:400px;" readonly=""></textarea>
                </div>
                <div id="imageDiv" style="width:420px; display:table-cell;">
                    <b>Source Image:</b>
                    <br><br>
                    <img id="sourceImage" width="400" />
                    <br>
                    <h3 id="description">Loading description. . .</h3>
                </div>
            </div>
          </div>

          

      </div>
    </div>