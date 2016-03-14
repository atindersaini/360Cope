<?php
 include 'header.php';
?>
              <div class="row">
                  <aside class="profile-nav col-lg-3">
                      <section class="panel">
                          <div class="user-heading round">
                              <a href="#">
                                  <img src="img/profile-avatar.jpg" alt="">
                              </a>
                              <h1 id="name"></h1>
                              <p id="email"></p>
                          </div>

                          <ul class="nav nav-pills nav-stacked">
                              <li><a href="profile.php"> <i class="icon-user"></i> Profile</a></li>
                              <!--<li><a href="profile-activity.html"> <i class="icon-calendar"></i> Recent Activity <span class="label label-danger pull-right r-activity">9</span></a></li>-->
                              <li class="active"><a href="profile-edit.php"> <i class="icon-edit"></i> Edit profile</a></li>
                          </ul>

                      </section>
                  </aside>
                  <aside class="profile-info col-lg-9">
                      <section class="panel">
                          <div class="bio-graph-heading">
                              You can make changes to your information with 360Copé.
                          </div>
                          <div class="panel-body bio-graph-info">
                              <h1> Profile Info</h1>
                              <form accept-charset="UTF-8"  id="profileEdit" class="form-horizontal" role="form" action="#" method="post">
                                  <!--<div class="form-group">
                                      <label  class="col-lg-2 control-label">About Me</label>
                                      <div class="col-lg-10">
                                          <textarea name="" id="" class="form-control" cols="30" rows="10"></textarea>
                                      </div>
                                  </div>-->
                                  <div class="form-group">
                                      <label  class="col-lg-2 control-label">First Name</label>
                                      <div class="col-lg-6">
                                          <input type="text" accept-charset="UTF-8"    class="form-control" id="fname" placeholder=" ">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label  class="col-lg-2 control-label">Last Name</label>
                                      <div class="col-lg-6">
                                          <input type="text" accept-charset="UTF-8"    class="form-control" id="lname" placeholder=" ">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label  class="col-lg-2 control-label">Phone</label>
                                      <div class="col-lg-6">
                                          <input type="text" accept-charset="UTF-8"    class="form-control" id="phone" placeholder=" ">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label  class="col-lg-2 control-label">Facility</label>
                                      <div class="col-lg-6">
                                          <input type="text" accept-charset="UTF-8"    class="form-control" id="facility" placeholder=" ">
                                      </div>
                                  </div>
                                 <div class="form-group">
                                      <label  class="col-lg-2 control-label">Address</label>
                                      <div class="col-lg-6">
                                          <input type="text" accept-charset="UTF-8"    class="form-control" id="address" placeholder=" ">
                                      </div>
                                  </div>
                                 <div class="form-group">
                                      <label  class="col-lg-2 control-label">Town/City</label>
                                      <div class="col-lg-6">
                                          <input type="text" accept-charset="UTF-8"    class="form-control" id="city" placeholder=" ">
                                      </div>
                                  </div>
                                 <div class="form-group">
                                      <label  class="col-lg-2 control-label">Zip/Postal Code</label>
                                      <div class="col-lg-6">
                                          <input type="text" accept-charset="UTF-8"    class="form-control" id="zip" placeholder=" ">
                                      </div>
                                  </div>
                                 <div class="form-group">
                                      <label  class="col-lg-2 control-label">State/Province</label>
                                      <div class="col-lg-6">
                                          <input type="text" accept-charset="UTF-8"    class="form-control" id="state" placeholder=" ">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label  class="col-lg-2 control-label">Country</label>
                                      <div class="col-lg-6">
                                          <input type="text" accept-charset="UTF-8"    class="form-control" id="country" placeholder=" ">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label  class="col-lg-2 control-label">Inspection Period(in months)</label>
                                      <div class="col-lg-6">
                                          <input type="text" accept-charset="UTF-8"    class="form-control" id="term" placeholder=" ">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label  class="col-lg-2 control-label">Inspection Alert before(in months)</label>
                                      <div class="col-lg-6">
                                          <input type="text" accept-charset="UTF-8"    class="form-control" id="alertTerm" placeholder=" ">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label  class="col-lg-2 control-label">Enter the emails for the alert</label>
                                      <div class="col-lg-6">
                                          <input type="text" accept-charset="UTF-8"    class="form-control" id="alertEmail" placeholder=" ">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <div class="col-lg-offset-2 col-lg-10">
                                          <button type="submit" class="btn btn-primary">Save</button>
                                          <button type="button" class="btn btn-default reset">Cancel</button>
                                      </div>
                                  </div>
                                  <div class="alert alert-warning"  style="display:none" id="profileValidation"></div>
                              </form>
                          </div>
                      </section>
                      <section>
                          <div class="panel panel-primary">
                              <div class="panel-heading"> Set New Password </div>
                              <div class="panel-body">
                                  <form accept-charset="UTF-8"  class="form-horizontal" role="form" action="#" method="post">
                                      <div class="form-group">
                                          <label  class="col-lg-2 control-label">Current Password</label>
                                          <div class="col-lg-6">
                                              <input type="password" class="form-control" id="oldPwd" placeholder=" ">
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <label  class="col-lg-2 control-label">New Password</label>
                                          <div class="col-lg-6">
                                              <input type="password" class="form-control" id="newPwd" placeholder=" ">
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <label  class="col-lg-2 control-label">Re-type New Password</label>
                                          <div class="col-lg-6">
                                              <input type="password" class="form-control" id="rtPwd" placeholder=" ">
                                          </div>
                                      </div>

                                      <!--<div class="form-group">
                                          <label  class="col-lg-2 control-label">Change Avatar</label>
                                          <div class="col-lg-6">
                                              <input type="file" class="file-pos" id="exampleInputFile">
                                          </div>
                                      </div>-->

                                      <div class="form-group">
                                          <div class="col-lg-offset-2 col-lg-10">
                                              <button type="button" id="resetPass" class="btn btn-primary">Save</button>
                                              <button type="button" class="btn btn-default reset">Cancel</button>
                                          </div>
                                      </div>
                                      <div class="alert alert-warning"  style="display:none" id="resetValidation"></div>
                                  </form>
                              </div>
                          </div>
                      </section>
                  </aside>
              </div>

              <!-- page end-->
          </section>
