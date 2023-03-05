$(document).ready(function () { basePageInitial();pageInitial(); });
$(window).resize(function () { basePageInitial();pageInitial(); });
function pageLoad() {
    var isAsyncPostback = Sys.WebForms.PageRequestManager.getInstance().get_isInAsyncPostBack();
    if (isAsyncPostback) {
        $(document).ready(function () {
            basePageInitial();
            pageInitial();
        });
    }
}

function basePageInitial() {
    $(".ChangePassword").colorbox({ iframe: true, width: "546px", height: "240px", overlayClose: false, escKey: false });
    $("#browser").treeview({toggle: function () {}});
    
}

function newPopup(url, strWidth, strHeight) {
    var strPage = url.split(".")[0];
    var strOpetion = "resizable=yes,scrollbars=yes,status=yes,left=0,top=0,width=" + strWidth + ",height=" + strHeight;
    popupWindow = window.open(url, strPage, strOpetion);
    popupWindow.focus();

}

function newPopup2(url, strWidth, strHeight) {
    var strPage = url.split(".")[0];
    var strOpetion = "resizable=yes,scrollbars=yes,status=yes,left=0,top=0,width=" + strWidth + ",height=" + strHeight;
    popupWindow = window.open(url, strPage, strOpetion);
    popupWindow.focus();

}

function alertSuccess() {
    $.unblockUI();
    $.blockUI({
        theme: true,
        title: 'System Message',
        message: '<p>Save success!!</p>',
        timeout: 1500
    });
}