<?php
// Get cURL resource
$curl = curl_init();
// Set some options - we are passing in a useragent too here
curl_setopt_array($curl, array(
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_URL => 'http://localhost:3000/api/servers',
    CURLOPT_USERAGENT => 'Cccam Server Request'
));
// Send the request & save response to $resp
$resp = curl_exec($curl);
// Close request to clear up some resources
curl_close($curl);

//Charachters to replace 
$arr_repl = array('"', '[', ']','');
$clean_resp = str_replace($arr_repl,'',$resp);
//Getting Arry List of Servers
$servers = explode (",", $clean_resp);

//print_r($clines);
function filterClines($server){
    if(!empty($server)){
        if($server[0] == 'C'){
            return $server;
        }
    }
}

?>

<!DOCTYPE html>
<html>
<title>Free CCCAM Servers</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
html,body,h1,h2,h3,h4,h5 {font-family: "Raleway", sans-serif}
</style>
<body class="w3-light-grey">

<!-- Top container -->
<div class="w3-bar w3-top w3-black w3-large" style="z-index:4">
  <button class="w3-bar-item w3-button w3-hide-large w3-hover-none w3-hover-text-light-grey" onclick="w3_open();"><i class="fa fa-bars"></i>  Menu</button>
  <span class="w3-bar-item w3-right">Heading</span>
</div>

<!-- Sidebar/menu -->
<nav class="w3-sidebar w3-collapse w3-white w3-animate-left" style="z-index:3;width:300px;" id="mySidebar"><br>
  <div class="w3-container">
    <h5>Menu</h5>
  </div>
  <div class="w3-bar-block">
    <a href="#" class="w3-bar-item w3-button w3-padding-16 w3-hide-large w3-dark-grey w3-hover-black" onclick="w3_close()" title="close menu"><i class="fa fa-remove fa-fw"></i>  Close Menu</a>
    <a href="#" class="w3-bar-item w3-button w3-padding w3-gray"><i class="fa fa-free-code-camp"></i><b>  FREE C-LINES </b><span class="w3-badge w3-red"><b>New</b></span></a><br><br>
  </div>
</nav>


<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px;margin-top:43px;">

  <!-- Header -->
  <header class="w3-container" style="padding-top:22px">
    <h5><b>Daily Free CCCAM Servers</b></h5>
  </header>
  <div class="w3-panel w3-pale-yellow w3-border w3-border-yellow">
    <p>Free online Cccam Servers (C-LINES) List for everyone. This list is daly updating. Book mark our website for daily free CCCAM servers C-LINES.</p>
  </div>
    <div class="w3-container w3-dark-grey w3-padding-32">
      <div class="w3-row">
        <div class="w3-container w3-third">
          <h4 class="w3-bottombar w3-border-red"><i class="fa fa-server w3-text-white w3-large"> </i>  Servers: <?php echo ' '.count($servers);?></h4>
        </div>
        <div class="w3-container w3-third">
        </div>
        <div class="w3-container w3-third">
          <h5>Updated On: <b class="w3-text-red"><?php echo date("D M d, Y");?></b></h5>
        </div>
      </div>
    </div>

  <div class="w3-panel">
    <div class="w3-row-padding" style="margin:0 -16px">
      <div class="w3-row">
        <table class="w3-table w3-striped w3-white">
            <tr>
                <th></th>
                <th>Server [ C: hostname port username password ]</th>
                <th>Server Version</th>
            </tr>
            <?php 
                if(!empty($resp)){
                    foreach ($servers as $server) {
                        if(!empty(filterClines($server))){
                            $serverSplited = explode ("#", $server);
                            echo '<tr>
                                    <td><i class="fa fa-circle w3-text-dark-gray w3-small"></i></td>
                                    <td class="w3-text-green"><b>'.$serverSplited[0].'</b></td>
                                    <td><i class="w3-text-gray">'.str_replace('v','',$serverSplited[1]).'</i></td>
                                </tr>';
                        }
                    }
                } else {
                    echo '<tr>
                            <td></td>
                            <td class="w3-text-red"><b>No Servers Yet :(</b></td>
                            <td></td>
                          </tr>';
                }
                
            ?>
        </table>
      </div>
    </div>
  </div>
  <!-- Footer -->
  <footer class="w3-container w3-padding-16 w3-light-grey">
    <h4>Created by MaNa</h4>
    <p>Powered by NodeJS API</a></p>
  </footer>

  <!-- End page content -->
</div>

<script>
// Get the Sidebar
var mySidebar = document.getElementById("mySidebar");

// Get the DIV with overlay effect
var overlayBg = document.getElementById("myOverlay");

// Toggle between showing and hiding the sidebar, and add overlay effect
function w3_open() {
  if (mySidebar.style.display === 'block') {
    mySidebar.style.display = 'none';
    overlayBg.style.display = "none";
  } else {
    mySidebar.style.display = 'block';
    overlayBg.style.display = "block";
  }
}

// Close the sidebar with the close button
function w3_close() {
  mySidebar.style.display = "none";
  overlayBg.style.display = "none";
}
</script>

</body>
</html>
