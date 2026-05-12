jQuery(function ($)
{
    $.datepicker.regional["vi-VN"] =
            {
                closeText: "Đóng",
                prevText: "Trước",
                nextText: "Sau",
                currentText: "Hôm nay",
                monthNames: ["Tháng 1,", "Tháng 2,", "Tháng 3,", "Tháng 4,", "Tháng 5,", "Tháng 6,", "Tháng 7,", "Tháng 8,", "Tháng 9,", "Tháng 10,", "Tháng 11,", "Tháng 12,"],
                monthNamesShort: ["Tháng 1", "Tháng 2", "Tháng 3", "Tháng 4", "Tháng 5", "Tháng 6", "Tháng 7", "Tháng 8", "Tháng 9", "Tháng 10", "Tháng 11", "Tháng 12"],
                dayNames: ["Chủ nhật", "Thứ hai", "Thứ ba", "Thứ tư", "Thứ năm", "Thứ sáu", "Thứ bảy"],
                dayNamesShort: ["CN", "Hai", "Ba", "Tư", "Năm", "Sáu", "Bảy"],
                dayNamesMin: ["CN", "T2", "T3", "T4", "T5", "T6", "T7"],
                weekHeader: "Tuần",
                dateFormat: "dd/mm/yy",
                firstDay: 1,
                isRTL: false,
                showMonthAfterYear: false,
                yearSuffix: "",
                changeMonth: true,
                changeYear: true
            };
    $.datepicker.setDefaults($.datepicker.regional["vi-VN"]);
});
$(document).ready(function () {
    $('.mod-text-gioi-thieu .show-more').click(function () {
        if ($('.mod-text-gioi-thieu .box-html').hasClass('active')) {
            $('.mod-text-gioi-thieu .box-html').removeClass('active');
            $('.mod-text-gioi-thieu .show-more').html('Xem thêm');
        } else {
            $('.mod-text-gioi-thieu .box-html').addClass('active');
            $('.mod-text-gioi-thieu .show-more').html('Thu gọn');
        }
    });
    $('.btn-xoa').click(function () {
        $('.number-xsmt').val('');
        $('#number1').focus();
    });
});
function cbvGetChange(curent, Cvalue) {
    $('#validate-error').html('');
    if (!$.isNumeric($('#number' + curent).val())) {
        $('#number' + curent).addClass('invalid-number');
        $('#validate-error').html('Bạn phải nhập số.');
        return false;
    }
    var parentCurent = $('#number' + curent).parents(".form-ul-ss").attr('data-dslist');
    if (Cvalue.length === 2) {
        var testError = 0;
        $('#form-ul-ss-' + parentCurent + ' .number-xsmt').removeClass('invalid-number');
        $('#form-ul-ss-' + parentCurent + ' input[name^="number_soi"]').each(function () {
            var leghtval = $(this).val().length;
            var itemEach = $(this).val();
            var itemID = $(this).attr('data-id');
            if (leghtval > 1 && itemID != curent && itemEach === Cvalue) {
                testError = 1;
                $('#number' + itemID).addClass('invalid-number');
                $('#number' + curent).addClass('invalid-number');
                $('#validate-error').html('Các cặp số trong cùng 1 dãy không được trùng nhau. Vui lòng kiểm tra lại dãy số của bạn.');
            }
        });
        if (Cvalue < 01 || Cvalue > 45) {
            testError = 1;
            $('.mod-chon-ngay-mt .btn-do-ve').attr('disabled', 'disabled');
            $('#number' + curent).addClass('invalid-number');
            $('#validate-error').html('Vui lòng nhập các số từ 01-45.');
//            $('#validate-error').html('Các cặp số trong cùng 1 dãy không được trùng nhau. Vui lòng kiểm tra lại dãy số của bạn.');
        } else if (testError === 0) {
            $('.mod-chon-ngay-mt .btn-do-ve').removeAttr("disabled");
            var nextFocus = ++curent;
            $('#number' + nextFocus).focus();
        } else {
            $('.mod-chon-ngay-mt .btn-do-ve').attr('disabled', 'disabled');
        }
    }
}
function cbvGetChangePower(curent, Cvalue) {
    $('#validate-error').html('');
    if (!$.isNumeric($('#number' + curent).val())) {
        $('#number' + curent).addClass('invalid-number');
        $('#validate-error').html('Bạn phải nhập số.');
        return false;
    }
    var parentCurent = $('#number' + curent).parents(".form-ul-ss").attr('data-dslist');
    if (Cvalue.length === 2) {
        var testError = 0;
        $('#form-ul-ss-' + parentCurent + ' .number-xsmt').removeClass('invalid-number');
        $('#form-ul-ss-' + parentCurent + ' input[name^="number_soi"]').each(function () {
            var leghtval = $(this).val().length;
            var itemEach = $(this).val();
            var itemID = $(this).attr('data-id');
            if (leghtval > 1 && itemID != curent && itemEach === Cvalue) {
                testError = 1;
                $('#number' + itemID).addClass('invalid-number');
                $('#number' + curent).addClass('invalid-number');
                $('#validate-error').html('Các cặp số trong cùng 1 dãy không được trùng nhau. Vui lòng kiểm tra lại dãy số của bạn.');
            }
        });
        if (Cvalue < 01 || Cvalue > 55) {
            testError = 1;
            $('.mod-chon-ngay-mt .btn-do-ve').attr('disabled', 'disabled');
            $('#number' + curent).addClass('invalid-number');
            $('#validate-error').html('Vui lòng nhập các số từ 01-55.');
//            $('#validate-error').html('Các cặp số trong cùng 1 dãy không được trùng nhau. Vui lòng kiểm tra lại dãy số của bạn.');
        } else if (testError === 0) {
            $('.mod-chon-ngay-mt .btn-do-ve').removeAttr("disabled");
            var nextFocus = ++curent;
            $('#number' + nextFocus).focus();
        } else {
            $('.mod-chon-ngay-mt .btn-do-ve').attr('disabled', 'disabled');
        }
    }
}
//max4d custom

function cbvAppenInput() {
    var inputcurent = $('#add-click-appInput').attr('data-sub');
    var newInput = ++inputcurent;
    $('#add-click-appInput').attr("data-sub", newInput);
    $("#cbv-appen-input").append('<input name="number4d_soi[]" id="number" class="date-chooser datepicker number4d" placeholder="Nhập số ..." maxlength="4" autocomplete="off" type="tel" value="" required="required">')
}
//function cbvAppenInputM6() {
////    alert('gg');return false;
//    var inputcurent = $('#add-click-appInputM6').attr('data-sub');
//    var newInput = ++inputcurent;
//    var optionInput = (newInput - 1) * 6;
//    $('#add-click-appInputM6').attr("data-sub", newInput);
//    var htmlAppen = "<ul class='form-ul-ss' id='form-ul-ss-" + newInput + "' data-dslist='" + newInput + "'>";
//    for (var i = 1; i <= 6; i++) {
//        ++optionInput;
//        htmlAppen += "<li class='input tel'><input onkeyup='cbvGetChange(" + optionInput + ", this.value)'  name='number_soi[" + optionInput + "]' class='number-xsmt number-xsmt-0 index-" + optionInput + "' placeholder='--' maxlength='2' autocomplete='off' type='text' id='number" + optionInput + "' data-id='" + optionInput + "'> </li>";
//    }
//    htmlAppen += "</ul>";
//
//    $(".mod-chon-ngay-mt .groups-ul").append(htmlAppen);
//}
