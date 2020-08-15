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
              <form role="form">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">フリガナ：</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter name" >
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1"><span class="label label-danger" style="color: red;">必須</span> 代表者氏名（参加者氏名１）：</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="reservation full name" required>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1"><span class="label label-danger" style="color: red;">必須</span> 代表者電話番号：</label>
                    <input type="tel" class="form-control" id="exampleInputEmail1" placeholder="031234567" required>
                    <p style="color: red;">※こちらから連絡する際に使用します</p>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">参加者氏名２：</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="participant full name 2" >
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">参加者氏名３：</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="participant full name 3" >
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">参加者氏名４：</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="participant full name 4" >
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">参加者氏名５：</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="participant full name 5">
                  </div>
                    <p class="text-danger" style="text-align:center">まだ予約は確定されていません</p>
                </div> 
                <div class="card-footer" style="text-align:center">
                  <button type="submit" class="btn btn-secondary">戻る</button>
                  <button type="submit" class="btn btn-primary">確認へ</button>
                </div>
              </form>
          </div><!-- /.card-info -->
        </div><!-- /.card -->
      </div><!-- /.col-md-6 -->
    </div><!-- /.row justify-content-center -->
  </div><!-- /.container-fruid -->
</body>
</html>

