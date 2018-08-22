var baseUrl = '../Server/Api/';
var KEY_TOKEN = 'token';

$(document).ready(function () {

    checkLogin()

    $('#plcSideBar').load('SideBar.html', function () {
        var token = getLocalToken();
        var fullName = token.FirstName + ' ' + token.LastName;
        document.getElementById('lblFullName').innerText = fullName;
    });
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
    if (isNullOrEmpty(lastPage))
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
    $('.panel').fadeToggle(750).stop(false, true);
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

    var token = getLocalToken();
    if (isNullOrEmpty(token))
        window.location = 'login.html';
    else {
        return true;
    }

}

/**
 * @returns boolean
 * @param {any} str
 */
function isNullOrEmpty(str) {

    return (str === 'null' || str === '' || str === undefined || str === null);

}

/**
 * @returns TokenObject
 */
function getLocalToken() {

    return JSON.parse(window.localStorage.getItem(KEY_TOKEN));

}

/**
 * @returns void
 * @param string jsonString
 */
function setLocalToken(jsonString) {
    window.localStorage.setItem(KEY_TOKEN, jsonString);
}