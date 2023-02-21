// JavaScript Document
function ViewAuditTrail() {
    LoadAuditTrailSearch();
    var myRequest = new ajaxObject("Application/AuditTrail.php");
    myRequest.callback = function (responseText) {
        $(document).ready(
            function () {
                $('#service_table').DataTable(
                    {
                        dom: 'Bfrtip',
                        lengthMenu: [
                            [10, 25, 50, 100, -1],
                            ['10 rows', '25 rows', '50 rows', '100 rows', 'Show all']
                        ],
                        buttons: [
                            {
                                extend: 'excel',
                                exportOptions: {
                                    columns: ':gt(0)'
                                }
                            },
                            {
                                extend: 'csv',
                                exportOptions: {
                                    columns: ':gt(0)'
                                }
                            },
                            {
                                extend: 'pdf',
                                exportOptions: {
                                    columns: ':gt(0)'
                                }
                            },
                            {
                                extend: 'print',
                                exportOptions: {
                                    columns: ':gt(0)'
                                }
                            },
                            {
                                extend: 'copy',
                                exportOptions: {
                                    columns: ':gt(0)'
                                }
                            },
                            {
                                extend: 'pageLength',
                                exportOptions: {
                                    columns: ':gt(0)'
                                }
                            }
                        ]
                    });
            });
        document.getElementById('main_window').innerHTML = responseText;
    }
    myRequest.update();
}
function ViewLogonErrors() {
    LoadLogonErrorsSearch();
    var myRequest = new ajaxObject("Application/LogonErrors.php");
    myRequest.callback = function (responseText) {
        $(document).ready(
            function () {
                $('#service_table').DataTable(
                    {
                        dom: 'Bfrtip',
                        lengthMenu: [
                            [10, 25, 50, 100, -1],
                            ['10 rows', '25 rows', '50 rows', '100 rows', 'Show all']
                        ],
                        buttons: [
                            {
                                extend: 'excel',
                                exportOptions: {
                                    columns: ':gt(0)'
                                }
                            },
                            {
                                extend: 'csv',
                                exportOptions: {
                                    columns: ':gt(0)'
                                }
                            },
                            {
                                extend: 'pdf',
                                exportOptions: {
                                    columns: ':gt(0)'
                                }
                            },
                            {
                                extend: 'print',
                                exportOptions: {
                                    columns: ':gt(0)'
                                }
                            },
                            {
                                extend: 'copy',
                                exportOptions: {
                                    columns: ':gt(0)'
                                }
                            },
                            {
                                extend: 'pageLength',
                                exportOptions: {
                                    columns: ':gt(0)'
                                }
                            }
                        ]
                    });
            });
        //alert_box(responseText);
        document.getElementById('main_window').innerHTML = responseText;
    }
    myRequest.update();
}
function LoadAuditTrailSearch() {
    var myRequest = new ajaxObject("Application/ShowAuditTrailSearch.php");
    myRequest.callback = function (responseText) {
        //alert_box(responseText);
        document.getElementById('search_bar').innerHTML = responseText;
        if (document.getElementById('search_bar').style.display == 'none' || document.getElementById('search_bar').style.display == '') {
            document.getElementById('search_bar').style.display = 'block';
        }
    }
    myRequest.update();
}
function LoadLogonErrorsSearch() {
    var myRequest = new ajaxObject("Application/ShowLogonErrorsSearch.php");
    myRequest.callback = function (responseText) {
        //alert_box(responseText);
        document.getElementById('search_bar').innerHTML = responseText;
        if (document.getElementById('search_bar').style.display == 'none' || document.getElementById('search_bar').style.display == '') {
            document.getElementById('search_bar').style.display = 'block';
        }
    }
    myRequest.update();
}
function DisplayLoginErrorSearch() {
    var UserName = document.getElementById('UserName').value;
    var FromDate = document.getElementById('FromDate').value;
    var ToDate = document.getElementById('ToDate').value;
    /*
    alert(UserName);
    alert(FromDate);
    alert(ToDate);*/
    var myRequest = new ajaxObject('Application/LogonErrorsSearch.php?UserName=' + UserName + '&FromDate=' + FromDate + '&ToDate=' + ToDate + '&');
    myRequest.callback = function (responseText) {
        $(document).ready(
            function () {
                $('#service_table').DataTable(
                    {
                        dom: 'Bfrtip',
                        lengthMenu: [
                            [10, 25, 50, 100, -1],
                            ['10 rows', '25 rows', '50 rows', '100 rows', 'Show all']
                        ],
                        buttons: [
                            {
                                extend: 'excel',
                                exportOptions: {
                                    columns: ':gt(0)'
                                }
                            },
                            {
                                extend: 'csv',
                                exportOptions: {
                                    columns: ':gt(0)'
                                }
                            },
                            {
                                extend: 'pdf',
                                exportOptions: {
                                    columns: ':gt(0)'
                                }
                            },
                            {
                                extend: 'print',
                                exportOptions: {
                                    columns: ':gt(0)'
                                }
                            },
                            {
                                extend: 'copy',
                                exportOptions: {
                                    columns: ':gt(0)'
                                }
                            },
                            {
                                extend: 'pageLength',
                                exportOptions: {
                                    columns: ':gt(0)'
                                }
                            }
                        ]
                    });
            });
        document.getElementById('main_window').innerHTML = responseText;
    }
    myRequest.update();
}
function DisplayAuditTrailSearch() {
    var AuditAction = document.getElementById('AuditAction').value;
    var Table = document.getElementById('Table').value;
    var Field = document.getElementById('Field').value;
    var FromDate = document.getElementById('FromDate').value;
    var ToDate = document.getElementById('ToDate').value;
    //if (AuditAction =='')
    if (AuditAction == '- Select -') {
        ActionValue = '';
    }
    else {
        ActionValue = AuditAction;
    }
    if (Table == '- Select -') {
        TableName = '';
    }
    else {
        TableName = Table;
    }
    if (Field == '- Select -') {
        FieldValue = '';
    }
    else {
        FieldValue = Field;
    }
    var myRequest = new ajaxObject('Application/AuditTrailSearch.php?ActionValue=' + ActionValue + '&TableName=' + TableName + '&FieldValue=' + FieldValue + '&FromDate=' + FromDate + '&ToDate=' + ToDate + '&');
    myRequest.callback = function (responseText) {
        document.getElementById('main_window').innerHTML = responseText;
    }
    myRequest.update();
}
function GetATdetails(Id) {
    alert(Id);
}
function GetFieldName() {
    var Tbl = document.getElementById('Table');
    var TableNameValue = Tbl.options[Tbl.selectedIndex].value;
    if (TableNameValue == '- Select -') {
        TableName = '';
    }
    else {
        TableName = TableNameValue;
    }
    var myRequest = new ajaxObject("Include/ShowDropDown.php?TableName=" + TableName + "&");
    myRequest.callback = function (responseText) {
        //alert_box(responseText);
        document.getElementById('show_my_fields').innerHTML = responseText;
    }
    myRequest.update();
}
function AuditTrailDashBoard() {
	//This function will be used to display patients on the browser window
	var pname = "Application/AuditTrailDashBoard.php";
	var myRequest = new ajaxObject(pname);
	myRequest.callback = function (responseText) {
		document.getElementById('main_window').innerHTML = responseText;
	}
	myRequest.update();
}