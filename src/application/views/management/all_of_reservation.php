<body>
  <section class="content-header">
    <div class="container-fluid text-center">
      <div class="row md-2 text-center">
        <div class="col-md-12" >
          <h1><b>etude</b>管理システム</h1>
        </div>
        <div class="col-md-12 text-right">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/index.php/">ログアウト</a></li>
          </ol>
        </div>
      </div>
    </div>
    <!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-12">
          <div class="card">
            <div class="management-card-header text-center" style="background-color: #17a2b8; color: #ffffff; border-top-left-radius: .25rem;border-top-right-radius: .25rem; padding: .75rem 1.25rem;">
              <h2 class="card-title" style="width:100%;">予約一覧</h2>
            </div>
            <div class="card-body">
              <div class="date_and_time text-center" style="padding:10px;">
                <h4><?php echo date("Y/m/d  H:i"); ?></h4>
              </div>
              <div class="row" style="max-width:60%;margin:10px auto;">
                <div class="col-6 col-sm-4" style="flex:auto; max-width:50%;">
                  <div class="info-box left">
                    <div class="info-box-content">
                      <span class="info-box-text text-center text-muted">来館中</span>
                      <span class="info-box-number text-center text-muted md-0">15</span>
                    </div>
                  </div>
                </div>
                <div class="col-6 col-sm-4" style="flex:auto; max-width:50%;">
                  <div class="info-box right">
                    <div class="info-box-content">
                      <span class="info-box-text text-center text-muted">受付待ち</span>
                      <span class="info-box-number text-center text-muted md-0">5 <span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-tools" style="padding:10px;">
                <ul class="nav nav-pills ml-auto">
                  <li class="nav-item-day">
                    <a class="nav-link" href="/Management/part_display" data-toggle="tab">当日</a>
                  </li>
                  <li class="nav-item-all">
                    <a class="nav-link active" href="/Management/all_display" data-toggle="tab">一覧</a>
                  </li>
                </ul>
              </div>
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th class="text-center">予約番号</th>
                    <th class="text-center">予約者氏名</th>
                    <th class="text-center">予約者カナ</th>
                    <th class="text-center">日</th>
                    <th class="text-center">開始時間</th>
                    <th class="text-center">終了時間</th>
                    <th class="text-center">電話番号</th>
                    <th class="text-center">人数</th>
                    <th class="text-center">状況</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if (!empty($booking_array)) : ?>
                    <?php foreach ($booking_array as $value) : ?>
                      <tr class="text-center">
                        <td><?php echo $value['id']; ?></td>
                        <td><a href="/index.php/Management/confirmation?id=<?php echo $value['id']; ?>"><?php echo $value['booker']; ?></a></td>
                        <td><?php echo $value['booker_yomi']; ?></td>
                        <td>
                          <time>
                            <?php echo date('Y/n/d', strtotime($value['booking_date'])); ?>
                          </time>
                        </td>
                        <td><?php echo date('G:i', strtotime($value['start_time'])); ?></td>
                        <td><?php echo date('G:i', strtotime($value['end_time'])); ?></td>
                        <td><?php echo $value['booker_tel']; ?></td>
                        <td><?php echo $value['people_num']; ?></td>
                        <td><?php if ($value['booking_status'] == "0") echo "受付待ち";
                                  if ($value['booking_status'] == "1") echo "入館中";
                                  if ($value['booking_status'] == "2") echo "退館";?>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                  <?php endif; ?>
                </tbody>
              </table>
            </div><!-- /.card-body -->
          </div><!-- /.card> -->
        </div><!-- /.col-12 -->
      </div><!-- /.row justify-content-center -->
    </div><!-- /.container-fluid -->
  </section><!-- /.content -->
</body>
