$(document).ready(function () {
    var listUser = [];
    $("#headingOne div").click(function () {
        $('.thing').remove();
        $('.tabelRow').remove();
    });

    $("#headingTwo div").click(function () {
        $('.thing').remove();
        $('.tabelRow').remove();
    });

    $.ajax({
        type: "GET",
        url: '/Subscriber/GetListUser',
        success: function (data) {
            var option4 = '';
            for (var i in data.objek) {
                option4 += '<option value="' + data.objek[i].Id + '">' + data.objek[i].Email + '</option>';
                listUser.push(data.objek[i].Email);
            }
            $('#UserSelect').typeahead({
                hint: true,
                highlight: true,
                minLength: 1
            }, {
                    name: 'user',
                    source: substringMatcher(listUser)
                });
        }
    });
    $('#AddInternal').click(function () {
        var i = $('.tabelRow').length;
        var emailUser = document.getElementById("UserSelect").value;

        if (emailUser === '' || emailUser === null) {
            swal.fire({
                text: "Please select one user",
                icon: "error",
                buttonsStyling: false,
                confirmButtonText: "Back",
                confirmButtonClass: "btn font-weight-bold btn-light"
            }).then(function () {
                return;
            });
        } else {
            if (listUser.indexOf(emailUser) > -1) {
                if (i > 0) {
                    var dataReceiver = document.getElementsByClassName("IdReceiver");
                    var names = [].map.call(dataReceiver, function (input) {
                        return input.value;
                    });
                    if (names.includes(emailUser)) {
                        swal.fire({
                            text: "User already added, please select another one.",
                            icon: "error",
                            buttonsStyling: false,
                            confirmButtonText: "Back",
                            confirmButtonClass: "btn font-weight-bold btn-light"
                        }).then(function () {
                            return;
                        });
                    } else {
                        $("#internalList").append('<tr class="tabelRow" name="tabelRow[' + i + ']">'
                            + '<td class="text-center"><input type="text" class="IdReceiver form-control form-control-solid text-center" name="IdReceiver[' + i + ']" id="IdReceiver[' + i + ']" value="' + emailUser + '" readonly /> </td>'
                            + '<td class="text-center"><input class="IntOthers" id="IntOthers[' + i + ']" name="IntOthers[' + i + ']" style="display:none"/>'
                            + '<input type="radio" name="fieldEdit" style="display: inline-block;" value="' + i + '" checked></td>'
                            + '<td class="text-center"><input type="text" class="form-control form-control-solid text-center" value="0(0,0)" name="ket[' + i + ']" id="ket[' + i + ']" readonly /> </td>'
                            + '<td><a href="javascript:void(0);" class="removeRow form-control text-center">Remove</a></td></tr>');

                        var j = $('#thing').length;
                        $("#canvasPosition").append('<canvas class="thing" id="thing" name="thing[' + j + ']" style="visibility:hidden;"></canvas>');
                    }
                } else {
                    $("#internalList").append('<tr class="tabelRow" id="tabelRow[' + i + ']">'
                        + '<td class="text-center"><input type="text" class="IdReceiver form-control form-control-solid text-center" name="IdReceiver[' + i + ']" id="IdReceiver[' + i + ']" value="' + emailUser + '" readonly /> </td>'
                        + '<td class="text-center"><input class="IntOthers" id="IntOthers[' + i + ']" name="IntOthers[' + i + ']" style="display:none"/>'
                        + '<input type="radio" name="fieldEdit" style="display: inline-block;" value="' + i + '" checked></td>'
                        + '<td class="text-center"><input type="text" class="form-control form-control-solid text-center" value="0(0,0)" name="ket[' + i + ']" id="ket[' + i + ']" readonly /> </td>'
                        + '<td><a href="javascript:void(0);" class="removeRow form-control text-center">Remove</a></td></tr>');

                    var j = $('#thing').length;
                    $("#canvasPosition").append('<canvas class="thing" id="thing" name="thing[' + j + ']" style="visibility:hidden;"></canvas>');
                }
            } else {
                swal.fire({
                    text: "User Not Found, try another one",
                    icon: "error",
                    buttonsStyling: false,
                    confirmButtonText: "Back",
                    confirmButtonClass: "btn font-weight-bold btn-light"
                }).then(function () {
                    return;
                });
            }
        }             

        document.getElementById('UserSelect').value = "";
    });

    $('#AddExternal').click(function () {
        var i = $('.tabelRow').length;

        var emailUser = document.getElementById("UserInput").value;

        if (emailUser === '' || emailUser === null) {
            swal.fire({
                text: "Please input user email first",
                icon: "error",
                buttonsStyling: false,
                confirmButtonText: "Back",
                confirmButtonClass: "btn font-weight-bold btn-light"
            }).then(function () {
                return;
            });
        } else {
            if (i > 0) {
                var dataReceiver = document.getElementsByClassName("IdReceiver");
                var names = [].map.call(dataReceiver, function (input) {
                    return input.value;
                });
                if (emailUser == names[i]) {
                    swal.fire({
                        text: "User already added, please select another one.",
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Back",
                        confirmButtonClass: "btn font-weight-bold btn-light"
                    }).then(function () {
                        return;
                    });
                } else {
                    $("#externalList").append('<tr class="tabelRow">'
                        + '<td class="text-center"><input type="text" class="IdReceiver form-control form-control-solid text-center" name="IdReceiver[' + i + ']" id="IdReceiver[' + i + ']" value="' + emailUser + '" readonly /> </td>'
                        + '<td class="text-center"><input class="ExtOthers" id="ExtOthers[' + i + ']" name="ExtOthers[' + i + ']" style="display:none"/>'
                        + '<input type="radio" name="fieldEdit" style="display: inline-block;" value="' + i + '" checked></td>'
                        + '<td class="text-center"><input type="text" class="form-control form-control-solid text-center" value="0(0,0)" name="ket[' + i + ']" id="ket[' + i + ']" value="0(0,0)" readonly /> </td>'
                        + '<td><a href="javascript:void(0);" class="removeRow form-control text-center">Remove</a></td></tr>');

                    var j = $('#thing').length;
                    $("#canvasPosition").append('<canvas class="thing" id="thing" name="thing[' + j + ']" style="visibility:hidden;"></canvas>');
                }
            } else {
                $("#externalList").append('<tr class="tabelRow">'
                    + '<td class="text-center"><input type="text" class="IdReceiver form-control form-control-solid text-center" name="IdReceiver[' + i + ']" id="IdReceiver[' + i + ']" value="' + emailUser + '" readonly /> </td>'
                    + '<td class="text-center"><input class="ExtOthers" id="ExtOthers[' + i + ']" name="ExtOthers[' + i + ']" style="display:none"/>'
                    + '<input type="radio" name="fieldEdit" style="display: inline-block;" value="' + i + '" checked></td>'
                    + '<td class="text-center"><input type="text" class="form-control form-control-solid text-center" value="0(0,0)" name="ket[' + i + ']" id="ket[' + i + ']"  value="0(0,0)" readonly /> </td>'
                    + '<td><a href="javascript:void(0);" class="removeRow form-control text-center">Remove</a></td></tr>');

                var j = $('#thing').length;
                $("#canvasPosition").append('<canvas class="thing" id="thing" name="thing[' + j + ']" style="visibility:hidden;"></canvas>');
            }
        }        

        document.getElementById('UserInput').value = "";
    });

    var theThing = document.querySelectorAll("#thing");
    var container = document.querySelector("#contentContainer");

    container.addEventListener("click", getClickPosition, false);
    container.onclick = function () {
        swapCanvases();
        var theThing1 = document.querySelectorAll("#thing");
        var z = $('input[name=fieldEdit]:checked').val();
        var c = theThing1[z].getContext("2d");
        var t = document.getElementById('IdReceiver[' + z + ']');
        var k = $(t).val();
        c.font = "20px Arial";
        c.fillText(k, 10, 50);
    };


    function swapCanvases() {
        var theThing1 = document.querySelectorAll("#thing");
        var z = $('input[name=fieldEdit]:checked').val();
        if (theThing1[z].style.visibility == 'hidden') {
            theThing1[z].style.visibility = 'visible';
        }
    }

    $("#internalList").on('click', '.removeRow', function () {
        var z = $('input[name=fieldEdit]:checked').val();

        var selectCanvas = $('canvas[name="thing[' + z + ']"]');
        $(selectCanvas).remove();

        $(this).closest('.tabelRow').remove();

        $('.IdReceiver').each(function (index) {
            $(this).attr('name', 'IdReceiver[' + index + ']');
        });
        $('.thing').each(function (index) {
            $(this).attr('name', 'thing[' + index + ']');
        });

        $(this).prop('checked', false);
    });

    $("#externalList").on('click', '.removeRow', function () {
        var z = $('input[name=fieldEdit]:checked').val();

        var selectCanvas = $('canvas[name="thing[' + z + ']"]');
        $(selectCanvas).remove();

        $(this).closest('.tabelRow').remove();

        $('.IdReceiver').each(function (index) {
            $(this).attr('name', 'IdReceiver[' + index + ']');
        });

        $('.thing').each(function (index) {
            $(this).attr('name', 'thing[' + index + ']');
        });

        $(this).prop('checked', false);
    });

    function getClickPosition(e) {
        var theThing1 = document.querySelectorAll("#thing");
        var z = $('input[name=fieldEdit]:checked').val();
        var a = ctx.canvas.height;
        var b = ctx.canvas.width;
        var parentPosition = getPosition(e.currentTarget);
        var xPosition = e.clientX - parentPosition.x - (theThing1[z].clientWidth / 2);
        var yPosition = e.clientY - parentPosition.y - (theThing1[z].clientHeight / 2) - 7;
        theThing1[z].style.left = (xPosition + 105) + "px";
        theThing1[z].style.top = (yPosition + 77) + "px";
        theThing1[z].innerHTML = Math.round((xPosition + 75) / container.clientWidth * b) + "," + Math.round((container.clientHeight - 30 - yPosition) / container.clientHeight * a);
        theThing1[z].hidden = false;
        var t = theThing1[z].innerHTML;
        var intPoint = document.getElementById('IntOthers[' + z + ']');
        $(intPoint).val(t + "," + document.getElementById('page_num').value);
        var extPoint = document.getElementById('ExtOthers[' + z + ']');
        $(extPoint).val(t + "," + document.getElementById('page_num').value);

        var displayPoint = document.getElementById('ket[' + z + ']');
        $(displayPoint).val(document.getElementById('page_num').value + " (" + t + ")");

        var formInt = $('.IntOthers');
        var valInt = formInt.map(function () {
            var value = $.trim(this.value)
            return value ? value : undefined;
        }).get();
        $('#PositionInternal').val(valInt.join('|'));

        var formExt = $('.ExtOthers');
        var valExt = formExt.map(function () {
            var value = $.trim(this.value)
            return value ? value : undefined;
        }).get();
        $('#PositionExternal').val(valExt.join('|'));

        var formRec = $('.IdReceiver');
        var valRec = formRec.map(function () {
            var value = $.trim(this.value)
            return value ? value : undefined;
        }).get();
        $('#EmailReceiver').val(valRec.join('|'));
        $('#LabelReceiver').html(valRec.join(', '));
        console.log(valInt);

        $("#internalList").on('click', '.removeRow', function () {
            var z = $('input[name=fieldEdit]:checked').val();

            valRec.splice(z, 1);
            $('#EmailReceiver').val(valRec.join('|'));
            $('#LabelReceiver').html(valRec.join(', '));

            valInt.splice(z, 1);
            $('#PositionInternal').val(valInt.join('|'));
        });

        $("#externalList").on('click', '.removeRow', function () {
            var z = $('input[name=fieldEdit]:checked').val();

            valRec.splice(z, 1);
            $('#EmailReceiver').val(valRec.join('|'));
            $('#LabelReceiver').html(valRec.join(', '));

            valExt.splice(z, 1);
            $('#PositionExternal').val(valExt.join('|'));
        });
    }
});

function getPosition(el) {
    var xPos = 0;
    var yPos = 0;

    while (el) {
        if (el.tagName == "BODY") {
            var xScroll = el.scrollLeft || document.documentElement.scrollLeft;
            var yScroll = el.scrollTop || document.documentElement.scrollTop;

            xPos += (el.offsetLeft - xScroll + el.clientLeft);
            yPos += (el.offsetTop - yScroll + el.clientTop);
        } else {
            xPos += (el.offsetLeft - el.scrollLeft + el.clientLeft);
            yPos += (el.offsetTop - el.scrollTop + el.clientTop);
        }

        el = el.offsetParent;
    }
    return {
        x: xPos,
        y: yPos
    };
}
