function LateRedirect(url){
  setTimeout(() => {
    location.href = url;
  }, 1000);
}
