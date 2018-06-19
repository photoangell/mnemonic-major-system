<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><title>x50.com Mnemonic Major System Composer</title></head>
<body>
<form method="post">
  <input type="text" name="code" value="<?php echo $_POST["code"];?>" />
  <input type="submit" />
  <br />
<?php
function numtolet($num) {
  // this is the derren brown method
  switch ($num) {
    case "0":
      $let = "s|z|c";
      break;
    case "1":
      $let = "l";
      break;
    case "2":
      $let = "n";
      break;
    case "3":
      $let = "m";
      break;
    case "4":
      $let = "r";
      break;
    case "5":
      $let = "f|v";
      break;
    case "6":
      $let = "b|p";
      break;
    case "7":
      $let = "T";
      break;
    case "8":
      $let = "sh|ch|j";
      break;
    case "9":
      $let = "g";
      break;
  }
  return $let;
}

if ($_POST["code"] <> '') {
    //found stuff
    Echo "your results are...<br /><br />";
    $vowel = "[aeiouy]";
    $regex = "/^" . $vowel . "*";

    //test if all numeric
    $numbertest = str_replace(" ", "", $_POST["code"]);
    if  (is_numeric($numbertest)) {
      //loop numbertest and populate array
      $letters = array();
      for ($i = 0; $i <= strlen($numbertest) - 1; $i++) {
        //echo "its " . $i;
        $singlenum = substr($numbertest, $i, 1);
        array_push($letters,$singlenum);
      }
           
    } else {
      //treat as space separated string
      $letters = explode(" ", $_POST["code"]);
    }

    //now build a regex    
    foreach ($letters as $char) {
          //improve this to auto include alternates
          if (is_numeric($char)) { $char = numtolet($char); }
          $regex .= "(" . $char . ")" . $vowel . "*"; }
    $regex = substr($regex, 0, $regex.length - 1);
    $regex .= "*$/i";
    echo  "using..." . $regex . "<br/>" ;
    
    $wordlist = file('WordList.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($wordlist as $word) {
        if (preg_match($regex, $word)) { 
          echo $word. ", "; }
    }
    echo "<hr />" ;

}   else {
  Echo "enter your letters, separated by space...<br />";

}

?>
<p>remember...</p>
<ul>
<?php 
for ($i = 0; $i <= 9; $i++) {
  echo "<li>" . $i . " = " . numtolet($i) . "</li>";
}
?>
</ul>    
<p>based on a post by 
<a href="http://blog.anthonyburns.co.uk/Never-forget-a-thing-thanks-to-Powershell-and-Regular-Expressions">Anthony Burns</a> |
<a href="http://x50.com/">about this app</a></p> 
</form>
</body>
</html>