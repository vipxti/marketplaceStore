$(document).ready(function() {


    var userFeed = new Instafeed({
        get: 'user',
        userId: '5851780956',
        limit: 6,
        resolution: 'standard_resolution',
        accessToken: '5851780956.1677ed0.8f30bf3f169b498eb7f69628b44843c9',
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