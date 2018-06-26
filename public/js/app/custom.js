$(document).ready(function() {


    var userFeed = new Instafeed({
        get: 'user',
        userId: '4479769937',
        limit: 12,
        resolution: 'standard_resolution',
        accessToken: '4479769937.d58614b.95ed9230bc564aedb27083af9c0875a4',
        sortBy: 'most-recent',
        template: '<div class="col-md-4 instaimg"><a href="{{image}}" title="{{caption}}" target="_blank"><img src="{{image}}" alt="{{caption}}" class="img-fluid"/></a></div>',
    });


    userFeed.run();

    
    // This will create a single gallery from all elements that have class "gallery-item"
    $('.gallery').magnificPopup({
        type: 'image',
        delegate: 'a',
        gallery: {
            enabled: true
        }
    });


});