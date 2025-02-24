/*=============== CAROUSEL ===============*/
const carousel = document.querySelector(".w__carousel");
const arrowsBtns = document.querySelectorAll(".icon__arrow");
const firstCardWidth = carousel.querySelector(".card__img").offsetWidth;
const carouselChildrens = [...carousel.children];

let cardPerView = Math.round(carousel.offsetWidth / firstCardWidth);

carouselChildrens
  .slice(-cardPerView)
  .reverse()
  .forEach((card) => {
    carousel.insertAdjacentHTML("afterbegin", card.outerHTML);
  });
carouselChildrens.slice(0, cardPerView).forEach((card) => {
  carousel.insertAdjacentHTML("beforeend", card.outerHTML);
});

arrowsBtns.forEach((btn) => {
  btn.addEventListener("click", () => {
    carousel.scrollLeft +=
      btn.id === "a_left" ? -firstCardWidth : firstCardWidth;
  });
});

const infiniteScroll = () => {
  if (carousel.scrollLeft === 0) {
    carousel.scrollLeft = carousel.scrollWidth - 2 * carousel.offsetWidth;
  } else if (
    Math.ceil(carousel.scrollLeft) ===
    carousel.scrollWidth - carousel.offsetWidth
  ) {
    carousel.scrollLeft = carousel.offsetWidth;
  }
};

carousel.addEventListener("scroll", infiniteScroll);
