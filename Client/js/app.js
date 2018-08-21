var baseUrl = 'http://localhost/PrestaBO/Server/Api/';

$(document).ready(function () {

    $('#plcSideBar').load('SideBar.html');

    toLastPage();
    
});

$(document).on('click', 'a', function () {

    var pageName = $(this).attr('data-url');
    if (pageName === undefined)
        return;
    loadPage(pageName);

});

function toLastPage() {
    var lastPage = window.localStorage.getItem('lastPage');
    if (lastPage === '' || lastPage === undefined)
        loadPage('Dashboard.html')
    else
        loadPage(lastPage);
}

/**
 *
 * @param String pageName
 */
function loadPage(pageName) {
    $('.panel').fadeToggle(750);
    window.localStorage.setItem('lastPage', pageName);
    $('#plcBody').load(pageName);
    $('.panel').fadeToggle(750).stop(false,true);
}

/**
 * 
 * @param String headingText
 */
function setPanelHeading(headingText) {

    $('.panel-heading').text(headingText);

}