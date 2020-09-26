<body class="hold-transition login-page">
  <div class="login-box" >
    <div class="login-logo"style="background-color:#17a2b8; margin-bottom:0; border-radius:0.25rem 0.25rem 0 0;">
      <a style="color:#ffffff;"><b>etude</b>管理システム</a>
    </div>
    <div class="card" >
      <div class="card-body login-card-body" style="border-radius:0 0 0.25rem 0.25rem;">
        <p class="login-box-msg">パスワードを入力してください</p>
        <form id="form">
          <div class="input-group mb-3">
            <input id="admin_password" type="password" name="admin_password" value="" class="form-control" placeholder="Password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row" >
            <div class="col-4" style="margin: 0 auto;">
              <button type="submit" class="btn btn-primary btn-block">Sign In</button>
            </div>
          </div>
        </form>
        <script src="<?= base_url(); ?>AdminLTE-3.0.5/plugins/jquery/jquery.min.js"></script>
        <script>
            $('#form').on('submit',function() {
                event.preventDefault();
                $.ajax({
                    url: '/index.php/management/Auth_check',
                    type: 'POST',
                    data: {
                        'admin_password':$('#admin_password').val()
                    },
                    datatype: 'json'
                }).then(
                function (data) {
                    window.location.href = "/index.php/management/all_display";
                },
                function (error) {
                    let err_msg = JSON.parse(error.responseText);
                    alert(err_msg.message);
                })
            });
        </script>
      </div><!-- /.card-body login-card-body -->
    </div><!-- /.card -->
  </div><!-- /.login-box -->
</body>
