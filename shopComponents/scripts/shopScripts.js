$(document).ready(function() {
    var partid = 0;

    $('#testButton').click(function() {
        $.ajax({
            url: 'testScript.php',
            type: 'post',
            success: function(response) {
                $('#testP').html(response);
            }
        });
    });

    $('#writeCart').click(function() {
        $('#paymentModal').modal("show");

        $.ajax({
            url: 'writeCart.php',
            type: 'post',
            success: function(response) {
                $('#cartP').html(response);
            }
        });
    });

    $('body').on('click', '.partButton', function() {
        partid = $(this).data("part-id");
        $('#partModal').modal('show');

        $('#ammount').popover('hide');
        $('.partLoaded').hide();
        $('#partLoading *').show();

        $.ajax({
            url: 'part.php',
            type: 'post',
            data: {
                id: partid
            },
            success: function(response) {
                $('#partModalTitle').html(response.name);
                $('#partImg').attr("src", response.img_path);

                $('#priceNormalWithout').html("Kč " + ReturnPrice(false, response.price, false));
                $('#priceNormalWith').html("Kč " + ReturnPrice(true, response.price, false));
                $('#priceWithout').html("Kč " + ReturnPrice(false, response.price, true));
                $('#priceWith').html("Kč " + ReturnPrice(true, response.price, true));

                $('#manufacturer').html(response.manufacturer);
                $('#brand').html(response.brand);
                $("#code").html(response.code);

                $('#storage').html(response.storage > 0 ? "Skladem <b>" +
                    response.storage + "</b> ks" : "<b>Není skladem</b>"
                );

                $('#code').html(response.code);
            },
            complete: function() {
                $('.partLoaded').show(1000);
                $('#partLoading *').hide(1000);
            },
            error: function(xhr, status, error) {
                alert(error);
            },
            dataType: "json"
        });
    });

    $('#add-to-cart-btn').click(function() {
        var ammount = $('#ammount').val();
        if (ammount < 1) {
            $('#ammount').popover('show');
        } else {
            $.ajax({
                url: 'addToCart.php',
                type: 'post',
                data: {
                    id: partid,
                    ammount: ammount
                },
                success: function(response) {
                    $('#partModal').modal('hide');
                }
            });
        }
    });

    $('.cartButton').click(function() {
        WriteCartContent();
    });

    $('body').on('click', '.removeButton', function() {
        var index = $(this).data("array-index");
        $.ajax({
            url: 'removeFromCart.php',
            type: 'post',
            data: {
                index: index
            },
            success: function(response) {
                WriteCartContent();
            }
        });
    });

    $('#orderOverviewButton').click(function() {
        $('#orderOverviewModal').modal('show');

        $('#orderOverviewLoaded').hide();
        $('#orderOverviewLoading *').show();

        $.ajax({
            url: 'cart.php',
            type: 'post',
            success: function(response) {
                var text = "";
                var sumWith = 0;
                var sumWithout = 0;
                for (var i = 0; i < response.length; i++) {
                    var totalWith = response[i].ammount * ReturnPrice(true, response[i].price, true);
                    sumWith += totalWith;

                    var totalWithout = response[i].ammount * ReturnPrice(false, response[i].price, true);
                    sumWithout += totalWithout;

                    text += "<tr>";
                    text += "<th scope='row'>" + (i + 1) + "</th>";
                    text +=
                        "<td><img style='max-height: 50px' class='img-thumbnail' src='imgs/parts/" +
                        response[i].img + "'>&nbsp;&nbsp;" + response[i]
                        .name + "</td>";
                    text += "<td>" + response[i].ammount + "</td>";
                    text += "<td>" + totalWith + "</td>";
                    text += "<td>" + totalWithout + "</td>";
                    text += "</tr>";
                }
                text += "<tr>";
                text += "<td><b>Součet</b></td>";
                text += "<td>&nbsp;</td>";
                text += "<td>&nbsp;</td>";
                text += "<td><b>" + sumWith + "</b></td>";
                text += "<td><b>" + sumWithout + "</b></td>";
                text += "</tr>";
                $('#orderOverviewBody').html(text);
            },
            complete: function() {
                $('#orderOverviewLoaded').show(1000);
                $('#orderOverviewLoading *').hide(1000);
            },
            dataType: "json"
        });
    });

    $('#contactFormButton').click(function() {
        $('#contactFormModal').modal('show');
        $('#deliveryAddressForm').hide();
    });

    $('#submitContactForm').click(function() {
        var canProceed = 0;

        for (var i = 1; i < ($('#deliveryAddress').is(":checked") ? 11 : 7); i++) {
            var inputId = "#validationCustom" + (i < 10 ? "0" : "") + i;
            var currentInput = $(inputId);
            canProceed += UpdateValidationClasses(currentInput, currentInput.val())
        }

        var check = $('#invalidCheck');
        canProceed += UpdateValidationClasses(check, check.is(':checked'));

        if (canProceed == ($('#deliveryAddress').is(":checked") ? 11 : 7)) {
            $('#contactFormModal').modal("hide");
            $('#paymentModal').modal("show");
        }
    });

    $('#deliveryAddress').change(function() {
        if (this.checked) {
            $('#deliveryAddressForm').show(500);
        } else {
            $('#deliveryAddressForm').hide(500);
        }
    });
});

function UpdateValidationClasses(object, valid) {
    if (!valid) {
        if (object.hasClass('is-valid')) {
            object.removeClass('is-valid');
        }

        object.addClass('is-invalid');

        return 0;
    } else {
        if (object.hasClass('is-invalid')) {
            object.removeClass('is-invalid');
        }

        object.addClass('is-valid');

        return 1;
    }
}

function ReturnSessionVar(varToReturn) {
    var result;
    $.ajax({
        url: "returnSessionVars.php",
        type: "post",
        async: false,
        success: function(response) {
            result = response[varToReturn];
        },
        error: function(error) {
            alert(error);
        },
        dataType: "json"
    });
    return result;
}

function ReturnPrice(dph, base, dis) {
    return (base * (dis ? ((parseFloat(ReturnSessionVar("discount")) - 100) / -
        100) : 1) * (dph ? 1.21 : 1)).toFixed(2);
}

function WriteCartContent() {
    if (ReturnSessionVar("cartCount") > 0) {
        $('#cartModal').modal('show');

        $('#cartLoaded').hide();
        $('#cartLoading *').show();

        $.ajax({
            url: 'cart.php',
            type: 'post',
            success: function(response) {
                var text = "";
                for (var i = 0; i < response.length; i++) {
                    text += "<tr>";
                    text += "<th scope='row'>" + (i + 1) + "</th>";
                    text +=
                        "<td><img style='max-height: 50px' class='img-thumbnail' src='imgs/parts/" +
                        response[i].img + "'>&nbsp;&nbsp;" + response[i]
                        .name + "</td>";
                    text += "<td>" + response[i].ammount + "</td>";
                    text +=
                        '<td><button type="button" class="btn removeButton" data-array-index="' +
                        i +
                        '"><i class="bi bi-x"></i></button>';
                    text +=
                        '<button type="button" class="btn partButton" data-part-id="' +
                        response[i].id +
                        '" data-dismiss="modal"><i class="bi bi-eye"></i></button></td>';
                    text += "</tr>";
                }
                $('#cartBody').html(text);
            },
            complete: function() {
                $('#cartLoaded').show(1000);
                $('#cartLoading *').hide(1000);
            },
            dataType: "json"
        });
    } else {
        $('#emptyCartModal').modal('show');
    }
}