$(document).ready(function(){
    // console.log('veikia');
    // $('.edit-post').submit(function(e){ //eventas submit
    //     e.preventDefault(); // stabdo default veikima
    //     //console.log('iki cia veikia');
    //     var url = $('.edit-post').attr('action');
    //     console.log(url);
    //     $.ajax({
    //         type: "POST",
    //         url: url,
    //         data: $(this).serialize(), //serialize paima visus inputus, paduoda i data
    //         success: function(response){
    //             var obj = JSON.parse(response);
    //             if(obj.code == 200){
    //                 $('.msg-block').show('slow').text(obj.msg);
    //             }
    //         }
    //     });
    // });

    $('.edit-post').change(function(){
        $('.msg-block').hide('slow').text(obj.msg);
    });



    // $('.wrapper').submit(function (e) {
    //     e.preventDefault();
    //     var obj = JSON.parse(response);
    //     //$('.wrapper').show('slow').text(obj);
    //     $('.input').addClass('red');
    //     $('.msg-block').show('slow').text(obj);
    // });

    $('.password2').change(function(){
        var pass1 = $('.password').val();
        var pass2 = $('.password2').val();
        if(pass1 !== pass2){
            $('.password2').addClass('red');

        }else{
            $('.password2').removeClass('red');
            //console.log('neveikia');
        }
    });

    $('.registration .email').change(function(){
        $.ajax({
            type: "POST",
            url: 'http://194.5.157.97/php2/mvc/index.php/account/verify',
            data: {email: $(this).val()},
            success: function (response) {
                var obj = JSON.parse(response);
                if(obj.code == 500){
                    $(this).addClass('red');
                    $('.msg-block').show('slow').text('Vartotojas su tokiu elektroniniu paštu jau egzistuoja');
                }else{
                    $('.msg-block').html('').hide();
                }

            }})
    });

    $('.dropdown').click(function(){
        $('.dropdown-content').toggle();
    });


    // funkcija kuria panaudojam search, kad uzklausas i serveri siustu ne su kiekvieba raide, o po kazkuro laiko
    function delay(callback, ms) {
        var timer = 0;
        return function() {
            var context = this, args = arguments;
            clearTimeout(timer);
            timer = setTimeout(function () {
                callback.apply(context, args);
            }, ms || 0);
        };
    }


    $('#search').keyup(delay(function() {
        var url = $('.search-form').attr('action');
        $.ajax({
            type: "GET",
            url: url,
            data: {keyword: $(this).val()},
            success: function (response)
            {
                //var obj = JSON.parse(response);
                $('.search-wrapper').html(response);
            }})
    },500));

    // Kad nesubmitintu formos paspaudus Enter
    $('.search-form').submit(function (e) {
        e.preventDefault();
    });


    //Render comments
    $('.comments-wrapper').ready(function(){

        var location = window.location.href;
        var id = location.split("show/").pop();

        $.ajax({
            type: "GET",
            url: "http://194.5.157.97/php2/mvc/index.php/comments/show/" + id,
            // data: $(this).val(window.location.href),

            success: function (comments) {
                $('.comments-wrapper').html(comments);
            }});

    });
});

