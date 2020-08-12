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
              <form role="form">
                <div class="card-body" >
                  <p class="text-danger" style="text-align:center"><small>予約時間の変更はできません</small></p>
                  <div class="row">
                  <ul class="col-5" style="text-align: right;">予約日時：</ul>
                  <ul class="col-7">2020/06/30 10:00～15:00</ul>
                </div><!-- card-body -->
                <p class="text-danger" style="text-align:center"><small>キャンセルされる方は、名前の横の✅の✔を外してください</small></p>
                <p class="text-danger" style="text-align:center"><small>参加者氏名に変更がある場合は、✅した状態で入力し直してください</small></p>
                <p class="text-danger" style="text-align:center"><small>この画面で参加者数の追加はできません</small></p>

                <div class="cp_ipcheck" style="text-align:center">
                  <label>
                    <input type="checkbox" id="d_rb1" checked />
                    <div class="form-group">
                      代表者氏名（参加者氏名１）
                      <input type="text" class="form-control" id="exampleInputEmail1" placeholder="participant full name" required>
                    </div>
                  </label>

                  <label>
                    <input type="checkbox" id="d_rb2" checked />
                    <div class="form-group">
                      参加者氏名２
                      <input type="text" class="form-control" id="exampleInputEmail1" placeholder="participant full name" required>
                    </div>
                  </label>

                  <label for="d_rb3" >
                    <input type="checkbox" id="d_rb3" checked />
                    <div class="form-group">
                      参加者氏名３
                      <input type="text" class="form-control" id="exampleInputEmail1" placeholder="participant full name" required>
                    </div>
                  </label>

                  <label for="d_rb4" >
                    <input type="checkbox" id="d_rb4" checked />
                    <div class="form-group">
                      参加者氏名４
                      <input type="text" class="form-control" id="exampleInputEmail1" placeholder="participant full name" required>
                    </div>
                  </label>

                  <label for="d_rb5" >
                    <input type="checkbox" id="d_rb5" checked />
                    <div class="form-group">
                      参加者氏名５
                      <input type="text" class="form-control" id="exampleInputEmail1" placeholder="participant full name" required>
                    </div>
                  </label>
                </div><!-- /.cp_ipcheck -->
                <div class="card-footer" style="text-align:center">
                  <button type="submit" class="btn btn-primary">確認画面へ</button>
                </div>
              </form>
          </div><!--/.card-info -->
        </div><!--/.card -->
      </div><!--/.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</body>
