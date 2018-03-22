$('.progbar').appear();

function progress(barID, value) {
    $(barID).animate({
        'width': value
    }, 300);
}

$('.progbar').on('appear', function () {
    progress('#bar1', '50%');
    progress('#bar2', '60%');
    progress('#bar3', '90%');
    progress('#bar4', '50%');
    progress('#bar5', '50%');
    progress('#bar6', '50%');
});