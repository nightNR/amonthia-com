if(!window.Amonthia) {
    window.Amonthia = {
        init: function() {
            Amonthia.registerSideMenuEvent();
            Amonthia.displayMenuLabelsIfAbleTo();
        },
        makeApiCall: function(service, command, data, callback) {
            $.ajax({
                url: apiUrl,
                method: 'POST',
                data: {
                    service: service,
                    command: command,
                    data: data
                },
                success: function(data) {
                    callback(data);
                }
            });
        },
        registerSideMenuEvent: function() {

        },
        displayMenuLabelsIfAbleTo: function() {
            console.log($("#sidebar-wrapper").width());
            if($("#sidebar-wrapper").width() < 250){
                console.log();

                $("#sidebar-wrapper .menu-label").each(function(){
                    console.log('t3');
                    $(this).css('display', 'none');
                });
            } else {
                console.log('t2');
                console.log($(this).find(".menu-label"));
                $("#sidebar-wrapper .menu-label").each(function(){
                    console.log('t3');
                    $(this).css('display', 'inline');
                });
            }
        }
    }
}

$(function() {
    console.log("init");
    window.Amonthia.init();
});