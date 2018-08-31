var baseUrl = '../Server/Api/';
var KEY_TOKEN = 'token';
var apiBaseUrl = '../../PrestaBO/Server/Api/Api.php';

$(document).ready(function () {

    checkLogin()

    $('#plcSideBar').load('SideBar.php', function () {

        //show user fullname
        var token = getLocalToken();
        var fullName = token.FirstName + ' ' + token.LastName;
        document.getElementById('lblFullName').innerText = fullName;
        
        buildSideBar(token);


    });
    toLastPage();

});

$(document).ajaxComplete(function (event, xhr, settings) {
    $('#loading').fadeOut('slow');
    if (xhr.status == 403) {
        alert(xhr.status);
        logOut();
    }
    
});

$(document).ajaxStart(function () {
    $('#loading').fadeIn('slow');
})

$(document).on('click', 'a', function () {

    var pageName = $(this).attr('data-url');
    if (pageName === undefined)
        return;
    loadPage(pageName);

});

$(document).on('click', '#btnLogout', function () {
    logOut();
});

$(document).on('click', '#btnMaximize', function () {
    var sideNav = document.getElementById('sideNav');
    var wrapper = document.getElementById('wrapper');
    $(sideNav).slideToggle('slow');
    window.localStorage.setItem('wrapperPaddingRight', $(wrapper).css('paddingRight'));
    $(wrapper).animate({ paddingRight: '0px' },'slow');

    $(this).addClass('hide');
    $('#btnRestore').removeClass('hide');
});

$(document).on('click', '#btnRestore', function () {
    var sideNav = document.getElementById('sideNav')    ;
    var wrapper = document.getElementById('wrapper');
    var padding = window.localStorage.getItem('wrapperPaddingRight');
    $(sideNav).slideToggle('slow');
    
    $(wrapper).animate({ paddingRight: padding },'slow');
    $(this).addClass('hide');
    $('#btnMaximize').removeClass('hide');
});

/**
 * logout
 */
function logOut(){
    window.localStorage.setItem(KEY_TOKEN, undefined);
    window.localStorage.clear();
    window.location = 'login.php';
}

/**
 * 
 */
function toLastPage() {

    var lastPage = window.localStorage.getItem('lastPage');
    if (isNullOrEmpty(lastPage))
        loadPage('Forms/Dashboard.php')
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

    $('#plcTitle').text(headingText);

}

/**
 * @returns boolean
 */
function checkLogin() {

    var token = getLocalToken();
    if (isNullOrEmpty(token))
        window.location = 'login.php';
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

/**
 * 
 * @param Token token
 */
function buildSideBar(token) {
    var urls = token.urls;
    var menus = Array();

    for (var i = 0; i < urls.length; i++) {
        if (urls[i].menu === null)
            urls[i].menu = 'other';
        if (menus.indexOf(urls[i].menu) < 0)
            menus.push(urls[i].menu);
    }

    var html = '';
    for (var i = 0; i < menus.length; i++) {

        var menu = menus[i];
        html += '<li>';
        html += '<a href="#" data-toggle="collapse" data-target="#m' + i + '">';
        html += '<span>' + menu + '</span><i class="fa fa-fw fa-caret-down"></i>';
        html += '</a>';
        html += '<ul id="m' + i + '" class="collapse">';

        for (var j = 0; j < urls.length; j++) {
            var url = urls[j];
            if (url.menu === menu) {
                html += '<li>';
                html += '<a href="#" data-url="Forms/' + url.url + '.php">' + url.text + '</a>';
                html += '</li>';
            }

        }

        html += '</ul>'
        html += '</li>';
    }
    $('#sideNav').html(html);
}

/**
 * 
 * @param String content
 */
function showModal(content) {
    $('#modal').modal().show();
    $('#plcModalBody').html(content);
}

