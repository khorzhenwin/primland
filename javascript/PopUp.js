function dismiss(index = 0) {
  document.getElementsByClassName("modal")[index].classList.add("hidden");
}

function show(index = 0) {
  document.getElementsByClassName("modal")[index].classList.remove("hidden");
}