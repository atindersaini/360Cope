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
                              <li class="active"><a href="profile.php"> <i class="icon-user"></i> Profile</a></li>
                              <!--<li><a href="profile-activity.html"> <i class="icon-calendar"></i> Recent Activity <span class="label label-danger pull-right r-activity">9</span></a></li>-->
                              <li><a href="profile-edit.php"> <i class="icon-edit"></i> Edit profile</a></li>
                          </ul>

                      </section>
                  </aside>
                  <aside class="profile-info col-lg-9">
                      
                      <section class="panel">
                          <div class="bio-graph-heading">
                              A comprehensive view of your complete information with 360Copé.
                          </div>
                          <div class="panel-body bio-graph-info">
                              <h1>Bio Graph</h1>
                              <div class="row">
                                  <div class="bio-row">
                                      <p><span>First Name </span>:  <span id="fname"></span></p>
                                  </div>
                                  <div class="bio-row">
                                      <p><span>Last Name </span>:  <span id="lname"></span></p>
                                  </div>
                                  <div class="bio-row">
                                      <p><span>Email </span>:  <span id="email2"></span></p>
                                  </div>
                                  <div class="bio-row">
                                      <p><span>Phone </span>:  <span id="phone"></span></p>
                                  </div>
                                  <div class="bio-row">
                                      <p><span>Facility </span>:  <span id="facility"></span></p>
                                  </div>
                                  <div class="bio-row">
                                      <p><span>Address</span>: <span id="address"></span></p>
                                  </div>
                                  <div class="bio-row">
                                      <p><span>Town/City</span>:  <span id="city"></span></p>
                                  </div>
                                  <div class="bio-row">
                                      <p><span>Zip/Postal Code</span>:  <span id="zip"></span></p>
                                  </div>
                                  <div class="bio-row">
                                      <p><span>State/Province </span>:  <span id="state"></span></p>
                                  </div>
                                  
                                  <div class="bio-row">
                                      <p><span>Country </span>:  <span id="country"></span></p>
                                  </div>
                              </div>
                          </div>
                      </section>
                      <!--<section>
                          <div class="row">
                              <div class="col-lg-6">
                                  <div class="panel">
                                      <div class="panel-body">
                                          <div class="bio-chart">
                                              <input class="knob" data-width="100" data-height="100" data-displayPrevious=true  data-thickness=".2" value="35" data-fgColor="#e06b7d" data-bgColor="#e8e8e8">
                                          </div>
                                          <div class="bio-desk">
                                              <h4 class="red">Envato Website</h4>
                                              <p>Started : 15 July</p>
                                              <p>Deadline : 15 August</p>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                              <div class="col-lg-6">
                                  <div class="panel">
                                      <div class="panel-body">
                                          <div class="bio-chart">
                                              <input class="knob" data-width="100" data-height="100" data-displayPrevious=true  data-thickness=".2" value="63" data-fgColor="#4CC5CD" data-bgColor="#e8e8e8">
                                          </div>
                                          <div class="bio-desk">
                                              <h4 class="terques">ThemeForest CMS </h4>
                                              <p>Started : 15 July</p>
                                              <p>Deadline : 15 August</p>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                              <div class="col-lg-6">
                                  <div class="panel">
                                      <div class="panel-body">
                                          <div class="bio-chart">
                                              <input class="knob" data-width="100" data-height="100" data-displayPrevious=true  data-thickness=".2" value="75" data-fgColor="#96be4b" data-bgColor="#e8e8e8">
                                          </div>
                                          <div class="bio-desk">
                                              <h4 class="green">VectorLab Portfolio</h4>
                                              <p>Started : 15 July</p>
                                              <p>Deadline : 15 August</p>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                              <div class="col-lg-6">
                                  <div class="panel">
                                      <div class="panel-body">
                                          <div class="bio-chart">
                                              <input class="knob" data-width="100" data-height="100" data-displayPrevious=true  data-thickness=".2" value="50" data-fgColor="#cba4db" data-bgColor="#e8e8e8">
                                          </div>
                                          <div class="bio-desk">
                                              <h4 class="purple">Adobe Muse Template</h4>
                                              <p>Started : 15 July</p>
                                              <p>Deadline : 15 August</p>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </section>-->
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
          $('#email2').html(data.Email);
          $('#fname').html(data.FirstName);
          $('#lname').html(data.Lastname);
          $('#phone').html(data.Contact);
          $('#facility').html(data.Facility);
          $('#address').html(data.Address);
          $('#city').html(data.City);
          $('#zip').html(data.Zip);
          $('#state').html(data.State);
          $('#country').html(data.Country);
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
</script>
