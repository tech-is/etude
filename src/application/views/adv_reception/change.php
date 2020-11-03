<body>
  <div class="container-fruid">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card">
          <div class="card-info">
            <div class="card-header">
              <h3 class="card-title">内容を変更してください</h3>
            </div>
              <ul class="cp_stepflow01">
                <li class="completed"><span class="bubble"></span>利用規約等確認</li>
                <li class="completed"><span class="bubble"></span>おねがい</li>
                <li class="completed"><span class="bubble"></span>QR受付</li>
                <li class="completed"><span class="bubble"></span>予約内容確認</li>
                <li class="active"><span class="bubble"></span>内容変更</li>
                <li class="completed"><span class="bubble"></span>変更内容確認</li>
                <li class="completed"><span class="bubble"></span>検温</li>
                <li class="completed"><span class="bubble"></span>案内</li>
                <li><span class="bubble"></span>全員終了</li>
              </ul>
              <form role="form" action="<?php base_url(); ?>/Group/change_confirmation" method="post">
                <div class="card-body" >
                  <p class="text-danger" style="text-align:center"><small>予約時間の変更はできません</small></p>
                  <div class="row">
                  <ul class="col-5" style="text-align: right;">予約日時：</ul>
                  <ul class="col-7"><?php echo htmlspecialchars($booking_data['booking_date']); ?> <?php echo htmlspecialchars(date('G:i', strtotime($booking_data['start_time']))); ?>～<?php echo htmlspecialchars(date('G:i', strtotime($booking_data['end_time']))); ?></ul>
                </div><!-- card-body -->
                <p class="text-danger" style="text-align:center"><small>キャンセルされる方は、名前の横の✅の✔を外してください</small></p>
                <p class="text-danger" style="text-align:center"><small>参加者氏名に変更がある場合は、✅した状態で入力し直してください</small></p>
                <p class="text-danger" style="text-align:center"><small>この画面で参加者数の追加はできません</small></p>
                <div class="cp_ipcheck" style="text-align:center">
                  <label class="col-12">
                    <div class="form-group">
                      <p id="d_rb1" >
                      代表者氏名（参加者氏名１）
                      <?php echo htmlspecialchars($booking_data['booker']); ?>
                      </p>
                    </div>
                  </label>
                    <?php if ($booking_data['people_num']!= 1) : ?>
                      <?php if (!empty($visitor_data)) : ?>
                        <?php for ($value=1; $value < $booking_data['people_num']; $value++) :?>
                          <label class="col-12">
                            <div class="form-group">
                              <input type="checkbox"  name="check_flag[<?= $value; ?>]" id="rb<?=$value;?>" value=<?php echo htmlspecialchars($visitor_data[$value]['number'])?> checked />
                              参加者氏名<?php echo htmlspecialchars($visitor_data[$value]['number']);?>&nbsp;&nbsp;
                              <input id="name<?php echo htmlspecialchars($value)?>" type="text" name="name<?php echo htmlspecialchars($value);?>" value="<?php echo htmlspecialchars($visitor_data[$value]['name']);?>">
                            </div>
                          </label>
                        <?php endfor; ?>
                        <?php endif; ?>
                      <?php endif; ?>
                </div><!-- /.cp_ipcheck -->
                <input type="hidden" name="<?php echo(html_escape($csrf_token_name));?>" value="<?php echo(html_escape($csrf_token_hash));?>">
                <div class="card-footer" style="text-align:center">
                  <button type="button" class="btn btn-secondary" onclick="location.href='<?php base_url(); ?>/Group_adv/confirmation'">戻る</a>
                  <button type="submit" class="btn btn-primary" >確認する</button>
                  <input type="hidden" name="id" value="<?php echo htmlspecialchars($booking_data['id']); ?>">
                </div>
              </form>
          </div><!--/.card-info -->
        </div><!--/.card -->
      </div><!--/.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</body>
