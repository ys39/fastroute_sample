<!doctype html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>fastroute</title>
<link href="/fastroute/css/assets/dist/css/bootstrap.min.css" rel="stylesheet">
<?php
// css
if(!empty($css_file_list)){
  foreach($css_file_list as $k => $v){
    printf("<link href=\"/fastroute/css/%s\" rel=\"stylesheet\">",$v);
  }
}
?>
</head>
