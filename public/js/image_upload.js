const showThumbnail = (btnHasClicked) => {
    const imgTag = btnHasClicked.parentNode.querySelector('.img-thumbnail');
    const file = btnHasClicked.files[0];
    const reader = new FileReader();

    reader.onloadend = function () {
        imgTag.src = reader.result;
    }

    if (file) {
        reader.readAsDataURL(file);
    } else {
        imgTag.src = "";
    }
}