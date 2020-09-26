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
                <h4><?php echo htmlspecialchars(date("Y/m/d  H:i")); ?></h4>
              </div>
              <div class="row" style="max-width:60%;margin:10px auto;">
                <div class="col-6 col-sm-4" style="flex:auto; max-width:50%;">
                  <div class="info-box left">
                    <div class="info-box-content">
                      <span class="info-box-text text-center text-muted">入館中</span>
                      <span class="info-box-number text-center text-muted md-0">
                        <?php $in = 0;?>
                          <?php foreach ($booking_array as $value) : ?>
                            <?php if(date('Y/n/d', strtotime($value['booking_date'])) == date("Y/n/d")):?>
                              <?php if($value['booking_status'] == 1):?>
                                <?php $in = $in + $value['people_num']?>
                              <?php endif?>
                            <?php endif?>
                          <?php endforeach; ?>
                        <?php echo htmlspecialchars($in);?>
                      </span>
                    </div>
                  </div>
                </div>
                <div class="col-6 col-sm-4" style="flex:auto; max-width:50%;">
                  <div class="info-box right">
                    <div class="info-box-content">
                      <span class="info-box-text text-center text-muted">受付待ち</span>
                      <span class="info-box-number text-center text-muted md-0">
                        <?php $wait = 0;?>
                        <?php foreach ($booking_array as $value) : ?>
                          <?php if(date('Y/n/d', strtotime($value['booking_date'])) == date("Y/n/d")):?>
                            <?php if($value['booking_status'] == 0):?>
                              <?php $wait = $wait + $value['people_num']?>
                            <?php endif?>
                          <?php endif?>
                        <?php endforeach; ?>
                        <?php echo htmlspecialchars($wait);?>
                      <span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-tools" style="padding:10px;">
                <ul class="nav nav-pills ml-auto" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#day">当日</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#all">一覧</a>
                  </li>
                </ul>
              </div>
              <div class="tab-content">
                <div class="tab-pane fade" id="all">
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
                            <td><?php echo htmlspecialchars($value['id']); ?></td>
                            <td><a href="/index.php/Management/confirmation?id=<?php echo htmlspecialchars($value['id']); ?>"><?php echo htmlspecialchars($value['booker']); ?></a></td>
                            <td><?php echo htmlspecialchars($value['booker_yomi']); ?></td>
                            <td>
                              <time>
                                <?php echo htmlspecialchars(date('Y/n/d', strtotime($value['booking_date']))); ?>
                              </time>
                            </td>
                            <td><?php echo htmlspecialchars(date('G:i', strtotime($value['start_time']))); ?></td>
                            <td><?php echo htmlspecialchars(date('G:i', strtotime($value['end_time']))); ?></td>
                            <td><?php echo htmlspecialchars($value['booker_tel']); ?></td>
                            <td><?php echo htmlspecialchars($value['people_num']); ?></td>
                            <td><?php if ($value['booking_status'] == 0) echo htmlspecialchars("受付待ち");
                                      if ($value['booking_status'] == 1) echo htmlspecialchars("入館中");
                                      if ($value['booking_status'] == 2) echo htmlspecialchars("退館");?>
                            </td>
                          </tr>
                        <?php endforeach; ?>
                      <?php endif; ?>
                    </tbody>
                  </table>
                </div>
                <div class="tab-pane active" id="day">
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
                          <?php if(date('Y/n/d', strtotime($value['booking_date'])) == date("Y/n/d")):?>
                            <tr class="text-center">
                              <td><?php echo htmlspecialchars($value['id']); ?></td>
                              <td><a href="/index.php/Management/confirmation?id=<?php echo htmlspecialchars($value['id']); ?>"><?php echo htmlspecialchars($value['booker']); ?></a></td>
                              <td><?php echo htmlspecialchars($value['booker_yomi']); ?></td>
                              <td>
                                <time>
                                  <?php echo htmlspecialchars(date('Y/n/d', strtotime($value['booking_date']))); ?>
                                </time>
                              </td>
                              <td><?php echo htmlspecialchars(date('G:i', strtotime($value['start_time']))); ?></td>
                              <td><?php echo htmlspecialchars(date('G:i', strtotime($value['end_time']))); ?></td>
                              <td><?php echo htmlspecialchars($value['booker_tel']); ?></td>
                              <td><?php echo htmlspecialchars($value['people_num']); ?></td>
                              <td><?php if ($value['booking_status'] == 0) echo htmlspecialchars("受付待ち");
                                        if ($value['booking_status'] == 1) echo htmlspecialchars("入館中");
                                        if ($value['booking_status'] == 2) echo htmlspecialchars("退館");?>
                              </td>
                            </tr>
                          <?php endif?>
                        <?php endforeach; ?>
                      <?php endif; ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div><!-- /.card-body -->
          </div><!-- /.card> -->
        </div><!-- /.col-12 -->
      </div><!-- /.row justify-content-center -->
    </div><!-- /.container-fluid -->
  </section><!-- /.content -->
</body>
