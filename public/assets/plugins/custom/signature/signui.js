var wrapper = document.getElementById("signature-pad"),
    clearButton = wrapper.querySelector("[data-action=clear]"),
    saveButton = wrapper.querySelector("[data-action=save]"),
    input = document.getElementById("Signature"),
    canvas = wrapper.querySelector("canvas"),
    signaturePad;

function resizeCanvas() {
    var ratio = Math.max(window.devicePixelRatio || 1, 1);
    canvas.width = canvas.offsetWidth * ratio;
    canvas.height = canvas.offsetHeight * ratio;
    canvas.getContext("2d").scale(ratio, ratio);
}

window.onresize = resizeCanvas;
resizeCanvas();

signaturePad = new SignaturePad(canvas);

clearButton.addEventListener("click", function (event) {
    signaturePad.clear();
});

signNextProcess.addEventListener("click", function (event) {
    event.preventDefault();
    if (!signaturePad.isEmpty()) {
        var a = signaturePad.toDataURL();
        $('#signerImage').val(a);
    }
});