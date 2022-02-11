function picture_prev(e) {
    if (e.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            document.getElementsByTagName("img")[0].setAttribute("src", e.target.result)
        }
        reader.readAsDataURL(e.files[0])
    }
  }

$(function () {
    $(".upload_btn").click(function () {
        var formElem = $(".upload_form")[0];
        var formdata = new FormData(formElem);

        $.ajax({
            url: "serverSideHandler.php",
            data: formdata,
            contentType: false,
            processData: false,
            method: "POST"
        }).done(function (response) {
            $(".reset_form").click() //clicking an html element
            document.getElementsByClassName("img-prev")[0].src = "images/blank.jpg";
            var data = JSON.parse(response);
            if (data.status == 1) {
                var style = document.createElement("style");
                var head = document.getElementsByTagName("head")[0]

                $(style).html(`${data.style}`);

                head.appendChild(style);
            }
        })
    })

    $(document).ready(function () {
        $.ajax({
            url: "serverSideHandler.php",
            data: {"fetch_animation":""},
            method: "POST"
        }).done(function (response) {

            var data = JSON.parse(response);
            if (data.status == 1) {
                var style = document.createElement("style");
                var head = document.getElementsByTagName("head")[0]

                $(style).html(`${data.style}`);

                head.appendChild(style);
            }
        })
    })
})