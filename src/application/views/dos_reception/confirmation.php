<body>
  <div class="container-fruid">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card">
          <div class="card-info">
              <div class="card-header">
                <h3 class="card-title">入力内容を確認して下さい</h3>
              </div>
              <ul class="cp_stepflow01">
                <li class="completed"><span class="bubble"></span>利用規約等確認</li>
                <li class="completed"><span class="bubble"></span>おねがい</li>
                <li class="completed"><span class="bubble"></span>希望日時入力</li>
                <li class="completed"><span class="bubble"></span>受付内容入力</li>
                <li class="active"><span class="bubble"></span>入力内容確認</li>
                <li class="completed"><span class="bubble"></span>検温入力</li>
                <li class="completed"><span class="bubble"></span>案内</li>
                <li><span class="bubble"></span>全員終了</li>
              </ul>
              <form role="form" method="post" action="/Group/input">
                <div class="card-body" >
                  <div class="row">
                    <?php if(!empty($_SESSION)): ?>
                        <ul class="col-6" style="text-align: right;">フリガナ：</ul>
                        <ul class="col-6"><?php echo htmlspecialchars($_SESSION['enter_name']); ?></ul>
                        <ul class="col-6" style="text-align: right;">代表者氏名：</ul>
                        <ul class="col-6"><?php echo htmlspecialchars($_SESSION['full_name_1']); ?></ul>
                        <ul class="col-6" style="text-align: right;">代表者電話番号：</ul>
                        <ul class="col-6"><?php echo htmlspecialchars($_SESSION['tel']); ?></ul>
                        <!-- 入力があった名前の数をカウントで表示 -->
                        <ul class="col-6" style="text-align: right;">人数：</ul>
                        <ul class="col-6"><?php echo count($_SESSION['full_name']) ?>人</ul>
                        <ul class="col-6" style="text-align: right;">予約日時：</ul>
                        <ul class="col-6">2020/06/30 10:00～15:00</ul>

                        <?php foreach($_SESSION['full_name'] as $key=>$name): ?>
                          <ul class="col-6" style="text-align: right;">参加者<?php echo $key ?>：</ul>
                          <ul class="col-6"><?php echo htmlspecialchars($name); ?></ul>
                        <?php endforeach; ?>
                        
                    <?php endif; ?>
                  </div><!-- /.row -->
                    <p class="text-danger" style="text-align:center">完了ボタンを押して受付内容を登録！</p>
                </div><!-- /.card-body -->
                <div class="card-footer" style="text-align:center">
                    <button type="submit" name="no" class="btn btn-secondary">戻る</button>
                    <button type="submit" name="yes" class="btn btn-primary">完了</button>
                </div>
              </form>
          </div><!-- /.card-info -->
        </div><!-- /.card -->
      </div><!-- /.col-md-6 -->
    </div><!-- /.row justify-content-center -->
  </div><!-- /.container-fruid -->
</body>
</html>
