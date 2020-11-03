<body>
  <div class="container-fruid">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card">
          <div class="card-info">
            <div class="card-header">
              <h3 class="card-title">QR受付</h3>
            </div>
              <ul class="cp_stepflow01">
                <li class="completed"><span class="bubble"></span>利用規約等確認</li>
                <li class="completed"><span class="bubble"></span>おねがい</li>
                <li class="active"><span class="bubble"></span>QR受付</li>
                <li class="completed"><span class="bubble"></span>予約内容確認</li>
                <li class="completed"><span class="bubble"></span>内容変更</li>
                <li class="completed"><span class="bubble"></span>変更内容確認</li>
                <li class="completed"><span class="bubble"></span>検温</li>
                <li class="completed"><span class="bubble"></span>案内</li>
                <li><span class="bubble"></span>全員終了</li>
              </ul>
              <form role="form" action="<?php base_url(); ?>/Group_adv/validity_check" method="post">
                <div class="card-body" >
                  <p class="text-danger" style="text-align:center">事前予約の受付を行います</p>
                  <p class="text-danger" style="text-align:center">QRコードをかざしてください</p>
                  <div class="id-form text-center" style="height:0; overflow:hidden;">
                  <!-- <div class="id-form text-center"> -->
                    <label for="token" style=width:200px;padding-left:7.5px;>id入力</label>
                    <input id="token" type="text" name="token" value="">
                    <input type="submit" name="btn_submit" value="入力">
                  </div>
                  <!-- QR -->
                </div><!-- /.card-body -->
                <input type="hidden" name="<?php echo(html_escape($csrf_token_name));?>" value="<?php echo(html_escape($csrf_token_hash));?>">
                <div class="card-footer" style="text-align:center">
                  <button type="button" class="btn btn-secondary" onclick="location.href='<?php base_url(); ?>/Group_adv/'">TOPに戻る</button>
                  <!-- <button type="submit" class="btn btn-primary">承諾する</button> -->
                </div>
              </form>
          </div><!--/.card-info -->
        </div><!--/.card -->
      </div><!--/.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</body>
<script>
  $(document).ready(function(){
    //何かしらの処理
    document.getElementById("token").focus();

  });
</script>
