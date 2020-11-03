<body>
  <div class="container-fruid">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card">
          <div class="card-info">
            <div class="card-header">
              <h3 class="card-title">予約内容は以下の通りです</h3>
            </div>
              <ul class="cp_stepflow01">
                <li class="completed"><span class="bubble"></span>利用規約等確認</li>
                <li class="completed"><span class="bubble"></span>おねがい</li>
                <li class="completed"><span class="bubble"></span>QR受付</li>
                <li class="active"><span class="bubble"></span>予約内容確認</li>
                <li class="active"><span class="bubble"></span>終了</li>
              </ul>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form">
                <input type="hidden" name="<?php echo(html_escape($csrf_token_name));?>" value="<?php echo(html_escape($csrf_token_hash));?>">
                <div class="card-footer text-center">
                  <!-- <?php $message = $_SESSION['error_message']?> -->
                  <p class="text-danger" style="text-align:center"><small>大変申し訳ございませんが、<?php echo htmlspecialchars($_SESSION['error_message_1']);?></small></p>
                  <p class="text-danger" style="text-align:center"><small><?php echo htmlspecialchars($_SESSION['error_message_2']);?></small></p>
                  <button type="button" class="btn btn-primary" onclick="location.href='<?php base_url(); ?>/Group_adv/'">終了</button>
                </div><!-- card-footer -->
              </form>
          </div><!--/.card-info -->
        </div><!--/.card -->
      </div><!--/.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</body>
