<body>
  <div class="container-fruid">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card">
          <div class="card-info">
            <div class="card-header">
              <h1 class="card-title">予約者情報入力</h1>
            </div>
            <ul class="cp_stepflow01">
              <li class="completed"><span class="bubble"></span>メールアドレス入力</li>
              <li class="completed"><span class="bubble"></span>希望日時入力</li>
              <li class="active"><span class="bubble"></span>予約者情報入力</li>
              <li class="bubble"><span class="bubble"></span>内容確認</li>
              <li class="bubble"><span class="bubble"></span>完了</li>
            </ul>
            <form method="post" role="form"
              action="<?php base_url();?>/Reservation/view_confirmation_reserve">
              <div class="card-body">
                <label for="booker_name">代表者氏名</label>
                <div class="row">
                  <div class="col-6">
                    <input class="form-control" name="booker_name" type="text" placeholder="田中太郎"
                      id="booker_name" value="<?php if(!empty($_SESSION['booker_name']))echo(html_escape($_SESSION['booker_name']));?>">
                  </div>
                  <!-- <div class="col-6">
                    <input class="form-control" name="first_name" type="text" placeholder="太郎"
                      id="first_name">
                  </div> -->
                </div>
                <label for="booker_yomi">代表者フリガナ</label>
                <div class="row">
                  <div class="col-6">
                    <input class="form-control" name="booker_yomi" type="text" placeholder="タナカタロウ"
                      id="booker_yomi" value="<?php if(!empty($_SESSION['booker_yomi']))echo(html_escape($_SESSION['booker_yomi']));?>">
                  </div>
                  <!-- <div class="col-6">
                    <input class="form-control" name="first_kana" type="text" placeholder="タロウ"
                      id="first_kana">
                  </div> -->
                </div>
                <label for="booker_tel">代表者電話番号</label>
                <div class="row">
                  <div class="col-6">
                    <input class="form-control" name="booker_tel" type="text"
                      placeholder="888-8888-8888" id="booker_tel" value="<?php if(!empty($_SESSION['booker_tel']))echo(html_escape($_SESSION['booker_tel']));?>">
                  </div>
                </div>
                <?php for($i=0;$i<$_SESSION['people_num']-1;$i++){ ?>
                <!-- 参加者は表示の際2からindexが開始するので$i+2 -->
                <label for="visitor">参加者<?php echo(html_escape($i+2)); ?>：</label>
                <div class="row">
                  <div class="col-6">
                    <!-- データベースに参加者はindexが1から始まるので$i+1 -->
                    <input class="form-control" type="text" placeholder="<?php echo(html_escape($_SESSION['sample_name'][$i])); ?>" id="visitor<?php echo(html_escape($i+1));?>" name="visitor<?php echo(html_escape($i+1));?>" value="<?php if(!empty($_SESSION['visitor'][$i+1]))echo(html_escape($_SESSION['visitor'][$i+1]));?>">
                  </div>
                  <!-- <div class="col-6">
                    <input class="form-control" type="text" placeholder="次郎"
                      id="visit_time">
                  </div> -->
                </div>
                <?php } ?>
              </div>
              <input type="hidden" name="<?php echo(html_escape($csrf_token_name));?>" value="<?php echo(html_escape($csrf_token_hash));?>">
              <!-- <input type="hidden" name="visit_date" value="<?php echo($booking_date); ?>">
              <input type="hidden" name="start_time" value="<?php echo($start_time); ?>">
              <input type="hidden" name="end_time" value="<?php echo($end_time); ?>">
              <input type="hidden" name="people_num" value="<?php echo($people_num); ?>">
              <input type="hidden" name="email" value="<?php echo($email); ?>"> -->
              <!--/.card-body -->
              <div class="card-footer" style="text-align:center">
                <button type="button" class="btn btn-secondary" onclick="location.href='view_detail_input_reserve'" >戻る</button>
                <button type="submit" class="btn btn-primary">次へ</button>
              </div>
            </form>
          </div><!--/.card-info-->
        </div><!-- /.card-->
      </div><!--/.col-md-6-->
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