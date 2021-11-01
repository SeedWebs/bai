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
    }
  });
}
document.addEventListener("DOMContentLoaded", scroll_fx);
window.addEventListener("scroll", scroll_fx, { passive: true });
window.addEventListener("resize", scroll_fx, true);

// DARK MODE
let mode = localStorage.getItem("s-mode") || "";
if (!mode) {
  if (window.matchMedia && window.matchMedia("(prefers-color-scheme: dark)").matches) {
    mode = "dark";
    document.getElementById("s-mode").classList.add("active");
  } else {
    mode = "light";
  }
} else {
  if (mode == "dark") {
    document.getElementById("s-mode").classList.add("active");
  }
}
document.body.classList.add("s-" + mode);

document.getElementById("s-mode").addEventListener("click", () => {
  if (document.body.classList.contains("s-dark")) {
    document.body.classList.add("s-light");
    document.body.classList.remove("s-dark");
    localStorage.setItem("s-mode", "light");
  } else {
    document.body.classList.add("s-dark");
    document.body.classList.remove("s-light");
    localStorage.setItem("s-mode", "dark");
  }
  document.getElementById("s-mode").classList.toggle("active");
});
