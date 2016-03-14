<?php
  include 'header.php';
?>
  <div class="row">
    <div class="col-lg-12">
      <section class="panel">
        <header class="panel-heading">
          Contact Us
        </header>
        <div class="panel-body">
          <div class="row">
            <div class="col-lg-5 col-sm-5 address">
              <h4>Meet Us</h4>
              <p>
                S303-A, Kiran Chambers, <br/>
                Linking Road, Khar, <br/>
                Mumbai, 400052, <br/>
                India.
              </p>
              <br>
              <br>
              <br>
              <p>
                Phone &nbsp;:&nbsp; &nbsp;&nbsp;&nbsp;<span class="muted">+91 22 26007090</span><br/>
                Fax &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;&nbsp;&nbsp;&nbsp;<span class="muted">+91 22 26007093</span><br/>
                Email &nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp; <span class="muted">support@cope.kiranxray.com</span>
              </p>
            </div>
            <div class="col-lg-7 col-sm-7 address">
              <h4>Send a Message</h4>
              <div class="contact-form">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" placeholder="" id="name" class="form-control">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" placeholder="" id="email" class="form-control">
                </div>
                <div class="form-group">
                    <label for="subject">Subject</label>
                    <input type="text" id="subject" class="form-control">
                </div>
                <div class="form-group">
                    <label for="message">Message</label>
                    <textarea placeholder="Your message goes here..." rows="5" id="message" class="form-control"></textarea>
                </div>
                <button id="submitContact" class="btn btn-danger" type="submit">Submit</button>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </div>
<?php
 include 'footer.php';
?>
<script>
  $(document).ready(function(){
    $(document).delegate('#submitContact','click',function(e){
      e.preventDefault();
      if($('#name').val() == "" || $('#subject').val() == '' || $('#email').val() == '' || $('#message').val() == ''){
        updateModel('All fields are mandatory.');
        return;
      }
      if(!validateEmail($('#email').val())){
        updateModel('Please enter a valide email-id.');
        return;
      }
      $(this).text('Processing');
      var data= {};
      data['_op'] = 'inquiry';
      data['name'] = $('#name').val();
      data['subject'] = $('#subject').val();
      data['email'] = $('#email').val();
      data['message'] = $('#message').val();
      handler("backend/processing.php",data,inquirySubmitted,'');
    });
  });
  function inquirySubmitted(data){
    if(!!data && data.error == 0){
      $('#name').val('');
      $('#subject').val('');
      $('#email').val('');
      $('#message').val('');
    }
    $('#submitContact').text('Submit');
    updateModel(data.message);
  }
</script>