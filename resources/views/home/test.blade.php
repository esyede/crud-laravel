<!DOCTYPE html>
<html lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Title Page</title>

        <!-- Bootstrap CSS -->
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/sweetalert.min.css') }}" rel="stylesheet">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="{{ asset('js/html5shiv.js') }}"></script>
            <script src="{{ asset('js/respond.min.js') }}"></script>
        <![endif]-->
    </head>
    <body>
        <h1 class="text-center">Hello World</h1>

        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <button class="single-button">Single Stage Long Process</button>
                    <button class="multi-button">Multi Stage Long Process</button>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <h2>Script Output Display</h2>
                        <div class="progress hidden" id="script-progress">
                          <div class="progress-bar progress-bar-striped active" id="progress-bar-start" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0">
                            <span class="sr-only">0% Complete</span>
                          </div>
                        </div>
                    <div id="script-output"><em>Nothing to output</em></div>
                </div>
            </div>
        </div>

        <!-- jQuery -->
        <script src="{{ asset('js/jquery.min.js') }}"></script>
        <script src="{{ asset('js/jquery.migrate.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('js/sweetalert.min.js') }}"></script>
        <script type="text/javascript">
            window.progressInterval;
            window.prevpc;
            window.hasError = false;
            window.finished = false;
            window.pollingPeriod = 1000;
            window.updatePeriod  = 250;
            window.lastData = null;
            window.lastUpdate;

            $(function(){
                $('.single-button').click(function(){
                    window.finished = false;
                    $.getJSON('{{ route('home.test') }}',
                        function(data){
                            console.log("ALL DONE", data);
                            clearInterval(window.progressInterval);
                            window.finished = true;
                            if(typeof data.error == 'undefined' || data.error === true){
                                displayError(data);
                            } else {
                                checkProgress();
                                $('.tertiary-status').remove();
                                if(!$('#script-progress').hasClass('hidden')){
                                    $('#script-progress').fadeOut(200,function(){$('#script-progress').addClass('hidden');});
                                    swal('Hore!', 'Data berhasil di scrap!', 'success');
                                }
                                output = $('<h4>Done!</h4>');
                                $('#script-output').html(output);
                            }
                        }
                    ).error(function(data){
                        window.hasError = true;
                        console.log("ERROR", data);
                        displayError(data);
                    });
                    window.progressInterval = setInterval(checkProgress, window.updatePeriod);
                });

                $('.multi-button').click(function(){
                    window.finished = false;
                    $.getJSON('{{ route('home.test') }}',
                        function(data){
                            console.log("ALL DONE", data);
                            clearInterval(window.progressInterval);
                            window.finished = true;
                            if(typeof data.error == 'undefined' || data.error === true){
                                displayError(data);
                            } else {
                                checkProgress();
                                $('.tertiary-status').remove();
                                if(!$('#script-progress').hasClass('hidden')){
                                    $('#script-progress').fadeOut(200,function(){$('#script-progress').addClass('hidden');});
                                }
                                output = $('<h4>Done!</h4>');
                                $('#script-output').html(output);
                                swal('Hore!', 'Data berhasil di scrap!', 'success')
                            }
                        }
                    ).error(function(data){
                        window.hasError = true;
                        console.log("ERROR", data);
                        displayError(data);
                    });
                    window.progressInterval = setInterval(checkProgress, window.updatePeriod);
                });
            });

            function displayError(data){
                clearInterval(window.progressInterval);
                console.log(data);
                var msg = 'No Message';
                if(typeof data.message !== 'undefined') msg = data.message;
                if(typeof data.responseText !== 'undefined') msg = data.responseText;
                output = $('<div class="alert alert-danger" role="alert"><strong>Oh no!</strong> Something went wrong, please try again.</div><p>Server message: <pre><code>'+msg+'</code></pre></p>');
                $('#script-output').html(output);
                return true;
            }

            function createAndInsertStatusBars(num){
                var statusBars = Array;
                var statuses = [
                    'progress-bar-success',
                    'progress-bar-info',
                    'progress-bar-warning',
                    'progress-bar-danger'
                ];
                for(i=0; i<num; i++){
                    var newStatus = statuses[i%4];
                    var bar = $('#progress-bar-start').clone();
                    bar.addClass('tertiary-status')
                        .addClass(newStatus)
                        .attr('id', 'tertiary-status-' + i)
                        .attr('aria-valuenow', 0)
                        .attr('aria-valuemin', 0)
                        .attr('aria-valuemax', 100)
                        .css('width', '0%');
                    $('#script-progress').append(bar);
                }
                return statusBars;
            }

            function checkProgress(createStatusBars){
                if(typeof createStatusBars === "undefined") createStatusBars = false;
                if(window.finished === true) return;
                url = '{{ route('home.json_progress') }}';

                var d = new Date();
                var n = d.getTime();

                if((n - window.lastUpdate) > window.pollingPeriod || window.lastData == null){

                    $.getJSON(url, function(data){

                        var d = new Date();
                        window.lastUpdate = d.getTime();
                        window.lastData = data;

                        updateDisplay(data);
                        return null;
                    }).fail(function(){
                        clearInterval(window.progressInterval);
                    }); 
                } else {
                    var data = $.extend({},window.lastData);
                    data.stage.completeItems = Math.min((data.stage.completeItems + Math.floor(((new Date().getTime()/1000)-data.stage.curTime)*data.stage.rate*0.5)), data.stage.totalItems);
                    data.stage.pcComplete = Math.min(((data.stage.completeItems)/data.stage.totalItems),1);
                    data.stage.timeRemaining = (data.stage.totalItems - data.stage.completeItems)/data.stage.rate;
                    updateDisplay(data);
                }
            }

            function updateDisplay(data){
                if(typeof data.totalStages !== 'undefined' && $('.tertiary-status').length < 1 ){
                    console.log("Created Status Bars");
                    createAndInsertStatusBars(data.totalStages);
                }
                var output;
                if(typeof data.message == 'undefined' || data.error === true || data.stage.stageNum === -1){
                    return displayError(data);
                }
                output = data.message;

                if($('#script-progress').hasClass('hidden')){
                    $('#script-progress').hide().removeClass('hidden').fadeIn(200);
                }

                if(window.prevpc === data.stage.pcComplete & data.stage.rate !== null){
                    data.stage.completeItems = Math.min((data.stage.completeItems + Math.floor(((new Date().getTime()/1000)-data.stage.curTime)*data.stage.rate)), data.stage.totalItems);
                    data.stage.pcComplete = Math.min(((data.stage.completeItems)/data.stage.totalItems),1);
                    data.stage.timeRemaining = (data.stage.totalItems - data.stage.completeItems)/data.stage.rate;
                } else {
                    window.prevpc = data.stage.pcComplete;
                }

                output = $('<div>');
                output.append($('<h4>'+Math.ceil( ( ((data.stage.stageNum-1)*100)/(data.totalStages) ) + (data.stage.pcComplete*100/(data.totalStages)) )+'% complete</h4>'));
                if(data.stage.name!==null)
                    output.append($('<h4>Stage: '+data.stage.name+'</h4>'));
                if(data.stage.message!==null)
                    output.append($('<p>Server message: <pre><code>'+data.stage.message+'</code></pre></p>'));
                if(data.stage.totalItems!==null)
                    output.append($('<p>' + data.stage.completeItems+ ' of ' + data.stage.totalItems + ' processed.</p>'));
                if(data.stage.timeRemaining!==null)
                    output.append($('<p>Remaining time: ' + Math.ceil(data.stage.timeRemaining*10)/10 + ' seconds (est)</p>'));
                if(data.stage.rate!==null)
                    output.append($('<p>Currently processing at ' + Math.ceil(data.stage.rate*10)/10 + ' /second</p>'));

                for(i = (data.stage.stageNum-1); i > 0; i--){
                    $('#tertiary-status-'+(i))
                        .attr('aria-valuenow', (1/(data.totalStages))*100)
                        .css('width', (1/(data.totalStages))*100+"%");
                }

                var percentOfTotal = (((1/(data.totalStages))*data.stage.pcComplete)*100);
                $('#tertiary-status-'+(data.stage.stageNum-1))
                    .attr('aria-valuenow', percentOfTotal)
                    .css('width', percentOfTotal+"%");
                $('#tertiary-status-' + (data.stage.stageNum-1) +' span').text(Math.ceil(percentOfTotal*100)+"%");

                $('#script-output').html(output);
            }
        </script>
    </body>
</html>