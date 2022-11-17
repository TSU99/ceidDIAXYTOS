<?php
include "config.php";

// Check user login or not
if(!isset($_SESSION['uname'])){
    header('Location: index.php');
}



// logout
if(isset($_POST['but_logout'])){
    session_destroy();
    header('Location: index.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="description" content="UBIQtsu">
  <meta name="author" content="anon">
  <meta name="viewport" content="width=device-width, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">

  <title>AR controller demo</title>

  <!-- necessary libraries to import -->
  <!-- basic A-FRAME library, use 1.2.0 because aframe-gui text doesn't show up with later versions -->
  <!-- see https://github.com/rdub80/aframe-gui/issues/64 -->
  <script src="https://aframe.io/releases/1.2.0/aframe.min.js"></script>
  <!-- ar.js library -->
  <script src="https://raw.githack.com/AR-js-org/AR.js/master/aframe/build/aframe-ar.js"></script>
  <!-- aframe-gui library -->
  <script src="https://rawgit.com/rdub80/aframe-gui/master/dist/aframe-gui.min.js"></script>
  <!-- dat-gui library (required by aframe-gui) -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/dat-gui/0.5.1/dat.gui.min.js" type="text/javascript"></script>

  <script>
  

    

    //component registration for in-built events (this case, fired when marker is detected)
    AFRAME.registerComponent('markerhandler', {
      init: function () {
        this.el.sceneEl.addEventListener('markerFound', (evt) => {
          console.log("marker found");
          console.log(evt);
        })
      }
    });

    

  
   
     
</script>


<style>
  .buttons {
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 5em;
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 10;
  }

  .say-hi-button {
    padding: 0.25em;
    border-radius: 4px;
    border: none;
    background: white;
    color: black;
    width: 4em;
    height: 2em;
  }
</style>

</head>
  <body style="margin : 0px; overflow: hidden;">
    <!-- html for the 2D UI -->
    <div class="buttons">
      <button class="say-hi-button">SAY HI!</button>
    </div>

    
    <!-- 2D marker types found here https://github.com/nicolocarpignoli/artoolkit-barcode-markers-collection -->
    <a-scene embedded arjs='sourceType: webcam; debugUIEnabled: false; detectionMode: mono_and_matrix; matrixCodeType: 4x4_BCH_13_9_3; emitevents:true;'
              gui-env dynamic-elements>
      <!-- marker id=1 -->
    <a-marker type="barcode" value="1">
    <?php
         $uname=$_SESSION['uname'];
         $sql_query = " SELECT isAdmin from users where username='$uname' ";
         $userIsAdmin = mysqli_query($con,$sql_query);
         
         $sql_query = " SELECT location from users where username='$uname' ";
          $userlocation = mysqli_query($con,$sql_query);

          $sql_query = " SELECT location from devices where DevID='1' ";
          $devicelocation = mysqli_query($con,$sql_query);
          if(($userlocation==$devicelocation) or ($userIsAdmin==TRUE) ){
            $sql_query = " SELECT type from devices where DevID='1' ";
            $devicetype = mysqli_query($con,$sql_query);
          }
          else{
            echo '<script>alert("You dont have access to this device")</script>';
            
          }
         ?> 
      <?php if ($devicetype == "light"): ?>
        <a-gui-flex-container
              id = "thepanel"
        			flex-direction="column" justify-content="center" align-items="normal" component-padding="0.1"
        			opacity="0.6" width="1.75" height="3" panel-color="#fff" panel-rounded="0.1"
        			position="0 0.5 0" rotation="-90 0 0"
        		  >
              
        
              <a-gui-label
        				width="1.25" height="0.25"
        				value="Light switch"
        				font-size="0.15"
        				line-height="0.4"
        				letter-spacing="0"
        				margin="0 0 0.05 0"
        			>
              </a-gui-label>

              <a-gui-toggle
                id="toggle1"                                                                                     //
                width="1.25" height="0.25"
                onclick= <?php $sql_query = "Update  devices SET IsLighton= ABS(authorised - 1) where DevID='1'"; $result = mysqli_query($con,$sql_query); ?>
                value="toggle"
                font-size="0.15"
                margin="0 0 0.05 0"
              ></a-gui-toggle>
              
             /a-gui-flex-container>
      <?php elseif($devicetype == "fan"): ?>
        <a-gui-flex-container
              id = "thepanel"
        			flex-direction="column" justify-content="center" align-items="normal" component-padding="0.1"
        			opacity="0.6" width="1.75" height="3" panel-color="#fff" panel-rounded="0.1"
        			position="0 0.5 0" rotation="-90 0 0"
        		  >
              
        
              <a-gui-label
        				width="1.25" height="0.25"
        				value="Fan"
        				font-size="0.15"
        				line-height="0.4"
        				letter-spacing="0"
        				margin="0 0 0.05 0"
        			>
              </a-gui-label>

              <a-gui-slider
                id="slider11"                                                                                   //
                width="1.25" height="0.25"
                onclick=""
                percent="0.20"
                margin="0 0 0.05 0"
              >
              </a-gui-slider>
              
             /a-gui-flex-container>
      <?php elseif($devicetype == "thermostat"): ?>
        <a-gui-flex-container
              id = "thepanel2"
        			flex-direction="column" justify-content="center" align-items="normal" component-padding="0.1"
        			opacity="0.6" width="1.75" height="3" panel-color="#fff" panel-rounded="0.1"
        			position="0 0.5 0" rotation="-90 0 0"
        		  >
              
        
              <a-gui-label
        				width="1.25" height="0.25"
        				value="Thermostat"
        				font-size="0.15"
        				line-height="0.4"
        				letter-spacing="0"
        				margin="0 0 0.05 0"
        			>
              </a-gui-label>

              <a-gui-slider
                id="slider12"                                                                               //
                width="1.25" height="0.25"
                onclick=""
                percent="0.20"
                margin="0 0 0.05 0"
              >
              </a-gui-slider>
              
             /a-gui-flex-container>
      <?php else{} ?>
        
    </a-marker>

    <!-- marker id=2 -->
    <a-marker type="barcode" value="2">
        
        <?php
         $uname=$_SESSION['uname'];
         $sql_query = " SELECT isAdmin from users where username='$uname' ";
         $userIsAdmin = mysqli_query($con,$sql_query);
         
         $sql_query = " SELECT location from users where username='$uname' ";
          $userlocation = mysqli_query($con,$sql_query);

          $sql_query = " SELECT location from devices where DevID='2' ";
          $devicelocation = mysqli_query($con,$sql_query);
          if(($userlocation==$devicelocation) or ($userIsAdmin==TRUE) ){
            $sql_query = " SELECT type from devices where DevID='2' ";
            $devicetype = mysqli_query($con,$sql_query);
          }
          else{
            echo '<script>alert("You dont have access to this device")</script>';
            
          }
         ?> 
      <?php if ($devicetype == "light"): ?>
        <a-gui-flex-container
              id = "thepanel"
        			flex-direction="column" justify-content="center" align-items="normal" component-padding="0.1"
        			opacity="0.6" width="1.75" height="3" panel-color="#fff" panel-rounded="0.1"
        			position="0 0.5 0" rotation="-90 0 0"
        		  >
              
        
              <a-gui-label
        				width="1.25" height="0.25"
        				value="Light switch"
        				font-size="0.15"
        				line-height="0.4"
        				letter-spacing="0"
        				margin="0 0 0.05 0"
        			>
              </a-gui-label>

              <a-gui-toggle
                id="toggle2"                                                                                     //
                width="1.25" height="0.25"
                onclick= <?php $sql_query = "Update  devices SET IsLighton= ABS(authorised - 1) where DevID='2'"; $result = mysqli_query($con,$sql_query); ?>
                value="toggle"
                font-size="0.15"
                margin="0 0 0.05 0"
              ></a-gui-toggle>
              
             /a-gui-flex-container>
      <?php elseif($devicetype == "fan"): ?>
        <a-gui-flex-container
              id = "thepanel1"
        			flex-direction="column" justify-content="center" align-items="normal" component-padding="0.1"
        			opacity="0.6" width="1.75" height="3" panel-color="#fff" panel-rounded="0.1"
        			position="0 0.5 0" rotation="-90 0 0"
        		  >
              
        
              <a-gui-label
        				width="1.25" height="0.25"
        				value="Fan"
        				font-size="0.15"
        				line-height="0.4"
        				letter-spacing="0"
        				margin="0 0 0.05 0"
        			>
              </a-gui-label>

              <a-gui-slider
                id="slider21"                                                                                   //
                width="1.25" height="0.25"
                onclick=""
                percent="0.20"
                margin="0 0 0.05 0"
              >
              </a-gui-slider>
              
             /a-gui-flex-container>
      <?php elseif($devicetype == "thermostat"): ?>
        <a-gui-flex-container
              id = "thepanel2"
        			flex-direction="column" justify-content="center" align-items="normal" component-padding="0.1"
        			opacity="0.6" width="1.75" height="3" panel-color="#fff" panel-rounded="0.1"
        			position="0 0.5 0" rotation="-90 0 0"
        		  >
              
        
              <a-gui-label
        				width="1.25" height="0.25"
        				value="Thermostat"
        				font-size="0.15"
        				line-height="0.4"
        				letter-spacing="0"
        				margin="0 0 0.05 0"
        			>
              </a-gui-label>

              <a-gui-slider
                id="slider22"                                                                               //
                width="1.25" height="0.25"
                onclick=""
                percent="0.20"
                margin="0 0 0.05 0"
              >
              </a-gui-slider>
              
             /a-gui-flex-container>
      <?php else{} ?>
              
      <?php endif; ?>  


    </a-marker>
    
    <!-- marker id=3 -->
        <a-marker type="barcode" value="3">
        <?php
         $uname=$_SESSION['uname'];
         $sql_query = " SELECT isAdmin from users where username='$uname' ";
         $userIsAdmin = mysqli_query($con,$sql_query);
         
         $sql_query = " SELECT location from users where username='$uname' ";
          $userlocation = mysqli_query($con,$sql_query);

          $sql_query = " SELECT location from devices where DevID='3' ";
          $devicelocation = mysqli_query($con,$sql_query);
          if(($userlocation==$devicelocation) or ($userIsAdmin==TRUE) ){
            $sql_query = " SELECT type from devices where DevID='3' ";
            $devicetype = mysqli_query($con,$sql_query);
          }
          else{
            echo '<script>alert("You dont have access to this device")</script>';
            
          }
         ?> 
      <?php if ($devicetype == "light"): ?>
        <a-gui-flex-container
              id = "thepanel"
        			flex-direction="column" justify-content="center" align-items="normal" component-padding="0.1"
        			opacity="0.6" width="1.75" height="3" panel-color="#fff" panel-rounded="0.1"
        			position="0 0.5 0" rotation="-90 0 0"
        		  >
              
        
              <a-gui-label
        				width="1.25" height="0.25"
        				value="Light switch"
        				font-size="0.15"
        				line-height="0.4"
        				letter-spacing="0"
        				margin="0 0 0.05 0"
        			>
              </a-gui-label>

              <a-gui-toggle
                id="toggle3"                                                                                     //
                width="1.25" height="0.25"
                onclick= <?php $sql_query = "Update  devices SET IsLighton= ABS(authorised - 1) where DevID='3'"; $result = mysqli_query($con,$sql_query); ?>
                value="toggle"
                font-size="0.15"
                margin="0 0 0.05 0"
              ></a-gui-toggle>
              
             /a-gui-flex-container>
      <?php elseif($devicetype == "fan"): ?>
        <a-gui-flex-container
              id = "thepanel3"
        			flex-direction="column" justify-content="center" align-items="normal" component-padding="0.1"
        			opacity="0.6" width="1.75" height="3" panel-color="#fff" panel-rounded="0.1"
        			position="0 0.5 0" rotation="-90 0 0"
        		  >
              
        
              <a-gui-label
        				width="1.25" height="0.25"
        				value="Fan"
        				font-size="0.15"
        				line-height="0.4"
        				letter-spacing="0"
        				margin="0 0 0.05 0"
        			>
              </a-gui-label>

              <a-gui-slider
                id="slider31"                                                                                   //
                width="1.25" height="0.25"
                onclick=""
                percent="0.20"
                margin="0 0 0.05 0"
              >
              </a-gui-slider>
              
             /a-gui-flex-container>
      <?php elseif($devicetype == "thermostat"): ?>
        <a-gui-flex-container
              id = "thepanel2"
        			flex-direction="column" justify-content="center" align-items="normal" component-padding="0.1"
        			opacity="0.6" width="1.75" height="3" panel-color="#fff" panel-rounded="0.1"
        			position="0 0.5 0" rotation="-90 0 0"
        		  >
              
        
              <a-gui-label
        				width="1.25" height="0.25"
        				value="Thermostat"
        				font-size="0.15"
        				line-height="0.4"
        				letter-spacing="0"
        				margin="0 0 0.05 0"
        			>
              </a-gui-label>

              <a-gui-slider
                id="slider32"                                                                               //
                width="1.25" height="0.25"
                onclick=""
                percent="0.20"
                margin="0 0 0.05 0"
              >
              </a-gui-slider>
              
             /a-gui-flex-container>
      <?php else{} ?>
    </a-marker>

    <!-- marker id=4 -->
    <a-marker type="barcode" value="4">
    <?php
         $uname=$_SESSION['uname'];
         $sql_query = " SELECT isAdmin from users where username='$uname' ";
         $userIsAdmin = mysqli_query($con,$sql_query);
         
         $sql_query = " SELECT location from users where username='$uname' ";
          $userlocation = mysqli_query($con,$sql_query);

          $sql_query = " SELECT location from devices where DevID='4' ";
          $devicelocation = mysqli_query($con,$sql_query);
          if(($userlocation==$devicelocation) or ($userIsAdmin==TRUE) ){
            $sql_query = " SELECT type from devices where DevID='4' ";
            $devicetype = mysqli_query($con,$sql_query);
          }
          else{
            echo '<script>alert("You dont have access to this device")</script>';
            
          }
         ?> 
      <?php if ($devicetype == "light"): ?>
        <a-gui-flex-container
              id = "thepanel"
        			flex-direction="column" justify-content="center" align-items="normal" component-padding="0.1"
        			opacity="0.6" width="1.75" height="3" panel-color="#fff" panel-rounded="0.1"
        			position="0 0.5 0" rotation="-90 0 0"
        		  >
              
        
              <a-gui-label
        				width="1.25" height="0.25"
        				value="Light switch"
        				font-size="0.15"
        				line-height="0.4"
        				letter-spacing="0"
        				margin="0 0 0.05 0"
        			>
              </a-gui-label>

              <a-gui-toggle
                id="toggle4"                                                                                     //
                width="1.25" height="0.25"
                onclick= <?php $sql_query = "Update  devices SET IsLighton= ABS(authorised - 1) where DevID='4'"; $result = mysqli_query($con,$sql_query); ?>
                value="toggle"
                font-size="0.15"
                margin="0 0 0.05 0"
              ></a-gui-toggle>
              
             /a-gui-flex-container>
      <?php elseif($devicetype == "fan"): ?>
        <a-gui-flex-container
              id = "thepanel1"
        			flex-direction="column" justify-content="center" align-items="normal" component-padding="0.1"
        			opacity="0.6" width="1.75" height="3" panel-color="#fff" panel-rounded="0.1"
        			position="0 0.5 0" rotation="-90 0 0"
        		  >
              
        
              <a-gui-label
        				width="1.25" height="0.25"
        				value="Fan"
        				font-size="0.15"
        				line-height="0.4"
        				letter-spacing="0"
        				margin="0 0 0.05 0"
        			>
              </a-gui-label>

              <a-gui-slider
                id="slider41"                                                                                   //
                width="1.25" height="0.25"
                onclick=""
                percent="0.20"
                margin="0 0 0.05 0"
              >
              </a-gui-slider>
              
             /a-gui-flex-container>
      <?php elseif($devicetype == "thermostat"): ?>
        <a-gui-flex-container
              id = "thepanel2"
        			flex-direction="column" justify-content="center" align-items="normal" component-padding="0.1"
        			opacity="0.6" width="1.75" height="3" panel-color="#fff" panel-rounded="0.1"
        			position="0 0.5 0" rotation="-90 0 0"
        		  >
              
        
              <a-gui-label
        				width="1.25" height="0.25"
        				value="Thermostat"
        				font-size="0.15"
        				line-height="0.4"
        				letter-spacing="0"
        				margin="0 0 0.05 0"
        			>
              </a-gui-label>

              <a-gui-slider
                id="slider42"                                                                               //
                width="1.25" height="0.25"
                onclick=""
                percent="0.20"
                margin="0 0 0.05 0"
              >
              </a-gui-slider>
              
             /a-gui-flex-container>
      <?php else{} ?>
        
    </a-marker>

     >
      <a-entity camera="fov:40" id="cam" ></a-entity>
    </a-scene>
  </body>
</html>