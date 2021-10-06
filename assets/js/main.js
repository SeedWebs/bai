// SCROLL FX

function isInViewport(el) {
  const rect = el.getBoundingClientRect();
  return rect.top <= (window.innerHeight || document.documentElement.clientHeight);
}

const elms = document.querySelectorAll(".site-loop .wp-block-columns, .entry-image > img, .entry-content > *, .s-fx");

function scroll_fx() {
  elms.forEach(function (elm) {
    if (isInViewport(elm)) {
      elm.classList.add("-show");
    } else {
      elm.classList.remove("-show");
    }
  });
}
document.addEventListener("DOMContentLoaded", scroll_fx);
window.addEventListener("scroll", scroll_fx, { passive: true });
window.addEventListener("resize", scroll_fx, true);
