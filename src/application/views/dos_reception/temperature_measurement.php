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
                <li class="completed"><span class="bubble"></span>おねがい</li>
                <li class="completed"><span class="bubble"></span>希望日時入力</li>
                <li class="completed"><span class="bubble"></span>受付内容入力</li>
                <li class="completed"><span class="bubble"></span>入力内容確認</li>
                <li class="active"><span class="bubble"></span>検温入力</li>
                <li class="completed"><span class="bubble"></span>案内</li>
                <li><span class="bubble"></span>全員終了</li>
              </ul>
              <form role="form">
                <div class="card-body" >
                      <div class="form-group">
                        <label for="exampleInputEmail1"><span class="label label-danger" style="color: red;">必須</span> 検温結果：</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="36.8" required>
                      </div>
                    <!-- <p class="text-danger" style="text-align:center">まだ予約は確定されていません</p> -->
                </div><!-- /.card-body -->
                <div class="card-footer" style="text-align:center">
                  <!-- <button type="submit" class="btn btn-secondary">戻る</button> -->
                  <button type="submit" class="btn btn-primary">登録</button>
                </div>
              </form>
          </div><!-- /.card-info -->
        </div><!-- /.card -->
      </div><!-- /.col-md-6 -->
    </div><!-- /.row justify-content-center -->
  </div><!-- /.container-fruid -->
</body>
</html>
