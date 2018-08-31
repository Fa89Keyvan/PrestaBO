// JavaScript source code


/**
 * 
 * @param {String} name
 * @param {String} id
 * @param {String} label
 * @param {String} type
 * @param {boolean} readOnly
 */
function input(name, id, label, type = 'text', readOnly = undefined) {
    var readOnly = readOnly === undefined ? '' : 'readonly';
    var html =
        '<div class="col-lg-2 col-md-3 col-sm-12 col-xs-12 pull-right">'+
        '<div class="form-group">' +
        '<label class="control-label" for="' + id + '">' + label + '</label>' +
        '<input name="' + name + '" type="' + type + '" id="' + id + '" class="form-control" ' + readOnly + ' />' +
        '</div></div>';
    return html;
}

/**
 * 
 * @param {any} model
 */
function editorForModel(model) {
    var html = '';
    for (var p in model) {
        html += input(p, p, model[p].label, model[p].type, model[p].readonly)
    }
    return html;
}

/**
 * 
 * @param {String} text
 * @param {String} id
 */
function submit(text, id) {

    return '<div class="col-lg-2 col-md-3 col-sm-12 col-xs-12 pull-right">' +
        '<div class="form-group">' +
        '<label class="control-label" for="' + id + '">&nbsp</label>' +
        '<input type="submit" value="' + text + '" id="' + id + '" class="form-control btn btn-success" />' +
        '</div></div>';
}


