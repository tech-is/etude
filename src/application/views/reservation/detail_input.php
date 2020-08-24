<body>
    <div class="container-fruid">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-info">
                        <div class="card-header">
                            <h1 class="card-title">希望日時入力</h1>
                        </div>
                        <ul class="cp_stepflow01">
                            <li class="completed"><span class="bubble"></span>メールアドレス入力</li>
                            <li class="active"><span class="bubble"></span>希望日時入力</li>
                            <li class="bubble"><span class="bubble"></span>予約者情報入力</li>
                            <li class="bubble"><span class="bubble"></span>内容確認</li>
                            <li class="bubble"><span class="bubble"></span>完了</li>
                        </ul>
                        <form method="get" id="vali_form" role="form"
                            action="<?php base_url();?>/index.php/Reservation/view_name_input_reserve">
                            <div class="card-body">
                                <label for="visit_date">来店日</label>
                                <input class="form-control" name="visit_date" type="text" placeholder="クリックして選択"
                                    id="visit_date" readonly="readonly">
                                <p>↓以下のカレンダーから日付をクリックして入力してください↓</p>
                                <!--カレンダー表示-->
                                <div id='calendar'></div>
                                <div class="row">
                                    <div class="col-5">
                                        <label for="visit_time">入店時間</label>
                                        <input class="form-control" name="visit_time1" type="text"
                                            placeholder="クリックして選択" id="visit_time1" readonly="readonly">
                                    </div>
                                    <div class="col-5">
                                        <label for="left_time">退店時間</label>
                                        <input class="form-control" name="left_time" type="text" placeholder="クリックして選択"
                                            id="left_time" readonly="readonly">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-3">
                                        <label for="visit_num">人数</label>
                                        <select class="form-control" name="visit_num">
                                            <option value="1">1人</option>
                                            <option value="2">2人</option>
                                            <option value="3">3人</option>
                                            <option value="4">4人</option>
                                            <option value="5">5人</option>
                                        </select></p>
                                    </div>
                                </div>
                            </div>
                            <!--/.card-body -->
                            <div class="card-footer" style="text-align:center">
                                <button type="submit" class="btn btn-primary">次へ</button>
                            </div>
                            <!--/.card-footer -->
                        </form>
                    </div>
                    <!--/.card-info -->
                </div>
                <!--/.card -->
            </div>
            <!--/.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
    <!-- jQuery -->
    <script src="<?= base_url(); ?>AdminLTE-3.0.5/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?= base_url(); ?>AdminLTE-3.0.5/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- bs-custom-file-input -->
    <script src="<?= base_url(); ?>AdminLTE-3.0.5/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url(); ?>AdminLTE-3.0.5/dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="<?= base_url(); ?>AdminLTE-3.0.5/dist/js/demo.js"></script>
    <script src="<?= base_url(); ?>fullcalendar-4.4.2//packages/core/locales-all.js"></script>
    <script src='<?= base_url(); ?>fullcalendar-4.4.2/packages/core/main.js'></script>
    <script src='<?= base_url(); ?>fullcalendar-4.4.2/packages/daygrid/main.js'></script>
    <script src="<?= base_url(); ?>fullcalendar-4.4.2/packages/interaction/main.js"></script>
    <script src="<?= base_url(); ?>fullcalendar-4.4.2/packages/daygrid/main.js"></script>
    <script src="<?= base_url(); ?>fullcalendar-4.4.2/packages/timegrid/main.js"></script>
    <script src="<?= base_url(); ?>fullcalendar-4.4.2/packages/list/main.js"></script>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.2/dist/jquery.validate.js">
    </script>

    <script type="text/javascript">
    $(document).ready(function() {
        bsCustomFileInput.init();
    });

    //基本画面が読み込まれたらイベントハンドラを登録するようにする
    // window.onload = function() {
    document.addEventListener('DOMContentLoaded', function() {
        /////////////////////////////////////////////////////////////カレンダー
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            locale: 'ja',
            plugins: ['interaction', 'dayGrid', 'timeGrid', 'list'],
            header: {
                left: "prev",
                center: "title",
                right: " next"
            },
        });
        calendar.render();
    });
    //fullcalenderがうまくできないので直接イベント作った。直す可能性あり
    $("#calendar").on("click", ".fc-day:not(.fc-other-month)", function() {
        $("#visit_date").val($(this).attr('data-date'));
    });
    </script>
</body>

</html>