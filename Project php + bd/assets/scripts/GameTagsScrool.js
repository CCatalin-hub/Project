document.addEventListener('DOMContentLoaded', () => {
  const tagsList = document.querySelectorAll('.tags');

  console.log('tags found:', tagsList.length);

  tagsList.forEach(el => {
    el.addEventListener('wheel', (e) => {
      e.preventDefault();
      el.scrollLeft += e.deltaY;
    }, { passive: false });
  });
});
