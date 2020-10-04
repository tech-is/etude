<body>
  <div class="container-fruid">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card">
          <div class="card-info">
            <div class="card-header">
              <h1 class="card-title">希望日時入力</h1>
            </div>
            <ul class="cp_stepflow01">
              <li class="completed"><span class="bubble"></span>メールアドレス入力</li>
              <li class="completed"><span class="bubble"></span>希望日時入力</li>
              <li class="completed"><span class="bubble"></span>予約者情報入力</li>
              <li class="completed"><span class="bubble"></span>内容確認</li>
              <li class="active"><span class="bubble"></span>完了</li>
            </ul>
            <div class="card-body text-center">
              <p>登録完了しました</br>来店お待ちしております。</p>
              <p>登録されたメールに入店時に必要なQRコードと予約情報のリンクを送りました。ご確認ください</p>
            </div>
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