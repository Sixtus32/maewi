<section class="chats chats_popup" id="chats-popup">
    <header>
        <div class="content">

            <img src="<?= $_SESSION['user_profile_photo'] ?>" alt="image_profile">
            <div class="details">
                <span><?php echo $_SESSION['user_name'] . " " . $_SESSION['user_surname'] ?></span>
                <span class="state">Active Now</span>
            </div>
        </div>
        <div class="close" id="chats-close">
            <i class="ri-close-circle-line"></i>
        </div>
    </header>
    <div class="search">
        <span class="text">Seleccione un contacto para iniciar el chat</span>
        <input type="text" placeholder="Introduce el usuario a buscar...">
        <button><i class="fas fa-search"></i></button>
    </div>

    <div class="users-list"></div>
</section>

<style>
    .chats_popup {
        position: absolute;
        left: 50%;
        bottom: 47.75%;
        /* background: #fff; */
        padding: 15px;
        border-radius: 15px;
        max-width: 380px;
        width: 100%;
        opacity: 0;
        pointer-events: none;
        box-shadow: 0px 10px 15px rgba(0, 0, 0, 0.1);
        z-index: 1000;
        margin: auto 0;
        padding: 10px;
        transition: opacity 0.3s ease, transform 0.3s ease;
        background-repeat: repeat;
        background-position: center;
        background-color: #FFFFFF;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='100%25' height='100%25' %3E%3Cdefs%3E%3ClinearGradient id='a' x1='0' x2='0' y1='0' y2='1'%3E%3Cstop offset='0' stop-color='%23FFFFFF'/%3E%3Cstop offset='1' stop-color='%23F1F5F0'/%3E%3C/linearGradient%3E%3C/defs%3E%3Cpattern id='b' width='6' height='6' patternUnits='userSpaceOnUse'%3E%3Ccircle fill='%23FFFFFF' cx='3' cy='3' r='3'/%3E%3C/pattern%3E%3Crect width='100%25' height='100%25' fill='url(%23a)'/%3E%3Crect width='100%25' height='100%25' fill='url(%23b)' fill-opacity='0.86'/%3E%3C/svg%3E");
        background-attachment: fixed;
    }

    .chats_popup.show {
        position: fixed;
        opacity: 1;
        pointer-events: auto;
        transform: translate(-50%, -50%) scale(1);
    }

    @media screen and (min-width: 777px) {
        .chats_popup.show {
            left: 275.25px;
            bottom: 325px;
        }
    }

    @media screen and (min-width: 1165px) {
        .chats_popup.show {
            left: 495.5px;
            bottom: 320px;
        }
    }

    .chats header {
        display: flex;
        align-items: center;
        border-bottom: 1px solid #e6e6e6;
        justify-content: space-between;
        margin-bottom: 1rem;
        padding-bottom: 1rem;
        transition: background-color 0.3s ease;
    }

    .chats header:hover {
        background-color: #f0f0f0;
        padding: 0.5rem;
        border-radius: 10px;
    }

    .chats header .content img {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        transition: transform 0.3s ease;
    }

    .chats header:hover .content img {
        transform: scale(1.1);
    }

    .chats header .content .details {
        display: grid;
        justify-content: center;
        align-items: center;
        transition: color 0.3s ease;
    }

    .chats header:hover .content .details span {
        color: #333;
    }

    :is(.chats, .user-list) .content {
        display: flex;
        align-items: center;
        column-gap: 1rem;
    }

    .chats header .close {
        padding: 6px 10px;
        font-size: 16px;
        cursor: pointer;
        transition: color 0.3s ease;
    }

    .chats header .close:hover {
        color: #ff0000;
    }

    .chats header .close i {
        font-size: 1.5rem;
    }

    .chats .state {
        font-size: .75rem;
        transition: color 0.3s ease;
    }

    .chats .search {
        margin: 20px 10px;
        display: flex;
        position: relative;
        align-items: center;
        justify-content: space-between;
    }

    .chats .search .text {
        font-size: 18px;
        transition: color 0.3s ease;
    }

    .chats .search input {
        position: absolute;
        height: 42px;
        width: calc(100% - 50px);
        font-size: 16px;
        padding: 0 13px;
        border: 1px solid #e6e6e6;
        outline: none;
        border-radius: 5px 0 0 5px;
        opacity: 0;
        pointer-events: none;
        transition: all .2s ease, opacity 0.3s ease;
    }

    .chats .search input:focus {
        opacity: 1;
        pointer-events: auto;
    }

    .chats .search button {
        position: relative;
        z-index: 1;
        width: 47px;
        height: 42px;
        font-size: 17px;
        cursor: pointer;
        border: none;
        background: #fff;
        color: #333;
        outline: none;
        border-radius: 0 5px 5px 0;
        transition: all .2s ease, background-color 0.3s ease;
    }

    .chats .search button:hover {
        background-color: #333;
        color: #fff;
    }

    .search button.active i::before {
        content: '\f00d';
    }
</style>