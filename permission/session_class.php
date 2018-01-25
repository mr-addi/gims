<?php
require_once 'session/manage_session_class.php';
$sesion_obj=new Manage_Session();
$res_sess=$sesion_obj->fetch_all_session();



?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Session Class</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/css/bootstrap.min.css" integrity="sha384-y3tfxAZXuh4HwSYylfB+J125MxIs6mR5FOHamPBG064zB+AFeWH94NdvaCBm8qnd" crossorigin="anonymous">
  </head>
  <body>
    <div class="jumbotron">
        <h3 class="text-center">Session Classes</h3>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-10">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>Select Session</th>
                <th>Select Session Year</th>
                <th>Select Classes</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>
                  <select class="form-control" name="sessio_id">
                    <?php
                    while ($sessions=mysqli_fetch_assoc($res_sess)) {
                      ?>
                        <option value="<?= $sessions['session_id'] ?>"><?= $sessions['session_type'] ?>-<?= $sessions['session_year'] ?></option>

                      <?php
                    } ?>
                  </select>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/js/bootstrap.min.js" integrity="sha384-vZ2WRJMwsjRMW/8U7i6PWi6AlO1L79snBrmgiDpgIWJ82z8eA5lenwvxbMV1PAh7" crossorigin="anonymous"></script>
  </body>
</html>
