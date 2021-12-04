function member_edit(memberID) {
    $.post("GetMember_Detail.php", {memberID: memberID}, (data)=>{
        var $memberData = JSON.parse(data);
        $("#edit_id").val($memberData.MemberID);
        $("#edit_ic").val($memberData.ICNo);
        $("#edit_Name").val($memberData.MemberName);
        $("#edit_email").val($memberData.MemberEmail);
        $("#edit_cont").val($memberData.ContactNo);
        $("#edit_username").val($memberData.Username);
        $("#edit_pass").val($memberData.Password);
        show(3);
    })
}
