/*=============== ACCORDION ===============*/
const accordions = document.querySelectorAll(".accordion");

accordions.forEach((item) => {
  item.addEventListener("click", () => {
    if (item.matches(".active")) {
      item.classList.remove("active");
    } else {
      accordions.forEach((item) => {
        item.classList.remove("active");
      });
      item.classList.add("active");
    }
  });
});
