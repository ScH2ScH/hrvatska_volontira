/**
 * Created by lovro on 02/01/15.
 */
var myChart = null
/*Search stats*/
$(document).ready(function () {
    var $button = $('#SearchBtn').hide();
    var $select = $('#selectYear').hide();
    var $action = $('#selectAction').hide();
    var $loading = $('#loadingDiv').hide();
    var $search = $('#statsSearch').hide();
    $(document)
        .ajaxStart(function () {
            emptyPrevious('');
            $loading.show();
            $search.hide();
            $select.hide();
            $action.hide();
            $button.hide();
        })
        .ajaxStop(function () {
            $loading.hide();
            $search.show();
            $select.show();
            $action.show();
            $button.show();
        });


    $("#searchBox").keyup(function () {
        var filter = $(this).val(), count = 0;
        $("#top-ten li").each(function () {
            if ($(this).text().search(new RegExp(filter, "i")) < 0) {
                $(this).fadeOut();
            } else {
                $(this).show();
                count++;
            }
        });
    });
});

jQuery(window).load(function () {
    var $loading = $('#loadingDiv').hide();
    $loading.hide();
});

/*Search events*/
$(document).ready(function () {
    $("#searchBox").keyup(function () {
        var filter = $(this).val(), count = 0;
        $(".card").each(function () {
            if ($(this).text().search(new RegExp(filter, "i")) < 0) {
                $(this).fadeOut();
            } else {
                $(this).show();
                count++;
            }
        });
    });
});


function getStats(year, url, action) {

    $.ajax({
        type: 'GET',
        url: url,
        dataType: 'text',
        data: {year: year, action: action},
        success: function (data) {
            parseResponse(data)
        },
        error: function (data) {
        }
    });
}


function emptyPrevious(title) {
    $('#top-ten').empty()
    $('#stats-name').empty().html(title)

    if (myChart) {
        myChart.destroy()
    }
}


function parseResponse(data) {

    var options = {
        scaleShowLabelBackdrop: true,
        scaleBackdropColor: "rgba(255,255,255,0.75)",
        scaleBeginAtZero: true,
        scaleBackdropPaddingY: 2,
        scaleBackdropPaddingX: 2,
        scaleShowLine: true,
        segmentShowStroke: true,
        segmentStrokeColor: "#fff",
        segmentStrokeWidth: 1,
        animationSteps: 100,
        animationEasing: "easeOutBounce",
        animateRotate: true,
        animateScale: true,
        legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>"
    };

    var elements = []
    var json = $.parseJSON(data);
    $.each(json, function () {
        $.each(this, function (k, v) {

            var city = {
                value: v.value * 100,
                color: v.color,
                highlight: v.highlight,
                label: v.label
            }
            elements.push(city)
        });
    });
    var ctx = $("#volunteersChart").get(0).getContext("2d");
    myChart = new Chart(ctx).Pie(elements, options);
    createSideList(elements)
}

function createSideList(elements) {
    elements.sort(function (a, b) {
        return parseFloat(a.value) - parseFloat(b.value)
    });
    var items = ""
    $.each(elements.reverse(), function (k, v) {
        items += "<li><span class='legend-square' style='background:" + v.color + "'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>" + v.label + " : " + (v.value).toFixed(0) + "</li>"
    })
    $('#top-ten').html(items)
}

function fillSelectBox() {
    getSelectData('years', 'selectYear')
    getSelectData('actions', 'selectAction')
}

function getSelectData(type, id) {
    var url = '/stats/' + type;
    $.ajax({
        type: 'GET',
        url: url,
        dataType: 'text',
        data: {},
        success: function (data) {
            var json = $.parseJSON(data);
            var items

            if (type == "years")
                items = "<option value='' disabled selected>Odaberite godinu</option>";
            else
                items = "<option value='' disabled selected>Odaberite akciju</option>";
            $.each(json[type], function (k, v) {
                items += "<option value='" + v + "'>" + v + "</option>";
            });
            $('#' + id).html(items)
        },
        error: function (data) {
            console.log("error")
        }
    });
}

function removeActiveClass() {
    $('#stats-city').removeClass("change-category-active")
    $('#stats-county').removeClass("change-category-active")
    $('#stats-region').removeClass("change-category-active")
}

function removeActiveClassAlternative() {
    $('#stats-hosts').removeClass("change-category-active")
    $('#stats-volunteers').removeClass("change-category-active")
    $('#stats-working-hours').removeClass("change-category-active")
}