<body>
  <div class="container-fruid">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card">
          <div class="card-info">
            <div class="card-header">
              <h3 class="card-title">予約内容を確認してください</h3>
            </div>
              <ul class="cp_stepflow01">
                <li class="completed"><span class="bubble"></span>利用規約等確認</li>
                <li class="completed"><span class="bubble"></span>おねがい</li>
                <li class="completed"><span class="bubble"></span>QR受付</li>
                <li class="active"><span class="bubble"></span>予約内容確認</li>
                <li class="completed"><span class="bubble"></span>内容変更</li>
                <li class="completed"><span class="bubble"></span>変更内容確認</li>
                <li class="completed"><span class="bubble"></span>検温</li>
                <li class="completed"><span class="bubble"></span>案内</li>
                <li><span class="bubble"></span>全員終了</li>
              </ul>
              <form role="form">
                <div class="card-body">
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
                    <ul class="col-6"><?php echo htmlspecialchars($booking_data['people_num']); ?>人</ul>
                    <ul class="col-6" style="text-align: right;">予約日時：</ul>
                    <ul class="col-6"><?php echo htmlspecialchars($booking_data['booking_date']); ?> <?php echo htmlspecialchars(date('G:i', strtotime($booking_data['start_time']))); ?>～<?php echo htmlspecialchars(date('G:i', strtotime($booking_data['end_time']))); ?></ul>
                    <?php if ($booking_data['people_num']!= 1) : ?>
                      <?php if (!empty($visitor_data)) : ?>
                        <?php for ($value=1; $value < $booking_data['people_num']; $value++) :?>
                          <ul class="col-6" style="text-align: right;">参加者氏名<?php echo htmlspecialchars($visitor_data[$value]['number']);?>：</ul>
                          <ul class="col-6"><?php echo htmlspecialchars($visitor_data[$value]['name']);?></ul>
                        <?php endfor; ?>
                      <?php endif; ?>
                    <?php endif; ?>
                  </div><!-- /.row -->
                </div><!-- /.card-body -->
                <input type="hidden" name="<?php echo(html_escape($csrf_token_name));?>" value="<?php echo(html_escape($csrf_token_hash));?>">
                <div class="card-footer" style="text-align:center">
                  <p class="text-danger" style="text-align:center">予約時間の変更や、人数を増やす変更はできません。</p>
                  <button type="button" class="btn btn-secondary" onclick="location.href='<?php base_url(); ?>/Group_adv/change/'">変更する</button>
                  <button type="button" class="btn btn-primary" onclick="location.href='<?php base_url(); ?>/Group_adv/temperature_measurement/'">検温へ</button>
                </div><!-- /.card-footer -->
              </form>
          </div><!--/.card-info -->
        </div><!--/.card -->
      </div><!--/.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</body>