<?php
 include 'footer.php'
?>
		<script type="text/JavaScript" src="include/js/init.js"></script>
		<script type="text/JavaScript" src="include/js/sha.js"></script>
    <script type="text/JavaScript" src="include/js/functions.js"></script>
<script>
$(document).ready(function(){
  $.ajax({
			type: "POST",
			url: init.host+"/backend/process_register.php",
			data: {_op:'getProfile'},
			dataType:"json",
			success: function(data) {
        if(data.error == 0){
					var data = data.user[0];
          $('#name').html(data.FirstName+' '+data.Lastname);
          $('#email').html(data.Email);
          $('#fname').val(data.FirstName);
          $('#lname').val(data.Lastname);
          $('#phone').val(data.Contact);
          $('#facility').val(data.Facility);
          $('#address').val(data.Address);
          $('#city').val(data.City);
          $('#zip').val(data.Zip);
          $('#state').val(data.State);
          $('#country').val(data.Country);
          $('#term').val(data.Term);
          $('#alertTerm').val(data.AlertTerm);
          $('#alertEmail').val(data.AlertEmail);
				}else{
					$('#profileValidation').addClass('alert-warning');
					$('#profileValidation').html("<div style='color:#DC143C;text-align:center'>"+data.msg+"</div>").show();
				}
			},
			error:function(res) {
				$('#profileValidation').addClass('alert-warning');
        $('#profileValidation').html("<div style='color:#DC143C;text-align:center'>Please try after some time.</div>").show();
			},	
  });
  $('#resetPass').click(function(e){
    e.preventDefault();
    var oldPassword = $('#oldPwd').val();
    var newPassword = $('#newPwd').val();
    var rtPassword = $('#rtPwd').val();;
    if(!oldPassword || !newPassword || !rtPassword){
      $('#resetValidation').removeClass('alert-warning').addClass('alert-danger');
      $('#resetValidation').html('<div style="color:#DC143C;text-align:center">You must provide all the requested details.</div>').show();
			return false;
		}
    if(newPassword !== rtPassword){
      $('#resetValidation').removeClass('alert-warning').addClass('alert-danger');
      $('#resetValidation').html('<div style="color:#DC143C;text-align:center">New Password does not match.</div>').show();
			return false;
    }
    oldPassword = hex_sha512(oldPassword);
    newPassword = hex_sha512(newPassword);
    var data ={};
    data['_op'] = 'resetPassword';
    data['ps'] = newPassword;
    data['os'] = oldPassword;
    $.ajax({
			type: "POST",
			url: init.host+"/backend/process_register.php",
			data: data,
			dataType:"json",
			success: function(data) {
        if(data.error == 0){
					$('#resetValidation').removeClass('alert-danger alert-warning').addClass('alert-success');
					$('#resetValidation').html("<div style='text-align:center'>Your password has been successfully changed</div>").show();
				}else{
					$('#resetValidation').addClass('alert-warning');
					$('#resetValidation').html("<div style='color:#DC143C;text-align:center'>"+data.msg+"</div>").show();
				}
			},
			error:function(res) {
				$('#resetValidation').addClass('alert-warning');
        $('#resetValidation').html("<div style='color:#DC143C;text-align:center'>Please try after some time.</div>").show();
			},	
		});
  });
$('#profileEdit').submit(function(e){
    e.preventDefault();
    var fname = $('#fname').val();
    var lname = $('#lname').val();
    var phone = $('#phone').val();
    var facility = $('#facility').val();
    var address = $('#address').val();
    var city = $('#city').val();
    var zip = $('#zip').val();
    var state = $('#state').val();
    var country = $('#country').val();
    var term = $('#term').val();
    var alertTerm = $('#alertTerm').val();
    var alertEmail = $('#alertEmail').val();
    if(!term || !alertTerm || !fname || !lname || !phone || !facility || !address || !city || !zip || !state || !country){
      $('#profileValidation').removeClass('alert-warning').addClass('alert-danger');
      $('#profileValidation').html('<div style="color:#DC143C;text-align:center">You must provide all the requested details.</div>').show();
			return false;
		}
    var data ={};
    data['_op'] = 'updateProfile';
    data['firstname'] = fname;
    data['lastname'] = lname;
    data['contact'] = phone;
    data['facility'] = facility;
    data['address'] = address;
    data['city'] = city;
    data['zip'] = zip;
    data['state'] = state;
    data['country'] = country;
    data['term'] = term;
    data['alertTerm'] = alertTerm;
    data['alertEmail'] = alertEmail;
    $.ajax({
			type: "POST",
			url: init.host+"/backend/process_register.php",
			data: data,
			dataType:"json",
			success: function(data) {
        if(data.error == 0){
					$('#profileValidation').removeClass('alert-danger alert-warning').addClass('alert-success');
					$('#profileValidation').html("<div style='text-align:center'>Your data has been successfully changed</div>").show();
				}else{
					$('#profileValidation').addClass('alert-warning');
					$('#profileValidation').html("<div style='color:#DC143C;text-align:center'>"+data.msg+"</div>").show();
				}
			},
			error:function(res) {
				$('#profileValidation').addClass('alert-warning');
        $('#profileValidation').html("<div style='color:#DC143C;text-align:center'>Please try after some time.</div>").show();
			},	
		});
  });
  $('.reset').click(function(e){
   e.preventDefault();
   window.location = 'profile.php';
  });
});
</script>
