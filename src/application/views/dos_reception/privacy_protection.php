<body>
  <div class="container-fruid">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card">
          <div class="card-info">
            <div class="card-header">
              <h3 class="card-title">利用規約等確認</h3>
            </div>
            <ul class="cp_stepflow01">
              <li class="active"><span class="bubble"></span>利用規約等確認</li>
              <li class="completed"><span class="bubble"></span>おねがい</li>
              <li class="completed"><span class="bubble"></span>希望日時入力</li>
              <li class="completed"><span class="bubble"></span>受付内容入力</li>
              <li class="completed"><span class="bubble"></span>入力内容確認</li>
              <li class="completed"><span class="bubble"></span>検温入力</li>
              <li class="completed"><span class="bubble"></span>案内</li>
              <li><span class="bubble"></span>全員終了</li>
            </ul>
            <form role="form" method="post" action="/Group/assent">
              <div class="card-body">
                <div class="privacy">
                  <p class="privacy_ttl">個人情報の利用目的について</p>
                  <div class="privacy_inner">
                    <p>〇〇〇〇〇株式会社（以下、「当社」という）は、個人情報を以下の目的に利用いたします。</p>
                    <ol>
                      <li>
                        <p>感染者が発生した場合に、調査分析を目的とし、公的機関より情報提供の依頼があった場合に使用いたします。</p>
                      </li>
                      <li>
                        <p>感染者が発生した場合には、ご連絡をさせていただきます。</p>
                      </li>
                    </ol>
                    <hr>
                    <p>※詳細は当社、個人情報のお取り扱いについて<br>
                      <a href="https://～"
                        target="_blank">https://～</a>をご参照ください。
                    </p>
                    <p>相談・苦情受付窓口</p>
                    <table>
                      <tr>
                        <th>受付時間</th>
                        <td>平日10：00～18：00（12/28～1/3を除く）</td>
                      </tr>
                      <tr>
                        <th>TEL</th>
                        <td>**-****-****</td>
                      </tr>
                    </table>
                    <p>以上</p>
                  </div><!--/.privacy_inner-->
                    <p class="text-danger" style="text-align:center">ご協力・ご理解をいただけない場合は、入場をお断りさせていただきます。</p>
                </div><!--/.privacy -->             
              </div><!--/.card-body-->
              <div class="card-footer" style="text-align:center">
                <button type="submit" name="no" class="btn btn-secondary">TOPに戻る</button>
                <button type="submit" name="yes" class="btn btn-primary">同意する</button>
              </div><!--/.card-footer -->
            </form>
          </div><!--/.card-info -->
        </div><!--/.card -->
      </div><!--/.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</body>
