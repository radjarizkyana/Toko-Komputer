const menuToggle = document.querySelector(".menu-bars");
const nav = document.querySelector(".list-menu");

menuToggle.addEventListener("click", () => {
  nav.classList.toggle("slide");
});

let price = $("#price").val();

let inputJmlBarang = $("#jumlah_beli");

inputJmlBarang.on("change keyup", () => {
  let total = price * inputJmlBarang.val();
  $(".price").html(`Harga yang harus dibayar : ${total}`);
});
