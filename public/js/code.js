function redirect(url) {
    window.location.href = url
}

function addTimes(n) {
    $('.times:eq(' + n + ')').removeClass('hidden')
}

function removeTimes(n) {
    $('.times:eq(' + n + ')').addClass('hidden')
}

function calculatePrice(word, price) {
    if (word == '') {
        totalPrice = '$ 0'
        timeFrame = '0 hours'
    } else {
        totalPrice = word * price
        if (totalPrice < 100) {
            totalPrice = '&#162 ' + totalPrice
        } else {
            totalPrice = totalPrice / 100
            totalPrice = '$ ' + totalPrice
        }
        if (word <= 500) {
            timeFrame = "Your project will take 24 hours to be completed"
        } else {
            timeFrame = "Your project will take 48 hours to be completed"
        }
    }

    document.querySelector('.total_price').innerHTML = totalPrice
    document.querySelector('.time_frame').innerHTML = timeFrame
}

function timer(id) {
    var setTime = setInterval(function() {
        var request = $.ajax({
            url: "/getTime?id=" + id,
            method: "GET",
        })

        request.done(function(time) {
            $('#time').html(time);
            if (time == 'Time Up') {
                clearInterval(setTime)
            }
        });


    }, 1000)
}

function changeProfilePicture() {
    var form = new FormData()
    var file = document.querySelector('#picture').files[0];
    form.append('picture', file)
    $.ajax({
        url: "/changeprofilepicture",
        method: "POST",
        data: form,
        processData: false,
        contentType: false,
        success: function(resp) {
            document.querySelector('#img').src = "/storage/" + resp + '?' + Math.random()

        },
        error: function() {

        }
    })
}