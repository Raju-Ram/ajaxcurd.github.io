<!DOCTYPE html>
<html lang="en">

<head>
  <title></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

</head>

<body>

  <div class="container">

    <h1 class="text-primary text-uppercase text-center"> AJAX CURD OPERATION</h1>
    <div class="d-flex justify-content-end">
      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
        Add Record
      </button>
    </div>
    <div>

      <h2 class="text-danger">ALL RECORD</h2>

      <div id="records_contant">

      </div>
    </div>
    <div class="modal" id="myModal">
      <div class="modal-dialog">
        <div class="modal-content">

          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title"> AJAX CURD OPERATION</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <form>
            <!-- Modal body -->
            <div class="modal-body">
              <div class="form-group">
                <lable>firstname:</lable>
                <input type="text" name="" id="firstname" class="form-control" placeholder="first name">

              </div>

              <div class="form-group">
                <lable>lastname:</lable>
                <input type="text" name="" id="lastname" class="form-control" placeholder="last name">

              </div>

              <div class="form-group">
                <lable>email:</lable>
                <input type="text" name="" id="email" class="form-control" placeholder="Email id">

              </div>

              <div class="form-group">
                <lable>mobile:</lable>
                <input type="text" name="" id="mobile" class="form-control" placeholder="Mobile">

              </div>


            </div>


            <!-- Modal footer -->
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="addrecord()">SAVE</button>
            </div>
            <button type="button" class="btn btn-danger" data-dismiss="modal">CLOSE</button>
        </div>
        </form>
      </div>
    </div>
  </div>


  <!-- ///////update  -->
  <div class="modal fade" id="update_user_modal">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title"> AJAX CURD OPERATION</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <form>
          <div class="modal-body">
            <div class="form-group">
              <lable>update_firstname:</lable>
              <input type="text" name="" id="update_firstname" class="form-control" placeholder="first name">

            </div>

            <div class="form-group">
              <lable>update_lastname:</lable>
              <input type="text" name="" id="update_lastname" class="form-control" placeholder="last name">

            </div>

            <div class="form-group">
              <lable>update_email:</lable>
              <input type="text" name="" id="update_email" class="form-control" placeholder="Email id">

            </div>

            <div class="form-group">
              <lable>update_mobile:</lable>
              <input type="text" name="" id="update_mobile" class="form-control" placeholder="Mobile">

            </div>


          </div>

          <!-- Modal footer -->
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal"
              onclick="updateuserdatails()">SAVE</button>
          </div>
          <button type="button" class="btn btn-danger" data-dismiss="modal">CLOSE</button>
          <input type="hidden" name="" id="hidden_user_id">
      </div>
      </form>

    </div>
  </div>
  </div>

  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>


  <script>

    $(document).ready(function () {
      readrecord();
    });

    function readrecord() {
      var readrecord = "readrecord";
      $.ajax({
        url: "backend1.php",
        type: "post",
        data: { readrecord: readrecord },
        success: function (data, status) {
          $('#records_contant').html(data);
        }



      });


    }


    function addrecord() {
      var firstname = $('#firstname').val();
      var lastname = $('#lastname').val();
      var Email = $('#email').val();
      var mobile = $('#mobile').val();


      $.ajax({
        url: "backend1.php",
        type: 'post',
        data: {
          firstname: firstname,
          lastname: lastname,
          email: Email,
          mobile: mobile,
        },

        success: function (data, status) {
          readrecord()

        }
      });
    }


    function deleteuser(deleteid) {
      var conf = confirm("are you sure");
      if (conf == true) {

        $.ajax({

          url: "backend1.php",
          type: "post",
          data: { deleteid: deleteid },
          success: function (data, status) {

            readrecord();


          }

        });

      }
    }

    function getuserdetails(id) {
      $('#hidden_user_id').val(id);
      $.post("backend.php", {
        id: id
      }, function (data, status) {
        // console.log(data)
        var user = JSON.parse(data);
        $('#update_firstname').val(user.firstname);
        $('#update_lastname').val(user.lastname);
        $('#update_email').val(user.email);
        $('#update_mobile').val(user.mobile);
      }
      );

      $('#update_user_modal').modal("show");

    }
  </script>
</body>

</html>