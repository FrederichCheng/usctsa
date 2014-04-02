<?php $this->load->view('_blocks/header') ?>
<div id="wrapper">
<?php 
    require_once(FUEL_FOLDER.'/FacebookSDK/facebook.php');
    $APP_ID = '258287400999278';
    $GROUP_ID = '12171823426';
    
    $facebook = new Facebook(array(
        'appId'  => $APP_ID,
        'secret' => 'a993a2c7a87605ed6efa9877e6641112',
      ));
    $TOKEN = $facebook->getApplicationAccessToken();
?>
<script>
    var DAYS = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];
    var MONTHES = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
    var GROUP_ID = '<?=$GROUP_ID?>';
    var APP_ID = '<?=$APP_ID?>';
    var ACCESS_TOKEN = '<?=$TOKEN?>';
    var TODAY = new Date();


    function day(day) {
        return '<span class="day">' + DAYS[day - 1] + '</span>';
    }

    var currentDate = new Date();
    var cached_events = null;


    function resetDate(year, month, date) {
        $("#month").text(MONTHES[month]);
        $("#year").text(year);
        currentDate = new Date(year, month, date);
        var firstDay = date % 7;
        var lastD = new Date(year, month, 28);
        var lastDate = lastD.getDate();



        while (lastD.getMonth() === currentDate.getMonth()) {
            lastDate = lastD.getDate();
            lastD.setDate(lastD.getDate() + 1);
        }

        firstDay = ((currentDate.getDay() + 8) - firstDay) % 7;
        for (var i = firstDay; i > 0; i--) {
            $("#cell" + i).find(".date").html(day(i));
        }
        for (var i = firstDay + 1; i <= lastDate + firstDay; i++) {
            if (i <= 7) {
                $("#cell" + i).find(".date").html(day(i) + " " + (i - firstDay));
            }
            else {
                $("#cell" + i).find(".date").html(i - firstDay);
            }
        }

        if (year === TODAY.getFullYear() && month === TODAY.getMonth()) {
            $("#cell" + (TODAY.getDate() + firstDay)).addClass("today");
            $("#jump_to_today").css('display', 'none');
        }
        else {
            $(".today").removeClass("today");
            $("#jump_to_today").css('display', 'block');
        }

        if (currentDate.getFullYear() >= TODAY.getFullYear()
                && currentDate.getMonth() >= TODAY.getMonth()) {
            cached_events = null;   //clear cached event.
        }

        loadGroupEvents(firstDay);
    }

    function fbError(response) {
        $(".errorMessage").text("Unable to retrieve data from Facebook");
        console.log("unable to retrieve data from Facebook: " + JSON.stringify(response.error));
    }

    function loadGroupEvents(firstDay) {
        if (null === cached_events) {
            FB.api('/' + GROUP_ID + '/events?access_token=' + ACCESS_TOKEN, function(response) {
                if (!response || response.error) {
                    fbError(response);
                    return;
                }
                var data = response['data'];
                cached_events = data;
                showEvents(cached_events, firstDay);
            });
        }
        else {
            showEvents(cached_events, firstDay);
        }
    }

    function showEvents(data, firstDay) {

        $('.events').html('');

        var itemCount = 0;
        for (var index in data) {
            data[index]['start_time'] = new Date(data[index]['start_time']);
            data[index]['end_time'] = new Date(data[index]['end_time']);
            var time = data[index]['start_time'];
            if (time.getMonth() === currentDate.getMonth() && time.getFullYear() === currentDate.getFullYear()) {
                var newDiv = $('<div>').attr('class', 'event').html(data[index]['name'].substring(0, 30));
                $("#cell" + (time.getDate() + firstDay)).find('.events').append(newDiv);
                newDiv.click(function(id) {
                    return function() {
                        showEvent(id);
                    };
                }(data[index]['id']));
                itemCount++;
            }
        }

        if (itemCount === 0) {
            $("#calendar").css("opacity", "0.4");
            $("#centerMessage").css("display", "table");
            $("#centerMessage .text").text("No Events in This Month");
        }
        else {
            $("#calendar").css({opacity: 1});
            $("#centerMessage").css("display", "none");
            $("#centerMessage .text").text("");
        }
    }

    function showEvent(id) {
        FB.api('/' + id + '?access_token=' + ACCESS_TOKEN, function(response) {
            if (!response || response.error) {
                fbError(response);
                return;
            }
            $('<div>').html(response.description).css({width: '600px', height: '400px'}).dialog({
                dialogClass: "no-close",
                maxHeight: 400,
                width: 600,
                resizable: false,
                modal: true,
                buttons: [
                    {
                        text: "OK",
                        click: function() {
                            $(this).dialog("close");
                        }
                    }
                ]
            });

        });
    }

    $(document).ready(
            function() {
                var today = new Date();
                resetDate(today.getFullYear(), today.getMonth(), today.getDate());

                $("#prev_button").click(function() {
                    if (currentDate.getMonth() === 0) {
                        resetDate(currentDate.getFullYear() - 1, 11, 1);
                    }
                    else {
                        resetDate(currentDate.getFullYear(), currentDate.getMonth() - 1, currentDate.getDate());
                    }
                });
                $("#next_button").click(function() {
                    if (currentDate.getMonth() === 11) {
                        resetDate(currentDate.getFullYear() + 1, 0, 1);
                    }
                    else {
                        resetDate(currentDate.getFullYear(), currentDate.getMonth() + 1, currentDate.getDate());
                    }
                });
                $("#jump_to_today").click(function() {
                    resetDate(TODAY.getFullYear(), TODAY.getMonth(), TODAY.getDate());
                });

                FB.init({
                    appId: APP_ID, // App ID
                    status: true, // check login status
                    cookie: true, // enable cookies to allow the server to access the session
                    xfbml: true  // parse XFBML
                });
            });
