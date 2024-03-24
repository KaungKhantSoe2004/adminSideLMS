if (window.location == "http://127.0.0.1:8000/chatRoom") {
    // Scroll to the bottom of the page
    // Using document.documentElement
    document.documentElement.scrollTop =
        document.documentElement.scrollHeight || document.body.scrollTop;

    // Using document.body
    document.body.scrollTop =
        document.body.scrollHeight || document.documentElement.scrollTop;

    // alert("scroll");
}
// alert(window.location);
