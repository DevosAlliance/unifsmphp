const searchBtn = document.querySelector(".search_btn");
const cancelBtn = document.querySelector(".cancel_btn");
const searchBox = document.querySelector(".tn_search");
const searchInput = document.querySelector(".tn_search input");
const tnLinks = document.querySelector(".tn_links");

const dropdown = document.querySelector(".dropdown");
const dropBtn = document.querySelector(".dropbtn");

let windowWidth = window.innerWidth;

searchBtn.onclick = () => {
  searchBox.classList.add("active");
  searchInput.classList.add("active");
  searchBtn.classList.add("active");
  cancelBtn.classList.add("active");
  dropdown.classList.add("hidden");
  dropBtn.classList.add("hidden");
};

cancelBtn.onclick = () => {
  searchBox.classList.remove("active");
  searchInput.classList.remove("active");
  searchBtn.classList.remove("active");
  cancelBtn.classList.remove("active");
  dropdown.classList.remove("hidden");
  if (windowWidth < 900) {
    dropBtn.classList.remove("hidden");
  }
};

function updateClasses() {
  if (windowWidth < 900) {
    dropdown.classList.add("active");
    dropBtn.classList.add("active");
    tnLinks.classList.add("dropdown-content");
    dropBtn.classList.remove("hidden");
  } else {
    dropdown.classList.remove("active");
    dropBtn.classList.remove("active");
    tnLinks.classList.remove("dropdown-content");
    dropBtn.classList.add("hidden");
  }
}

updateClasses();
window.addEventListener("resize", updateClasses);

/*=============== SHOW MENU ===============*/
const showMenu = (toggleId, navId) => {
  const toggle = document.getElementById(toggleId),
    nav = document.getElementById(navId);

  toggle.addEventListener("click", () => {
    nav.classList.toggle("show-menu");
    toggle.classList.toggle("show-icon");
  });
};

showMenu("nav-toggle", "nav-menu");

/*=============== DROPDOWN DELAY & AUTO CLOSE ===============*/
let dropdownTimeout;
const dropdownItems = document.querySelectorAll(".dropdown__item");

function closeAllDropdowns() {
    dropdownItems.forEach(item => {
        const menu = item.querySelector(".dropdown__menu");
        if (menu) {
            menu.style.opacity = "0";
            menu.style.pointerEvents = "none";
        }
    });
}

dropdownItems.forEach(item => {
    const menu = item.querySelector(".dropdown__menu");

    if (menu) {
        item.addEventListener("mouseenter", function () {
            clearTimeout(dropdownTimeout);
            closeAllDropdowns();
            menu.style.opacity = "1";
            menu.style.pointerEvents = "initial";
        });

        item.addEventListener("mouseleave", function () {
            dropdownTimeout = setTimeout(() => {
                menu.style.opacity = "0";
                menu.style.pointerEvents = "none";
            }, 500);
        });

        menu.addEventListener("mouseenter", function () {
            clearTimeout(dropdownTimeout);
        });

        menu.addEventListener("mouseleave", function () {
            dropdownTimeout = setTimeout(() => {
                menu.style.opacity = "0";
                menu.style.pointerEvents = "none";
            }, 500);
        });
    }
});