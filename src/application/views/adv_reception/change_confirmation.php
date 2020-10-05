<body>
  <div class="container-fruid">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card">
          <div class="card-info">
            <div class="card-header">
              <h3 class="card-title">変更内容を確認してください</h3>
            </div>
              <ul class="cp_stepflow01">
                <li class="completed"><span class="bubble"></span>利用規約等確認</li>
                <li class="completed"><span class="bubble"></span>おねがい</li>
                <li class="completed"><span class="bubble"></span>QR受付</li>
                <li class="completed"><span class="bubble"></span>予約内容確認</li>
                <li class="completed"><span class="bubble"></span>内容変更</li>
                <li class="active"><span class="bubble"></span>変更内容確認</li>
                <li class="completed"><span class="bubble"></span>検温</li>
                <li class="completed"><span class="bubble"></span>案内</li>
                <li><span class="bubble"></span>全員終了</li>
              </ul>
              <form role="form" action="/index.php/Group/modify_data_temperature_measurement"method="post">
                <div class="card-body" >
                  <div class="row">
                    <ul class="col-6" style="text-align: right;">フリガナ：</ul>
                    <ul class="col-6"><?php echo htmlspecialchars($booking_data['booker_yomi']); ?></ul>
                    <ul class="col-6" style="text-align: right;">代表者氏名（参加者氏名１）：</ul>
                    <ul class="col-6"><?php echo htmlspecialchars($booking_data['booker']); ?></ul>
                    <ul class="col-6" style="text-align: right;">メールアドレス：</ul>
                    <ul class="col-6"><?php echo htmlspecialchars($booking_data['booker_email']); ?></ul>
                    <ul class="col-6" style="text-align: right;">代表者電話番号：</ul>
                    <ul class="col-6"><?php echo htmlspecialchars($booking_data['booker_tel']); ?></ul>
                    <ul class="col-6" style="text-align: right;">人数：</ul>
                    <ul class="col-6"><?php echo htmlspecialchars($_SESSION['people_num']); ?>人</ul>
                    <ul class="col-6" style="text-align: right;">予約日時：</ul>
                    <ul class="col-6"><?php echo htmlspecialchars($booking_data['booking_date']); ?> <?php echo htmlspecialchars(date('G:i', strtotime($booking_data['start_time']))); ?>～<?php echo htmlspecialchars(date('G:i', strtotime($booking_data['end_time']))); ?></ul>
                    <?php if ($_SESSION['people_num'] != 1) : ?>
                      <?php for ($value=2; $value <= 5; $value++) :?>
                        <?php if(!empty($_SESSION['check_flag'][$value])) : ?>
                          <?php $num = $value-1; ?>
                          <ul class="col-6" style="text-align: right;">参加者氏名<?php echo htmlspecialchars($value);?>：</ul>
                          <ul class="col-6"><?php echo htmlspecialchars($_SESSION["name{$num}"]);?></ul>
                        <?php endif; ?>
                      <?php endfor; ?>
                    <?php endif; ?>
                  </div>
                </div><!-- /.card-body -->
                <div class="card-footer" style="text-align:center">
                  <button type="button" class="btn btn-secondary" onclick="history.back()">戻る</button>
                  <button type="submit" class="btn btn-primary" onclick="location.href='/index.php/Group/modify_data_temperature_measurement?id=<?php echo htmlspecialchars($booking_data['id']); ?>'">変更内容の登録、検温へ</button>
                  <input type="hidden" name="id" value="<?php echo htmlspecialchars($booking_data['id']); ?>">
                  <input type="hidden" name="people_num" value="<?php echo htmlspecialchars($booking_data['people_num']); ?>">
                  <!-- <?php if ($_SESSION['people_num'] != 1) : ?> -->
                      <?php for ($value=2; $value <= 5; $value++) :?>
                        <?php if(!empty($_SESSION['check_flag'][$value])) : ?>
                          <?php $num = $value-1; ?>
                          <!-- <ul class="col-6" style="text-align: right;">参加者氏名<?php echo htmlspecialchars($value);?>：</ul> -->
                          <input type="hidden" name="number[<?php echo htmlspecialchars($value);?>]" value="$value">
                          <!-- <ul class="col-6"><?php echo htmlspecialchars($_SESSION["name{$num}"]);?></ul> -->
                          <?php $name = $_SESSION["name{$num}"]?>
                          <input type="hidden" name="name[<?php echo htmlspecialchars($value);?>]" value="<?php echo htmlspecialchars($name);?>">
                        <?php endif; ?>
                      <?php endfor; ?>
                    <!-- <?php endif; ?> -->
                </div>
              </form>
          </div><!--/.card-info -->
        </div><!--/.card -->
      </div><!--/.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</body>
