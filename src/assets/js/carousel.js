document.addEventListener("DOMContentLoaded", () => {
  const carousel = document.querySelector(".carousel");
  if (!carousel) return; // Evita erros se o elemento não existir

  const arrowsBtns = document.querySelectorAll(".icon__arrow");
  const firstCard = carousel.querySelector(".card");
  if (!firstCard) return; // Evita erros se não houver cards

  const firstCardWidth = firstCard.offsetWidth;
  const carouselChildrens = [...carousel.children];

  let cardPerView = Math.round(carousel.offsetWidth / firstCardWidth);

  // Duplicação dos cards para efeito de loop infinito
  carouselChildrens.slice(-cardPerView).reverse().forEach((card) => {
    carousel.insertAdjacentHTML("afterbegin", card.outerHTML);
  });
  carouselChildrens.slice(0, cardPerView).forEach((card) => {
    carousel.insertAdjacentHTML("beforeend", card.outerHTML);
  });

  // Botões de navegação
  arrowsBtns.forEach((btn) => {
    btn.addEventListener("click", () => {
      const direction = btn.id === "a_left" ? -firstCardWidth : firstCardWidth;
      carousel.scrollLeft += direction;
      console.log("Scroll Left:", carousel.scrollLeft);
    });
  });
  

  // Função de rolagem infinita
  const infiniteScroll = () => {
    if (carousel.scrollLeft <= 0) {
      carousel.scrollLeft = carousel.scrollWidth - 2 * carousel.offsetWidth;
    } else if (
      Math.ceil(carousel.scrollLeft) >=
      carousel.scrollWidth - carousel.offsetWidth
    ) {
      carousel.scrollLeft = carousel.offsetWidth;
    }
  };

  carousel.addEventListener("scroll", infiniteScroll);
});
