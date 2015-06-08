
//print login info to statusUpdate via innerHTML
//receives response from ajaxRequest
function printLogin(results) {
    if (results.response == 1) {
        document.getElementById('statusUpdate').innerHTML = "Login Successful";
        window.location.assign("http://web.engr.oregonstate.edu/~choiwoo/cs290/final/joblist.php");
    }
    else if (results.response == 0) {
        document.getElementById('statusUpdate').innerHTML = "Failed to login";
    }
    else {
        document.getElementById('statusUpdate').innerHTML = results.response;
    }
    return false;
}

//print user registration info to statusUpdate via innerHTML
//receives response from ajaxRequest
function printNewUser(results) {
    if (results.response == 1) {
        document.getElementById('statusUpdate').innerHTML = "New user created";
    }
    else if (results.response == 0) {
        document.getElementById('statusUpdate').innerHTML = "User already exists";
    }
    else {
        document.getElementById('statusUpdate').innerHTML = results.response;
    }
}

//login protocol
//form an object and call ajax accordingly
function login(type) {
    var username = document.getElementById('username').value;
       if(username==null || username==""){
           alert("Please enter a username");
           return false;
       }
    var password = document.getElementById('password').value;

    var parameters = {
        username: username,
        password: password
    };
    if (type == "login") {
        var url = 'login.php';
        document.getElementById('statusUpdate').innerHTML = "Logging in....";
        ajaxRequest(url,'POST',parameters, printLogin);
    }
    if (type == "new") {
        var url = 'newuser.php';
        document.getElementById('statusUpdate').innerHTML = "Creating user....";
        ajaxRequest(url,'POST', parameters, printNewUser);
    }
    return false;
}
/*got lazy and just added the below functions in login.js
	essentially does the same thing login does but with JOB instead
*/
function addJob() {
    var jobName = document.getElementById('jobName').value;
    var description = document.getElementById('description').value;
    var email = document.getElementById('email').value;
    var location = document.getElementById('location').value;
    var parameters = {
        jobName: jobName,
        description: description,
		email: email,
		location: location
    };
   
    var url = 'newjob.php';
    document.getElementById('statusUpdate').innerHTML = "Adding new job";
    ajaxRequest(url,'POST', parameters, printJob);
    
    return false;
}


//print job info to statusUpdate via innerHTML
//receives response from ajaxRequest
function printJob(results) {
    if (results.response == 1) {
        document.getElementById('statusUpdate').innerHTML = "Job Added!";
        window.location.assign("http://web.engr.oregonstate.edu/~choiwoo/cs290/final/joblist.php");
    }
    else if (results.response == 0) {
        document.getElementById('statusUpdate').innerHTML = "Failed to add job";
    }
    else {
        document.getElementById('statusUpdate').innerHTML = results.response;
    }
    return false;
}

