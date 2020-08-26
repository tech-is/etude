<body>
  <div class="container-fruid">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card">
          <div class="card-info">
            <div class="card-header">
              <h1 class="card-title">登録内容確認</h1></h3>
            </div>
            <ul class="cp_stepflow01">
              <li class="completed"><span class="bubble"></span>メールアドレス入力</li>
              <li class="completed"><span class="bubble"></span>希望日時入力</li>
              <li class="completed"><span class="bubble"></span>予約者情報入力</li>
              <li class="active"><span class="bubble"></span>登録内容確認</li>
              <li class="bubble"><span class="bubble"></span>完了</li>
            </ul>
            <form role="form" action = "<?php base_url();?>/index.php/Reservation/view_complete">
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
                    <td class="confirmtabletd">aaaaaaaa@bbbbb.mail</td>
                  </tr>
                  <tr>
                    <th class="confirmtableth" >TEL：</th>
                    <td class="confirmtabletd"><?php if(!empty($booker_tel))echo $booker_tel; ?></td></td>
                  </tr>
                  <tr>
                    <th class="confirmtableth" >人数：</th>
                    <td class="confirmtabletd">3人</td>
                  </tr>
                  <tr>
                    <th class="confirmtableth" >予約日時：</th>
                    <td class="confirmtabletd">2020/06/30  10:00 ~ 15:00</td>
                  </tr>
                  <?php for($i=0;$i<$people_num-1;$i++){ ?>
                  <tr>
                    <th class="confirmtableth" >参加者<?php echo($i+2);?>：</th>
                    <td class="confirmtabletd">松山　太郎</td>
                  </tr>
                  <?php } ?>
                </table>
              </div><!--/.card-body -->
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