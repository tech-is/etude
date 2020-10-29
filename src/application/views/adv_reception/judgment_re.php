<body>
  <div class="container-fruid">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card">
          <div class="card-info">
              <div class="card-header">
                <h3 class="card-title">ご案内</h3>
              </div>
              <ul class="cp_stepflow01">
              <li class="completed"><span class="bubble"></span>利用規約等確認</li>
              <li class="completed" ><span class="bubble"></span>おねがい</li>
              <li class="completed"><span class="bubble"></span>QR受付</li>
              <li class="completed"><span class="bubble"></span>予約内容確認</li>
              <li class="completed"><span class="bubble"></span>内容変更</li>
              <li class="completed"><span class="bubble"></span>変更内容確認</li>
              <li class="completed"><span class="bubble"></span>検温</li>
              <li class="active"><span class="bubble"></span>案内</li>
              <li><span class="bubble"></span>全員終了</li>
            </ul>
              <?php if($_SESSION['last_number_flag']==true){ ?>
              <form role="form" action="/Group_adv/measurement_finish" method="post">
              <?php }else{ ?>
              <form role="form" action="/Group_adv/temperature_measurement" method="post">
              <?php } ?>
              <!-- 検温結果を受け取る -->
              <?php if($value<37.5){ ?>
                <div class="card-body">
                    <p class="text-danger" style="text-align:center">検温のご協力ありがとうございました</p>
                    <p class="text-danger" style="text-align:center">ご入館ください</p>
                </div>
              <?php }else{ ?>
                <div class="card-body" >
                    <p class="text-danger" style="text-align:center">体温が37.5度を超える方は、</p>
                    <p class="text-danger" style="text-align:center">入館をお断りしております。</p>
                    <p class="text-danger" style="text-align:center">従業員の誘導に従い、</p>
                    <p class="text-danger" style="text-align:center">再測定にご協力ください。</p>
                </div><!-- /.card-body -->
              <?php } ?>
                <div class="card-footer" style="text-align:center">
                <?php if($_SESSION['last_number_flag']==true){ ?>
                  <button type="submit" class="btn btn-primary" name="finish">完了</button>
                <?php }else{ ?>
                  <button type="submit" class="btn btn-primary" name="within_range">OK！次の人へ</button>
                <?php } ?>
                </div>
              </form>
          </div><!-- /.card-info -->
        </div><!-- /.card -->
      </div><!-- /.col-md-6 -->
    </div><!-- /.row justify-content-center -->
  </div><!-- /.container-fruid -->
</body>
</html>
