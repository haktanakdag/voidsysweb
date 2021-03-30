function onReady(callback) {
    var intervalID = window.setInterval(checkReady, 250);

    function checkReady() {
        if (document.getElementsByTagName('body')[0] !== undefined) {
            window.clearInterval(intervalID);
            callback.call(this);
        }
    }
    var tid = setInterval( function () {
    if ( document.readyState !== 'complete' ) return;
    clearInterval( tid );       
    // do your work
}, 100 );
    
}

function show(id, value) {
    document.getElementById(id).style.display = value ? 'block' : 'none';
}

onReady(function () {
    show('loadedpage', true);
    show('loadingdiv', false);
});