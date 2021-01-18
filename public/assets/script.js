$(document).ready(function() {
	
	  
	$('#deleteBtn').on('click', function() {
        $('#delete').toggle();
	});
	$('#category').on('change', function() {
        if (this.value == 'Inna') {
            $("#description").show();
        } else {
            $("#description").hide();
        }
	});
	$('#commentsBtn').on('click', function() {
        $('#comments').toggle();
    });
    $('#reservationsNav').on('click', function() {

        $('#reservations').show();
        $('#users').hide();
        $('#topics').hide();
        $('#reservationsNav').attr('class', 'nav-link active');
        $('#usersNav').attr('class', 'nav-link');
        $('#topicsNav').attr('class', 'nav-link');
        $('#settingsNav').attr('class', 'nav-link mb-5');
    });
    $('#usersNav').on('click', function() {

        $('#reservations').hide();
        $('#users').show();
        $('#topics').hide();
        $('#reservationsNav').attr('class', 'nav-link');
        $('#usersNav').attr('class', 'nav-link active');
        $('#topicsNav').attr('class', 'nav-link');
        $('#settingsNav').attr('class', 'nav-link mb-5');
    });
    $('#topicsNav').on('click', function() {

        $('#reservations').hide();
        $('#users').hide();
        $('#topics').show();
        $('#reservationsNav').attr('class', 'nav-link');
        $('#usersNav').attr('class', 'nav-link');
        $('#topicsNav').attr('class', 'nav-link active');
        $('#settingsNav').attr('class', 'nav-link mb-5');
    });
    $('#message').on('click', function() {
        $('#message').hide();
    })

});
