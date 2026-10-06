$(document).ready(function () {
    var theThing = document.querySelector("#thing");
    var container = document.querySelector("#contentContainer");

    container.onclick = function () {
        swapCanvases();
    };

    function swapCanvases() {
        if (theThing.style.visibility == 'hidden') {
            theThing.style.visibility = 'visible';
        }
    }

    container.addEventListener("click", getClickPosition, false);

    function getClickPosition(e) {
        var a = ctx.canvas.height;
        var b = ctx.canvas.width;
        var parentPosition = getPosition(e.currentTarget);
        var xPosition = e.clientX - parentPosition.x - (theThing.clientWidth / 2);
        var yPosition = e.clientY - parentPosition.y - (theThing.clientHeight / 2) - 7;
        theThing.style.left = (xPosition + 105) + "px";
        theThing.style.top = (yPosition + 77) + "px";
        theThing.innerHTML = Math.round((xPosition + 75) / container.clientWidth * b) + "," + Math.round((container.clientHeight - 30 - yPosition) / container.clientHeight * a);
        theThing.hidden = false;
        var t = thing.innerHTML;

        $("#PositionList").val(t + "," + document.getElementById('page_num').value);
        console.log(t);
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