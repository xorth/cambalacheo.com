$(document).ready(function() {
    $("input:text[name$='title']").simplyCountable({
        counter: "#counter-title",
        maxCount: 255,
        countDirection: 'up',
        onOverCount: function(count, contable, counter) {
            counter.parents().eq(2).addClass("has-error");
            console.log(counter.parents().eq(2));
        },
        onSafeCount: function(count, countable, counter) {
            counter.parents().eq(2).removeClass("has-error");
        }
    });

    $("textarea[name$='description']").simplyCountable({
        counter: "#counter-description",
        maxCount: 255,
        countDirection: 'up',
        onOverCount: function(count, contable, counter) {
            counter.parents().eq(2).addClass("has-error");
        },
        onSafeCount: function(count, countable, counter) {
            counter.parents().eq(2).removeClass("has-error");
        }
    });

    $("input:text[name$='request']").simplyCountable({
        counter: "#counter-request",
        maxCount: 255,
        countDirection: 'up',
        onOverCount: function(count, contable, counter) {
            counter.parents().eq(2).addClass("has-error");
        },
        onSafeCount: function(count, countable, counter) {
            counter.parents().eq(2).removeClass("has-error");
        }
    });
});