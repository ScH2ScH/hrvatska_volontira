var modal;

var app = {

    CRUDUpdated: function (message) {
        oTable.fnReloadAjax(null, null, true);
        modal.unbind('hide.bs.modal');
        modal.modal("hide");

        if (message) {
            showNotification(message, 'success');
        }
    },

    CRUDDeleted: function (message) {
        oTable.fnReloadAjax();
        modal.modal("hide");

        if (message) {
            showNotification(message, 'success');
        }
    }

}


function initDatatables(element, source_url) {
    var oTable;
    oTable = element.dataTable({
        "oLanguage": {
            "sLengthMenu": "_MENU_ records per page"
        },
        "bProcessing": true,
        "bServerSide": true,
        "sAjaxSource": source_url,
        "fnDrawCallback": function (oSettings) {
            setIframeListener();
        }
    });
    return oTable;
}


function setIframeListener() {
    $('*[data-toggle="iframe-modal"]').on("click", function () {
        var src = $(this).attr("data-iframe-src");
        $("#iframe-modal iframe").attr("src", src);
        modal = $("#iframe-modal").modal();
    });
}

function showNotification(message, css_class) {
    var notif = $("<div>").attr({class: 'alert-sm alert alert-' + css_class}).text(message);
    notif.append($("<button>").attr({class: "close", "data-dismiss": "alert"}).text('x'));
    $('.notifications').html(notif);

    setTimeout(function () {
        $('.notifications').fadeOut(function () {
            $(this).html("");
            $(this).toggle();
        });

    }, 3000);

}

$(function () {
    $(".select2").select2();
})

function initImageRoll() {
    var imagesToDelete = [];
    $(".image-roll ul li .delete-icon").on("click", function () {
        var id = $(this).parent('li').attr('data-id');

        if ($(this).hasClass("active")) {
            var index = imagesToDelete.indexOf(id);
            if (index > -1) {
                imagesToDelete.splice(index, 1);
            }
        } else {
            imagesToDelete.push(id);
        }

        $("#imagesToDelete").val(JSON.stringify(imagesToDelete));
        $(this).toggleClass("active");
//                console.log($("#imagesToDelete").val());
    })
}


function popupwindow(url, title, w, h) {
    var left = (screen.width / 2) - (w / 2);
    var top = (screen.height / 2) - (h / 2);
    return window.open(url, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);
}