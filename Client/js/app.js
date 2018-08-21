var baseUrl = '../Server/Api/';
var KEY_TOKEN = 'token';

$(document).ready(function () {

    checkLogin()

    $('#plcSideBar').load('SideBar.html');
    toLastPage();
    
});

$(document).on('click', 'a', function () {

    var pageName = $(this).attr('data-url');
    if (pageName === undefined)
        return;
    loadPage(pageName);

});

$(document).on('click', '#btnLogout', function () {

    window.localStorage.setItem(KEY_TOKEN, undefined);
    window.localStorage.clear();
    window.location = 'login.html';

});

/**
 * 
 */
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

/**
 * @returns boolean
 */
function checkLogin() {

    var token = window.localStorage.getItem(KEY_TOKEN);
    if (token === undefined || token === null || token === '')
        window.location = 'login.html';
    else
        return true;
}