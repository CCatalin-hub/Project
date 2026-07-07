document.addEventListener("DOMContentLoaded", () => {
  const sortSelect = document.getElementById("sort");
  const btn = document.getElementById("orderBtn");
  const siteUrl = document.querySelector('meta[name="site-url"]').content;
  const params = new URLSearchParams(window.location.search);

  let sort = params.get("sort") || "name";
  let order = params.get("order") || "asc";

  sortSelect.value = sort;
  btn.textContent = order === "asc" ? "⮝" : "⮟";

  function redirect() {
    params.set("sort", sort);
    params.set("order", order);
    window.location.search = params.toString();
  }

  sortSelect.addEventListener("change", () => {
    sort = sortSelect.value;
    redirect();
  });

  btn.addEventListener("click", () => {
    order = order === "asc" ? "desc" : "asc";
    btn.textContent = order === "asc" ? "⮝" : "⮟";

    redirect();
  });
  
  const searchInput = document.getElementById("search");
  const goBtn = document.getElementById("go");

  function goSearch() {
    const value = searchInput.value.trim();
    if (!value) return;

    const b64 = btoa(unescape(encodeURIComponent(value))).replace(/\+/g, '-').replace(/\//g, '_').replace(/=+$/g, '');

    window.location.href = siteUrl + "/GameBD/recherche/" + b64;
  }

  if (goBtn) {
    goBtn.addEventListener("click", goSearch);
  }

  if (searchInput) {
    searchInput.addEventListener("keydown", (e) => {
      if (e.key === "Enter") {
        e.preventDefault();
        goSearch();
      }
    });
  }
});
