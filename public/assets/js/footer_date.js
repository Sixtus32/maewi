// Mostrar fecha del año actual.
let footerDate = new Date().getFullYear();

document.querySelector("#footer-data").innerHTML = `
&copy; Copyright ${footerDate}
Made <i class='ti-heart text-danger'>
</i> By <a href='<?=BASE_URL?>'>Maewi</a>`;
