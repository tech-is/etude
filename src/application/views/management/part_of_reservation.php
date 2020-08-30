<body>
  <div class="container-fruid">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card">
          <div class="management-card-header" style="text-align:center; background-color: #17a2b8; color: #ffffff; border-top-left-radius: .25rem;border-top-right-radius: .25rem; padding: .75rem 1.25rem;">
            <h3 class="card-title">受付（予約）情報</h3>
          </div>
          <form role="form" action="/index.php/Management/confirmation" method="post">
            <div class="card-body" >
              <div class="row">
                <ul class="col-6" style="text-align: right;">フリガナ：</ul>
                <ul class="col-6"><?php echo $booking_data['booker_yomi']; ?></ul>
                <ul class="col-6" style="text-align: right;">代表者氏名（参加者氏名１）：</ul>
                <ul class="col-6"><?php echo $booking_data['booker']; ?></ul>
                <ul class="col-6" style="text-align: right;">メールアドレス：</ul>
                <ul class="col-6"><?php echo $booking_data['booker_email']; ?></ul>
                <ul class="col-6" style="text-align: right;">代表者電話番号：</ul>
                <ul class="col-6"><?php echo $booking_data['booker_tel']; ?></ul>
                <ul class="col-6" style="text-align: right;">人数：</ul>
                <ul class="col-6"><?php echo $booking_data['people_num']; ?>人</ul>
                <ul class="col-6" style="text-align: right;">予約日時：</ul>
                <ul class="col-6"><?php echo $booking_data['booking_date']; ?> <?php echo date('G:i', strtotime($booking_data['start_time'])); ?>～<?php echo date('G:i', strtotime($booking_data['end_time'])); ?></ul>
                <?php if ($booking_data['people_num']== '1') : ?>
                  <?php if (!empty($visitor_data)) : ?>
                    <?php for ($value=1; $value < $booking_data['people_num']; $value++) :?>
                      <ul class="col-6" style="text-align: right;">参加者氏名<?php echo $visitor_data[$value]['number'];?>：</ul>
                      <ul class="col-6"><?php echo $visitor_data[$value]['name'];?></ul>
                    <?php endfor; ?>
                  <?php endif; ?>
                <?php endif; ?>
              </div><!-- /.row -->
            </div><!-- /.card-body -->
            <div class="card-footer" style="text-align:center">
              <button type="button" class="btn btn-secondary" onclick="history.back()">戻る</button>
            </div><!-- /.card-footer -->
          </form><!--/.form -->
        </div><!--/.card -->
      </div><!--/.col-md-6 -->
    </div><!-- /.row justify-content-center -->
  </div><!-- /.container-fluid -->
</body>
