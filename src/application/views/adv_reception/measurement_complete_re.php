<body>
  <div class="container-fruid">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card">
          <div class="card-info">
              <div class="card-header">
                <h3 class="card-title">おつかれさまでした</h3>
              </div>
              <ul class="cp_stepflow01">
              <li class="completed"><span class="bubble"></span>利用規約等確認</li>
              <li class="completed" ><span class="bubble"></span>おねがい</li>
              <li class="completed"><span class="bubble"></span>QR受付</li>
              <li class="completed"><span class="bubble"></span>予約内容確認</li>
              <li class="completed"><span class="bubble"></span>内容変更</li>
              <li class="completed"><span class="bubble"></span>変更内容確認</li>
              <li class="completed"><span class="bubble"></span>検温</li>
              <li class="completed"><span class="bubble"></span>案内</li>
              <li class="active" ><span class="bubble"></span>全員終了</li>
            </ul>
            <form role="form" action="<?php base_url(); ?>Group_adv/finish" method="post" >
              <div class="card-body">
                  <p class="text-danger" style="text-align:center">ご協力ありがとうございました</p>
              </div>
              <div class="card-footer" style="text-align:center">
                <button type="submit" name="finish" class="btn btn-primary">全員終了</button>
              </div>
            </form>
          </div><!-- /.card-info -->
        </div><!-- /.card -->
      </div><!-- /.col-md-6 -->
    </div><!-- /.row justify-content-center -->
  </div><!-- /.container-fruid -->
</body>
</html>
