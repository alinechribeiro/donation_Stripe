<!DOCTYPE html>
<html lang="en">
<?php include 'header.html'; ?>
<body>

<div class="container mt-3">
  <h1>Studio Republic - Task #3</h1>
  <h2>Contact Us</h2>
    <form id="sendemailform" action="sendEmail.php" method="post" class="needs-validation" novalidate>
    <div class="form-group">
      <label for="uname">Name:</label>
      <input type="text" class="form-control" id="uname" placeholder="Enter your name" name="uname" required>
      <div id="invalid-name" class="d-none invalid">Please fill out this field.</div>
    </div>
    <div class="form-group">
      <label for="email">Email:</label>
      <input type="email" class="form-control" id="email" placeholder="Enter your email" name="email" required>
      <div id="invalid-email" class="d-none invalid">Please fill out this field.</div>
    </div>
    <div class="form-group mb-1">
        <label for="consent d-none">I consent to Studio Republic sending me emails</label>
    </div>
    <div class="form-check">
        <label class="form-check-label">
          <input type="radio" class="form-check-input" name="marketing" value="Yes" checked>Yes
        </label>
      </div>
      <div class="form-check">
        <label class="form-check-label">
          <input type="radio" class="form-check-input" name="marketing" value="No">No
        </label>
      </div>
      <div class="form-group d-block mb-3 mt-2">
        <label class="d-block mt-3" for="email">I would like to receive updates on:</label>
        <div class="form-check-inline">
          <label class="form-check-label">
            <input type="checkbox" class="form-check-input" name="srnews" value="Yes">Studio Republic News
          </label>
        </div>
        <div class="form-check-inline">
          <label class="form-check-label">
            <input type="checkbox" class="form-check-input" name="vacancies" value="Yes">Vacancies
          </label>
        </div>
        <div class="form-check-inline">
          <label class="form-check-label">
            <input type="checkbox" class="form-check-input" name="peggy" value="Yes">Peggy the dog
          </label>
        </div>
      </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>

<script>
$(document).ready(function() {
  emailValid = false;
  nameValid = false;
  // Name can't be blank
  $('#uname').on('input', function() {
    var input=$(this);
    var is_name=input.val();
    if(is_name){
      $("#invalid-name").addClass("d-none");
      nameValid = true;
    } else {
      $("#invalid-name").removeClass("d-none");
      nameValid = false;
    }
  });

  // Email must be an email
  $('#email').on('input', function() {
    var input=$(this);
    var re = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
    var is_email=re.test(input.val());
    if(is_email){
      $("#invalid-email").addClass("d-none");
      emailValid = true;
    } else {
      $("#invalid-email").removeClass("d-none");
      emailValid = false;
    }
  });

  // Form Submission
  $("#sendemailform").on("submit", function(e){
    e.preventDefault();
    if (emailValid && nameValid){
      var action = $(this).attr('action');
      var formData = $(this).serialize();
      $.post(action, formData, function(data, status, xhr) {
        var response = JSON.parse(data);
        if (response["success"]) {
          application = response['application'];
          Swal.fire({
            title: 'Email Sent!',
            text: 'Thanks for getting in touch',
            icon: 'success',
            confirmButtonText: 'Cool'
          }).then(function(isConfirm){
            window.location.href = "https://www.studiorepublic.com/";
          });
        }
        
      });
    }
  });
});
</script>

</body>
</html>
