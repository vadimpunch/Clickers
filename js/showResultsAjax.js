$( window ).load(function() {
    $("#showResults").click(function () {
        $.ajax({
                url: 'test.php',
                type: 'POST',

                data: $('#your_form').serialize(),
            success: function (data) {
                        var arr = JSON.parse(data);
                    var questions = $('input[type=radio]');
                     questions.detach();
                     $.each(arr, function(value){
                            value = +this;
                     });
                     for(var i=0; i<=$('label').length; i++)
                     { $('label')[i].append(arr[i]);}

            }
            }
        );
    });
});


