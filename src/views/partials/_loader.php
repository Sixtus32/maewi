<!-- ==================     LOADER  ================= -->
<div class="load" id="load">
    <img src="<?BASE_URL?>assets/img/" alt="loader image gif" class="load__gif">
</div>

<style>
    .load
    {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: #f6f6f6;
        place-items: center;
        z-index: 1000;
    }

    .load__git
    {
        width: 210px;
    }

    .loader_not_visible{
        display: none;
    }
</style>

<script>
    onload = () => {
        const load = document.querySelector('#load');
        setTimeout(() => {
            load.classList.add("loader_not_visible");
            load.classList.remove("load");
        },2200)
    }
</script>