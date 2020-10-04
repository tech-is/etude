<body>
  <div class="container-fruid">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card">
          <div class="card-info">
              <div class="card-header">
                <h3 class="card-title">希望チェック</h3>
              </div>
              <ul class="cp_stepflow01">
                <li class="completed"><span class="bubble"></span>利用規約等確認</li>
                <li class="completed"><span class="bubble"></span>おねがい</li>
                <li class="active"><span class="bubble"></span>希望日時入力</li>
                <li class="completed"><span class="bubble"></span>受付内容入力</li>
                <li class="completed"><span class="bubble"></span>入力内容確認</li>
                <li class="completed"><span class="bubble"></span>検温入力</li>
                <li class="completed"><span class="bubble"></span>案内</li>
                <li><span class="bubble"></span>全員終了</li>
              </ul>
              <form role="form" method="post" id="vali_form" action="/Group/hope">
                <div class="card-body" style="text-align: right;">
                  <div class="row">
                    <div class="col-6" style="padding-top: 5px; padding-bottom: 20px;">
                      <label for="visit_date">来館日:</label>
                    </div>
                    <div class="col-6" >
                      <?php $timestamp=time(); ?>
                      <input class="form-control" name="booking_date" type="text" style="padding: 5px 5px 5px 3px; width: 70%;" placeholder="" id="visit_date" readonly="readonly" value="<?php echo htmlspecialchars(date("Y/m/d",$timestamp)); ?>" >
                      <!-- <div align="left"><?php echo htmlspecialchars(date("Y/m/d",$timestamp)); ?></div> -->
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-6" style="padding-top: 5px; padding-bottom: 20px;">
                        <label for="visit_time">入館時間:</label>
                    </div>
                    <!-- 現在時間取得 -->
                    <div class="col-6">
                        <?php date_default_timezone_set('Asia/Tokyo'); ?>
                        <input class="form-control" style="padding: 5px 5px 5px 3px; width: 70%;" name="start_time" type="text" placeholder="" id="visit_time1" readonly="readonly" value="<?php echo  htmlspecialchars(date('H:i')); ?>">
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-6" style="padding-top: 5px; padding-bottom: 50px;" >
                        <label for="left_time">退館時間:</label>
                    </div>
                    <!-- 入館時間より後の時間のみ表示され、退館時間の選択が可能 -->
                    <div class="col-6" style="padding-bottom: 50px;" >
                          <?php 
                            date_default_timezone_set('Asia/Tokyo');
                            $time=date('H:i');
                            $h=strpos($time,":");
                            $a=intval(substr($time,0,$h));
                          ?>
                        <select class="form-control" style="padding: 5px 5px 5px 0px; width: 70%;" name="end_time" type="text" placeholder="選択" id="left_time" readonly="readonly">
                          <?php for($i=$a+1;$i<=24;$i++){?>
                          <option value="<?php echo htmlspecialchars(($i)).":00";?>"><?php echo htmlspecialchars(sprintf('%02d',$i)).":00";?></option>
                          <?php } ?>
                        </select>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-6" style="padding-top: 5px; padding-bottom: 30px;">
                        <label for="visit_num">人数:</label>
                    </div>
                    <div class="col-6">
                        <select class="form-control" name="people_num" style="padding: 5px; width: 50%;">
                              <!-- 10名で設定中 -->
                          <?php for($i=1;$i<=10;$i++){?>
                          <option value="<?php echo htmlspecialchars(($i));?>"><?php echo htmlspecialchars(($i));?>人</option>
                          <?php } ?>
                        </select></p>
                    </div>
                  </div>
                </div>

                <div class="text-center" style="color:red; padding-top: 5px; padding-bottom: 20px;">
                  <?php if(isset($_SESSION['book_unacceptable'])): ?>
                  <?php echo htmlspecialchars($_SESSION['book_unacceptable']); ?>
                  <?php endif;?>
                </div>

                <div class="card-footer" style="text-align:center">
                  <button type="submit" name="cancel" class="btn btn-secondary">入館をやめる</button>
                  <button type="submit" name="check" class="btn btn-primary">チェック</button>
                </div>
              </form>
          </div><!-- /.card-info -->
        </div><!-- /.card -->
      </div><!-- /.col-md-6 -->
    </div><!-- /.row justify-content-center -->
  </div><!-- /.container-fruid -->
</body>
</html>