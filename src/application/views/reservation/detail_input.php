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
                        <!-- <?php echo($_SESSION['book_unacceptable']);?> -->
                        <?php if(isset($_SESSION['book_unacceptable'])): ?>
                        <?php echo('<p class="text-center">'.$_SESSION['book_unacceptable'].'</p>');?>
                        <?php endif;?>
                        <!-- <form method="post" id="vali_form" role="form"
                            action="<?php base_url();?>/Reservation/view_name_input_reserve"> -->
                        <form method="post" id="vali_form" role="form"
                            action="<?php base_url();?>/Reservation/bookable_check">
                            <div class="card-body">
                                <label for="booking_date">来店日</label>
                                <input class="form-control" name="booking_date" type="text" placeholder="クリックして選択"
                                    id="booking_date" readonly="readonly" value="<?php if(!empty($_SESSION['booking_date']))echo(html_escape($_SESSION['booking_date']));?>">
                                <p>↓以下のカレンダーから日付をクリックして入力してください↓</p>
                                <!--カレンダー表示-->
                                <div id='calendar'></div>
                                <div class="row" id="time_set">
                                    <div class="col-5">
                                        <div class="form-group">
                                            <label for="start_time">入店時間</label>
                                            <select class="form-control" name="start_time" id="start_time" value="<?php if(!empty($_SESSION['start_time']))echo(html_escape($_SESSION['start_time'])); ?>">
                                            <?php for($i=1;$i<=24;$i++){?>
                                            <option value="<?php echo(html_escape($i.':00'));?>"><?php echo(html_escape($i));?>:00</option>
                                            <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-5">
                                        <div class="form-group">
                                            <label for="end_time">退店時間</label>
                                            <select class="form-control" name="end_time" id="end_time" value="<?php if(!empty($_SESSION['end_time']))echo(html_escape($_SESSION['end_time'])); ?>">
                                            <?php for($i=1;$i<=24;$i++){?>
                                            <option value="<?php echo(html_escape($i.':00'));?>"><?php echo(html_escape($i));?>:00</option>
                                            <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-3">
                                        <label for="people_num">人数</label>
                                        <select class="form-control" name="people_num">
                                            <option value="1">1人</option>
                                            <option value="2">2人</option>
                                            <option value="3">3人</option>
                                            <option value="4">4人</option>
                                            <option value="5">5人</option>
                                        </select></p>
                                        <!-- <input class="form-control" name="visit_num" type="text"
                                            placeholder="Default input" id="num"> -->
                                    </div>
                                </div>
                                <!-- csrfチェック -->
                                <input type="hidden" name="<?php echo($csrf_token_name);?>" value="<?php echo($csrf_token_hash);?>">
                                <!-- <input type="hidden" name="email" value=<?php echo(html_escape($email)); ?>> -->
                                <!-- <input type="hidden" name="email" value=<?php echo(html_escape($_SESSION['booker_email'])); ?>> -->
                            </div><!--/.card-body -->
                            <div class="card-footer" style="text-align:center">
                                <button type="submit" class="btn btn-primary">次へ</button>
                            </div>
                            <!--/.card-footer -->
                        </form>
                    </div><!--card-info-->
                </div><!--card-->
            </div><!--/.col-md-6-->
        </div><!--/.row-->
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>

    <script type="text/javascript">
    $(document).ready(function() {
        bsCustomFileInput.init();
    });
    //バリデーション
    $("#vali_form").validate({});

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
    // $("#calendar").on("click", ".fc-day:not(.fc-other-month)", function() {
    //     $("#booking_date").val($(this).attr('data-date'));
    // });
    $("#calendar").on("click", ".fc-day:not(.fc-other-month)", function() {
        $("#booking_date").val($(this).attr('data-date'));
        // $('#time_set').after('<p>追加されました</p>');
        
        //csrf対策
        var token = $('input[name="csrf_test_name"]').attr('value')
        
        // alert($("#booking_date").val());
        // alert(token);

        $.ajax({
            url: 'http://etude.com/Reservation/ajaxtest',
            type: 'POST',
            // datatype: 'json',
            data: {
                'csrf_test_name':token,
                'booking_date':$('#booking_date').val()
            }
            // contentType: "application/json; charset=utf-8",
        }).then(
        //dataには通信成功時のデータが入っている
        function (data) {
            // alert("AAA");
            //すでにグラフが存在していると消す。
            // $("#graph").remove();
            //オブジェクトにパラメーターを指定してアクセスできる。
            // console.log(data);
            // let err_msg = JSON.parse(data);
            //time_set直下にグラフを作成する。
            // $('#time_set').after('<div id="graph" class="row"></div>');
            // // console.log(err_msg);
            // //24時間分のdivを表示
            // for(var i =1;i<=24;i++){
            //     $('#graph').prepend('<div class="graphcol col-1" >1</div>');
            //     console.log(data.bookable_array[i]);
            //     // $('.graphcol:last').html(data.bookable_array[i]);
            // }
            // // $(".graphcol").eq(5).html(data.bookable_array[5])
            // //24時間分の予約可否状態を入力する。
            // for(var i=0;i<24;i++){
            //     $(".graphcol").eq(i).html(data.bookable_array[i+1])
            //     //時間外はgrey
            //     if(data.bookable_array[i+1] === -1){
            //         $(".graphcol").eq(i).addClass("limit-grey");
            //     //3人未満はred
            //     }else if(data.bookable_array[i+1] <= 3){
            //         $(".graphcol").eq(i).addClass("limit-red");
            //     //6人未満はyellow
            //     }else if(data.bookable_array[i+1] <= 6){
            //         $(".graphcol").eq(i).addClass("limit-yellow");
            //     //6人より多い時青色
            //     }else if(data.bookable_array[i+1] > 6){
            //         $(".graphcol").eq(i).addClass("limit-blue");
            //     }
            // }

            $("#myChart").remove();
            //time_set直下にグラフを作成する。
            $('#time_set').after('<canvas id="myChart"></canvas>');
            var ctx = document.getElementById('myChart').getContext('2d');
            var booking_data_color= new Array()
            var booking_data = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10]
            for(var i=0;i<booking_data.length;i++){
                if(booking_data[i]>=12){
                    booking_data_color[i] = "rgba(200,0,0,0.4)"
                }else if(booking_data[i]>=7){
                    booking_data_color[i] = "rgba(0,200,0,0.4)"
                }else{
                    booking_data_color[i] = "rgba(68,156,235,0.8)"
                }
            }
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['0:00', ' ', ' ', '3:00', ' ', ' ', '6:00',' ',' ','9:00', ' ', ' ', '12:00', ' ', ' ', '15:00',' ',' ','18:00', ' ', ' ', '21:00', ' ', ' ','24:00'],
                    datasets: [{
                        label: false,
                        data: booking_data,
                        backgroundColor: booking_data_color
                    }]
                },
                options: {
                    title:{
                        display:true,
                        text:'混雑状況'
                    },
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true,
                                min: 0,
                                max: 40,
                                stepSize: 10,
                            }
                        }]
                    },
                    legend:{
                        display:false
                    }
                }
            });
        },
        function (error) {
            alert("BBB");
        })
    });

    </script>
</body>

</html>