<body>
  <div class="container-fruid">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card">
          <div class="card-info">
            <div class="card-header">
              <h1 class="card-title">メールアドレス入力</h1>
            </div>
            <ul class="cp_stepflow01">
              <li class="active"><span class="bubble"></span>メールアドレス入力</li>
              <li class="bubble"><span class="bubble"></span>希望日時入力</li>
              <li class="bubble"><span class="bubble"></span>予約者情報入力</li>
              <li class="bubble"><span class="bubble"></span>内容確認</li>
              <li class="bubble"><span class="bubble"></span>完了</li>
            </ul>
            <img src="<?= base_url(); ?>assets/onegai.jpg" alt="お願い画面">
            <!-- <form role="form" action = "/index.php/Reservation/view_detail_input_reserve"> -->
            <form  method="post" role="form" action = "/index.php/Mail">
              <div class="card-body">
                <div class="form-group">
                   <label for="exampleInputEmail1">メールアドレス</label>
                  <input type="email" name="Email"class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                </div>
                <div class="form-group">
                   <label for="exampleInputEmail2">メールアドレス再入力</label>
                  <input type="email" name="Email2"class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                </div>
              </div><!--/.card-body -->
              <p class="text-center">
              以下のボタンを押すと入力したメールアドレスに予約情報入力ページへのURLが送られます。</br>利用を開始することで利用規約およびプライバシー
に同意するものとします。
              </p>
              <div class="card-footer" style="text-align:center">
                <button type="submit" class="btn btn-primary">送信</button>
              </div><!--/.card-footer -->
            </form>
          </div><!--/.card-info -->
        </div><!--/.card -->
      </div><!--/.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
  <!-- jQuery -->
  <script src="<?= base_url(); ?>AdminLTE-3.0.5/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="<?= base_url(); ?>AdminLTE-3.0.5/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- bs-custom-file-input -->
  <script src="<?= base_url(); ?>AdminLTE-3.0.5/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?= base_url(); ?>AdminLTE-3.0.5/dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="<?= base_url(); ?>AdminLTE-3.0.5/dist/js/demo.js"></script>
  <script type="text/javascript">
  $(document).ready(function() {
    bsCustomFileInput.init();
  });
  </script>
</body>
</html>