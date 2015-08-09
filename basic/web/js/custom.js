
$(document).ready(function(){
    $.fn.exists = function () {
        return this.length !== 0;
    }

    $questions = $('.widget--survey__question');

    $questions.hide();
    $('.widget--survey__endsurvey').hide();

    $questions.first().show().addClass('widget--survey__question--current');
    $questions.last().addClass('widget--survey__question--last');


        $questions.find('.widget--survey__answer__link').click(function(){
            if (!$(this).closest('.widget--survey__question').hasClass('widget--survey__question--last')){
                $('.widget--survey__question--current').hide().removeClass('widget--survey__question--current')
                    .next().fadeIn().addClass('widget--survey__question--current');
            }
            else {
                $('.widget--survey__question--current').hide().removeClass('widget--survey__question--current');
                $('.widget--survey__endsurvey').fadeIn();
            }

        });



    if ( $(".surveyview__answer__votes").exists() ) {

        String.prototype.trunc = String.prototype.trunc ||
            function(n){
                return this.length>n ? this.substr(0,n-1)+'...' : this;
            };

        function getRandomColor() {
            var letters = '0123456789ABCDEF'.split('');
            var color = '#';
            for (var i = 0; i < 6; i++ ) {
                color += letters[Math.floor(Math.random() * 16)];
            }
            return color;
        }

        var chart = [];
        var ctx = [];

        $('.surveyview__question').each(function(){
            var data = {
                labels:[],
                datasets:[]
            };
            var i_question= 0;
            var i_answer = 0;
            var question_current = $(this);

            question_current.find('.surveyview__answer').each(function(){

                var answer_name = $(this).find(".surveyview__answer__name").text();
                data.labels.push(answer_name.trunc(5));

                var answer_votes = $(this).find(".surveyview__answer__votes--absolute").text();
                var object = {
                    label: answer_name,
                    data: [],
                    fillColor: getRandomColor(),
                    strokeColor: '#fff',
                    highlightFill: "#FF5A5d",
                    highlightStroke: "#FF5A5E"
                };
                if (i_answer == 0) data.datasets.push(object);
                i_answer++;
                data.datasets[0].data.push(answer_votes);


                $(this).find('.surveyview__answer__votes').remove();

            });
            question_current.find('.surveyview__chart').html('<canvas width="250" height="150"></canvas>');

            var options = {
                responsive: true,

                //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
                scaleBeginAtZero : true,

                //Boolean - Whether grid lines are shown across the chart
                scaleShowGridLines : true,

                //String - Colour of the grid lines
                scaleGridLineColor : "rgba(0,0,0,.05)",

                //Number - Width of the grid lines
                scaleGridLineWidth : 1,

                //Boolean - Whether to show horizontal lines (except X axis)
                scaleShowHorizontalLines: true,

                //Boolean - Whether to show vertical lines (except Y axis)
                scaleShowVerticalLines: true,

                //Boolean - If there is a stroke on each bar
                barShowStroke : true,


                //Number - Pixel width of the bar stroke
                barStrokeWidth : 2,

                //Number - Spacing between each of the X value sets
                barValueSpacing : 5,

                //Number - Spacing between data sets within X values
                barDatasetSpacing : 1


            };



            ctx[i_question] = question_current.find('canvas').get(0).getContext("2d");


            chart[i_question] = new Chart(ctx[i_question]).Bar(data,options);

            i_question++;
        });



    }
});
