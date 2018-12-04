var userId = $('#userid-input').val();

//The login button function. $ is part of the jquery library
$('#login-button').click(function(){
    console.log("Login");

    var username = $('#username-input').val();
    var password = $( '#password-input' ).val();
    console.log(username);
    console.log(password);
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        var jsonresponse = this.responseText;
        userId = JSON.parse(jsonresponse)[0].userid;
        console.log(userId);
        document.getElementById("user-login-divider").innerHTML =
        "Login successful!";
    }
    else if (this.readyState == 4 && this.status == 404) {
        document.getElementById("user-login-divider").innerHTML =
        "Wrong username or password";
    }
  };

  var queryString = "user/" + username + "/" + password;
  xhttp.open("GET", "../api/" + queryString, true);
  xhttp.setRequestHeader('Content-type','application/json; charset=utf-8');
  xhttp.send();
});

//The register button function
$('#register-button').click(function(){
    console.log("Register");

    var username = $('#username-input').val();
    var password = $( '#password-input' ).val();
    console.log(username);
    console.log(password);
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        var jsonresponse = this.responseText;
        userId = JSON.parse(jsonresponse)[0].userid;
        console.log(userId);
        document.getElementById("user-login-divider").innerHTML =
        "Registration successful!";
    }
    else if (this.readyState == 4 && this.status == 404) {
        document.getElementById("user-login-divider").innerHTML =
        "Could not register user";
    }
  };

  var queryString = "user/" + username + "/" + password;
  xhttp.open("POST", "../api/" + queryString, true);
  xhttp.setRequestHeader('Content-type','application/json; charset=utf-8');
  xhttp.send();
});
//The get all events button function. $ is part of the jquery library
$('#get-all-events-button').click(function(){
    console.log("Get events");

    

    var date = $('#datepicker-input').val();
    console.log(date);
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("get-all-events-divider").innerHTML =
            this.responseText;
        }
        else if (this.readyState == 4 && this.status == 404) {
            document.getElementById("get-all-events-divider").innerHTML =
            "You have no events on this date";
        }
    };
  var queryString = "user/" + userId + "/event/" + date;
  xhttp.open("GET", "../api/" + queryString, true);
  xhttp.send();
});

//The get event button function. $ is part of the jquery library
$('#get-event-button').click(function(){
    console.log("Get an event");

    var date = $('#datepicker-input-2').val();
    var time = $( '#timepicker-input' ).val() + ":00";
    console.log(date);
    console.log(time);
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("get-event-divider").innerHTML =
      this.responseText;
    }
    else if (this.readyState == 4 && this.status == 404) {
        document.getElementById("get-event-divider").innerHTML =
        "You have no event at this time";
    }
  };

  var queryString = "user/" + userId + "/event/" + date + "/" + time;
  xhttp.open("GET", "../api/" + queryString, true);
  xhttp.send();
});

//The post event button function. $ is part of the jquery library
$('#post-event-button').click(function(){
    console.log("Post an event");

    var date = $('#datepicker-input-post-event').val();
    var time = $( '#timepicker-input-post-event' ).val() + ":00";
    var info = $('#event-info-input').val();
    var location = $('#event-location-input').val();
    console.log(date);
    console.log(time);
    console.log(info);
    console.log(location);

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("post-event-divider").innerHTML =
      this.responseText;
    }
    else if (this.readyState == 4 && this.status == 404) {
        document.getElementById("post-event-divider").innerHTML =
        "This event can not be created";
    }
  };
  //localhost/api/user/42/event/2018-05-03/00:00:00/anevent/atkeddy
  var queryString = "user/" + userId + "/event/" + date + "/" + time + "/" + info + "/" + location;
  xhttp.open("POST", "../api/" + queryString, true);
  xhttp.send();
});


//Input formating
$( "#datepicker-input" ).datepicker({ dateFormat: 'yy-mm-dd' });
$( "#datepicker-input-2" ).datepicker({ dateFormat: 'yy-mm-dd' });
$("#timepicker-input").timepicker({
    timeFormat: 'HH:mm',
    interval: 30,
    minTime: '00:00:00',
    maxTime: '23:30:00',
    dynamic: false,
    dropdown: true,
    scrollbar: true
});
$( "#datepicker-input-post-event" ).datepicker({ dateFormat: 'yy-mm-dd' });
$("#timepicker-input-post-event").timepicker({
    timeFormat: 'HH:mm',
    interval: 30,
    minTime: '00:00:00',
    maxTime: '23:30:00',
    dynamic: false,
    dropdown: true,
    scrollbar: true
});