$('.progbar').appear();

function progress(barID, value) {
    $(barID).animate({
        'width': value
    }, 300);
}

$('.progbar').on('appear', function () {
    progress('#bar1', '80%');
    progress('#bar2', '80%');
    progress('#bar3', '60%');
    progress('#bar4', '70%');
    progress('#bar5', '70%');
    progress('#bar6', '70%');
});