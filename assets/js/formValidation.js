(function ($) {
    "use strict";
    var doc = new jsPDF();
    var specialElementHandlers = {
        '#editor': function (element, renderer) {
            return true;
        }
    };

    var displayResults = $('.overlay-results');

/********************** Bank***************** */
//Add a bank
$('#addBank').on('submit',function(e){
    e.preventDefault();

    var overlay = $('.overlay-loading');
    var mainForm = $('#getAddBank');
    var form = $('.modalContent');
    var xmlhttp = new XMLHttpRequest();
    var params = "BankName="+$('#BankName').val()+"&accNo="+$('#accNo').val();

    xmlhttp.onprogress = function(){
        overlay.show();
        form.hide();
    };

    xmlhttp.onload = function() {
        var results = xmlhttp.responseText;
        results = results.substring(results.indexOf("}")+1, results.indexOf(".")+1);

        if(results.includes('OK')){
            // Check if an element currently exists
            if (!$('#successCheck').length) {
                var successAlert = '<div id="successCheck" class="alert alert-success alert-dismissible" role="alert">Bank Added Successfully..<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                mainForm.before(successAlert);
            }
            setTimeout(function(){ 
                $('#BankName').val('');
                $('#accNo').val('');
                overlay.hide();
                displayResults.show();
                }, 2000);
        }
        else{
            // Check if an element currently exists
            if (!$('#sqlError').length) {
                var errorAlert = '<div id="sqlError" class="alert alert-danger alert-dismissable" role="alert">'+results+'<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                mainForm.before(errorAlert);
            }
            setTimeout(function(){
                overlay.hide();
                form.show();
                }, 2000);
        }
        
    };

    xmlhttp.open("POST", "http://localhost/shsms/inc/addforms/addBanks.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send(params);

});

//edit a bank
$('#getEditBank').on('submit',function(e){
    e.preventDefault();

    var msg = $('.message');
    var overlay = $('.overlay-loading');
    var form = $('.modalContent');
    msg.html('');
    var xmlhttp = new XMLHttpRequest();
    var params = "eid="+$('#eid').val()+"&editBankName="+$('#editBankName').val()+"&editAccNo="+$('#editAccNo').val();

    xmlhttp.onprogress = function(){
        overlay.show();
        form.hide();
    };

    xmlhttp.onload = function() {
        var results = xmlhttp.responseText;
        console.log(results);
        results = results.substring(results.indexOf("}")+1, results.indexOf(".")+1);

        if(results.includes('OK')){
            msg.addClass('alert-success');
            msg.append('Bank Updated Successfully..');
            msg.show();
            setTimeout(function(){ 
                $('#BankName').val('');
                $('#accNo').val('');
                overlay.hide();
                displayResults.show();
                }, 2000);
            
        }
        else{
            msg.addClass('alert-danger');
            msg.append(results);
            msg.show();
            setTimeout(function(){
                overlay.hide();
                form.show();
                }, 2000);
        }
        
    };

    xmlhttp.open("POST", "http://localhost/shsms/inc/editforms/editBanks.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send(params);

});

$('#getDelete').on('submit',function(e){
    e.preventDefault();

    var msg = $('.message');
    var overlay = $('.overlay-loading');
    var displayResults = $('.overlay-results');
    var form = $('.modalContent');
    msg.html('');
    var xmlhttp = new XMLHttpRequest();
    var params = "did="+$('#did').val();

    xmlhttp.onprogress = function(){
        overlay.show();
        form.hide();
    };

    xmlhttp.onload = function() {
        var results = xmlhttp.responseText;
        results = results.substring(results.indexOf("}")+1, results.indexOf(".")+1);

        if(results.includes('OK')){
            msg.addClass('alert-success');
            msg.append('Record Deleted Successfully..');
            msg.show();
            setTimeout(function(){ 
                overlay.hide();
                displayResults.show();
                //window.location.reload();
                }, 2000);
        }
        else{
            msg.addClass('alert-danger');
            msg.append(results);
            msg.show();
            setTimeout(function(){
                overlay.hide();
                displayResults.show();
                form.show();
                }, 2000);
        }
        
    };

    xmlhttp.open("POST", "http://localhost/shsms/inc/deleteforms/deleteBank.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send(params);

});

//reload page
$('#addBank').on('hidden.bs.modal', function(e) {
    
    window.location.reload();

});

$('#editBank').on('hidden.bs.modal', function(e) {
    
    window.location.reload();

});

$('#deleteBank').on('hidden.bs.modal', function(e) {
    
    window.location.reload();

});

//fetch data to fill form
$('#editBank').on('show.bs.modal', function(e) {
    var bankId = $(e.relatedTarget).data('bankid');
    console.log(bankId);
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            var results = xmlhttp.responseText;
            results = results.substring(results.indexOf("["), results.indexOf("]")+1);
            results = JSON.parse(results);
            $(e.currentTarget).find('input[name="eid"]').val(results[0]);
            $(e.currentTarget).find('input[name="editBankName"]').val(results[1]);
            $(e.currentTarget).find('input[name="editAccNo"]').val(results[2]);
        }

    };
    xmlhttp.open("GET", "banks.php?eid=" + bankId, true);
    xmlhttp.send();
    
});

//fetch id to delete
$('#deleteBank').on('show.bs.modal', function(e) {
    var bankId = $(e.relatedTarget).data('bankid');
    $(e.currentTarget).find('input[name="did"]').val(bankId);
});

/****************************************************************** */

/****************Subjects ************************/
//Add a Subject
$('#getAddSubject').on('submit',function(e){
    e.preventDefault();

    var overlay = $('.overlay-loading');
    var mainForm = $('#getAddSubject');
    var form = $('.modalContent');
    var xmlhttp = new XMLHttpRequest();
    var params = "SubjectName="+$('#SubjectName').val();

    xmlhttp.onprogress = function(){
        overlay.show();
        console.log(params);
        form.hide();
    };

    xmlhttp.onload = function() {
        var results = xmlhttp.responseText;
        results = results.substring(results.indexOf("}")+1, results.indexOf(".")+1);

        if(results.includes('OK')){
            // Check if an element currently exists
            if (!$('#successCheck').length) {
                var successAlert = '<div id="successCheck" class="alert alert-success alert-dismissible" role="alert">Subject Added Successfully..<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                mainForm.before(successAlert);
            }
            setTimeout(function(){ 
                $('#SubjectName').val('');
                overlay.hide();
                displayResults.show();
                }, 2000);
        }
        else{
            // Check if an element currently exists
            if (!$('#sqlError').length) {
                var errorAlert = '<div id="sqlError" class="alert alert-danger alert-dismissable" role="alert">'+results+'<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                mainForm.before(errorAlert);
            }
            setTimeout(function(){
                overlay.hide();
                form.show();
                }, 2000);
        }
        
    
    };

    xmlhttp.open("POST", "http://localhost/shsms/inc/addforms/addsubjects.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send(params);

});

//edit a subject
$('#getEditSubject').on('submit',function(e){
    e.preventDefault();

    var msg = $('.message');
    var overlay = $('.overlay-loading');
    var form = $('.modalContent');
    msg.html('');
    var xmlhttp = new XMLHttpRequest();
    var params = "eid="+$('#eid').val()+"&editSubjectName="+$('#editSubjectName').val();

    xmlhttp.onprogress = function(){
        overlay.show();
        form.hide();
    };

    xmlhttp.onload = function() {
        var results = xmlhttp.responseText;

        if(results.includes('OK.')){
            msg.addClass('alert-success');
            msg.append('Subject Updated Successfully..');
            msg.show();
            setTimeout(function(){ 
                $('#editSubjectName').val('');
                overlay.hide();
                displayResults.show();
                }, 2000);
            
        }
        else{
            msg.addClass('alert-danger');
            msg.append(results);
            msg.show();
            setTimeout(function(){
                overlay.hide();
                form.show();
                }, 2000);
        }
        
    };

    xmlhttp.open("POST", "http://localhost/shsms/inc/editforms/editSubjects.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send(params);

});

$('#getDeleteSubject').on('submit',function(e){
    e.preventDefault();

    var msg = $('.message');
    var overlay = $('.overlay-loading');
    var displayResults = $('.overlay-results');
    var form = $('.modalContent');
    msg.html('');
    var xmlhttp = new XMLHttpRequest();
    var params = "did="+$('#did').val();

    xmlhttp.onprogress = function(){
        overlay.show();
        form.hide();
    };

    xmlhttp.onload = function() {
        var results = xmlhttp.responseText;

        if(results.includes('OK')){
            msg.addClass('alert-success');
            msg.append('Record Deleted Successfully..');
            msg.show();
            setTimeout(function(){ 
                overlay.hide();
                displayResults.show();
                }, 2000);
        }
        else{
            msg.addClass('alert-danger');
            msg.append(results);
            msg.show();
            setTimeout(function(){
                overlay.hide();
                displayResults.show();
                form.show();
                }, 2000);
        }
        
    };

    xmlhttp.open("POST", "http://localhost/shsms/inc/deleteforms/deleteSubjects.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send(params);

});

//reload page
$('#addSubject').on('hidden.bs.modal', function(e) {
    
    window.location.reload();

});

$('#editSubject').on('hidden.bs.modal', function(e) {
    
    window.location.reload();

});

$('#deleteSubject').on('hidden.bs.modal', function(e) {
    
    window.location.reload();

});
//fetch data to fill form
$('#editSubject').on('show.bs.modal', function(e) {
    var studentId = $(e.relatedTarget).data('subjectid');
    console.log(studentId);
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            var results = xmlhttp.responseText;
            results = results.substring(results.indexOf("["), results.indexOf("]")+1);
            results = JSON.parse(results);
            $(e.currentTarget).find('input[name="eid"]').val(results[0]);
            $(e.currentTarget).find('input[name="editSubjectName"]').val(results[1]);
        }

    };
    xmlhttp.open("GET", "subjects.php?eid=" + studentId, true);
    xmlhttp.send();
    
});

//fetch id to delete
$('#deleteSubject').on('show.bs.modal', function(e) {
    var studentId = $(e.relatedTarget).data('subjectid');
    $(e.currentTarget).find('input[name="did"]').val(studentId);
});
/********************************************************************* */


/****************Courses ************************/
//Add a Course
$('#getAddCourse').on('submit',function(e){
    e.preventDefault();

    var overlay = $('.overlay-loading');
    var mainForm = $('#getAddCourse');
    var form = $('.modalContent');
    var xmlhttp = new XMLHttpRequest();
    var params = "CourseName="+$('#CourseName').val();

    xmlhttp.onprogress = function(){
        overlay.show();
        console.log(params);
        form.hide();
    };

    xmlhttp.onload = function() {
        var results = xmlhttp.responseText;
        results = results.substring(results.indexOf("}")+1, results.indexOf(".")+1);

        if(results.includes('OK')){
            // Check if an element currently exists
            if (!$('#successCheck').length) {
                var successAlert = '<div id="successCheck" class="alert alert-success alert-dismissible" role="alert">Subject Added Successfully..<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                mainForm.before(successAlert);
            }
            setTimeout(function(){ 
                $('#CourseName').val('');
                overlay.hide();
                displayResults.show();
                }, 2000);
        }
        else{
            // Check if an element currently exists
            if (!$('#sqlError').length) {
                var errorAlert = '<div id="sqlError" class="alert alert-danger alert-dismissable" role="alert">'+results+'<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                mainForm.before(errorAlert);
            }
            setTimeout(function(){
                overlay.hide();
                form.show();
                }, 2000);
        }
        
    
    };

    xmlhttp.open("POST", "http://localhost/shsms/inc/addforms/addCourses.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send(params);

});

//edit a Course
$('#getEditCourse').on('submit',function(e){
    e.preventDefault();

    var msg = $('.message');
    var displayResults = $('.overlay-results');
    var overlay = $('.overlay-loading');
    var form = $('.modalContent');
    msg.html('');
    var xmlhttp = new XMLHttpRequest();
    var params = "eid="+$('#eid').val()+"&editCourseName="+$('#editCourseName').val();

    xmlhttp.onprogress = function(){
        overlay.show();
        form.hide();
    };

    xmlhttp.onload = function() {
        var results = xmlhttp.responseText;

        if(results.includes('OK.')){
            msg.addClass('alert-success');
            msg.append('Course Updated Successfully..');
            msg.show();
            setTimeout(function(){ 
                $('#editCourseName').val('');
                overlay.hide();
                displayResults.show();
                }, 2000);
            
        }
        else{
            msg.addClass('alert-danger');
            msg.append(results);
            msg.show();
            setTimeout(function(){
                overlay.hide();
                form.show();
                }, 2000);
        }
        
    };

    xmlhttp.open("POST", "http://localhost/shsms/inc/editforms/editCourses.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send(params);

});

$('#getDeleteCourse').on('submit',function(e){
    e.preventDefault();

    var msg = $('.message');
    var overlay = $('.overlay-loading');
    var displayResults = $('.overlay-results');
    var form = $('.modalContent');
    msg.html('');
    var xmlhttp = new XMLHttpRequest();
    var params = "did="+$('#did').val();

    xmlhttp.onprogress = function(){
        overlay.show();
        form.hide();
    };

    xmlhttp.onload = function() {
        var results = xmlhttp.responseText;

        if(results.includes('OK')){
            msg.addClass('alert-success');
            msg.append('Record Deleted Successfully..');
            msg.show();
            setTimeout(function(){ 
                overlay.hide();
                displayResults.show();
                }, 2000);
        }
        else{
            msg.addClass('alert-danger');
            msg.append(results);
            msg.show();
            setTimeout(function(){
                overlay.hide();
                displayResults.show();
                form.show();
                }, 2000);
        }
        
    };

    xmlhttp.open("POST", "http://localhost/shsms/inc/deleteforms/deleteCourses.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send(params);

});

//reload page
$('#addCourse').on('hidden.bs.modal', function(e) {
    
    window.location.reload();

});

$('#editCourse').on('hidden.bs.modal', function(e) {
    
    window.location.reload();

});

$('#deleteCourse').on('hidden.bs.modal', function(e) {
    
    window.location.reload();

});

//fetch data to fill form
$('#editCourse').on('show.bs.modal', function(e) {
    var courseId = $(e.relatedTarget).data('courseid');
    console.log(courseId);
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            var results = xmlhttp.responseText;
            results = results.substring(results.indexOf("["), results.indexOf("]")+1);
            results = JSON.parse(results);
            $(e.currentTarget).find('input[name="eid"]').val(results[0]);
            $(e.currentTarget).find('input[name="editCourseName"]').val(results[1]);
        }

    };
    xmlhttp.open("GET", "courses.php?eid=" + courseId, true);
    xmlhttp.send();
    
});

//fetch id to delete
$('#deleteCourse').on('show.bs.modal', function(e) {
    var courseId = $(e.relatedTarget).data('courseid');
    $(e.currentTarget).find('input[name="did"]').val(courseId);
});
/********************************************************************* */


/****************Classes ************************/
//Add a Class
$('#getAddClass').on('submit',function(e){
    e.preventDefault();

    var msg = $('.message');
    var overlay = $('.overlay-loading');
    var mainForm = $('#getAddClass');
    var form = $('.modalContent');
    msg.html('');
    var xmlhttp = new XMLHttpRequest();
    var params = "ClassName="+$('#ClassName').val();

    xmlhttp.onprogress = function(){
        overlay.show();
        form.hide();
    };

    xmlhttp.onload = function() {
        var results = xmlhttp.responseText;
        results = results.substring(results.indexOf("}")+1, results.indexOf(".")+1);

        if(results.includes('OK')){
            // Check if an element currently exists
            if (!$('#successCheck').length) {
                var successAlert = '<div id="successCheck" class="alert alert-success alert-dismissible" role="alert">Class Added Successfully..<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                mainForm.before(successAlert);
            }
            setTimeout(function(){ 
                $('#ClassName').val('');
                overlay.hide();
                displayResults.show();
                }, 2000);
        }
        else{
            // Check if an element currently exists
            if (!$('#sqlError').length) {
                var errorAlert = '<div id="sqlError" class="alert alert-danger alert-dismissable" role="alert">'+results+'<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                mainForm.before(errorAlert);
            }
            setTimeout(function(){
                overlay.hide();
                form.show();
                }, 2000);
        }
        
    
    };

    xmlhttp.open("POST", "http://localhost/shsms/inc/addforms/addClass.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send(params);

});

//edit a class
$('#getEditClass').on('submit',function(e){
    e.preventDefault();

    var msg = $('.message');
    var overlay = $('.overlay-loading');
    var form = $('.modalContent');
    msg.html('');
    var xmlhttp = new XMLHttpRequest();
    var params = "eid="+$('#eid').val()+"&editClassName="+$('#editClassName').val();

    xmlhttp.onprogress = function(){
        overlay.show();
        form.hide();
    };

    xmlhttp.onload = function() {
        var results = xmlhttp.responseText;

        if(results.includes('OK.')){
            msg.addClass('alert-success');
            msg.append('Subject Updated Successfully..');
            msg.show();
            setTimeout(function(){ 
                $('#editClassName').val('');
                overlay.hide();
                displayResults.show();
                }, 2000);
            
        }
        else{
            msg.addClass('alert-danger');
            msg.append(results);
            msg.show();
            setTimeout(function(){
                overlay.hide();
                form.show();
                }, 2000);
        }
        
    };

    xmlhttp.open("POST", "http://localhost/shsms/inc/editforms/editClass.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send(params);

});

$('#getDeleteClass').on('submit',function(e){
    e.preventDefault();

    var msg = $('.message');
    var overlay = $('.overlay-loading');
    var displayResults = $('.overlay-results');
    var form = $('.modalContent');
    msg.html('');
    var xmlhttp = new XMLHttpRequest();
    var params = "did="+$('#did').val();

    xmlhttp.onprogress = function(){
        overlay.show();
        form.hide();
    };

    xmlhttp.onload = function() {
        var results = xmlhttp.responseText;
        
        if(results.includes('OK')){
            msg.addClass('alert-success');
            msg.append('Record Deleted Successfully..');
            msg.show();
            setTimeout(function(){ 
                overlay.hide();
                displayResults.show();
                }, 2000);
        }
        else{
            msg.addClass('alert-danger');
            msg.append(results);
            msg.show();
            setTimeout(function(){
                overlay.hide();
                displayResults.show();
                form.show();
                }, 2000);
        }
        
    };

    xmlhttp.open("POST", "http://localhost/shsms/inc/deleteforms/deleteClass.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send(params);

});

//reload page
$('#addClass').on('hidden.bs.modal', function(e) {
    
    window.location.reload();

});

$('#editClass').on('hidden.bs.modal', function(e) {
    
    window.location.reload();

});

$('#deleteClass').on('hidden.bs.modal', function(e) {
    
    window.location.reload();

});
//fetch data to fill form
$('#editClass').on('show.bs.modal', function(e) {
    var classId = $(e.relatedTarget).data('classid');
    console.log(classId);
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            var results = xmlhttp.responseText;
            console.log(results);
            results = results.substring(results.indexOf("["), results.indexOf("]")+1);
            results = JSON.parse(results);
            $(e.currentTarget).find('input[name="eid"]').val(results[0]);
            $(e.currentTarget).find('input[name="editClassName"]').val(results[1]);
        }
    };
    xmlhttp.open("GET", "classes.php?eid=" + classId, true);
    xmlhttp.send();
    

    /*$(e.currentTarget).find('input[name="studentid"]').val(studentId);*/
});

//fetch id to delete
$('#deleteClass').on('show.bs.modal', function(e) {
    var classId = $(e.relatedTarget).data('classid');
    $(e.currentTarget).find('input[name="did"]').val(classId);
});

/********************************************************************* */

/****************Hostel ************************/
//Add a Hostel
$('#getAddHostel').on('submit',function(e){
    e.preventDefault();

    var msg = $('.message');
    var overlay = $('.overlay-loading');
    var form = $('.modalContent');
    var mainForm = $('#getAddHostel');
    msg.html('');
    var xmlhttp = new XMLHttpRequest();
    var params = "Name="+$('#Name').val()+"&Status="+$('#Status').val();

    xmlhttp.onprogress = function(){
        overlay.show();
        form.hide();
    };

    xmlhttp.onload = function() {
        var results = xmlhttp.responseText;

        if(results.includes('OK')){
            // Check if an element currently exists
            if (!$('#successCheck').length) {
                var successAlert = '<div id="successCheck" class="alert alert-success alert-dismissible" role="alert">Hostel Added Successfully..<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                mainForm.before(successAlert);
            }
            setTimeout(function(){ 
                $('#Name').val('');
                $('#Status').val('');
                overlay.hide();
                displayResults.show();
                }, 2000);
        }
        else{
            // Check if an element currently exists
            if (!$('#sqlError').length) {
                var errorAlert = '<div id="sqlError" class="alert alert-danger alert-dismissable" role="alert">'+results+'<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                mainForm.before(errorAlert);
            }
            setTimeout(function(){
                overlay.hide();
                form.show();
                }, 2000);
        }
        
    
    };

    xmlhttp.open("POST", "http://localhost/shsms/inc/addforms/addHostel.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send(params);

});

//edit a Hostel
$('#getEditHostel').on('submit',function(e){
    e.preventDefault();

    var msg = $('.message');
    var displayResults = $('.overlay-results');
    var overlay = $('.overlay-loading');
    var form = $('.modalContent');
    msg.html('');
    var xmlhttp = new XMLHttpRequest();
    var params = "eid="+$('#eid').val()+"&editName="+$('#editName').val()+"&editStatus="+$('#editStatus').val();

    xmlhttp.onprogress = function(){
        overlay.show();
        form.hide();
    };

    xmlhttp.onload = function() {
        var results = xmlhttp.responseText;

        if(results.includes('OK.')){
            msg.addClass('alert-success');
            msg.append('Subject Updated Successfully..');
            msg.show();
            setTimeout(function(){ 
                $('#editName').val('');
                $('#editStatus').val('');
                overlay.hide();
                displayResults.show();
                }, 2000);
            
        }
        else{
            msg.addClass('alert-danger');
            msg.append(results);
            msg.show();
            setTimeout(function(){
                overlay.hide();
                form.show();
                }, 2000);
        }
        
    };

    xmlhttp.open("POST", "http://localhost/shsms/inc/editforms/editHostel.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send(params);

});

$('#getDeleteHostel').on('submit',function(e){
    e.preventDefault();

    var msg = $('.message');
    var overlay = $('.overlay-loading');
    var displayResults = $('.overlay-results');
    var form = $('.modalContent');
    msg.html('');
    var xmlhttp = new XMLHttpRequest();
    var params = "did="+$('#did').val();

    xmlhttp.onprogress = function(){
        overlay.show();
        form.hide();
    };

    xmlhttp.onload = function() {
        var results = xmlhttp.responseText;
        
        if(results.includes('OK')){
            msg.addClass('alert-success');
            msg.append('Record Deleted Successfully..');
            msg.show();
            setTimeout(function(){ 
                overlay.hide();
                displayResults.show();
                }, 2000);
        }
        else{
            msg.addClass('alert-danger');
            msg.append(results);
            msg.show();
            setTimeout(function(){
                overlay.hide();
                displayResults.show();
                form.show();
                }, 2000);
        }
        
    };

    xmlhttp.open("POST", "http://localhost/shsms/inc/deleteforms/deleteHostel.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send(params);

});

//reload page
$('#addHostel').on('hidden.bs.modal', function(e) {
    
    window.location.reload();

});

$('#editHostel').on('hidden.bs.modal', function(e) {
    
    window.location.reload();

});

$('#deleteHostel').on('hidden.bs.modal', function(e) {
    
    window.location.reload();

});

//fetch data to fill form
$('#editHostel').on('show.bs.modal', function(e) {
    var hostelId = $(e.relatedTarget).data('hostelid');

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            var results = xmlhttp.responseText;
            results = results.substring(results.indexOf("["), results.indexOf("]")+1);
            results = JSON.parse(results);
            $(e.currentTarget).find('input[name="eid"]').val(results[0]);
            $(e.currentTarget).find('input[name="editName"]').val(results[1]);
            $(e.currentTarget).find('input[name="editStatus"]').val(results[2]);
        }
    };
    xmlhttp.open("GET", "hostels.php?eid=" + hostelId, true);
    xmlhttp.send();
    
});

//fetch id to delete
$('#deleteHostel').on('show.bs.modal', function(e) {
    var hostelId = $(e.relatedTarget).data('hostelid');
    $(e.currentTarget).find('input[name="did"]').val(hostelId);
});

/********************************************************************* */


/****************Students ************************/
//Add a Student
$('#getAddStudent').on('submit',function(e){
    e.preventDefault();

    var msg = $('.message');
    var overlay = $('.overlay-loading');
    var form = $('.modalContent');
    var mainForm = $('#getAddStudent');
    msg.html('');
    var xmlhttp = new XMLHttpRequest();
    var params = "StudentID="+$('#StudentID').val()+
    "&FirstName="+$('#FirstName').val()+
    "&LastName="+$('#LastName').val()+
    "&DOB="+$('#DOB').val()+
    "&Class="+$('#Class').val()+
    "&Gender="+$('#Gender').val()+
    "&Hostel="+$('#Hostel').val()+
    "&Course="+$('#Course').val()+
    "&ParentsFirstName="+$('#ParentsFirstName').val()+
    "&ParentsLastName="+$('#ParentsLastName').val()+
    "&parentEmail="+$('#parentEmail').val()+
    "&ParentsPhone="+$('#ParentsPhone').val()+
    "&ParentsAddress="+$('#ParentsAddress').val();

    var date = new Date();
    var dateMake = date.getFullYear()+"-"+date.getMonth()+"-"+date.getDate();
    var dobMake = $('#DOB').val();
    var today = new Date(dateMake);
    var dob = new Date(dobMake);

    function diff_years(dt2, dt1) 
    {
        var diff =(dt2.getTime() - dt1.getTime()) / 1000;
        diff /= (60 * 60 * 24);
        return Math.abs(Math.round(diff/365.25));
    }

    var year = diff_years(dob,today);

    if(year >= 12){
        xmlhttp.onprogress = function(){
            overlay.show();
            form.hide();
        };
    
        xmlhttp.onload = function() {
            var results = xmlhttp.responseText;
            var email = results.substring(results.indexOf("{")+1, results.indexOf("}"));
            if(results.includes('OK')){
                // Check if an element currently exists
                if (!$('#successCheck').length) {
                    var successAlert = '<div id="successCheck" class="alert alert-success alert-dismissible" role="alert">Student Added Successfully..<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                    mainForm.before(successAlert);
                }

                var msg = "Name: "+$('#FirstName').val()+" "+$('#LastName').val()+"\nID: "+$('#StudentID').val() +"\n"+ "Email: " + email + "\n" + "Password: Pass";
                doc.text(msg, 15, 15, {
                    'width': 170,
                        'elementHandlers': specialElementHandlers
                });
                doc.save($('#StudentID').val()+'.pdf');

                setTimeout(function(){ 
                    
                    overlay.hide();
                    displayResults.show();
                    }, 2000);
            }
            else{
                // Check if an element currently exists
                if (!$('#sqlError').length) {
                    var errorAlert = '<div id="sqlError" class="alert alert-danger alert-dismissable" role="alert">'+results+'<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                    mainForm.before(errorAlert);
                }
                setTimeout(function(){
                    overlay.hide();
                    form.show();
                    }, 2000);
            }
            
        
        };
    
        xmlhttp.open("POST", "http://localhost/shsms/inc/addforms/addStudents.php", true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send(params);
    }
    else{
        // Check if an element currently exists
        if (!$('#errorCheck').length) {
            var successAlert = '<div id="errorCheck" class="alert alert-danger alert-dismissible" role="alert">Student can not be less than 12 years.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
            mainForm.before(successAlert);
        }
    }

});

//edit a Student
$('#getEditStudent').on('submit',function(e){
    e.preventDefault();

    var msg = $('.message');
    var displayResults = $('.overlay-results');
    var overlay = $('.overlay-loading');
    var mainForm = $('#getEditStudent');
    var form = $('.modalContent');
    msg.html('');
    var xmlhttp = new XMLHttpRequest();
    var params = "eid="+$('#eid').val()+
    "&editFirstName="+$('#editFirstName').val()+
    "&editLastName="+$('#editLastName').val()+
    "&editDOB="+$('#editDOB').val()+
    "&editClass="+$('#editClass').val()+
    "&editGender="+$('#editGender').val()+
    "&editHostel="+$('#editHostel').val();

    var date = new Date();
    var dateMake = date.getFullYear()+"-"+date.getMonth()+"-"+date.getDate();
    var dobMake = $('#editDOB').val();
    var today = new Date(dateMake);
    var dob = new Date(dobMake);

    function diff_years(dt2, dt1) 
    {
        var diff =(dt2.getTime() - dt1.getTime()) / 1000;
        diff /= (60 * 60 * 24);
        return Math.abs(Math.round(diff/365.25));
    }

    var year = diff_years(dob,today);

    if(year >= 12){
        xmlhttp.onprogress = function(){
            overlay.show();
            form.hide();
        };

        xmlhttp.onload = function() {
            var results = xmlhttp.responseText;
            if(results.includes('OK.')){
                // Check if an element currently exists
                if (!$('#successCheck').length) {
                    var successAlert = '<div id="successCheck" class="alert alert-success alert-dismissible" role="alert">Student Updated Successfully..<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                    mainForm.before(successAlert);
                }
                setTimeout(function(){ 
                    $('#editFirstName').val('');
                    $('#editLastName').val('');
                    $('#editDOB').val('');
                    $('#editClass').val('');
                    $('#editGender').val('');
                    $('#editHostel').val('');
                    overlay.hide();
                    displayResults.show();
                    }, 2000);
            }
            else{
                // Check if an element currently exists
                if (!$('#sqlError').length) {
                    var errorAlert = '<div id="sqlError" class="alert alert-danger alert-dismissable" role="alert">'+results+'<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                    mainForm.before(errorAlert);
                }
                setTimeout(function(){
                    overlay.hide();
                    form.show();
                    }, 2000);
            }
            
        };

        xmlhttp.open("POST", "http://localhost/shsms/inc/editforms/editStudents.php", true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send(params);
    }
    else{
        // Check if an element currently exists
        if (!$('#errorCheck').length) {
            var successAlert = '<div id="errorCheck" class="alert alert-danger alert-dismissible" role="alert">Student can not be less than 12 years.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
            mainForm.before(successAlert);
        }
        
    }

});

$('#getDeleteStudent').on('submit',function(e){
    e.preventDefault();

    var msg = $('.message');
    var overlay = $('.overlay-loading');
    var displayResults = $('.overlay-results');
    var form = $('.modalContent');
    msg.html('');
    var xmlhttp = new XMLHttpRequest();
    var params = "did="+$('#did').val();

    xmlhttp.onprogress = function(){
        overlay.show();
        form.hide();
    };

    xmlhttp.onload = function() {
        var results = xmlhttp.responseText;
        
        if(results.includes('OK')){
            msg.addClass('alert-success');
            msg.append('Record Deleted Successfully..');
            msg.show();
            setTimeout(function(){ 
                overlay.hide();
                displayResults.show();
                }, 2000);
        }
        else{
            msg.addClass('alert-danger');
            msg.append(results);
            msg.show();
            setTimeout(function(){
                overlay.hide();
                displayResults.show();
                form.show();
                }, 2000);
        }
        
    };

    xmlhttp.open("POST", "http://localhost/shsms/inc/deleteforms/deleteStudents.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send(params);

});

//reload page
$('#addStudent').on('hidden.bs.modal', function(e) {
    
    window.location.reload();

});

$('#editStudent').on('hidden.bs.modal', function(e) {
    
    window.location.reload();

});

$('#deleteStudent').on('hidden.bs.modal', function(e) {
    
    window.location.reload();

});

//fetch data to fill form

$('#editStudent').on('show.bs.modal', function(e) {
    var studentId = $(e.relatedTarget).data('studentid');

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            var results = xmlhttp.responseText;
            results = results.substring(results.indexOf("["), results.indexOf("]")+1);
            results = JSON.parse(results);
            $(e.currentTarget).find('input[name="eid"]').val(results[0]);
            $(e.currentTarget).find('input[name="editStudentID"]').val(results[0]);
            $(e.currentTarget).find('input[name="editFirstName"]').val(results[1]);
            $(e.currentTarget).find('input[name="editLastName"]').val(results[2]);
            $(e.currentTarget).find('select[name="editGender"]').val(results[3]);
            $(e.currentTarget).find('input[name="editDOB"]').val(results[4]);
            $(e.currentTarget).find('select[name="editHostel"]').val(results[5]);
            $(e.currentTarget).find('select[name="editClass"]').val(results[6]);
            $(e.currentTarget).find('select[name="editCourse"]').val(results[7]);
        }

    };
    xmlhttp.open("GET", "students.php?eid=" + studentId, true);
    xmlhttp.send();
    
});

//fetch id to delete
$('#deleteStudent').on('show.bs.modal', function(e) {
    var studentId = $(e.relatedTarget).data('studentid');
    $(e.currentTarget).find('input[name="did"]').val(studentId);
});

/********************************************************************* */



/****************Staff ************************/
//Add a Staff
$('#getAddStaff').on('submit',function(e){
    e.preventDefault();

    var msg = $('.message');
    var overlay = $('.overlay-loading');
    var displayResults = $('.overlay-results');
    var form = $('.modalContent');
    var mainForm = $('#getAddStaff');
    msg.html('');
    var xmlhttp = new XMLHttpRequest();
    var params = "StaffID="+$('#StaffID').val()+
    "&FirstName="+$('#FirstName').val()+
    "&LastName="+$('#LastName').val()+
    "&DOB="+$('#DOB').val()+
    "&Gender="+$('#Gender').val()+
    "&Phone="+$('#Phone').val()+
    "&Subject="+$('#Subject').val()+
    "&Position="+$('#Position').val();

    var date = new Date();
    var dateMake = date.getFullYear()+"-"+date.getMonth()+"-"+date.getDate();
    var dobMake = $('#DOB').val();
    var today = new Date(dateMake);
    var dob = new Date(dobMake);

    function diff_years(dt2, dt1) 
    {
        var diff =(dt2.getTime() - dt1.getTime()) / 1000;
        diff /= (60 * 60 * 24);
        return Math.abs(Math.round(diff/365.25));
    }

    var year = diff_years(dob,today);

    if(year >= 18 & year <= 50){
        xmlhttp.onprogress = function(){
            overlay.show();
            form.hide();
        };
    
        xmlhttp.onload = function() {
            var results = xmlhttp.responseText;
            var email = results.substring(results.indexOf("{")+1, results.indexOf("}"));
            if(results.includes('OK')){
                // Check if an element currently exists
                if (!$('#successCheck').length) {
                    var successAlert = '<div id="successCheck" class="alert alert-success alert-dismissible" role="alert">Staff Added Successfully..<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                    mainForm.before(successAlert);
                }

                var msg = "Name: "+$('#FirstName').val()+" "+$('#LastName').val()+"\nID: "+$('#StaffID').val() +"\n"+ "Email: " + email + "\n" + "Password: Pass";
                doc.text(msg, 15, 15, {
                    'width': 170,
                        'elementHandlers': specialElementHandlers
                });
                doc.save($('#StaffID').val()+'.pdf');

                setTimeout(function(){ 
                    $('#FirstName').val('');
                    $('#LastName').val('');
                    $('#DOB').val('');
                    $('#Class').val('');
                    $('#Gender').val('');
                    $('#Phone').val('');
                    $('#Position').val('');
                    overlay.hide();
                    displayResults.show();
                    }, 2000);
            }
            else{
                // Check if an element currently exists
                if (!$('#sqlError').length) {
                    var errorAlert = '<div id="sqlError" class="alert alert-danger alert-dismissable" role="alert">'+results+'<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                    mainForm.before(errorAlert);
                }
                setTimeout(function(){
                    overlay.hide();
                    form.show();
                    }, 2000);
            }
        
        };
    
        xmlhttp.open("POST", "http://localhost/shsms/inc/addforms/addStaff.php", true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send(params);
    }
    else{
        // Check if an element currently exists
        if (!$('#errorCheck').length) {
            var successAlert = '<div id="errorCheck" class="alert alert-danger alert-dismissible" role="alert">Staff can not be less than 18 or more than 50 years.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
            mainForm.before(successAlert);
        }
    }

});

//edit a Staff
$('#getEditStaff').on('submit',function(e){
    e.preventDefault();

    var msg = $('.message');
    var displayResults = $('.overlay-results');
    var overlay = $('.overlay-loading');
    var mainForm = $('#getEditStaff');
    var form = $('.modalContent');
    msg.html('');
    var xmlhttp = new XMLHttpRequest();
    var params = "eid="+$('#eid').val()+
    "&editFirstName="+$('#editFirstName').val()+
    "&editLastName="+$('#editLastName').val()+
    "&editDOB="+$('#editDOB').val()+
    "&editPosition="+$('#editPosition').val()+
    "&editGender="+$('#editGender').val()+
    "&editPhone="+$('#editPhone').val();

    var date = new Date();
    var dateMake = date.getFullYear()+"-"+date.getMonth()+"-"+date.getDate();
    var dobMake = $('#editDOB').val();
    var today = new Date(dateMake);
    var dob = new Date(dobMake);

    function diff_years(dt2, dt1) 
    {
        var diff =(dt2.getTime() - dt1.getTime()) / 1000;
        diff /= (60 * 60 * 24);
        return Math.abs(Math.round(diff/365.25));
    }

    var year = diff_years(dob,today);

    if(year >= 18){
        xmlhttp.onprogress = function(){
            overlay.show();
            form.hide();
        };

        xmlhttp.onload = function() {
            var results = xmlhttp.responseText;
            console.log(results);
            if(results.includes('OK.')){
                // Check if an element currently exists
                if (!$('#successCheck').length) {
                    var successAlert = '<div id="successCheck" class="alert alert-success alert-dismissible" role="alert">Staff Updated Successfully..<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                    mainForm.before(successAlert);
                }
                setTimeout(function(){ 
                    $('#editFirstName').val('');
                    $('#editLastName').val('');
                    $('#editDOB').val('');
                    $('#editEmail').val('');
                    $('#editPosition').val('');
                    $('#editGender').val('');
                    overlay.hide();
                    displayResults.show();
                    }, 2000);
            }
            else{
                // Check if an element currently exists
                if (!$('#sqlError').length) {
                    var errorAlert = '<div id="sqlError" class="alert alert-danger alert-dismissable" role="alert">'+results+'<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                    mainForm.before(errorAlert);
                }
                setTimeout(function(){
                    overlay.hide();
                    form.show();
                    }, 2000);
            }
            
        };

        xmlhttp.open("POST", "http://localhost/shsms/inc/editforms/editStaff.php", true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send(params);
    }
    else{
        // Check if an element currently exists
        if (!$('#errorCheck').length) {
            var successAlert = '<div id="errorCheck" class="alert alert-danger alert-dismissible" role="alert">Staff can not be less than 18 years.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
            mainForm.before(successAlert);
        }
        
    }

});

$('#getDeleteStaff').on('submit',function(e){
    e.preventDefault();

    var msg = $('.message');
    var overlay = $('.overlay-loading');
    var displayResults = $('.overlay-results');
    var form = $('.modalContent');
    msg.html('');
    var xmlhttp = new XMLHttpRequest();
    var params = "did="+$('#did').val();

    xmlhttp.onprogress = function(){
        overlay.show();
        form.hide();
    };

    xmlhttp.onload = function() {
        var results = xmlhttp.responseText;
        
        if(results.includes('OK')){
            msg.addClass('alert-success');
            msg.append('Record Deleted Successfully..');
            msg.show();
            setTimeout(function(){ 
                overlay.hide();
                displayResults.show();
                }, 2000);
        }
        else{
            msg.addClass('alert-danger');
            msg.append(results);
            msg.show();
            setTimeout(function(){
                overlay.hide();
                displayResults.show();
                form.show();
                }, 2000);
        }
        
    };

    xmlhttp.open("POST", "http://localhost/shsms/inc/deleteforms/deleteStaff.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send(params);

});

//reload page
$('#addStaff').on('hidden.bs.modal', function(e) {
    
    window.location.reload();

});

$('#editStaff').on('hidden.bs.modal', function(e) {
    
    window.location.reload();

});

$('#deleteStaff').on('hidden.bs.modal', function(e) {
    
    window.location.reload();

});

//fetch data to fill form
$('#editStaff').on('show.bs.modal', function(e) {
    var staffId = $(e.relatedTarget).data('staffid');
    //console.log(teacherId);
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            var results = xmlhttp.responseText;
            results = results.substring(results.indexOf("["), results.indexOf("]")+1);
            results = JSON.parse(results);
            $(e.currentTarget).find('input[name="eid"]').val(results[0]);
            $(e.currentTarget).find('input[name="editFirstName"]').val(results[1]);
            $(e.currentTarget).find('input[name="editLastName"]').val(results[2]);
            $(e.currentTarget).find('input[name="editDOB"]').val(results[3]);
            $(e.currentTarget).find('input[name="editEmail"]').val(results[4]);
            $(e.currentTarget).find('input[name="editPhone"]').val(results[5]);
            $(e.currentTarget).find('select[name="editGender"]').val(results[6]);
            $(e.currentTarget).find('select[name="editPosition"]').val(results[7]);
        }
    };
    xmlhttp.open("GET", "staff.php?eid=" + staffId, true);
    xmlhttp.send();
    
});

//fetch id to delete
$('#deleteStaff').on('show.bs.modal', function(e) {
    var staffId = $(e.relatedTarget).data('staffid');
    $(e.currentTarget).find('input[name="did"]').val(staffId);
});

/********************************************************************* */

/****************Fees Collesction ************************/
$("#PaidAmount, #Arrears").keyup(function(){
    var balance = 0;
    var x = Number($('#PaidAmount').val());
    var y = Number($('#Arrears').val());
    balance = x - y;
    $('#Balance').val(balance);
});

$("#editPaidAmount, #editArrears").keyup(function(){
    var balance = 0;
    var x = Number($('#editPaidAmount').val());
    var y = Number($('#editArrears').val());
    balance = x - y;
    $('#editBalance').val(balance);
});

//Add a Fees
$('#getAddFees').on('submit',function(e){
    e.preventDefault();

    var msg = $('.message');
    var overlay = $('.overlay-loading');
    var form = $('.modalContent');
    var mainForm = $('#getAddFees');
    msg.html('');
    var xmlhttp = new XMLHttpRequest();
    var params = "RegNo="+$('#RegNo').val()+
    "&PaidAmount="+$('#PaidAmount').val()+
    "&Balance="+$('#Balance').val()+
    "&Arrears="+$('#Arrears').val()+
    "&Remarks="+$('#Remarks').val();

    xmlhttp.onprogress = function(){
        overlay.show();
        form.hide();
    };

    xmlhttp.onload = function() {
        var results = xmlhttp.responseText;

        if(results.includes('OK')){
            // Check if an element currently exists
            if (!$('#successCheck').length) {
                var successAlert = '<div id="successCheck" class="alert alert-success alert-dismissible" role="alert">Fees Collected Successfully..<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                mainForm.before(successAlert);
            }
            setTimeout(function(){ 
                $('#RegNo').val('');
                $('#PaidAmount').val('');
                $('#Balance').val('');
                $('#Arrears').val('');
                $('#Remarks').val('');
                overlay.hide();
                form.show();
                }, 2000);
        }
        else{
            // Check if an element currently exists
            if (!$('#sqlError').length) {
                var errorAlert = '<div id="sqlError" class="alert alert-danger alert-dismissable" role="alert">'+results+'<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                mainForm.before(errorAlert);
            }
            setTimeout(function(){
                overlay.hide();
                form.show();
                }, 2000);
        }
        
    
    };

    xmlhttp.open("POST", "http://localhost/shsms/inc/addforms/addFeesCollection.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send(params);

});

//edit a Fees
$('#getEditFees').on('submit',function(e){
    e.preventDefault();

    var displayResults = $('.overlay-results');
    var overlay = $('.overlay-loading');
    var mainForm = $('#getEditFees');
    var form = $('.modalContent');
    var xmlhttp = new XMLHttpRequest();
    var params = "eid="+$('#eid').val()+
    "&editPaidAmount="+$('#editPaidAmount').val()+
    "&editBalance="+$('#editBalance').val()+
    "&editArrears="+$('#editArrears').val()+
    "&editRemarks="+$('#editRemarks').val();

    xmlhttp.onprogress = function(){
        overlay.show();
        form.hide();
    };

    xmlhttp.onload = function() {
        var results = xmlhttp.responseText;
        console.log(results);
        if(results.includes('OK.')){
            // Check if an element currently exists
            if (!$('#successCheck').length) {
                var successAlert = '<div id="successCheck" class="alert alert-success alert-dismissible" role="alert">Staff Updated Successfully..<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                mainForm.before(successAlert);
            }
            setTimeout(function(){ 
                $('#editFirstName').val('');
                $('#editLastName').val('');
                $('#editDOB').val('');
                $('#editEmail').val('');
                $('#editPosition').val('');
                $('#editGender').val('');
                $('#editEmail').val('');
                overlay.hide();
                displayResults.show();
                }, 2000);
        }
        else{
            // Check if an element currently exists
            if (!$('#sqlError').length) {
                var errorAlert = '<div id="sqlError" class="alert alert-danger alert-dismissable" role="alert">'+results+'<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                mainForm.before(errorAlert);
            }
            setTimeout(function(){
                overlay.hide();
                form.show();
                }, 2000);
        }
        
    };

    xmlhttp.open("POST", "http://localhost/shsms/inc/editforms/editFeesCollection.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send(params);

});

$('#getDeleteFees').on('submit',function(e){
    e.preventDefault();

    var msg = $('.message');
    var overlay = $('.overlay-loading');
    var displayResults = $('.overlay-results');
    var form = $('.modalContent');
    msg.html('');
    var xmlhttp = new XMLHttpRequest();
    var params = "did="+$('#did').val();

    xmlhttp.onprogress = function(){
        overlay.show();
        form.hide();
    };

    xmlhttp.onload = function() {
        var results = xmlhttp.responseText;
        
        if(results.includes('OK')){
            msg.addClass('alert-success');
            msg.append('Record Deleted Successfully..');
            msg.show();
            setTimeout(function(){ 
                overlay.hide();
                displayResults.show();
                }, 2000);
        }
        else{
            msg.addClass('alert-danger');
            msg.append(results);
            msg.show();
            setTimeout(function(){
                overlay.hide();
                displayResults.show();
                form.show();
                }, 2000);
        }
        
    };

    xmlhttp.open("POST", "http://localhost/shsms/inc/deleteforms/deleteFeesCollection.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send(params);

});

//reload page
$('#addFeesCollection').on('hidden.bs.modal', function(e) {
    
    window.location.reload();

});

$('#editFeesCollection').on('hidden.bs.modal', function(e) {
    
    window.location.reload();

});

$('#deleteFeesCollection').on('hidden.bs.modal', function(e) {
    
    window.location.reload();

});

//fetch data to fill form
$('#editFeesCollection').on('show.bs.modal', function(e) {
    var feescollectionId = $(e.relatedTarget).data('feescollectionid');

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            var results = xmlhttp.responseText;
            results = results.substring(results.indexOf("["), results.indexOf("]")+1);
            results = JSON.parse(results);
            $(e.currentTarget).find('input[name="eid"]').val(results[0]);
            $(e.currentTarget).find('input[name="editRegNo"]').val(results[1]);
            $(e.currentTarget).find('input[name="editPaidAmount"]').val(results[2]);
            $(e.currentTarget).find('input[name="editArrears"]').val(results[3]);
            $(e.currentTarget).find('input[name="editBalance"]').val(results[4]);
            $(e.currentTarget).find('input[name="editRemarks"]').val(results[5]);
        }
    };
    xmlhttp.open("GET", "feescollection.php?eid=" + feescollectionId, true);
    xmlhttp.send();
    
});

//fetch id to delete
$('#deleteFeesCollection').on('show.bs.modal', function(e) {
    var feescollectionId = $(e.relatedTarget).data('feescollectionid');
    $(e.currentTarget).find('input[name="did"]').val(feescollectionId);
});

/********************************************************************* */

/**************** Exam Results ************************/
$('#Score').keyup(function(){
    var x = Number($('#Score').val());
    var grade = gradeChecker(x);
    $('#Grade').val(grade);
});

$("#editScore").keyup(function(){
    var x = Number($('#editScore').val());
    var grade = gradeChecker(x);
    $('#editGrade').val(grade);
});

function gradeChecker(x){
    var grade = "";
    
    if(x >= 75 && x <= 100){
        grade = "A1";   
    }
    else if(x >= 70 && x <= 74){
        grade = "B2";  
    }
    else if(x >= 65 && x <= 69){
        grade = "B3";  
    }
    else if(x >= 60 && x <= 64){
        grade = "C4";  
    }
    else if(x >= 55 && x <= 59){
        grade = "C5";  
    }
    else if(x >= 50 && x <= 54){
        grade = "C6";  
    }
    else if(x >= 45 && x <= 49){
        grade = "D7";  
    }
    else if(x >= 40 && x <= 44){
        grade = "E8";  
    }
    else if(x >= 0 && x <= 39){
        grade = "F9";  
    }
    else{
        grade = 'Invalid entry.';
    }
    return grade;

}

//Add a Results
$('#getAddResults').on('submit',function(e){
    e.preventDefault();

    var msg = $('.message');
    var overlay = $('.overlay-loading');
    var form = $('.modalContent');
    var mainForm = $('#getAddResults');
    msg.html('');
    var xmlhttp = new XMLHttpRequest();
    var params = "RegNo="+$('#RegNo').val()+
    "&Category="+$('#Category').val()+
    "&Score="+$('#Score').val()+
    "&Subject="+$('#SubjectID').val()+
    "&Grade="+$('#Grade').val();

    var score = $('#Score').val();

    if(score > 0 && score <= 100){

        xmlhttp.onprogress = function(){
            overlay.show();
            form.hide();
        };

        xmlhttp.onload = function() {
            var results = xmlhttp.responseText;

            if(results.includes('OK')){
                // Check if an element currently exists
                if (!$('#successCheck').length) {
                    var successAlert = '<div id="successCheck" class="alert alert-success alert-dismissible" role="alert">Results Added Successfully..<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                    mainForm.before(successAlert);
                }
                setTimeout(function(){ 
                    overlay.hide();
                    displayResults.show();
                    }, 2000);
            }
            else{
                // Check if an element currently exists
                if (!$('#sqlError').length) {
                    var errorAlert = '<div id="sqlError" class="alert alert-danger alert-dismissable" role="alert">'+ results +'<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                    mainForm.before(errorAlert);
                }
                setTimeout(function(){
                    overlay.hide();
                    form.show();
                    }, 2000);
            }
            
        
        };

        xmlhttp.open("POST", "http://localhost/shsms/inc/addforms/addExamResults.php", true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send(params);
    }
    else{
        // Check if an element currently exists
        if (!$('#errorCheck').length) {
            var successAlert = '<div id="errorCheck" class="alert alert-danger alert-dismissible" role="alert">Students score can not be less the 0 or greater than 100.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
            mainForm.before(successAlert);
        }
    }

});

//edit a Results
$('#getEditResults').on('submit',function(e){
    e.preventDefault();

    var overlay = $('.overlay-loading');
    var mainForm = $('#getEditResults');
    var form = $('.modalContent');
    var xmlhttp = new XMLHttpRequest();
    var params = "eid="+$('#eid').val()+
    "&editRegNo="+$('#editRegNo').val()+
    "&editCategory="+$('#editCategory').val()+
    "&editScore="+$('#editScore').val()+
    "&editGrade="+$('#editGrade').val();

    var score = $('#editScore').val();

    if(score > 0 && score <= 100){
        xmlhttp.onprogress = function(){
            overlay.show();
            form.hide();
        };

        xmlhttp.onload = function() {
            var results = xmlhttp.responseText;
            console.log(results);
            if(results.includes('OK.')){
                // Check if an element currently exists
                if (!$('#successCheck').length) {
                    var successAlert = '<div id="successCheck" class="alert alert-success alert-dismissible" role="alert">Staff Updated Successfully..<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                    mainForm.before(successAlert);
                }
                setTimeout(function(){
                    overlay.hide();
                    displayResults.show();
                    }, 2000);
            }
            else{
                // Check if an element currently exists
                if (!$('#sqlError').length) {
                    var errorAlert = '<div id="sqlError" class="alert alert-danger alert-dismissable" role="alert">'+results+'<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                    mainForm.before(errorAlert);
                }
                setTimeout(function(){
                    overlay.hide();
                    form.show();
                    }, 2000);
            }
            
        };

        xmlhttp.open("POST", "http://localhost/shsms/inc/editforms/editExamResults.php", true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send(params);
        }
    else{
        // Check if an element currently exists
        if (!$('#errorCheck').length) {
            var successAlert = '<div id="errorCheck" class="alert alert-danger alert-dismissible" role="alert">Students score can not be less the 0 or greater than 100.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
            mainForm.before(successAlert);
        }
    }
});

$('#getDeleteResults').on('submit',function(e){
    e.preventDefault();

    var msg = $('.message');
    var overlay = $('.overlay-loading');
    var form = $('.modalContent');
    msg.html('');
    var xmlhttp = new XMLHttpRequest();
    var params = "did="+$('#did').val();

    console.log(params);
    xmlhttp.onprogress = function(){
        overlay.show();
        form.hide();
    };

    xmlhttp.onload = function() {
        var results = xmlhttp.responseText;
        console.log(results);
        if(results.includes('OK')){
            msg.addClass('alert-success');
            msg.append('Record Deleted Successfully..');
            msg.show();
            setTimeout(function(){ 
                overlay.hide();
                displayResults.show();
                }, 2000);
        }
        else{
            msg.addClass('alert-danger');
            msg.append(results);
            msg.show();
            setTimeout(function(){
                overlay.hide();
                displayResults.show();
                form.show();
                }, 2000);
        }
        
    };

    xmlhttp.open("POST", "http://localhost/shsms/inc/deleteforms/deleteExamResults.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send(params);

});

//reload page
$('#addExamResults').on('hidden.bs.modal', function(e) {
    
    window.location.reload();

});

$('#editExamResults').on('hidden.bs.modal', function(e) {
    
    window.location.reload();

});

$('#deleteExamResults').on('hidden.bs.modal', function(e) {
    window.location.reload();
});

//fetch data to fill form
$('#editExamResults').on('show.bs.modal', function(e) {
    var examresultsId = $(e.relatedTarget).data('examresultsid');

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            var results = xmlhttp.responseText;
            results = results.substring(results.indexOf("["), results.indexOf("]")+1);
            results = JSON.parse(results);
            $(e.currentTarget).find('input[name="eid"]').val(results[0]);
            $(e.currentTarget).find('input[name="editRegNo"]').val(results[1]);
            $(e.currentTarget).find('select[name="editCategory"]').val(results[2]);
            $(e.currentTarget).find('input[name="editScore"]').val(results[3]);
            $(e.currentTarget).find('input[name="editGrade"]').val(results[4]);
        }
    };
    xmlhttp.open("GET", "examresults.php?eid=" + examresultsId, true);
    xmlhttp.send();
    
});

//fetch id to delete
$('#deleteExamResults').on('show.bs.modal', function(e) {
    var examresultsId = $(e.relatedTarget).data('examresultsid');
    $(e.currentTarget).find('input[name="did"]').val(examresultsId);
});

/********************************************************************* */


/************************ Parents ***************************/
$('#editParent').on('show.bs.modal', function(e) {
    var parentId = $(e.relatedTarget).data('parentid');
    console.log(parentId);
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            var results = xmlhttp.responseText;
            console.log(results);
            results = results.substring(results.indexOf("["), results.indexOf("]")+1);
            results = JSON.parse(results);
            $(e.currentTarget).find('input[name="eid"]').val(results[0]);
            $(e.currentTarget).find('input[name="editParentsFirstName"]').val(results[1]);
            $(e.currentTarget).find('input[name="editParentsLastName"]').val(results[2]);
            $(e.currentTarget).find('input[name="editParentsPhone"]').val(results[3]);
            $(e.currentTarget).find('input[name="editParentsEmail"]').val(results[4]);
            $(e.currentTarget).find('input[name="editParentsAddress"]').val(results[5]);
        }
    };
    xmlhttp.open("GET", "parents.php?eid=" + parentId, true);
    xmlhttp.send();
    
});

$('#deleteParent').on('show.bs.modal', function(e) {
    var parentId = $(e.relatedTarget).data('parentid');
    $(e.currentTarget).find('input[name="did"]').val(parentId);
});
/***********************************************************/

/************************ Events ***************************/
$('#editEvent').on('show.bs.modal', function(e) {
    var eventId = $(e.relatedTarget).data('eventid');
    console.log(eventId);
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            var results = xmlhttp.responseText;
            console.log(results);
            results = results.substring(results.indexOf("["), results.indexOf("]")+1);
            results = JSON.parse(results);
            $(e.currentTarget).find('input[name="eid"]').val(results[0]);
            $(e.currentTarget).find('input[name="editEventName"]').val(results[1]);
            $(e.currentTarget).find('input[name="editEventDate"]').val(results[2]);
            $(e.currentTarget).find('textarea[name="editEventDetails"]').val(results[3]);
        }
    };
    xmlhttp.open("GET", "events.php?eid=" + eventId, true);
    xmlhttp.send();
    
});

$('#deleteEvent').on('show.bs.modal', function(e) {
    var eventId = $(e.relatedTarget).data('eventid');
    $(e.currentTarget).find('input[name="did"]').val(eventId);
});
/***********************************************************/

/************************ Notices ***************************/
$('#editNotice').on('show.bs.modal', function(e) {
    var noticeId = $(e.relatedTarget).data('noticeid');
    console.log(noticeId);
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            var results = xmlhttp.responseText;
            console.log(results);
            results = results.substring(results.indexOf("["), results.indexOf("]")+1);
            results = JSON.parse(results);
            $(e.currentTarget).find('input[name="eid"]').val(results[0]);
            $(e.currentTarget).find('input[name="editNoticeName"]').val(results[1]);
            $(e.currentTarget).find('input[name="editNoticeDate"]').val(results[2]);
            $(e.currentTarget).find('textarea[name="editNoticeDetails"]').val(results[3]);
        }
    };
    xmlhttp.open("GET", "notices.php?eid=" + noticeId, true);
    xmlhttp.send();
    

    /*$(e.currentTarget).find('input[name="studentid"]').val(studentId);*/
});

$('#deleteNotice').on('show.bs.modal', function(e) {
    var noticeId = $(e.relatedTarget).data('noticeid');
    $(e.currentTarget).find('input[name="did"]').val(noticeId);
});
/***********************************************************/

/************************ Profile ***************************/
//edit a profile
$('#getEditFees').on('submit',function(e){
    e.preventDefault();

    var displayResults = $('.overlay-results');
    var overlay = $('.overlay-loading');
    var mainForm = $('#getEditFees');
    var form = $('.modalContent');
    var xmlhttp = new XMLHttpRequest();
    var params = "eid="+$('#eid').val()+
    "&editPaidAmount="+$('#editPaidAmount').val()+
    "&editBalance="+$('#editBalance').val()+
    "&editArrears="+$('#editArrears').val()+
    "&editRemarks="+$('#editRemarks').val();

    xmlhttp.onprogress = function(){
        overlay.show();
        form.hide();
    };

    xmlhttp.onload = function() {
        var results = xmlhttp.responseText;
        console.log(results);
        if(results.includes('OK.')){
            // Check if an element currently exists
            if (!$('#successCheck').length) {
                var successAlert = '<div id="successCheck" class="alert alert-success alert-dismissible" role="alert">Staff Updated Successfully..<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                mainForm.before(successAlert);
            }
            setTimeout(function(){ 
                $('#editFirstName').val('');
                $('#editLastName').val('');
                $('#editDOB').val('');
                $('#editEmail').val('');
                $('#editPosition').val('');
                $('#editGender').val('');
                $('#editEmail').val('');
                overlay.hide();
                displayResults.show();
                }, 2000);
        }
        else{
            // Check if an element currently exists
            if (!$('#sqlError').length) {
                var errorAlert = '<div id="sqlError" class="alert alert-danger alert-dismissable" role="alert">'+results+'<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                mainForm.before(errorAlert);
            }
            setTimeout(function(){
                overlay.hide();
                form.show();
                }, 2000);
        }
        
    };

    xmlhttp.open("POST", "http://localhost/shsms/inc/editforms/editFeesCollection.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send(params);

});

/***
 *TODO:
 * Add a print event to the profile page..
 */
$("#btnReport").click(function() {
    var msg = "Testing pdf print..";
    doc.text(msg, 15, 15, {
        'width': 170,
            'elementHandlers': specialElementHandlers
    });
    doc.save('test.pdf');
  });

$('#getEditPass').on('submit',function(e){
    e.preventDefault();

    var displayResults = $('.overlay-results');
    var overlay = $('.overlay-loading');
    var mainForm = $('#getEditPass');
    var form = $('.modalContent');
    var xmlhttp = new XMLHttpRequest();
    var params = "pid="+$('#pid').val()+
    "&editNewPassword="+$('#editNewPassword').val();

    console.log($('#pid').val());
    var newPass = $('#editNewPassword').val();
    var newPassConfirm = $('#editNewConfirmPassword').val();

    if(newPass === newPassConfirm){

        xmlhttp.onprogress = function(){
            overlay.show();
            form.hide();
        };
    
        xmlhttp.onload = function() {
            var results = xmlhttp.responseText;
            console.log(results);
            console.log('results are in.');
            if(results.includes('OK.')){
                // Check if an element currently exists
                if (!$('#successCheck').length) {
                    var successAlert = '<div id="successCheck" class="alert alert-success alert-dismissible" role="alert">Password Updated Successfully..<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                    mainForm.before(successAlert);
                }
                setTimeout(function(){
                    overlay.hide();
                    displayResults.show();
                    }, 2000);
            }
            else{
                // Check if an element currently exists
                if (!$('#sqlError').length) {
                    var errorAlert = '<div id="sqlError" class="alert alert-danger alert-dismissable" role="alert">'+results+'<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                    mainForm.before(errorAlert);
                }
                setTimeout(function(){
                    overlay.hide();
                    form.show();
                    }, 2000);
            }
            
        };
    
        xmlhttp.open("POST", "http://localhost/shsms/inc/editforms/editPassword.php", true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send(params);
    }
    else{
        // Check if an element currently exists
        if (!$('#errorCheck').length) {
            var errorNew = '<div id="errorCheck" class="alert alert-danger alert-dismissible" role="alert">The passwords do not match.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
            mainForm.before(errorNew);
        }
    }

});

$('#editPassword').on('hidden.bs.modal', function(e) {
    
    window.location.reload();

});
/***********************************************************/
})(jQuery);
