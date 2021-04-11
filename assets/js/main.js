

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
            $(e.currentTarget).find('input[name="editFirstName"]').val(results[1]);
            $(e.currentTarget).find('input[name="editLastName"]').val(results[2]);
            document.getElementById('editGender').value=results[3];
            //$(e.currentTarget).find('input[name="editGender"]').val(results[3]);
            $(e.currentTarget).find('input[name="editDOB"]').val(results[4]);
            $(e.currentTarget).find('input[name="editRegNo"]').val(results[5]);
            document.getElementById('editHostel').value=results[6];
            //$(e.currentTarget).find('input[name="studentid"]').val(results[6]);
            document.getElementById('editClass').value=results[7];
            //$(e.currentTarget).find('input[name="studentid"]').val(results[7]);
            $(e.currentTarget).find('input[name="editTotalFees"]').val(results[8]);
            $(e.currentTarget).find('input[name="editAdvanceFees"]').val(results[9]);
            $(e.currentTarget).find('input[name="editBalance"]').val(results[10]);
            $(e.currentTarget).find('input[name="editGuardian"]').val(results[11]);
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
            console.log(results);
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
            console.log(results);
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
            console.log(results);
            results = results.substring(results.indexOf("["), results.indexOf("]")+1);
            results = JSON.parse(results);
            console.log(results);
            $(e.currentTarget).find('input[name="eid"]').val(results[0]);
            $(e.currentTarget).find('input[name="editFirstName"]').val(results[1]);
            $(e.currentTarget).find('input[name="editLastName"]').val(results[2]);
            $(e.currentTarget).find('input[name="editDOB"]').val(results[3]);
            $(e.currentTarget).find('input[name="editEmail"]').val(results[4]);
            $(e.currentTarget).find('input[name="editPhone"]').val(results[5]);
            document.getElementById('editGender').value=results[6];
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
            console.log(results);
            results = results.substring(results.indexOf("["), results.indexOf("]")+1);
            results = JSON.parse(results);
            console.log(results);
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
            console.log(results);
            results = results.substring(results.indexOf("["), results.indexOf("]")+1);
            results = JSON.parse(results);
            console.log(results);
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