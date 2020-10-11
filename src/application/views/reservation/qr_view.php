<body>
  <div class="container-fruid">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card">
          <div class="card-info">
            <div class="card-header">
              <h1 class=" card-title">受付時にこのQRコードを使用してください</h3>
            </div>
            <!-- トークンをjqueryでとれるようにするためだけの処理 -->
            <p hidden id="token"><?php echo($token); ?></p>
            <div class="text-center" id="output" val="aaaa" text="aaaa"></div>
            <div class="card-body">
              <!--テーブルは初期状態が100%でない-->
              <table class="confirmtable">
                <tr>
                  <th class="confirmtableth">予約者氏名：</th>
                  <td class="confirmtabletd"><?php if(!empty($booker))echo $booker; ?></td>
                </tr>
                <tr>
                  <th class="confirmtableth">フリガナ：</th>
                  <td class="confirmtabletd"><?php if(!empty($booker_yomi))echo $booker_yomi; ?></td>
                </tr>
                <tr>
                  <th class="confirmtableth">メールアドレス：</th>
                  <td class="confirmtabletd"><?php if(!empty($booker_email))echo $booker_email; ?>
                  </td>
                </tr>
                <tr>
                  <th class="confirmtableth">TEL：</th>
                  <td class="confirmtabletd"><?php if(!empty($booker_tel))echo $booker_tel; ?></td>
                  </td>
                </tr>
                <tr>
                  <th class="confirmtableth">人数：</th>
                  <td class="confirmtabletd"><?php if(!empty($people_num))echo $people_num; ?>人</td>
                </tr>
                <tr>
                  <th class="confirmtableth">予約日時：</th>
                  <td class="confirmtabletd">
                    <?php if(!empty($detail_date_info))echo($detail_date_info);?></td>
                </tr>
                <?php for($i=0;$i<$people_num-1;$i++){ ?>
                <tr>
                  <th class="confirmtableth">参加者<?php echo($i+2);?>：</th>
                  <td class="confirmtabletd"><?php echo($visitor[$i]['name']);?></td>
                </tr>
                <?php } ?>
              </table>
            </div>
            <!--/.card-body -->
          </div>
          <!--/.card-info -->
        </div>
        <!--/.card -->
      </div>
      <!--/.col -->
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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
  <script type="text/javascript" src="<?= base_url(); ?>jquery-qrcode-master/src/jquery.qrcode.js"></script>
  <script type="text/javascript" src="<?= base_url(); ?>jquery-qrcode-master/src/qrcode.js"></script>
  <script>
  // $(document.body).click(function(){
  //   alert($("#token").text());
  // });
  jQuery(function() {
    let qr;
    qr = jQuery('#token').text();
    // console.log(qr);
    jQuery('#output').qrcode(qr);
  })
  </script>
</body>

</html>