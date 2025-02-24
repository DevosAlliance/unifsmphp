/*=============== TAB ===============*/
const tabs = document.querySelectorAll(".tab__btn");
const all_content = document.querySelectorAll(".g__content");

if (tabs.length === 0 || all_content.length === 0) {
  console.error("Erro");
}

tabs.forEach((tab, index) => {
  tab.addEventListener("click", () => {
    tabs.forEach((tab) => {
      tab.classList.remove("active");
    });
    tab.classList.add("active");

    all_content.forEach((content) => {
      content.classList.remove("active");
    });
    all_content[index].classList.add("active");
  });
});
