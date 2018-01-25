<!DOCTYPE html>
<html lang="en">
<head>
  <title><?=$title ?></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/header_css.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.6/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"></script>
</head>
<body>
<div class="jumbotron set_logo">
  <div class="pull-left" style="float:left">
    <a href="index.php"><img src="../image/logo.png" alt="GIMS logo" width="170px" height="140px" style="padding-bottom:10px;"></a>
  </div>
  <div class="inner pull-right top_ul">
    <ul class="list-inline list-unstyled top_links">
      <li><a href="<?=$home ?>">Home</a></li>
      <li><a class="active" href="#"><u><?=$active ?></u></a></li>
      <li><a href="<?=$next_link ?>"><?=$next_content ?></a></li>
    </ul>
  </div>
</div>
