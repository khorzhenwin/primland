function staff_edit(UserID) {
    $.post("GetStaff_Detail.php", {UserID: UserID}, (data)=>{
        var $UserData = JSON.parse(data);
        $("#edit_uid").val($UserData.AdminID);
        $("#edit_phone").val($UserData.AdminContactNo);
        $("#edit_name").val($UserData.AdminUsername);
        $("#edit_pass").val($UserData.AdminPassword);

        show(3);
    })
}
