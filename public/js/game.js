$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
let startTime = null;

function newGame() {
    let name = $('#name-input').val();
    $.ajax({
        type: "POST",
        dataType: "JSON",
        url: 'new-game',
        data: {'name': name},
        success: function () {
            $('#play-game').removeClass('d-none');
            $('#enter-name').hide();
            startTime = Date.now();
        },
        error: function (response) {
            $('#nameError').text(response.responseText);
        }
    })
}

function guessNumber() {
    let number = parseInt($('#guess').val()) || 0;
    let guessTime = Date.now() - startTime;
    $.ajax({
        type: "POST",
        dataType: "JSON",
        url: 'check/' + number + '?time=' + guessTime,
        data: {'number': number},
        success: function (response) {
            $('#guess').val("");
            if (response.win === true) {
                let notice = document.createElement('div');
                notice.classList.add('alert', 'alert-success');
                let time = new Date(parseInt(response.time)).toISOString().slice(11,19);
                notice.innerText = 'Congratulations! You guessed the combination ' + number + '. Attempts: ' + response.tries + ', time: ' + time + '.';
                document.getElementById('results').prepend(notice);
                document.getElementById('play-form').hidden = true;
            }
            else {
                let par = document.createElement('p');
                par.innerText =  response.tries + '. Number: '+ number + ' => Bulls: ' + response.bulls + ', Cows: ' + response.cows;
                document.getElementById('results').prepend(par);
            $('#numberError').text(response.responseText).hide();
            }
        },
        error: function (response) {
            $('#numberError').text(response.responseText);
        }
    })
}

function giveUp() {
    let number = this.responseText;
    $.ajax({
        type: "GET",
        dataType: "JSON",
        url: 'give-up',

        success: function (response) {
            number = response;
            let notice = document.createElement('div');
            notice.classList.add('alert', 'alert-danger');
            notice.innerText = 'You could not guess the combination ' + number + '.';
            document.getElementById('results').prepend(notice);
            document.getElementById('play-form').hidden = true;
        }
    })
}

function getTop(category) {
    let tbody
    switch (category) {
        case 'tries':
            tbody = document.getElementById('top-tbody-tries');
            tbody.innerHTML = '';
            break;
        case 'times':
            tbody = document.getElementById('top-tbody-times');
            tbody.innerHTML = '';
            break;
    }
    $.ajax({
        type: "GET",
        dataType: "JSON",
        url: 'get-top/' + category,

        success: function (response) {
            console.log(response)
            let i = 1;
            for (let item of response) {
                let time = new Date(parseInt(item.time)).toISOString().slice(11,19);
                let tr  = document.createElement('tr');
                let td0 = document.createElement('td');
                let td1 = document.createElement('td');
                let td2 = document.createElement('td');
                let td3 = document.createElement('td');
                td0.innerText = i.toString();
                td1.innerText = item.name;
                td2.innerText = item.tries;
                td3.innerText = time;
                tr.append(td0, td1, td2, td3);
                tbody.append(tr);
                i++;
            }
        }
    })
}



