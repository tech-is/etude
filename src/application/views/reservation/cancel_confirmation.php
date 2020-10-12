<body>
  <div class="container-fruid">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card">
          <div class="card-info">
            <div class="card-header">
              <h1 class="card-title">予約キャンセル確認</h1>
            </div>
            <form method="post" role="form" action = "<?php base_url();?>/Reservation/delete_reserve_data">
              <div class="card-body">
                <!--テーブルは初期状態が100%でない-->
                <table class="confirmtable">
                  <tr>
                    <th class="confirmtableth" >予約者氏名：</th>
                    <td class="confirmtabletd"><?php if(!empty($booker))echo $booker; ?></td>
                  </tr>
                  <tr>
                    <th class="confirmtableth">フリガナ：</th>
                    <td class="confirmtabletd"><?php if(!empty($booker_yomi))echo $booker_yomi; ?></td>
                  </tr>
                  <tr>
                    <th class="confirmtableth" >メールアドレス：</th>
                    <td class="confirmtabletd"><?php if(!empty($booker_email))echo $booker_email; ?></td>
                  </tr>
                  <tr>
                    <th class="confirmtableth" >TEL：</th>
                    <td class="confirmtabletd"><?php if(!empty($booker_tel))echo $booker_tel; ?></td></td>
                  </tr>
                  <tr>
                    <th class="confirmtableth" >人数：</th>
                    <td class="confirmtabletd"><?php if(!empty($people_num))echo $people_num; ?>人</td>
                  </tr>
                  <tr>
                    <th class="confirmtableth" >予約日時：</th>
                    <td class="confirmtabletd"><?php if(!empty($detail_date_info))echo($detail_date_info);?></td>
                  </tr>
                  <?php for($i=0;$i<$people_num-1;$i++){ ?>
                  <tr>
                    <th class="confirmtableth" >参加者<?php echo($i+2);?>：</th>
                    <td class="confirmtabletd"><?php echo($visitor_data[$i+1]['name']);?></td>
                  </tr>
                  <?php } ?>
                </table>
                <p style="color:red">以下のボタンを押すと削除が完了します。</p>
              </div><!--/.card-body -->
              <input type="hidden" name="token" value=<?php echo($token); ?>>
              <!-- csrfチェック -->
              <input type="hidden" name="<?php echo($csrf_token_name);?>" value="<?php echo($csrf_token_hash);?>">
              <div class="card-footer" style="text-align:center">
                <button type="submit" class="btn btn-primary">予約を削除する</button>
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