function add_member(event) {
    dismiss(1);
    show();
    setTimeout(() => {
        document.getElementById("Add").submit();
    }, 1000);
}

function edit_member(event) {
    dismiss(3);
    show(4);
    setTimeout(() => {
        document.getElementById("Edit").submit();
    }, 1000);
}

function add_staff(event) {
    dismiss(1);
    show();
    setTimeout(() => {
        document.getElementById("Add").submit();
    }, 1000);
}

function edit_staff(event) {
    dismiss(3);
    show(4);
    setTimeout(() => {
        document.getElementById("Edit").submit();
    }, 1000);
}