import Alpine from 'alpinejs'
import riadh_app from './riadh_app.js'
import collapse from '@alpinejs/collapse'

Alpine.prefix("xyz-");
Alpine.plugin(collapse)
Alpine.data('riadh_app', riadh_app)

window.Alpine = Alpine

Alpine.start()

function showMeaning (event){
    var createdDiv,
        info = getSelectionInfo(event);

    if (!info) { return; }

    window.riadh_app.info = info
    window.riadh_app.fetchMeaning()
}

function getSelectionInfo(event) {
    var word;
    var boundingRect;
    var selection = window.getSelection();
    var range = selection.getRangeAt(0);
    var context = range.commonAncestorContainer.data.substring(0, range.startOffset) + '{$&' + range.commonAncestorContainer.data.substring(range.startOffset, range.endOffset) + '&$} ' + range.commonAncestorContainer.data.substring(range.endOffset).replace(/\n/g, ' ').replace(/\s+/g, ' ').trim();

    if (window.getSelection().toString().length > 1) {
        word = window.getSelection().toString();
        boundingRect = getSelectionCoords(window.getSelection());
    } else {
        return null;
    }

    var top = boundingRect.top + window.scrollY,
        bottom = boundingRect.bottom + window.scrollY,
        left = boundingRect.left + window.scrollX,
        right = boundingRect.right + window.scrollX;

    if (boundingRect.height == 0) {
        top = event.pageY;
        bottom = event.pageY;
        left = event.pageX;
        right = event.pageX;
    }

    return {
        top: top,
        bottom: bottom,
        left: left,
        right,
        word: word,
        context,
        clientY: event.clientY,
        height: boundingRect.height
    };
}

function getSelectionCoords(selection) {
    var oRange = selection.getRangeAt(0); //get the text range
    var oRect = oRange.getBoundingClientRect();
    return oRect;
}

document.addEventListener('dblclick', ((e) => {
    showMeaning(e)
    return;
}))