</script>

<style>
    .button{
        display: inline;
        cursor:pointer;
    }
    .day{
        font-weight: bold;
    }
    .today{
        background-color:wheat;
        opacity: 0.4;
    }
    .errorMessage{
        color:red;
        text-align:right;
        font-size:12px;
        display:inline;
    }
    table{
        width: 800.5px;
        margin:0 auto;
        border-width: 0px;
        border-spacing: 0px;
        padding-left:2px;
        padding-right: 2px;


    }
    table, td{

    }
    table td{
        width:56px;
        height:97px;
    }

    table#calendar td:hover{
        background-color:navajowhite;
    }

    #calendar{
        height: 500px;
        background-image: url('<?= assets_path('images/calendar.gif')?>'); 
        background-size: 800px 504px;
        background-position-y:-2px;
        background-position-x:-2px;
        background-repeat: no-repeat;
        margin-bottom: 50px;
        z-index: 1;
        //border-width: 1px;
        //border-style: solid;
    }

    #calendar_banner, #calendar_banner td{
        font-size: 18px;
        border-width: 0px;
        text-align: right;
        vertical-align:bottom;
        height:30px;
        font-family: monospace, Tahoma,Georgia,Serif;
    }

    #jump_to_today{
        font-size: 16px;
        color: grey;
        float:left;
    }

    .date{
        text-align: right;
        font-size:12px;
        margin-right:4px;
        color: grey;
    }
    .events{
        height:80%;
        overflow-y:scroll;
        width:107px;
        margin-left:3px;
    }
    .event{
        display:block;
        overflow-x:hidden;
        border-width:1px;
        border-style:solid;
        border-color:darkorange;
        text-align: center;
        background-color: peachpuff;
        border-radius: 4px;
        cursor: pointer;
    }
    #centerMessage{
        font-size: 40px;
        color: grey;
        position: absolute;
        display: none;
        width: 960px;
        height: 500px;
        z-index: 10;
        text-align: center;


    }
    #centerMessage .text{
        margin-top: auto;
        margin-bottom: auto;
        vertical-align: middle;
        display:table-cell;
    }
</style>

<section id="main_inner">
    <?php echo fuel_var('body', ''); ?>
