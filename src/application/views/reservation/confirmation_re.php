<body>
  <div class="container-fruid">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card">
          <div class="card-info">
            <div class="card-header">
              <h1 class="card-title">登録内容確認</h1>
            </div>
            <ul class="cp_stepflow01">
              <li class="completed"><span class="bubble"></span>メールアドレス入力</li>
              <li class="completed"><span class="bubble"></span>希望日時入力</li>
              <li class="completed"><span class="bubble"></span>予約者情報入力</li>
              <li class="active"><span class="bubble"></span>登録内容確認</li>
              <li class="bubble"><span class="bubble"></span>完了</li>
            </ul>
            <form method="post" role="form" action = "<?php base_url();?>/Reservation/view_complete">
              <div class="card-body">
                <!--テーブルは初期状態が100%でない-->
                <table class="confirmtable">
                  <tr>
                    <th class="confirmtableth" >予約者氏名：</th>
                    <td class="confirmtabletd"><?php if(!empty($_SESSION['booker_name']))echo(html_escape($_SESSION['booker_name'])); ?></td>
                  </tr>
                  <tr>
                    <th class="confirmtableth">フリガナ：</th>
                    <!-- <td class="confirmtabletd"><?php if(!empty($booker_yomi))echo $booker_yomi; ?></td> -->
                    <td class="confirmtabletd"><?php if(!empty($_SESSION['booker_yomi']))echo(html_escape($_SESSION['booker_yomi'])); ?></td>
                  </tr>
                  <tr>
                    <th class="confirmtableth" >メールアドレス：</th>
                    <!-- <td class="confirmtabletd"><?php if(!empty($booker_email))echo $booker_email; ?></td> -->
                    <td class="confirmtabletd"><?php if(!empty($_SESSION['booker_email']))echo(html_escape($_SESSION['booker_email'])); ?></td>
                  </tr>
                  <tr>
                    <th class="confirmtableth" >TEL：</th>
                    <!-- <td class="confirmtabletd"><?php if(!empty($booker_tel))echo $booker_tel; ?></td></td> -->
                    <td class="confirmtabletd"><?php if(!empty($_SESSION['booker_tel']))echo(html_escape($_SESSION['booker_tel'])); ?></td>
                  </tr>
                  <tr>
                    <th class="confirmtableth" >人数：</th>
                    <!-- <td class="confirmtabletd"><?php if(!empty($people_num))echo $people_num; ?>人</td> -->
                    <td class="confirmtabletd"><?php if(!empty($_SESSION['people_num']))echo(html_escape($_SESSION['people_num'])); ?></td>
                  </tr>
                  <tr>
                    <th class="confirmtableth" >予約日時：</th>
                    <!-- <td class="confirmtabletd"><?php if(!empty($detail_visit_info))echo($detail_visit_info);?></td> -->
                    <td class="confirmtabletd"><?php if(!empty($_SESSION['detail_visit_info']))echo(html_escape($_SESSION['detail_visit_info'])); ?></td>
                  </tr>
                  <?php for($i=0;$i<$_SESSION['people_num']-1;$i++){ ?>
                  <tr>
                    <th class="confirmtableth" >参加者<?php echo($i+2);?>：</th>
                    <td class="confirmtabletd"><?php echo(html_escape($_SESSION['visitor'][$i+1]));?></td>
                  </tr>
                  <?php } ?>
                </table>
                <p style="color:red" class="text-center">以下の完了ボタンを押すと予約が確定されます。</p>
              </div><!--/.card-body -->
              <!-- csrfチェック -->
              <input type="hidden" name="<?php echo(html_escape($csrf_token_name));?>" value="<?php echo(html_escape($csrf_token_hash));?>">
              <div class="card-footer" style="text-align:center">
                <button type="button" class="btn btn-secondary" onclick="location.href='view_name_input_reserve'">戻る</button>
                <button type="submit" class="btn btn-primary">完了</button>
              </div><!--/.card-footer -->
            </form>
          </div><!--/.card-info -->
        </div><!--/.card -->
      </div><!--/.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
  <script src="<?= base_url(); ?>fullcalendar-4.4.2/packages/core/locales-all.js"></script>
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