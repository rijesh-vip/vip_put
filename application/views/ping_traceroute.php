<div class="col-md-9">
  <div class="hero-unit">
    <h1>Ping test network connectivity to a server</h1>
    <p>Enter a host name or IP address to perform a Ping or a Traceroute.</p>
    <p><a href="#" class="btn btn-primary btn-large">Learn more &raquo;</a></p>
  </div>
  <div class="row">
    <div class="col-md-12">
      <!-- To use feedback icons, ensure that you use Bootstrap v3.1.0 or later -->
      <form action="<?php echo site_url('ping')?>" id="registrationForm" method="post" class="form-horizontal"
          data-bv-feedbackicons-valid="glyphicon glyphicon-ok"
          data-bv-feedbackicons-invalid="glyphicon glyphicon-remove"
          data-bv-feedbackicons-validating="glyphicon glyphicon-refresh">

          <div class="form-group col-sm-12">
              <label class="col-sm-3 control-label">Domain</label>
              <div class="col-sm-3">
                  <input type="text" class="form-control" name="domain_name"
                      data-bv-notempty="true"
                      data-bv-notempty-message="Domain name is required and cannot be empty"
                      data-bv-regexp="true"
                      data-bv-regexp-regexp="^[a-zA-Z0-9.]+$"
                      data-bv-regexp-message="Enter valid domain name"
                   />
              </div>
              <div class="col-sm-6">
                  <div class="radio">
                      <label>
                          <input type="radio" name="action_type" value="ping"
                          data-bv-notempty="true"
                          data-bv-notempty-message="Action type is required" /> Ping
                      </label>
                  </div>
                  <div class="radio">
                      <label>
                          <input type="radio" name="action_type" value="traceroute" /> Traceroute
                      </label>
                  </div>
              </div>
          </div>
          <div class="form-group col-sm-12">
              <div class="col-sm-12 col-sm-offset-3">
                  <!-- Do NOT use name="submit" or id="submit" for the Submit button -->
                  <button type="submit" class="btn btn-default">Check</button>
              </div>
          </div>
      </form>
    </div><!--/span-->
    <div class="row col-sm-12">
        <div id="result_data" class="row">
        </div>
    </div>
  </div><!--/row-->
</div><!--/span-->
<script>
$(document).ready(function() {
    $('#registrationForm').bootstrapValidator()
    .on('success.form.bv', function(e) {
            // Prevent form submission
            e.preventDefault();

            // Get the form instance
            var $form = $(e.target);

            // Get the BootstrapValidator instance
            var bv = $form.data('bootstrapValidator');

            //Loading
            $('#result_data').html("Connecting...");

            // Use Ajax to submit form data
            $.post($form.attr('action'), $form.serialize(), function(result) {
                $('#result_data').html(result);
            });
        });
});
</script>