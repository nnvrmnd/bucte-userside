$(function(){
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    let getEventParam = urlParams.get('event');
    let event = decipher(getEventParam)
    $.get('./assets/hndlr/GetData.php', {key: event}, function(data){
        data = JSON.parse(data) 
        $(`div[class*=blog-details-text]`).html(data.description);
        $(`[id*=page-title]`).html(data.title);
        $(`[id*=event_image]`).css({"background-image" : `url(./files/events/${data.image})`}); //style="background-image: url(./dist/img/bg-img/17.jpg);"
    })		
})	