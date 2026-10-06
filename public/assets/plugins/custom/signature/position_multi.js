$(document).ready(function () {
    $('#generate').click(function () {
        var countPosition = $("#number").val();
        $("#signatureList").empty();
        for (var i = 0; i < countPosition; i++) {
            var signName = i + 1;
            $("#signatureList").append('<tr class="tabelRow">'
                + '<td class="text-center"><input type="text" class="form-control form-control-lg form-control-solid text-center" name="field[' + i + ']" id="field[' + i + ']" value="Signature ' + signName + '" readonly /> </td>'
                + '<td class="text-center"><input class="Others" id="Others[' + i + ']" name="Others[' + i + ']" style="display:none"/>'
                + '<input type="radio" name="fieldEdit" style="display: inline-block;" value="' + i + '" checked></td>'
                + '<td class="text-center"><input type="text" class="form-control form-control-lg form-control-solid text-center" name="ket[' + i + ']" id="ket[' + i + ']" readonly /> </td></tr> ');

            var rowCount = $('#thing').length;
            $("#canvasPosition").append('<canvas class="thing" id="thing" name="thing[' + rowCount + ']" style="visibility:hidden;"></canvas>');
        }
    });

    var theThing = document.querySelectorAll("#thing");
    var container = document.querySelector("#contentContainer");

    container.addEventListener("click", getClickPosition, false);
    container.onclick = function () {
        swapCanvases();
        var theThing1 = document.querySelectorAll("#thing");
        var z = $('input[name=fieldEdit]:checked').val();
        var c = theThing1[z].getContext("2d");
        var t = document.getElementById('field[' + z + ']');
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

    function getClickPosition(e) {
        var theThing1 = document.querySelectorAll("#thing");
        var z = $('input[name=fieldEdit]:checked').val();
        var a = ctx.canvas.height;
        var b = ctx.canvas.width;
        var parentPosition = getPosition(e.target);
        var xPosition = e.clientX - parentPosition.x - (theThing1[z].clientWidth / 2);
        var yPosition = e.clientY - parentPosition.y - (theThing1[z].clientHeight / 2) - 7;
        theThing1[z].style.left = (xPosition + 107) + "px";
        theThing1[z].style.top = (yPosition + 77) + "px";
        theThing1[z].innerHTML = Math.round((xPosition + 75) / container.clientWidth * b) + "," + Math.round((container.clientHeight - 30 - yPosition) / container.clientHeight * a);
        theThing1[z].hidden = false;
        var t = theThing1[z].innerHTML;
        var h = document.getElementById('Others[' + z + ']');
        var j = document.getElementById('ket[' + z + ']');
        $(h).val(t + "," + document.getElementById('page_num').textContent);
        $(j).val(document.getElementById('page_num').textContent + " (" + t + ")");

        var form = $('.Others');
        var vals1 = form.map(function () {
            var value = $.trim(this.value)
            return value ? value : undefined;
        }).get();
        $('#PositionList').val(vals1.join('|'));
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