</section>
<!-- Cover Photo -->
<div class="pagewidth">            
    <table id="calendar_banner">
        <thead>
            <tr>
                <td> 
                    <div id="jump_to_today" class="button">Jump to Today</div>
                    <div class="errorMessage">  </div>
                    <div class="button" id="prev_button"> &lt;&lt; </div> 
                    <span id="month"></span> <span id="year"></span> 
                    <div class="button" id="next_button">&gt;&gt;</div>
                </td>
            </tr>
        </thead>
    </table>
    <div id="calendar_div">
        <div id="centerMessage"><span class="text"></span></div>
        <table id="calendar">
            <tr>
                <td id="cell1">
                    <div class="date">

                    </div>
                    <div class="events">

                    </div>
                </td>
                <td id="cell2">
                    <div class="date">

                    </div>
                    <div class="events">

                    </div>
                </td>
                <td id="cell3" >
                    <div class="date">

                    </div>
                    <div class="events">

                    </div>
                </td>
                <td id="cell4" >                            
                    <div class="date">

                    </div>
                    <div class="events">

                    </div></td>
                <td id="cell5">                            
                    <div class="date">

                    </div>
                    <div class="events">

                    </div></td>
                <td id="cell6">                            
                    <div class="date">

                    </div>
                    <div class="events">

                    </div></td>
                <td id="cell7">                            
                    <div class="date">

                    </div>
                    <div class="events">

                    </div></td>
            </tr>
            <tr>
                <td id="cell8">                            
                    <div class="date">

                    </div>
                    <div class="events">

                    </div></td>
                <td id="cell9">                            
                    <div class="date">

                    </div>
                    <div class="events">

                    </div></td>
                <td id="cell10">                            
                    <div class="date">

                    </div>
                    <div class="events">

                    </div></td>
                <td id="cell11">                            
                    <div class="date">

                    </div>
                    <div class="events">

                    </div></td>
                <td id="cell12">                           
                    <div class="date">

                    </div>
                    <div class="events">

                    </div></td>
                <td id="cell13">                            
                    <div class="date">

                    </div>
                    <div class="events">

                    </div></td>
                <td id="cell14">                            
                    <div class="date">

                    </div>
                    <div class="events">

                    </div></td>
            </tr>
            <tr>
                <td id="cell15">                            
                    <div class="date">

                    </div>
                    <div class="events">

                    </div></td>
                <td id="cell16">                            
                    <div class="date">

                    </div>
                    <div class="events">

                    </div></td>
                <td id="cell17">                            
                    <div class="date">

                    </div>
                    <div class="events">

                    </div></td>
                <td id="cell18">                            
                    <div class="date">

                    </div>
                    <div class="events">

                    </div></td>
                <td id="cell19">                            
                    <div class="date">

                    </div>
                    <div class="events">

                    </div></td>
                <td id="cell20">                            
                    <div class="date">

                    </div>
                    <div class="events">

                    </div></td>
                <td id="cell21">                            
                    <div class="date">

                    </div>
                    <div class="events">

                    </div></td>
            </tr>
            <tr>
                <td id="cell22">                            
                    <div class="date">

                    </div>
                    <div class="events">

                    </div></td>
                <td id="cell23">                            
                    <div class="date">

                    </div>
                    <div class="events">

                    </div></td>
                <td id="cell24">                            
                    <div class="date">

                    </div>
                    <div class="events">

                    </div></td>
                <td id="cell25">                            
                    <div class="date">

                    </div>
                    <div class="events">

                    </div></td>
                <td id="cell26">                            
                    <div class="date">

                    </div>
                    <div class="events">

                    </div></td>
                <td id="cell27">                            
                    <div class="date">

                    </div>
                    <div class="events">

                    </div></td>
                <td id="cell28">                            
                    <div class="date">

                    </div>
                    <div class="events">

                    </div></td>
            </tr>
            <tr>
                <td id="cell29">                            
                    <div class="date">

                    </div>
                    <div class="events">

                    </div></td>
                <td id="cell30">                            
                    <div class="date">

                    </div>
                    <div class="events">

                    </div></td>
                <td id="cell31">                            
                    <div class="date">

                    </div>
                    <div class="events">

                    </div></td>
                <td id="cell32">                            
                    <div class="date">

                    </div>
                    <div class="events">

                    </div></td>
                <td id="cell33">                            
                    <div class="date">

                    </div>
                    <div class="events">

                    </div></td>
                <td id="cell34">                            
                    <div class="date">

                    </div>
                    <div class="events">

                    </div></td>
                <td id="cell35">                            
                    <div class="date">

                    </div>
                    <div class="events">

                    </div></td>
            </tr>
        </table>
    </div>
</div>	
</div>
 <script src="http://connect.facebook.net/en_US/all.js"></script>
<?php $this->load->view('_blocks/footer') ?>