

var timer = {
	// called: 0,
	max: 0,
	localTime: {
		remaining: 0,
		now: 0
	},
	srvTime: {
		max: 0,
		remaining: 0,
		now: 0
	},
	tickCallback: null,
	timeoutCallback: null,
	tick: function () {
		// console.log(this.called);
		// this.called++;

		// If max has not been set
		if (this.srvTime.max == 0) {
			this.sync();
		}

		// Get local millis (converted from micro)
		this.localTime.now = (new Date).getTime() / 1000;

		// Calc the remaining
		this.localTime.remaining = this.srvTime.max - this.localTime.now;
		// console.log('%i = %i - %i', this.localTime.remaining, this.srvTime.max, this.localTime.now);

		// Tick @ 1s and update view
		setTimeout(function() {
			timer.tickCallback(timer.localTime.remaining);
			// Check for timeout
			if (timer.localTime.remaining > 0) {
				// console.log('remaining : ' + timer.localTime.remaining);
				timer.tick(timer.localTime.remaining);
			} else {
				// console.log('Timeout :' + timer.localTime.remaining);
				// console.log('Max :' + timer.srvTime.max);
				// console.log('Now :' + timer.localTime.now);
				timer.timeoutCallback();
			}
		}, 1000);
	},
	sync: function () {
        $.ajax({
            type: 'get',
            url : 'exam/timer',
			async: false,
            success: function(data) {
				// console.log('Success ajax timer sync ' + data.max);
				timer.srvTime.max = data.max;
				// console.log('Fetch maxtime : ' + data.max);
				timer.srvTime.now = data.now;
				timer.srvTime.remaining = data.remaining;
            },
            error: function(e) {
                console.error("Timer can't be synced. Will use local time instead. Cause : " + e.message);
            }
        });
	}
};

$(document).ready(function() {

    // Prevent premature submission
    $(window).keydown(function(event) {
        return (event.keyCode == 13)? false : true;
    });

    var subject = $('form').attr('id').replace('-paper', '');

    // Backup answer, accident prevention
    $('.choice-radio').click(function (ev) {
        var qid = $(this).attr('name').split('-')[0];
        var val = $(this).attr('value');

        if (val != '') {
            localStorage.setItem(subject + '-' + qid, val);
        }
    });

    function loadChoices() {
        var quests = $("div.row.question").get();  // Get questions count
        for(var i = 0; i < quests.length; i++) {
            var value = localStorage.getItem(subject + '-' + quests[i].id);
            if(value == null) {
                continue;
            }
            $("#" + quests[i].id + " input[value=" + value + "]").prop('checked', true);
        }
    }

    function loadFromServer() {
        var $exam_id = $('#exam_id').val();
        var $subject_id = $('.exam-paper').attr('data-subjectId');
        var $questionDb;

        $.ajax({
            type: 'get',
            url : '/user/exam/get-answer',
            data: {
                exam_id: $exam_id,
                subject_id: $subject_id
            },
            success: function(data) {
                var quests = $("div.row.question").get();  // Get questions count
                var quest_db = data.question;

                quest_db.forEach(function(element, index, array) {
                    var exam_question = $('.question#' + element.question_id);
                    if (exam_question.length) {
                        exam_question.find('input[value='+element.answer+']').prop('checked', true);
                        console.log(exam_question.find('[name='+element.exam_id+'-ch]:checked'));
                    }
                });
            },
            error: function() {
                console.error('Jawaban gagal dimuat dari server, memuat dari simpanan local');
            }
        });

    }

    // On ready load all saved answer
    // Load from local THEN from server
    //      1. Faster response from user perspective
    //      2. If local choice is different than in DB, then user can notice and change it
    //                  (actually.. it's not a problem...)
    loadChoices();
    loadFromServer();

	timer.tickCallback = function (remaining) {
		remaining = Math.floor(remaining);
		console.log('callback rem : ' + remaining);
		var h = Math.floor((remaining / 60 / 60) % 24);
		var m = Math.floor((remaining / 60) % 60);
		var s = Math.floor((remaining) % 60);

		var timerClass = 'timer col-sm-1 ';
		// Warn participant
		if (h == 1 && m > 40) {
			timerClass += 'time-relax';
		} else if (h == 1 && m > 0) {
			timerClass += 'time-running';
		} else if (h == 0 && m > 20) {
			timerClass += 'time-warning';
		} else if (h == 0 && m < 20) {
			timerClass += 'time-critical';
		}
		console.log('class : ' + timerClass + '; m : ' + m);

		$('.timer').attr('class', timerClass);

		if(h < 10) {
			h = '0' + h.toString();
		}
		if(m < 10) {
			m = '0' + m.toString();
		}
		if(s < 10) {
			s = '0' + s.toString();
		}

		$('.timer').html(h + ' : ' + m + ' : ' + s);
	};

	timer.timeoutCallback = function () {
		$('input[type=submit]').trigger('click');
	};

	timer.tick();

    function submitAnswer(callback) {

        // JSON syntax
        // "answer":[
        //     {"id":"1", "answer":"A"},
        //     {"id":"2", "answer":"C"},
        //     {"id":"42",`"answer":"B"}
        // ]

        var $answer = [];
        var $exam_id = $('#exam_id').val();

        $('.question').each(function() {
            var question_answer = {};
            var id = this.id;
            question_answer['id'] = id;
            question_answer['answer'] = $(this).find('[name='+id+'-ch]:checked').val();

            // Just insert the data of question that have answer
            // to lighten the load of server>
            if(question_answer['answer']) {
                $answer.push(question_answer);
            }
        });

		/**
		 * For case prevention where the team open many tab with different subject
		 * it will save the whole answers (not only the page currently on, as
		 * subjected by above 'jQuery.each()').
		 */
		var subject = $('form').attr('id').replace('-paper', '');
		for(var i = 0; i < localStorage.length; i++) {
			var question_answer = {};

			// Get the key
			var key = localStorage.key(i);
			// Check it is not the current subject
			var cacheSubject = key.split('-')[0];
			question_answer['id'] = key.split('-')[1];
			// console.log('subject : ' + cacheSubject + ' ; id : ' + question_answer['id']);

			if (cacheSubject == subject) {
				continue;
			}

			// Get it's value
			question_answer['answer'] = localStorage.getItem(key);
			var cacheVal = question_answer['answer'];
			// console.log('val : ' + cacheVal);

			// Check it is not contains other than A-E
			if (cacheVal == 'A' || cacheVal == 'B' || cacheVal == 'C'
				|| cacheVal == 'D' || cacheVal == 'E') {
				// Push it into array
                $answer.push(question_answer);
			}
		}

		// console.log('Answer : ');
		// console.log($answer);

        $.ajax({
            async: false,
            type: 'POST',
            url : '/user/exam/submit',
            data: {
                answers: $answer,
                exam_id: $exam_id
            },
            success: function() {
                callback();
            },
            error: function() {
                alert('Gagal menyimpan jawaban, harap mengulangi menekan tombol.');
            }
        });
    }

    $('.exam-paper').submit(function(e) {
        e.preventDefault();
        var self = this;

        submitAnswer(self.submit());
    });

    $('.subject-link').on('click', function(e) {
        e.preventDefault();
        var self = this;

        submitAnswer(function() {
            window.location = self.href;
        });
    });
});
