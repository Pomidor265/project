class MyHeader extends HTMLElement {
    connectedCallback() {
        this.innerHTML = `
        <header class="header my-header">
            <div class="logo-img">
                <img src="/src/icons/icon2.png">
            </div>
            <div class="title">
                <p>Энциклопедия о заболеваниях</p>
            </div>
        </header> `;
    }
};

class MyHeader_Main extends HTMLElement {
    connectedCallback() {
        const isAuth = window.isAuth === true || window.isAuth === "true";
        this.innerHTML = `
        <header class="header my-header-main">
           <div class="logo-img">
                <img src="/src/icons/icon2.png">
            </div>
            <div class="title">
                <p>Энциклопедия о заболеваниях</p>
            </div>
            <div class="right-block">
                ${!isAuth ? `
                    <button class="btn" onclick="window.location.href='register.php'">
                        Зарегистрироваться
                    </button>
                ` : ""}
                <div class="avatar" onclick="AvClick()">
                    <img src="/src/avatar.png">
                </div>
            </div>
        </header>`;
    }
}

class MyHeader_Log extends HTMLElement {
    connectedCallback() {
        let pageTitle = "";
        const currentPath = window.location.pathname;
        
        if (currentPath.includes("login.php") || currentPath.includes("login")) {
            pageTitle = "Авторизация";
        } else if (currentPath.includes("register.php") || currentPath.includes("register")) {
            pageTitle = "Регистрация";
        } else if (currentPath.includes("account.php") || currentPath.includes("account")) {
            pageTitle = "Личный кабинет";
        }
        else if (currentPath.includes("appointment.php") || currentPath.includes("appointment")) {
            pageTitle = "Запись к врачу";
        }
        this.innerHTML = `
        <header class="header my-header">
            <div class="logo-img">
                <img src="/src/icons/icon2.png">
            </div>
            <div class="center-title">
                <p>${pageTitle}</p>
            </div>
        </header> `;
    }
};

customElements.define("my-header", MyHeader);
customElements.define("my-header-main", MyHeader_Main)
customElements.define("my-header-log", MyHeader_Log)

function AvClick() {
    if (window.isAuth) {
        window.location.href = "/Pages/account.php";
    } else {
        window.location.href = "/Pages/login.php"; 
    }
}