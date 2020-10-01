<body>
  <div class="container-fruid">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card">
          <div class="card-info">
              <div class="card-header">
                <h3 class="card-title">おねがい</h3>
              </div>
              <ul class="cp_stepflow01">
                <li class="completed"><span class="bubble"></span>利用規約等確認</li>
                <li class="active"><span class="bubble"></span>おねがい</li>
                <li class="completed"><span class="bubble"></span>希望日時入力</li>
                <li class="completed"><span class="bubble"></span>受付内容入力</li>
                <li class="completed"><span class="bubble"></span>入力内容確認</li>
                <li class="completed"><span class="bubble"></span>検温入力</li>
                <li class="completed"><span class="bubble"></span>案内</li>
                <li><span class="bubble"></span>全員終了</li>
              </ul>
              <div class="card-body" >
                <div class="row">
                  <iframe src="https://docs.google.com/gview?url=https://kiyotatsu.com/***(省略)***/wf_sample.pdf&embedded=true" style="width:100%; height:500px;" frameborder="0"></iframe>
                </div>
                  <p class="text-danger" style="text-align:center">ご協力・ご理解をいただけない場合は、入場をお断りさせていただきます。</p>
              </div>
              <form role="form" method="post" action="/Group/request">
                <div class="card-footer" style="text-align:center">
                  <button type="submit" name="no" class="btn btn-secondary">TOPに戻る</button>
                  <button type="submit" name="yes" class="btn btn-primary">承諾する</button>
                </div><!--/.card-footer -->
              </form>
          </div><!--/.card-info -->
        </div><!--/.card -->
      </div><!--/.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</body>
