// active nav item
const navItem = document.getElementsByClassName("nav-link");
for (const element of navItem) {
   element.addEventListener("click", () => {
      for (const ele of navItem) {
         ele.classList.remove("active");
      }
      element.classList.add("active");
   });
}

// input file preview
const previewImage = (id) => {
   document.getElementById(id).src = URL.createObjectURL(event.target.files[0]);
};

// tab profile
const tabs = document.getElementsByClassName("tab");
const contents = document.getElementsByClassName("content");
for (const element of tabs) {
   const tabId = element.getAttribute("tab-id");
   const content = document.getElementById(tabId);
   element.addEventListener("click", () => {
      for (const t of tabs) {
         t.classList.remove("active");
      }
      for (const c of contents) {
         c.classList.remove("active");
      }
      element.classList.add("active");
      content.classList.add("active");
   });
}




const toggleSideMenu = () => {
   document.getElementById("sidebar").classList.toggle("active");
   document.getElementById("content").classList.toggle("active");
};


// Cookies & Privacy
if (localStorage.getItem('cookie-value') == 1 || sessionStorage.getItem('cookie-value') == 1){
    $('.cookie-content').remove();
} else{
    $('.cookie-content').removeClass('d-none');
}

$('#cookie-accept').on("click", function (){
    localStorage.setItem('cookie-value', 1);
    sessionStorage.removeItem('cookie-value');
    $('.cookie-content').remove();
});

$('#cookie-deny').on("click", function (){
    sessionStorage.setItem('cookie-value', 1);
    localStorage.removeItem('cookie-value');
    $('.cookie-content').remove();
});
