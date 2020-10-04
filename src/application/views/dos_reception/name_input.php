<body>
  <div class="container-fruid">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card">
          <div class="card-info">
              <div class="card-header">
                <h3 class="card-title">受付内容入力</h3>
              </div>
              <ul class="cp_stepflow01">
                <li class="completed"><span class="bubble"></span>利用規約等確認</li>
                <li class="completed"><span class="bubble"></span>おねがい</li>
                <li class="completed"><span class="bubble"></span>希望日時入力</li>
                <li class="active"><span class="bubble"></span>受付内容入力</li>
                <li class="completed"><span class="bubble"></span>入力内容確認</li>
                <li class="completed"><span class="bubble"></span>検温入力</li>
                <li class="completed"><span class="bubble"></span>案内</li>
                <li><span class="bubble"></span>全員終了</li>
              </ul>
              
              <!-- バリデーション機能 -->
              <?php echo form_open('/Group/check'); ?>
              <!-- <form role="form" method="post" action="/Group/check"> -->
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1"> ※フリガナ：</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="enter_name" placeholder="Enter name" value="<?php if(!empty($enter_name))echo htmlspecialchars($enter_name); ?>">
                    <small style="color: red;"><?php echo form_error('enter_name'); ?></small>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1"> ※代表者氏名：</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="full_name_1" placeholder="reservation full name" value="<?php if(!empty($full_name_1))echo htmlspecialchars($full_name_1); ?>">
                    <small style="color: red;"><?php echo form_error('full_name_1'); ?></small>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1"> ※代表者電話番号：</label>
                    <input type="tel" class="form-control" id="exampleInputEmail1" name="tel" placeholder="09012341234" value="<?php if(!empty($tel))echo htmlspecialchars($tel); ?>">
                    <small style="color: red;"><?php echo form_error('tel'); ?></small>
                    <small style="color: red;">※連絡が必要になった場合は、代表者の方へご連絡いたします</small>
                  </div>

                  <?php if ($_SESSION['people_num']!= 1) : ?>
                        <?php for ($value=0; $value < $_SESSION['people_num']; $value++) :?>
                            <div class="form-group">
                              <label for="exampleInputEmail1">参加者氏名<?php echo $value+1;?>：</label>
                              <input type="text" class="form-control" id="exampleInputEmail1" name="full_name_<?php echo $value+1;?>" placeholder="participant full name <?php echo $value+1;?>" value="<?php if(!empty($full_name_2))echo htmlspecialchars($full_name_2); ?>">
                            </div>
                        <?php endfor; ?>
                  <?php endif; ?>
                    <p class="text-danger" style="text-align:center">まだ予約は確定されていません</p>
                </div> 
                <div class="card-footer" style="text-align:center">
                  <button type="submit" name="no" class="btn btn-secondary">戻る</button>
                  <button type="submit" name="yes" class="btn btn-primary">確認へ</button>
                </div>
              </form>
          </div><!-- /.card-info -->
        </div><!-- /.card -->
      </div><!-- /.col-md-6 -->
    </div><!-- /.row justify-content-center -->
  </div><!-- /.container-fruid -->
</body>
</html>
