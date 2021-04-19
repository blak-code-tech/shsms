
(function ($) {
    "use strict";


    /*==================================================================
    [ Validate ]*/
    var input = $('.validate-input .input100');

    $('.validate-form').on('submit',function(){
        var check = true;

        for(var i=0; i<input.length; i++) {
            if(validate(input[i]) == false){
                showValidate(input[i]);
                check=false;
            }
        }

        return check;
    });


    $('.validate-form .input100').each(function(){
        $(this).focus(function(){
           hideValidate(this);
        });
    });

    function validate (input) {
        if($(input).attr('type') == 'email' || $(input).attr('name') == 'email') {
            if($(input).val().trim().match(/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{1,5}|[0-9]{1,3})(\]?)$/) == null) {
                return false;
            }
        }
        else {
            if($(input).val().trim() == ''){
                return false;
            }
        }
    }

    function showValidate(input) {
        var thisAlert = $(input).parent();

        $(thisAlert).addClass('alert-validate');
    }

    function hideValidate(input) {
        var thisAlert = $(input).parent();

        $(thisAlert).removeClass('alert-validate');
    }
    
    

})(jQuery);

$('#editStudent').on('show.bs.modal', function(e) {
    var studentId = $(e.relatedTarget).data('studentid');

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            var results = xmlhttp.responseText;
            results = results.substring(results.indexOf("["), results.indexOf("]")+1);
            results = JSON.parse(results);
            console.log(results);
            $(e.currentTarget).find('input[name="eid"]').val(results[0]);
            $(e.currentTarget).find('input[name="editStudentID"]').val(results[0]);
            $(e.currentTarget).find('input[name="editFirstName"]').val(results[1]);
            $(e.currentTarget).find('input[name="editLastName"]').val(results[2]);
            $(e.currentTarget).find('select[name="editGender"]').val(results[3]);
            $(e.currentTarget).find('input[name="editDOB"]').val(results[4]);
            $(e.currentTarget).find('select[name="editHostelID"]').val(results[5]);
            $(e.currentTarget).find('select[name="editClassID"]').val(results[6]);
        }

    };
    xmlhttp.open("GET", "students.php?eid=" + studentId, true);
    xmlhttp.send();
    

    /*$(e.currentTarget).find('input[name="studentid"]').val(studentId);*/
});

$('#deleteStudent').on('show.bs.modal', function(e) {
    var studentId = $(e.relatedTarget).data('studentid');
    $(e.currentTarget).find('input[name="did"]').val(studentId);
});

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
    

    /*$(e.currentTarget).find('input[name="studentid"]').val(studentId);*/
});

$('#deleteSubject').on('show.bs.modal', function(e) {
    var studentId = $(e.relatedTarget).data('subjectid');
    $(e.currentTarget).find('input[name="did"]').val(studentId);
});

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

$('#deleteBank').on('show.bs.modal', function(e) {
    var bankId = $(e.relatedTarget).data('bankid');
    $(e.currentTarget).find('input[name="did"]').val(bankId);
});

$('#editTeacher').on('show.bs.modal', function(e) {
    var teacherId = $(e.relatedTarget).data('teacherid');
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
        }
    };
    xmlhttp.open("GET", "teachers.php?eid=" + teacherId, true);
    xmlhttp.send();
    
});

$('#deleteTeacher').on('show.bs.modal', function(e) {
    var teacherId = $(e.relatedTarget).data('teacherid');
    $(e.currentTarget).find('input[name="did"]').val(teacherId);
});

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

$('#deleteFeesCollection').on('show.bs.modal', function(e) {
    var feescollectionId = $(e.relatedTarget).data('feescollectionid');
    $(e.currentTarget).find('input[name="did"]').val(feescollectionId);
});

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

$('#deleteHostel').on('show.bs.modal', function(e) {
    var hostelId = $(e.relatedTarget).data('hostelid');
    $(e.currentTarget).find('input[name="did"]').val(hostelId);
});

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

$('#deleteClass').on('show.bs.modal', function(e) {
    var classId = $(e.relatedTarget).data('classid');
    $(e.currentTarget).find('input[name="did"]').val(classId);
});

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
    

    /*$(e.currentTarget).find('input[name="studentid"]').val(studentId);*/
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
    

    /*$(e.currentTarget).find('input[name="studentid"]').val(studentId);*/
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