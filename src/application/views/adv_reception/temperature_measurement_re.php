<body>
  <div class="container-fruid">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card">
          <div class="card-info">
              <div class="card-header">
                <h3 class="card-title">検温結果を入力してください</h3>
              </div>
              <ul class="cp_stepflow01">
                <li class="completed"><span class="bubble"></span>利用規約等確認</li>
                <li class="completed" ><span class="bubble"></span>おねがい</li>
                <li class="completed"><span class="bubble"></span>QR受付</li>
                <li class="completed"><span class="bubble"></span>予約内容確認</li>
                <li class="completed"><span class="bubble"></span>内容変更</li>
                <li class="completed"><span class="bubble"></span>変更内容確認</li>
                <li class="active"><span class="bubble"></span>検温</li>
                <li class="completed"><span class="bubble"></span>案内</li>
                <li><span class="bubble"></span>全員終了</li>
              </ul>
              <form role="form" method="post" action="<?php base_url(); ?>/Group_adv/measurement">
                <div class="card-body" >
                      <div class="form-group">
                        <label for="exampleInputEmail1"><span class="label label-danger" style="color: red;">必須:</span> 検温結果を入力してください</label>
                        <p><?php echo htmlspecialchars($visitor_data[$_SESSION['num']]['name']) ??"ゲスト" ?>様</p>
                        <?php $_SESSION['num']+=1; ?>
                        <input type="number" step="0.1" max="42.0" min="34.5" class="form-control" id="exampleInputEmail1" placeholder="36.8" name="temperature" required>
                      </div>
                </div><!-- /.card-body -->
                <div class="card-footer" style="text-align:center">
                  <button type="submit" name="register" class="btn btn-primary">登録</button>
                </div>
              </form>
          </div><!-- /.card-info -->
        </div><!-- /.card -->
      </div><!-- /.col-md-6 -->
    </div><!-- /.row justify-content-center -->
  </div><!-- /.container-fruid -->
</body>
</html>
